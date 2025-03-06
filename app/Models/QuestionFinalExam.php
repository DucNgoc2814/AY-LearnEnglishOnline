<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionFinalExam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'finalExamId',
        'question',
        'orderNumber'
    ];

    protected $casts = [
        'orderNumber' => 'integer'
    ];

    public function finalExam()
    {
        return $this->belongsTo(FinalExam::class, 'finalExamId');
    }

    public function answers()
    {
        return $this->hasMany(AnswerFinalExam::class, 'questionFinalExamId');
    }
} 