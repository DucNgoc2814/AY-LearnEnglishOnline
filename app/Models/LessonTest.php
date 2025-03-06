<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'lessonId', 'minScore', 'isRequired'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions()
    {
        return $this->hasMany(QuestionLessonTest::class);
    }

    public function lessonTestResults()
    {
        return $this->hasMany(LessonTestResult::class);
    }
}
