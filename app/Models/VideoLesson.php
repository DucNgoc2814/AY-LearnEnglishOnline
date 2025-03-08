<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoLesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lessonId',
        'videoUrl',
        'duration',
        'videoType',
        'thumbnailUrl',
        'isProcessed',
        'videoQuality'
    ];

    protected $casts = [
        'duration' => 'integer',
        'isProcessed' => 'boolean',
        'videoQuality' => 'json',
        'videoType' => 'string'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessonId');
    }
}
