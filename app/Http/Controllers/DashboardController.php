<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Teacher dashboard
     */
    public function teacher()
    {
        $user = auth()->user();
        
        if (!$user->isTeacher()) {
            return redirect('/dashboard/student');
        }

        $lessons = $user->createdLessons()->latest()->paginate(10);
        $totalStudents = User::where('role', 'student')->count();
        $totalLessons = $user->createdLessons()->count();
        
        return view('dashboard.teacher', compact('lessons', 'totalStudents', 'totalLessons'));
    }

    /**
     * Student dashboard
     */
    public function student()
    {
        $user = auth()->user();
        
        if (!$user->isStudent()) {
            return redirect('/dashboard/teacher');
        }

        $enrolledLessons = $user->enrolledLessons()->latest()->paginate(10);
        $availableLessons = Lesson::whereNotIn('id', $user->enrolledLessons->pluck('id'))
                                  ->latest()
                                  ->paginate(10);
        
        return view('dashboard.student', compact('enrolledLessons', 'availableLessons'));
    }

    /**
     * Enroll student in a lesson
     */
    public function enrollInLesson(Request $request, $lessonId)
    {
        $user = auth()->user();
        
        if (!$user->isStudent()) {
            return response()->json(['error' => 'Solo los estudiantes pueden inscribirse en lecciones'], 403);
        }

        $lesson = Lesson::findOrFail($lessonId);
        
        if (!$user->enrolledLessons->contains($lesson->id)) {
            $user->enrolledLessons()->attach($lesson->id);
            return response()->json(['success' => 'Te has inscrito exitosamente en la lección']);
        }
        
        return response()->json(['error' => 'Ya estás inscrito en esta lección'], 409);
    }
}
