<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'userId',
        'courseId',
        'status',
        'progress',
        'startDate',
        'completionDate',
        'lastAccessDate',
        'note'
    ];

    protected $casts = [
        'progress' => 'integer',
        'startDate' => 'datetime',
        'completionDate' => 'datetime',
        'lastAccessDate' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseId');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'enrollmentId');
    }
} 