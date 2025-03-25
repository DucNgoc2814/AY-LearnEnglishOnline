<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonProgress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'enrollment_id',
        'start_date',
        'completion_date',
        'last_accessed_date',
        'progress_percentage',
        'is_completed',
        'time_spent_seconds',
        'access_count',
        'notes',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'lesson_id' => 'integer',
        'enrollment_id' => 'integer',
        'start_date' => 'datetime',
        'completion_date' => 'datetime',
        'last_accessed_date' => 'datetime',
        'progress_percentage' => 'decimal:2',
        'is_completed' => 'boolean',
        'time_spent_seconds' => 'integer',
        'access_count' => 'integer',
    ];

    /**
     * Get the user associated with this progress
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the lesson associated with this progress
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    /**
     * Get the enrollment associated with this progress
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id');
    }

    /**
     * Update the progress with a new access
     */
    public function recordAccess(int $timeSpentSeconds = null): void
    {
        $this->access_count += 1;
        $this->last_accessed_date = now();
        
        if ($timeSpentSeconds) {
            $this->time_spent_seconds += $timeSpentSeconds;
        }
        
        $this->save();
    }

    /**
     * Mark the lesson as completed
     */
    public function markAsCompleted(): void
    {
        if (!$this->is_completed) {
            $this->is_completed = true;
            $this->completion_date = now();
            $this->progress_percentage = 100;
            $this->save();
            
            // Update the enrollment progress if applicable
            if ($this->enrollment_id) {
                $enrollment = $this->enrollment;
                if ($enrollment) {
                    $enrollment->updateProgress();
                }
            }
        }
    }

    /**
     * Update the progress percentage
     */
    public function updateProgress(float $percentage): void
    {
        $percentage = min(100, max(0, $percentage));
        
        if ($percentage > $this->progress_percentage) {
            $this->progress_percentage = $percentage;
            
            if ($percentage >= 100 && !$this->is_completed) {
                $this->markAsCompleted();
            } else {
                $this->save();
            }
        }
    }

    /**
     * Get the formatted time spent
     */
    public function getFormattedTimeSpent(): string
    {
        $hours = floor($this->time_spent_seconds / 3600);
        $minutes = floor(($this->time_spent_seconds % 3600) / 60);
        $seconds = $this->time_spent_seconds % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
    }

    /**
     * Check if this lesson was accessed recently
     */
    public function isRecentlyAccessed(int $minutes = 60): bool
    {
        if (!$this->last_accessed_date) {
            return false;
        }
        
        return $this->last_accessed_date->diffInMinutes(now()) <= $minutes;
    }

    /**
     * Calculate the estimated time to complete the lesson
     */
    public function getEstimatedTimeToComplete(): ?int
    {
        if ($this->is_completed || $this->progress_percentage >= 100) {
            return 0;
        }
        
        if ($this->progress_percentage <= 0 || $this->time_spent_seconds <= 0) {
            return null;
        }
        
        // Calculate remaining time based on current progress and time spent
        $remainingPercentage = 100 - $this->progress_percentage;
        $timePerPercentage = $this->time_spent_seconds / $this->progress_percentage;
        
        return ceil($remainingPercentage * $timePerPercentage);
    }
} 