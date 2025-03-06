<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionLessonTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'lessonTestId', 'question'
    ];

    public function lessonTest()
    {
        return $this->belongsTo(LessonTest::class);
    }

    public function answers()
    {
        return $this->hasMany(AnswerLessonTest::class);
    }
}
