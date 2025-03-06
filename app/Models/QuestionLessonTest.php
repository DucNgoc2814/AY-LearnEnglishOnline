<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionLessonTest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lessonTestId',
        'question',
        'orderNumber'
    ];

    protected $casts = [
        'orderNumber' => 'integer'
    ];

    public function lessonTest()
    {
        return $this->belongsTo(LessonTest::class, 'lessonTestId');
    }

    public function answers()
    {
        return $this->hasMany(AnswerLessonTest::class, 'questionLessonTestId');
    }
} 