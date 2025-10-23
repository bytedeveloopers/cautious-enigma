<?php

namespace App\Http\Controllers;

use App\Models\LessonReview;
use App\Models\Lesson;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $lessonId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500'
        ]);

        $lesson = Lesson::findOrFail($lessonId);

        // Check if user has completed the lesson
        $enrollment = auth()->user()
            ->enrolledLessons()
            ->where('lesson_id', $lessonId)
            ->first();

        if (!$enrollment || !$enrollment->pivot->completed) {
            return back()->with('error', 'Debes completar la lección antes de calificarla');
        }

        // Create or update review
        LessonReview::updateOrCreate(
            [
                'lesson_id' => $lessonId,
                'user_id' => auth()->id()
            ],
            [
                'rating' => $request->rating,
                'review' => $request->review
            ]
        );

        return back()->with('success', 'Calificación guardada exitosamente');
    }

    public function destroy($reviewId)
    {
        $review = LessonReview::findOrFail($reviewId);
        
        if ($review->user_id !== auth()->id()) {
            return back()->with('error', 'No tienes permiso para eliminar esta calificación');
        }

        $review->delete();
        
        return back()->with('success', 'Calificación eliminada');
    }
}
