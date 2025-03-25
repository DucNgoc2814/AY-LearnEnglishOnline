<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionInteraction extends Model
{
    protected $fillable = [
        'session_id',
        'student_id',
        'type',
        'content',
        'reaction_type',
        'interaction_time',
        'is_private',
        'is_highlighted',
        'is_answered',
    ];

    protected $casts = [
        'interaction_time' => 'datetime',
        'is_private' => 'boolean',
        'is_highlighted' => 'boolean',
        'is_answered' => 'boolean',
    ];

    /**
     * Get the session that owns this interaction.
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }

    /**
     * Get the student who made this interaction.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
} 