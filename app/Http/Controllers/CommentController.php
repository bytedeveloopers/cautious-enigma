<?php

namespace App\Http\Controllers;

use App\Models\LessonComment;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $lessonId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'is_question' => 'boolean',
            'parent_id' => 'nullable|exists:lesson_comments,id'
        ]);

        $comment = LessonComment::create([
            'lesson_id' => $lessonId,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
            'is_question' => $request->is_question ?? false
        ]);

        return back()->with('success', 'Comentario agregado exitosamente');
    }

    public function toggleLike($commentId)
    {
        $comment = LessonComment::findOrFail($commentId);
        $userId = auth()->id();

        if ($comment->isLikedBy($userId)) {
            $comment->likedBy()->detach($userId);
            $comment->decrement('likes');
        } else {
            $comment->likedBy()->attach($userId);
            $comment->increment('likes');
        }

        return back();
    }

    public function markAsAnswered($commentId)
    {
        $comment = LessonComment::findOrFail($commentId);
        
        // Only teachers can mark as answered
        if (!auth()->user()->isTeacher()) {
            return back()->with('error', 'No tienes permiso para esta acción');
        }

        $comment->update([
            'is_answered' => true,
            'answered_by' => auth()->id()
        ]);

        return back()->with('success', 'Pregunta marcada como respondida');
    }

    public function destroy($commentId)
    {
        $comment = LessonComment::findOrFail($commentId);
        
        // Only comment owner or teacher can delete
        if ($comment->user_id !== auth()->id() && !auth()->user()->isTeacher()) {
            return back()->with('error', 'No tienes permiso para eliminar este comentario');
        }

        $comment->delete();
        
        return back()->with('success', 'Comentario eliminado');
    }
}
