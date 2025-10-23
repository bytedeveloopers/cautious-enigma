<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $query = Lesson::with(['teacher', 'categories']);

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Filter by difficulty
        if ($request->filled('difficulty')) {
            $query->where('difficulty_level', $request->difficulty);
        }

        // Filter by rating
        if ($request->filled('min_rating')) {
            $query->where('average_rating', '>=', $request->min_rating);
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'order');
        switch ($sortBy) {
            case 'rating':
                $query->orderByDesc('average_rating');
                break;
            case 'popular':
                $query->orderByDesc('total_reviews');
                break;
            case 'newest':
                $query->orderByDesc('created_at');
                break;
            default:
                $query->orderBy('order', 'asc');
        }

        $lessons = $query->paginate(12);
        $categories = Category::active()->ordered()->get();

        return view('lessons.index', compact('lessons', 'categories'));
    }

    public function show($id)
    {
        $lesson = Lesson::with([
            'teacher', 
            'categories',
            'topLevelComments.user',
            'topLevelComments.replies.user',
            'reviews.user',
            'quiz.questions',
            'quiz.attempts' => function($query) {
                $query->where('user_id', auth()->id());
            }
        ])->findOrFail($id);
        
        $userEnrollment = null;
        $userReview = null;
        
        if (auth()->check()) {
            $userEnrollment = auth()->user()
                ->enrolledLessons()
                ->where('lesson_id', $id)
                ->first();
                
            $userReview = auth()->user()
                ->reviews()
                ->where('lesson_id', $id)
                ->first();
        }
        
        return view('lessons.show', compact('lesson', 'userEnrollment', 'userReview'));
    }
}
