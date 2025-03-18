<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinalExam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'courseId',
        'slug',
        'name',
        'description',
        'duration',
        'minScore',
        'maxScore',
        'totalAttempt',
        'maxAttempt',
        'isRequired'
    ];

    protected $casts = [
        'duration' => 'integer',
        'minScore' => 'integer',
        'maxScore' => 'integer',
        'totalAttempt' => 'integer',
        'maxAttempt' => 'integer',
        'isRequired' => 'boolean'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function questions()
    {
        return $this->hasMany(QuestionFinalExam::class, 'finalExamId');
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class, 'finalExamId');
    }
} 