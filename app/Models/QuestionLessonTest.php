<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionLessonTest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lesson_test_id',
        'content',
        'type',
        'score',
        'order',
        'explanation'
    ];

    protected $casts = [
        'score' => 'float',
        'order' => 'integer'
    ];

    public function lessonTest()
    {
        return $this->belongsTo(LessonTest::class);
    }

    public function answers()
    {
        return $this->hasMany(AnswerLessonTest::class, 'question_id');
    }
}
