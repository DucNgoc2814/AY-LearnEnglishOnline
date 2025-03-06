<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'lessonId', 'startTime', 'endTime', 'participants', 'recordingLink'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function videoRecords()
    {
        return $this->hasMany(VideoRecord::class);
    }

}
