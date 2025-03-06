<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'userId',
        'lessonId',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lessonId');
    }
} 