<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonTestResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'lesson_test_id',
        'score',
        'time_taken',
        'attempt_number',
        'status'
    ];

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
