<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'total_points',
        'completed_lessons',
        'level',
        'last_activity'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_activity' => 'datetime',
            'total_points' => 'integer',
            'completed_lessons' => 'integer'
        ];
    }

    /**
     * Check if user is a teacher
     */
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    /**
     * Check if user is a student
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Get lessons created by this teacher
     */
    public function createdLessons()
    {
        return $this->hasMany(Lesson::class, 'teacher_id');
    }

    /**
     * Get lessons enrolled by this student
     */
    public function enrolledLessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_enrollments')
                    ->withPivot(['completed', 'completed_at', 'progress_percentage', 'time_spent'])
                    ->withTimestamps();
    }

    /**
     * Get notifications for this user
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get unread notifications
     */
    public function unreadNotifications()
    {
        return $this->hasMany(Notification::class)->where('is_read', false);
    }

    /**
     * Get certificates earned by this user
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Get reviews written by this user
     */
    public function reviews()
    {
        return $this->hasMany(LessonReview::class);
    }

    /**
     * Get comments written by this user
     */
    public function comments()
    {
        return $this->hasMany(LessonComment::class);
    }

    /**
     * Get quiz attempts by this user
     */
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * Get passed quizzes count
     */
    public function getPassedQuizzesCountAttribute()
    {
        return $this->quizAttempts()->where('passed', true)->distinct('quiz_id')->count('quiz_id');
    }

    /**
     * Get average quiz score
     */
    public function getAverageQuizScoreAttribute()
    {
        return round($this->quizAttempts()->avg('score') ?? 0, 1);
    }

    /**
     * Calculate ranking score (for leaderboard)
     */
    public function getRankingScoreAttribute()
    {
        return ($this->total_points ?? 0) + 
               ($this->completed_lessons ?? 0) * 50 + 
               ($this->passed_quizzes_count ?? 0) * 100;
    }

    /**
     * Get user level based on points
     */
    public function getLevelAttribute($value)
    {
        if ($this->total_points >= 1000) return 'Experto';
        if ($this->total_points >= 500) return 'Avanzado';
        if ($this->total_points >= 200) return 'Intermedio';
        if ($this->total_points >= 50) return 'Principiante';
        return 'Novato';
    }

    /**
     * Get level color
     */
    public function getLevelColorAttribute()
    {
        return match($this->level) {
            'Experto' => 'bg-purple-100 text-purple-800',
            'Avanzado' => 'bg-blue-100 text-blue-800',
            'Intermedio' => 'bg-green-100 text-green-800',
            'Principiante' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}
