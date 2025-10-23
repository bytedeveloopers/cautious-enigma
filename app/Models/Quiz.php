<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'lesson_id',
        'title',
        'description',
        'passing_score',
        'time_limit',
        'max_attempts',
        'is_active'
    ];

    protected $casts = [
        'passing_score' => 'integer',
        'time_limit' => 'integer',
        'max_attempts' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Get the lesson this quiz belongs to
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Get questions for this quiz
     */
    public function questions()
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('order');
    }

    /**
     * Get attempts for this quiz
     */
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * Get user's attempts
     */
    public function userAttempts($userId)
    {
        return $this->attempts()->where('user_id', $userId);
    }

    /**
     * Check if user can take quiz
     */
    public function canUserAttempt($userId)
    {
        $attemptCount = $this->userAttempts($userId)->count();
        return $attemptCount < $this->max_attempts;
    }

    /**
     * Get user's best score
     */
    public function getUserBestScore($userId)
    {
        return $this->userAttempts($userId)->max('score') ?? 0;
    }

    /**
     * Scope for active quizzes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
