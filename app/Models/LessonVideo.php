<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonVideo extends Model
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
    public function totalDuration()
    {
        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
