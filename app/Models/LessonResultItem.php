<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonResultItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lessonResultId',
        'questionLessonTestId',
        'answerLessonTestId',
        'isCorrect'
    ];

    protected $casts = [
        'isCorrect' => 'boolean'
    ];

    public function lessonResult()
    {
        return $this->belongsTo(LessonResult::class, 'lessonResultId');
    }

    public function question()
    {
        return $this->belongsTo(QuestionLessonTest::class, 'questionLessonTestId');
    }

    public function answer()
    {
        return $this->belongsTo(AnswerLessonTest::class, 'answerLessonTestId');
    }
} 