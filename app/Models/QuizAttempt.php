<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'quiz_id',
        'user_id',
        'score',
        'correct_answers',
        'total_questions',
        'passed',
        'started_at',
        'completed_at',
        'time_spent',
        'answers'
    ];

    protected $casts = [
        'score' => 'integer',
        'correct_answers' => 'integer',
        'total_questions' => 'integer',
        'passed' => 'boolean',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'time_spent' => 'integer',
        'answers' => 'array'
    ];

    /**
     * Get the quiz this attempt belongs to
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the user who made this attempt
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get percentage score
     */
    public function getPercentageAttribute()
    {
        return $this->score;
    }

    /**
     * Get grade letter
     */
    public function getGradeAttribute()
    {
        if ($this->score >= 90) return 'A';
        if ($this->score >= 80) return 'B';
        if ($this->score >= 70) return 'C';
        if ($this->score >= 60) return 'D';
        return 'F';
    }

    /**
     * Get grade color
     */
    public function getGradeColorAttribute()
    {
        return match($this->grade) {
            'A' => 'text-green-600 bg-green-100',
            'B' => 'text-blue-600 bg-blue-100',
            'C' => 'text-yellow-600 bg-yellow-100',
            'D' => 'text-orange-600 bg-orange-100',
            'F' => 'text-red-600 bg-red-100',
            default => 'text-gray-600 bg-gray-100'
        };
    }

    /**
     * Calculate time spent in readable format
     */
    public function getFormattedTimeAttribute()
    {
        if (!$this->time_spent) return '0m 0s';
        
        $minutes = floor($this->time_spent / 60);
        $seconds = $this->time_spent % 60;
        
        return "{$minutes}m {$seconds}s";
    }
}
