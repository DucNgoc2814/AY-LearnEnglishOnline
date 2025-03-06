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
        'order_number'
    ];

    protected $casts = [
        'isCorrect' => 'boolean',
        'order_number' => 'integer'
    ];

    public function questionLessonTest()
    {
        return $this->belongsTo(QuestionLessonTest::class, 'questionLessonTestId');
    }
} 