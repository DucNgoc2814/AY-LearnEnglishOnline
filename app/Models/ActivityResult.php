<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityResult extends Model
{
    protected $fillable = [
        'activity_id',
        'student_id',
        'answers',
        'score',
        'max_score',
        'completion_percentage',
        'start_time',
        'submit_time',
        'feedback'
    ];

    protected $casts = [
        'answers' => 'array',
        'score' => 'decimal:2',
        'max_score' => 'decimal:2',
        'completion_percentage' => 'float',
        'start_time' => 'datetime',
        'submit_time' => 'datetime'
    ];

    /**
     * Get the activity that owns this result.
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(SessionActivity::class, 'activity_id');
    }

    /**
     * Get the student who submitted this result.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
} 