<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'class_id',
        'session_date',
        'start_time',
        'end_time',
        'location',
        'status',
        'notes'
    ];

    protected $casts = [
        'session_date' => 'date',
    ];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
} 