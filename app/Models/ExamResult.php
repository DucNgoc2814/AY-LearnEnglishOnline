<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamResult extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'userId',
        'finalExamId',
        'score',
        'timeTaken',
        'attemptNumber',
        'status',
        'startTime',
        'endTime',
        'feedback'
    ];

    protected $casts = [
        'score' => 'integer',
        'timeTaken' => 'integer',
        'attemptNumber' => 'integer',
        'startTime' => 'datetime',
        'endTime' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function finalExam()
    {
        return $this->belongsTo(FinalExam::class, 'finalExamId');
    }

    public function examResultItems()
    {
        return $this->hasMany(ExamResultItem::class, 'examResultId');
    }
} 