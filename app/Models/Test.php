<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Test extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'testable_type',
        'testable_id',
        'slug',
        'name',
        'description',
        'duration',
        'min_score',
        'max_score',
        'max_attempt',
        'type',
        'settings'
    ];

    protected $casts = [
        'duration' => 'integer',
        'min_score' => 'integer',
        'max_score' => 'integer',
        'max_attempt' => 'integer',
        'settings' => 'json'
    ];

    // Relationships
    public function testable(): MorphTo
    {
        return $this->morphTo();
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(TestResult::class);
    }

    // Methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function getFormattedTimeLimit(): string
    {
        $minutes = $this->time_limit;
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $remainingMinutes);
        }

        return sprintf('%d phút', $minutes);
    }

    public function canAttempt($studentId): bool
    {
        if ($this->max_attempts === 0) {
            return true;
        }

        return $this->getAttemptCount($studentId) < $this->max_attempts;
    }

    public function getAttemptCount($studentId): int
    {
        return $this->results()
            ->where('student_id', $studentId)
            ->count();
    }

    public function getRemainingAttempts($studentId): int
    {
        if ($this->max_attempts === 0) {
            return PHP_INT_MAX; // Unlimited
        }

        $attemptCount = $this->getAttemptCount($studentId);
        return max(0, $this->max_attempts - $attemptCount);
    }

    public function hasPassed($studentId): bool
    {
        $highestScore = $this->results()
            ->where('student_id', $studentId)
            ->max('score');

        return $highestScore >= $this->passing_score;
    }

    public function getBestResult($studentId)
    {
        return $this->results()
            ->where('student_id', $studentId)
            ->orderByDesc('score')
            ->first();
    }

    public function getLatestResult($studentId)
    {
        return $this->results()
            ->where('student_id', $studentId)
            ->latest()
            ->first();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeForCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }
} 