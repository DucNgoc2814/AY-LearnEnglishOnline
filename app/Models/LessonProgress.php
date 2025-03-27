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

    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'status',
        'progress',
        'time_spent',
        'last_accessed_at',
        'completed_at',
        'meta_data'
    ];

    protected $casts = [
        'progress' => 'float',
        'time_spent' => 'integer',
        'last_accessed_at' => 'datetime',
        'completed_at' => 'datetime',
        'meta_data' => 'array'
    ];

    // Relationships
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    // Methods
    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->progress = 100;
        $this->completed_at = now();
        $this->save();

        // Update enrollment progress
        $this->enrollment->updateProgress();
    }

    public function updateTimeSpent($minutes)
    {
        $this->time_spent += $minutes;
        $this->last_accessed_at = now();
        $this->save();
    }

    public function updateProgress($progress)
    {
        $this->progress = min(100, $progress);
        $this->last_accessed_at = now();
        
        if ($this->progress >= 100) {
            $this->markAsCompleted();
        } else {
            $this->save();
        }
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function getFormattedTimeSpent(): string
    {
        $hours = floor($this->time_spent / 60);
        $minutes = $this->time_spent % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $minutes);
        }

        return sprintf('%d phút', $minutes);
    }
} 