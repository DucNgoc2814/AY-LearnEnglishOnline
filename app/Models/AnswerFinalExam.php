<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerFinalExam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'questionFinalExamId',
        'answer',
        'isCorrect',
        'order_number'
    ];

    protected $casts = [
        'isCorrect' => 'boolean',
        'order_number' => 'integer'
    ];

    public function questionFinalExam()
    {
        return $this->belongsTo(QuestionFinalExam::class, 'questionFinalExamId');
    }
} 