<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attendance extends Model
{
    protected $fillable = [
        'sessionId',
        'studentId',
        'status',
        'checkInTime',
        'notes'
    ];

    protected $casts = [
        'checkInTime' => 'datetime:H:i'
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(ClassSession::class, 'sessionId');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'studentId');
    }
    
    /**
     * Get the online attendance details associated with the attendance record.
     */
    public function onlineDetail(): HasOne
    {
        return $this->hasOne(OnlineAttendanceDetail::class, 'attendance_id');
    }
    
    /**
     * Check if this is an online attendance
     */
    public function isOnlineAttendance(): bool
    {
        return $this->session->isOnline() && $this->onlineDetail()->exists();
    }
} 