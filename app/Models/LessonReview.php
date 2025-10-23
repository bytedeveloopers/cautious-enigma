<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonReview extends Model
{
    protected $fillable = [
        'lesson_id',
        'user_id',
        'rating',
        'review',
        'is_helpful',
        'helpful_count'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_helpful' => 'boolean',
        'helpful_count' => 'integer'
    ];

    /**
     * Get the lesson this review belongs to
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Get the user who wrote this review
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Update lesson's average rating
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($review) {
            $review->updateLessonRating();
        });

        static::updated(function ($review) {
            $review->updateLessonRating();
        });

        static::deleted(function ($review) {
            $review->updateLessonRating();
        });
    }

    /**
     * Update the lesson's average rating
     */
    public function updateLessonRating()
    {
        $lesson = $this->lesson;
        
        $avgRating = $lesson->reviews()->avg('rating');
        $totalReviews = $lesson->reviews()->count();
        
        $lesson->update([
            'average_rating' => $avgRating,
            'total_reviews' => $totalReviews
        ]);
    }

    /**
     * Get star display (for templates)
     */
    public function getStarsAttribute()
    {
        return str_repeat('⭐', $this->rating);
    }
}
