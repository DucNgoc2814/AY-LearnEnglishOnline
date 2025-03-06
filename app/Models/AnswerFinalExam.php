<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerFinalExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'questionFinalExamId', 'answer', 'isCorrect'
    ];

    public function questionFinalExam()
    {
        return $this->belongsTo(QuestionFinalExam::class, 'questionFinalExamId');
    }
}
