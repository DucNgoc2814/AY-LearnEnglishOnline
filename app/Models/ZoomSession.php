<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZoomSession extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lessonId',
        'releaseTime',
        'recordingLink',
        'status'
    ];

    protected $casts = [
        'releaseTime' => 'datetime'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessonId');
    }

    public function videoRecords()
    {
        return $this->hasMany(VideoRecord::class, 'zoomSessionId');
    }
} 