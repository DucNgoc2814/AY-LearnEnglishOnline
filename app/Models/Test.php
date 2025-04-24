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
        'lesson_id',
        'slug',
        'name',
        'description',
        'duration',
        'min_score',
        'max_score',
        'is_required',
        'total_attempt',
        'max_attempt',
        'type',
        'role',
        'settings'
    ];

    protected $casts = [
        'duration' => 'integer',
        'min_score' => 'integer',
        'max_score' => 'integer',
        'is_required' => 'boolean',
        'total_attempt' => 'integer',
        'max_attempt' => 'integer',
        'role' => 'integer',
        'settings' => 'json'
    ];

    // // Thêm debug
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope('debug', function ($query) {
    //         \Log::info($query->toSql());
    //         \Log::info($query->getBindings());
    //     });
    // }

    // Relationships
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
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
    public function getFormattedTimeLimit(): string
    {
        $minutes = $this->duration / 60; // Convert from seconds to minutes
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $remainingMinutes);
        }

        return sprintf('%d phút', $minutes);
    }

    public function canAttempt($studentId): bool
    {
        if ($this->max_attempt === 0) {
            return true;
        }

        return $this->getAttemptCount($studentId) < $this->max_attempt;
    }

    public function getAttemptCount($studentId): int
    {
        return $this->results()
            ->where('student_id', $studentId)
            ->count();
    }

    public function getRemainingAttempts($studentId): int
    {
        if ($this->max_attempt === 0) {
            return PHP_INT_MAX; // Unlimited
        }

        $attemptCount = $this->getAttemptCount($studentId);
        return max(0, $this->max_attempt - $attemptCount);
    }

    public function hasPassed($studentId): bool
    {
        $highestScore = $this->results()
            ->where('student_id', $studentId)
            ->max('score');

        return $highestScore >= $this->min_score;
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
    public function scopeForLesson($query, $lessonId)
    {
        return $query->where('lesson_id', $lessonId);
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the grade items related to this test
     */
    public function gradeItems()
    {
        return $this->belongsToMany(GradeItem::class, 'grade_item_test')
                    ->withPivot('metadata')
                    ->withTimestamps();
    }
}
