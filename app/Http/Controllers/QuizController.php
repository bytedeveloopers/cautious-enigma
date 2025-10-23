<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\Lesson;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Show quiz for a lesson
     */
    public function show($lessonId)
    {
        $lesson = Lesson::with('quiz.questions.answers')->findOrFail($lessonId);
        
        if (!$lesson->quiz) {
            return back()->with('error', 'Esta lección no tiene un quiz disponible');
        }

        $quiz = $lesson->quiz;
        
        // Check if user can attempt
        if (!$quiz->canUserAttempt(auth()->id())) {
            return back()->with('error', 'Has alcanzado el número máximo de intentos para este quiz');
        }

        $previousAttempts = $quiz->userAttempts(auth()->id())->orderByDesc('created_at')->get();
        $bestScore = $quiz->getUserBestScore(auth()->id());

        return view('quizzes.show', compact('lesson', 'quiz', 'previousAttempts', 'bestScore'));
    }

    /**
     * Start a quiz attempt
     */
    public function start(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        
        if (!$quiz->canUserAttempt(auth()->id())) {
            return back()->with('error', 'Has alcanzado el número máximo de intentos');
        }

        $attempt = QuizAttempt::create([
            'quiz_id' => $quizId,
            'user_id' => auth()->id(),
            'started_at' => now(),
            'total_questions' => $quiz->questions()->count()
        ]);

        return redirect()->route('quizzes.take', $attempt->id);
    }

    /**
     * Take the quiz (show questions)
     */
    public function take($attemptId)
    {
        $attempt = QuizAttempt::with('quiz.questions.answers')
            ->where('user_id', auth()->id())
            ->findOrFail($attemptId);

        if ($attempt->completed_at) {
            return redirect()->route('quizzes.result', $attemptId);
        }

        return view('quizzes.take', compact('attempt'));
    }

    /**
     * Submit quiz answers
     */
    public function submit(Request $request, $attemptId)
    {
        $attempt = QuizAttempt::with('quiz.questions')
            ->where('user_id', auth()->id())
            ->findOrFail($attemptId);

        if ($attempt->completed_at) {
            return redirect()->route('quizzes.result', $attemptId);
        }

        $quiz = $attempt->quiz;
        $userAnswers = $request->input('answers', []);
        
        $correctCount = 0;
        $totalPoints = 0;
        $answersData = [];

        foreach ($quiz->questions as $question) {
            $userAnswerId = $userAnswers[$question->id] ?? null;
            $isCorrect = $question->isCorrectAnswer($userAnswerId);
            
            if ($isCorrect) {
                $correctCount++;
                $totalPoints += $question->points;
            }

            $answersData[] = [
                'question_id' => $question->id,
                'user_answer_id' => $userAnswerId,
                'correct_answer_id' => $question->correctAnswer->id,
                'is_correct' => $isCorrect,
                'points_earned' => $isCorrect ? $question->points : 0
            ];
        }

        $score = $totalPoints; // Total points = score (0-100)
        $passed = $score >= $quiz->passing_score;

        // Calculate time spent
        $timeSpent = now()->diffInSeconds($attempt->started_at);

        $attempt->update([
            'score' => $score,
            'correct_answers' => $correctCount,
            'passed' => $passed,
            'completed_at' => now(),
            'time_spent' => $timeSpent,
            'answers' => $answersData
        ]);

        // Update lesson enrollment
        $enrollment = auth()->user()->enrolledLessons()
            ->where('lesson_id', $quiz->lesson_id)
            ->first();

        if ($enrollment) {
            $currentBestScore = $enrollment->pivot->quiz_score ?? 0;
            
            $enrollment->pivot->update([
                'quiz_score' => max($score, $currentBestScore),
                'quiz_passed' => $passed || $enrollment->pivot->quiz_passed,
                'quiz_attempts' => $enrollment->pivot->quiz_attempts + 1
            ]);

            // Award points if passed
            if ($passed && !$enrollment->pivot->completed) {
                $user = auth()->user();
                $user->increment('total_points', $quiz->lesson->points ?? 50);
            }
        }

        return redirect()->route('quizzes.result', $attemptId)
            ->with('success', $passed ? '¡Felicidades! Has aprobado el quiz' : 'No aprobaste esta vez, intenta de nuevo');
    }

    /**
     * Show quiz results
     */
    public function result($attemptId)
    {
        $attempt = QuizAttempt::with(['quiz.lesson', 'quiz.questions.answers'])
            ->where('user_id', auth()->id())
            ->findOrFail($attemptId);

        return view('quizzes.result', compact('attempt'));
    }

    /**
     * Show leaderboard/ranking
     */
    public function leaderboard()
    {
        $topStudents = \App\Models\User::where('role', 'student')
            ->withCount(['quizAttempts as passed_quizzes' => function ($query) {
                $query->where('passed', true)->distinct('quiz_id');
            }])
            ->orderByDesc('total_points')
            ->orderByDesc('completed_lessons')
            ->limit(50)
            ->get()
            ->map(function ($user, $index) {
                $user->rank = $index + 1;
                return $user;
            });

        $currentUser = auth()->user();
        $userRank = null;

        if ($currentUser && $currentUser->isStudent()) {
            $allStudents = \App\Models\User::where('role', 'student')
                ->orderByDesc('total_points')
                ->orderByDesc('completed_lessons')
                ->get();
            
            $userRank = $allStudents->search(function ($user) use ($currentUser) {
                return $user->id === $currentUser->id;
            }) + 1;
        }

        return view('quizzes.leaderboard', compact('topStudents', 'userRank'));
    }
}
