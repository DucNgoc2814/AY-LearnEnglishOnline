<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class OnlineRoom extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'room_id',
        'room_type',
        'roomable_id',
        'roomable_type',
        'title',
        'description',
        'host_id',
        'host_email',
        'join_url',
        'host_url',
        'password',
        'scheduled_start',
        'scheduled_end',
        'duration_minutes',
        'recurrence_pattern',
        'meeting_settings',
        'status',
        'provider',
        'timezone',
        'created_by',
        'original_zoom_session_id',
    ];

    protected $casts = [
        'roomable_id' => 'integer',
        'host_id' => 'string',
        'scheduled_start' => 'datetime',
        'scheduled_end' => 'datetime',
        'duration_minutes' => 'integer',
        'recurrence_pattern' => 'json',
        'meeting_settings' => 'json',
        'original_zoom_session_id' => 'integer',
    ];

    /**
     * Get the owning roomable model (course, class, exam, etc.)
     */
    public function roomable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the recordings for this room
     */
    public function recordings(): HasMany
    {
        return $this->hasMany(OnlineSessionRecording::class, 'online_room_id');
    }

    /**
     * Get the attendance details for this room
     */
    public function attendanceDetails(): HasMany
    {
        return $this->hasMany(OnlineAttendanceDetail::class, 'online_room_id');
    }

    /**
     * Check if the online room is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active' || $this->status === 'in_progress';
    }

    /**
     * Check if the online room is currently in session
     */
    public function isInSession(): bool
    {
        $now = Carbon::now();
        
        // If room is not active, it's not in session
        if (!$this->isActive()) {
            return false;
        }
        
        // If status is explicitly set to in_progress, it's in session
        if ($this->status === 'in_progress') {
            return true;
        }
        
        // Check if current time is between scheduled start and end
        return $now->between(
            $this->scheduled_start, 
            $this->scheduled_end ?? $this->scheduled_start->copy()->addMinutes($this->duration_minutes)
        );
    }

    /**
     * Get the next occurrence of this room if it's recurring
     */
    public function getNextOccurrence(): ?Carbon
    {
        // If room is not recurring, return scheduled start
        if (empty($this->recurrence_pattern)) {
            return $this->scheduled_start;
        }
        
        $now = Carbon::now();
        
        // If scheduled start is in the future, return it
        if ($this->scheduled_start->gt($now)) {
            return $this->scheduled_start;
        }
        
        // Simple implementation for daily, weekly, and monthly patterns
        // In a real implementation, you'd want to use a more robust solution
        $pattern = $this->recurrence_pattern;
        $type = $pattern['type'] ?? null;
        
        if (!$type) {
            return null;
        }
        
        $nextDate = $this->scheduled_start->copy();
        
        while ($nextDate->lt($now)) {
            if ($type === 'daily') {
                $nextDate->addDays($pattern['interval'] ?? 1);
            } elseif ($type === 'weekly') {
                $nextDate->addWeeks($pattern['interval'] ?? 1);
            } elseif ($type === 'monthly') {
                $nextDate->addMonths($pattern['interval'] ?? 1);
            }
        }
        
        return $nextDate;
    }

    /**
     * Get the formatted duration
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d hours', $hours, $minutes);
        } else {
            return sprintf('%d minutes', $minutes);
        }
    }

    /**
     * Get the list of participants who attended this room
     */
    public function getParticipants()
    {
        return $this->attendanceDetails()
            ->with('user')
            ->select('user_id')
            ->distinct()
            ->get()
            ->pluck('user');
    }
} 