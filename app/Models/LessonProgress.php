<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lesson_progress';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'watched_time',
        'total_time',
        'status',
        'last_watched_at',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'last_watched_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the enrollment that owns the lesson progress.
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    /**
     * Get the lesson that the progress belongs to.
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Scope a query to only include completed lessons.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include in-progress lessons.
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Mark the lesson as completed.
     */
    public function markAsCompleted(): self
    {
        $this->status = 'completed';
        $this->completed_at = now();
        $this->save();
        
        return $this;
    }

    /**
     * Update the progress of the lesson.
     */
    public function updateProgress($watchedTime, $totalTime): self
    {
        $this->watched_time = $watchedTime;
        $this->total_time = $totalTime;
        $this->last_watched_at = now();
        
        // If watched more than 90% of the total time, mark as completed
        if ($totalTime > 0 && ($watchedTime / $totalTime) >= 0.9) {
            $this->markAsCompleted();
        } else {
            $this->save();
        }
        
        return $this;
    }

    /**
     * Get the progress percentage.
     */
    public function getProgressPercentage(): int
    {
        if ($this->total_time <= 0) {
            return 0;
        }
        
        return min(100, round(($this->watched_time / $this->total_time) * 100));
    }
} 