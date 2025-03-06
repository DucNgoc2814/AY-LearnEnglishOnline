<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerLessonTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'questionLessonTestId', 'answer', 'isCorrect'
    ];

    public function questionLessonTest()
    {
        return $this->belongsTo(QuestionLessonTest::class, 'questionLessonTestId');
    }
}
