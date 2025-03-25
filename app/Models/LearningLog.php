<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LearningLog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'resource_id',
        'enrollment_id',
        'start_time',
        'last_access_time',
        'completion_time',
        'duration_seconds',
        'progress_percentage',
        'is_completed',
        'times_accessed',
        'interaction_data',
        'notes',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'resource_id' => 'integer',
        'enrollment_id' => 'integer',
        'start_time' => 'datetime',
        'last_access_time' => 'datetime',
        'completion_time' => 'datetime',
        'duration_seconds' => 'integer',
        'progress_percentage' => 'decimal:2',
        'is_completed' => 'boolean',
        'times_accessed' => 'integer',
        'interaction_data' => 'json',
    ];

    /**
     * Get the user associated with this learning log
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the resource associated with this learning log
     */
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    /**
     * Get the enrollment associated with this learning log
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id');
    }

    /**
     * Update the learning log with a new access
     */
    public function recordAccess(int $durationSeconds = null): void
    {
        $this->times_accessed += 1;
        $this->last_access_time = now();
        
        if ($durationSeconds) {
            $this->duration_seconds += $durationSeconds;
        }
        
        $this->save();
    }

    /**
     * Mark the resource as completed
     */
    public function markAsCompleted(): void
    {
        if (!$this->is_completed) {
            $this->is_completed = true;
            $this->completion_time = now();
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
     * Get the formatted duration
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration_seconds / 3600);
        $minutes = floor(($this->duration_seconds % 3600) / 60);
        $seconds = $this->duration_seconds % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
    }

    /**
     * Check if this resource was accessed recently
     */
    public function isRecentlyAccessed(int $minutes = 60): bool
    {
        if (!$this->last_access_time) {
            return false;
        }
        
        return $this->last_access_time->diffInMinutes(now()) <= $minutes;
    }
} 