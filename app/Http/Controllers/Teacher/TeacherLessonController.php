<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;

class TeacherLessonController extends Controller
{
    /**
     * Show the form for creating a new lesson
     */
    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('teacher.lessons.create', compact('categories'));
    }

    /**
     * Store a newly created lesson
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'duration' => 'required|integer|min:1',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'points' => 'required|integer|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            
            // Quiz fields
            'create_quiz' => 'boolean',
            'quiz_title' => 'required_if:create_quiz,true|string|max:255',
            'passing_score' => 'required_if:create_quiz,true|integer|min:0|max:100',
            'max_attempts' => 'required_if:create_quiz,true|integer|min:1|max:10',
            
            // Questions
            'questions' => 'required_if:create_quiz,true|array|min:4|max:4',
            'questions.*.question' => 'required_if:create_quiz,true|string',
            'questions.*.answers' => 'required_if:create_quiz,true|array|min:3|max:3',
            'questions.*.answers.*.text' => 'required_if:create_quiz,true|string',
            'questions.*.correct_answer' => 'required_if:create_quiz,true|integer|min:0|max:2',
        ]);

        // Create lesson
        $lesson = Lesson::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'video_url' => $validated['video_url'],
            'duration' => $validated['duration'],
            'difficulty_level' => $validated['difficulty_level'],
            'points' => $validated['points'],
            'teacher_id' => auth()->id(),
            'order' => Lesson::max('order') + 1,
        ]);

        // Attach categories
        if (!empty($validated['categories'])) {
            $lesson->categories()->attach($validated['categories']);
        }

        // Create quiz if requested
        if ($request->create_quiz) {
            $quiz = Quiz::create([
                'lesson_id' => $lesson->id,
                'title' => $validated['quiz_title'],
                'description' => 'Quiz para ' . $lesson->title,
                'passing_score' => $validated['passing_score'],
                'max_attempts' => $validated['max_attempts'],
            ]);

            // Create questions and answers
            foreach ($validated['questions'] as $index => $questionData) {
                $question = QuizQuestion::create([
                    'quiz_id' => $quiz->id,
                    'question' => $questionData['question'],
                    'points' => 25,
                    'order' => $index + 1,
                ]);

                foreach ($questionData['answers'] as $answerIndex => $answerData) {
                    QuizAnswer::create([
                        'question_id' => $question->id,
                        'answer' => $answerData['text'],
                        'is_correct' => $answerIndex == $questionData['correct_answer'],
                        'order' => $answerIndex + 1,
                    ]);
                }
            }
        }

        return redirect()->route('dashboard.teacher')
            ->with('success', 'Lección creada exitosamente');
    }

    /**
     * Show the form for editing a lesson
     */
    public function edit($id)
    {
        $lesson = Lesson::with(['categories', 'quiz.questions.answers'])
            ->where('teacher_id', auth()->id())
            ->findOrFail($id);
        
        $categories = Category::active()->ordered()->get();
        
        return view('teacher.lessons.edit', compact('lesson', 'categories'));
    }

    /**
     * Update the specified lesson
     */
    public function update(Request $request, $id)
    {
        $lesson = Lesson::where('teacher_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'duration' => 'required|integer|min:1',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'points' => 'required|integer|min:0',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $lesson->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'video_url' => $validated['video_url'],
            'duration' => $validated['duration'],
            'difficulty_level' => $validated['difficulty_level'],
            'points' => $validated['points'],
        ]);

        // Sync categories
        if (isset($validated['categories'])) {
            $lesson->categories()->sync($validated['categories']);
        } else {
            $lesson->categories()->detach();
        }

        return redirect()->route('dashboard.teacher')
            ->with('success', 'Lección actualizada exitosamente');
    }

    /**
     * Remove the specified lesson
     */
    public function destroy($id)
    {
        $lesson = Lesson::where('teacher_id', auth()->id())->findOrFail($id);
        
        $lesson->delete();

        return redirect()->route('dashboard.teacher')
            ->with('success', 'Lección eliminada exitosamente');
    }
}
