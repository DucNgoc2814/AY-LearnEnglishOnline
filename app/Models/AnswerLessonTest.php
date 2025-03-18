<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerLessonTest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'questionLessonTestId',
        'answer',
        'isCorrect',
        'answerType',
        'orderNumber',
        'caseSensitive',
        'alternativeAnswers'
    ];

    protected $casts = [
        'isCorrect' => 'boolean',
        'orderNumber' => 'integer',
        'caseSensitive' => 'boolean'
    ];

    public function questionLessonTest()
    {
        return $this->belongsTo(QuestionLessonTest::class, 'questionLessonTestId');
    }
}
