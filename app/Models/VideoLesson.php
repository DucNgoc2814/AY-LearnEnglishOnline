<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoLesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lessonId',
        'name',
        'slug',
        'videoUrl',
        'duration',
        'videoType',
        'thumbnailUrl'
    ];

    protected $casts = [
        'duration' => 'integer',
        'videoType' => 'string'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessonId');
    }

    public function getFormattedDurationAttribute()
    {
        if (!$this->duration) {
            return 'N/A';
        }

        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;
        return "{$minutes} phút {$seconds} giây";
    }
}
