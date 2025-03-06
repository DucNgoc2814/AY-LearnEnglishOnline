<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonTestResult extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessonTest()
    {
        return $this->belongsTo(LessonTest::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
