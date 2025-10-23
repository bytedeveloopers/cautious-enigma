<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonComment extends Model
{
    protected $fillable = [
        'lesson_id',
        'user_id',
        'parent_id',
        'content',
        'is_question',
        'is_answered',
        'answered_by',
        'likes'
    ];

    protected $casts = [
        'is_question' => 'boolean',
        'is_answered' => 'boolean',
        'likes' => 'integer'
    ];

    /**
     * Get the lesson this comment belongs to
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Get the user who wrote this comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent comment (for replies)
     */
    public function parent()
    {
        return $this->belongsTo(LessonComment::class, 'parent_id');
    }

    /**
     * Get replies to this comment
     */
    public function replies()
    {
        return $this->hasMany(LessonComment::class, 'parent_id');
    }

    /**
     * Get the teacher who answered (if applicable)
     */
    public function answeredBy()
    {
        return $this->belongsTo(User::class, 'answered_by');
    }

    /**
     * Get users who liked this comment
     */
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'comment_likes', 'comment_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Check if user liked this comment
     */
    public function isLikedBy($userId)
    {
        return $this->likedBy()->where('user_id', $userId)->exists();
    }

    /**
     * Scope for questions only
     */
    public function scopeQuestions($query)
    {
        return $query->where('is_question', true);
    }

    /**
     * Scope for unanswered questions
     */
    public function scopeUnanswered($query)
    {
        return $query->where('is_question', true)
                    ->where('is_answered', false);
    }

    /**
     * Scope for top-level comments (not replies)
     */
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }
}
