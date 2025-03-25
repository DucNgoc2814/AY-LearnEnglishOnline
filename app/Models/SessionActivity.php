<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SessionActivity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'session_id',
        'title',
        'description',
        'type',
        'content',
        'duration',
        'start_time',
        'end_time',
        'is_graded',
        'is_mandatory'
    ];

    protected $casts = [
        'content' => 'array',
        'duration' => 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_graded' => 'boolean',
        'is_mandatory' => 'boolean'
    ];

    /**
     * Get the session that owns this activity.
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }

    /**
     * Get the results for this activity.
     */
    public function results(): HasMany
    {
        return $this->hasMany(ActivityResult::class, 'activity_id');
    }
} 