<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'student_id',
        'session_id',
        'join_time',
        'leave_time',
        'duration',
        'ip_address',
        'device_info',
        'meta_data',
    ];

    protected $casts = [
        'join_time' => 'datetime',
        'leave_time' => 'datetime',
        'device_info' => 'array',
        'meta_data' => 'array',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function session()
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }
} 