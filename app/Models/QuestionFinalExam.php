<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionFinalExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'finalExamId', 'question'
    ];

    public function finalExam()
    {
        return $this->belongsTo(FinalExam::class);
    }

    public function answers()
    {
        return $this->hasMany(AnswerFinalExam::class);
    }
}
