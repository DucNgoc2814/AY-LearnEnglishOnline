<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassSchedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'classId',
        'dayOfWeek',
        'startTime',
        'endTime',
        'startDate',
        'endDate',
        'roomNumber',
        'notes',
        'isRepeating',
        'isActive'
    ];

    protected $casts = [
        'startTime' => 'datetime:H:i',
        'endTime' => 'datetime:H:i',
        'startDate' => 'date',
        'endDate' => 'date',
        'isRepeating' => 'boolean',
        'isActive' => 'boolean'
    ];

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'classId');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(ClassSession::class, 'scheduleId');
    }
} 