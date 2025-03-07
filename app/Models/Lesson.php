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
        return $this->hasMany(LessonTest::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function zoomSessions()
    {
        return $this->hasMany(ZoomSession::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
    public function videoLesson()
    {
        return $this->hasMany(VideoLesson::class);
    }
}
