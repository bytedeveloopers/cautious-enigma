<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'quiz_id',
        'question',
        'points',
        'order'
    ];

    protected $casts = [
        'points' => 'integer',
        'order' => 'integer'
    ];

    /**
     * Get the quiz this question belongs to
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get answers for this question
     */
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class, 'question_id')->orderBy('order');
    }

    /**
     * Get the correct answer
     */
    public function correctAnswer()
    {
        return $this->hasOne(QuizAnswer::class, 'question_id')->where('is_correct', true);
    }

    /**
     * Check if given answer is correct
     */
    public function isCorrectAnswer($answerId)
    {
        return $this->answers()->where('id', $answerId)->where('is_correct', true)->exists();
    }
}
