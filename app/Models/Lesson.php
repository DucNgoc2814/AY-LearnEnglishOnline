<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'courseId',
        'type',
        'videoUrl',
        'startTime',
        'endTime',
        'duration',
        'notes',
        'sortDescription',
        'description'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessonTests()
    {
        return $this->hasMany(LessonTest::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function lessonTestResults()
    {
        return $this->hasMany(LessonTestResult::class);
    }

    public function zoomSessions()
    {
        return $this->hasMany(ZoomSession::class);
    }
}
