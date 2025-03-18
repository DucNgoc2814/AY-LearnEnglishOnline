<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonResult extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'userId',
        'lessonTestId',
        'score',
        'timeTaken',
        'attemptNumber',
        'status'
    ];

    protected $casts = [
        'score' => 'integer',
        'timeTaken' => 'integer',
        'attemptNumber' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function lessonTest()
    {
        return $this->belongsTo(LessonTest::class, 'lessonTestId');
    }

    public function resultItems()
    {
        return $this->hasMany(LessonResultItem::class, 'lessonResultId');
    }
} 