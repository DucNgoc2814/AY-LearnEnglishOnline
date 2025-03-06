<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionFinalExam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'final_exam_id',
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

    public function finalExam()
    {
        return $this->belongsTo(FinalExam::class);
    }

    public function answers()
    {
        return $this->hasMany(AnswerFinalExam::class, 'question_id');
    }
}
