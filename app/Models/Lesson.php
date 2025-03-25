<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'courseId',
        'name',
        'slug',
        'type',
        'description',
        'orderNumber',
        'isPreview',
        'totalView',
        'totalComment'
    ];

    protected $casts = [
        'orderNumber' => 'integer',
        'isPreview' => 'boolean',
        'totalView' => 'integer',
        'totalComment' => 'integer'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function lessonTests()
    {
        return $this->hasMany(LessonTest::class, 'lessonId');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
    public function videoLessons()
    {
        return $this->hasMany(LessonVideo::class, 'lessonId');
    }

    public function totalTests()
    {
        return $this->lessonTests()
            ->whereNull('deleted_at')
            ->count();
    }

    public function totalVideo()
    {
        return $this->videoLessons()
            ->whereNull('deleted_at')
            ->count();
    }

    public function totalVideoDuration()
    {
        $totalSeconds = $this->videoLessons()
            ->whereNull('deleted_at')
            ->sum('duration');

        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function resources()
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }
}
