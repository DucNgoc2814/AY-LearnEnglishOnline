<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Progress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'enrollmentId',
        'lessonId',
        'watchedTime',
        'totalTime',
        'status',
        'lastWatchedAt',
        'completedAt'
    ];

    protected $casts = [
        'watchedTime' => 'integer',
        'totalTime' => 'integer',
        'lastWatchedAt' => 'datetime',
        'completedAt' => 'datetime'
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollmentId');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessonId');
    }
} 