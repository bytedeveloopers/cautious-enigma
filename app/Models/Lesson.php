<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content',
        'video_url',
        'duration',
        'order',
        'teacher_id',
        'points',
        'average_rating',
        'total_reviews',
        'difficulty_level',
        'resources'
    ];

    protected $casts = [
        'duration' => 'integer',
        'order' => 'integer',
        'points' => 'integer',
        'average_rating' => 'decimal:2',
        'total_reviews' => 'integer',
        'resources' => 'array'
    ];

    /**
     * Get the teacher who created this lesson
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get students enrolled in this lesson
     */
    public function enrolledStudents()
    {
        return $this->belongsToMany(User::class, 'lesson_enrollments')
                    ->withPivot(['completed', 'completed_at', 'progress_percentage', 'time_spent'])
                    ->withTimestamps();
    }

    /**
     * Get categories for this lesson
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_lesson')
                    ->withTimestamps();
    }

    /**
     * Get comments for this lesson
     */
    public function comments()
    {
        return $this->hasMany(LessonComment::class);
    }

    /**
     * Get top-level comments (not replies)
     */
    public function topLevelComments()
    {
        return $this->hasMany(LessonComment::class)->whereNull('parent_id');
    }

    /**
     * Get reviews for this lesson
     */
    public function reviews()
    {
        return $this->hasMany(LessonReview::class);
    }

    /**
     * Get quiz for this lesson
     */
    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    /**
     * Check if lesson has a quiz
     */
    public function hasQuiz()
    {
        return $this->quiz()->exists();
    }

    /**
     * Get difficulty badge color
     */
    public function getDifficultyColorAttribute()
    {
        return match($this->difficulty_level) {
            'beginner' => 'bg-green-100 text-green-800',
            'intermediate' => 'bg-yellow-100 text-yellow-800',
            'advanced' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}