<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamResultItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'examResultId',
        'questionFinalExamId',
        'answerFinalExamId',
        'isCorrect'
    ];

    protected $casts = [
        'isCorrect' => 'boolean'
    ];

    public function examResult()
    {
        return $this->belongsTo(ExamResult::class, 'examResultId');
    }

    public function question()
    {
        return $this->belongsTo(QuestionFinalExam::class, 'questionFinalExamId');
    }

    public function answer()
    {
        return $this->belongsTo(AnswerFinalExam::class, 'answerFinalExamId');
    }
} 