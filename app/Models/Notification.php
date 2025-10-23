<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'read_at',
        'action_url'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime'
    ];

    /**
     * Get the user this notification belongs to
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    /**
     * Scope for unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for read notifications
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Get icon based on type
     */
    public function getIconAttribute()
    {
        return match($this->type) {
            'new_lesson' => '📚',
            'new_comment' => '💬',
            'achievement' => '🏆',
            'points_earned' => '⭐',
            'level_up' => '🎉',
            'certificate' => '📜',
            default => '🔔'
        };
    }

    /**
     * Get color based on type
     */
    public function getColorAttribute()
    {
        return match($this->type) {
            'new_lesson' => 'blue',
            'new_comment' => 'green',
            'achievement' => 'purple',
            'points_earned' => 'yellow',
            'level_up' => 'pink',
            'certificate' => 'indigo',
            default => 'gray'
        };
    }
}
