<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonTest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'lessonId',
        'slug',
        'name',
        'description',
        'duration',
        'minScore',
        'maxScore',
        'orderNumber',
        'isRequired',
        'totalAttempt',
        'maxAttempt'
    ];

    protected $casts = [
        'duration' => 'integer',
        'minScore' => 'integer',
        'maxScore' => 'integer',
        'orderNumber' => 'integer',
        'isRequired' => 'boolean',
        'totalAttempt' => 'integer',
        'maxAttempt' => 'integer'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessonId');
    }

    public function questions()
    {
        return $this->hasMany(QuestionLessonTest::class, 'lessonTestId');
    }

    public function lessonResults()
    {
        return $this->hasMany(LessonResult::class, 'lessonTestId');
    }

    public function latestResult()
    {
        return $this->hasOne(LessonResult::class, 'lessonTestId')->latest();
    }
} 