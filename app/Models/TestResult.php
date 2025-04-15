<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'user_id',
        'class_session_id',
        'score',
        'total_questions',
        'correct_answers',
        'attempt_number',
        'started_at',
        'completed_at',
        'status',
        'meta_data'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'score' => 'float',
        'meta_data' => 'json'
    ];

    // Relationships
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classSession()
    {
        return $this->belongsTo(ClassSession::class);
    }

    public function details()
    {
        return $this->hasMany(TestResultDetail::class);
    }

    // Methods
    public function calculateScore()
    {
        $this->score = $this->details()->sum('points');
        $this->save();
        
        return $this;
    }

    public function isPassed(): bool
    {
        return $this->score >= $this->test->passing_score;
    }

    public function getScorePercentage(): float
    {
        if ($this->max_score == 0) {
            return 0;
        }
        
        return round(($this->score / $this->max_score) * 100, 2);
    }

    public function getFormattedTimeSpent(): string
    {
        $minutes = floor($this->time_spent / 60);
        $seconds = $this->time_spent % 60;
        
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function requiresManualGrading(): bool
    {
        return $this->details()
            ->whereHas('question', function ($q) {
                $q->whereIn('question_type', ['essay', 'file_upload']);
            })
            ->exists();
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_at');
    }

    public function scopePending($query)
    {
        return $query->whereNull('completed_at')
            ->whereNotNull('started_at');
    }

    public function scopePassed($query)
    {
        return $query->whereHas('test', function ($q) {
            $q->whereRaw('test_results.score >= tests.min_score');
        });
    }

    public function scopeFailed($query)
    {
        return $query->whereHas('test', function ($q) {
            $q->whereRaw('test_results.score < tests.min_score');
        });
    }
} 