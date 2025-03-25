<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassSession extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'classId',
        'scheduleId',
        'online_room_id',
        'sessionDate',
        'startTime',
        'endTime',
        'roomNumber',
        'session_type',
        'topic',
        'content',
        'homework',
        'notes',
        'status'
    ];

    protected $casts = [
        'sessionDate' => 'date',
        'startTime' => 'datetime:H:i',
        'endTime' => 'datetime:H:i'
    ];

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'classId');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(ClassSchedule::class, 'scheduleId');
    }
    
    public function onlineRoom(): BelongsTo
    {
        return $this->belongsTo(OnlineRoom::class, 'online_room_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'sessionId');
    }
    
    public function interactions(): HasMany
    {
        return $this->hasMany(SessionInteraction::class, 'session_id');
    }
    
    public function activities(): HasMany
    {
        return $this->hasMany(SessionActivity::class, 'session_id');
    }
    
    /**
     * Check if the session is an online session
     */
    public function isOnline(): bool
    {
        return $this->session_type === 'online' || $this->session_type === 'hybrid';
    }
    
    /**
     * Check if the session is in person
     */
    public function isInPerson(): bool
    {
        return $this->session_type === 'in_person' || $this->session_type === 'hybrid';
    }
} 