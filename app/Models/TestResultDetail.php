<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestResultDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'test_result_id',
        'question_id',
        'answer_id',
        'text_answer',
        'is_correct',
        'score',
        'time_spent',
        'order_number'
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'score' => 'integer',
        'time_spent' => 'integer'
    ];

    // Relationships
    public function testResult()
    {
        return $this->belongsTo(TestResult::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    // Methods
    public function grade($points, $feedback = null, $gradedBy = null)
    {
        $this->score = min($points, $this->max_points);
        $this->is_correct = $this->score >= $this->max_points;
        
        if ($feedback) {
            $this->feedback = $feedback;
        }
        
        if ($gradedBy) {
            $this->graded_by = $gradedBy;
        }
        
        $this->graded_at = now();
        $this->save();
        
        // Update total score on the test result
        $this->result->calculateScore();
        
        return $this;
    }

    public function requiresManualGrading(): bool
    {
        return $this->question->requiresManualGrading();
    }

    public function getScorePercentage(): float
    {
        if ($this->max_points == 0) {
            return 0;
        }
        
        return round(($this->score / $this->max_points) * 100, 2);
    }

    // Scopes
    public function scopeCorrect($query)
    {
        return $query->where('is_correct', true);
    }

    public function scopeIncorrect($query)
    {
        return $query->where('is_correct', false);
    }

    public function scopeGraded($query)
    {
        return $query->whereNotNull('graded_at');
    }

    public function scopeUngraded($query)
    {
        return $query->whereNull('graded_at');
    }
} 