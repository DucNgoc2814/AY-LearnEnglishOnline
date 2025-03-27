<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use WhichBrowser\Parser;

class OnlineAttendanceDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'attendance_id',
        'join_time',
        'leave_time',
        'duration_minutes',
        'ip_address',
        'device_info',
        'camera_on',
        'microphone_on',
        'screen_sharing'
    ];

    protected $casts = [
        'join_time' => 'datetime',
        'leave_time' => 'datetime',
        'duration_minutes' => 'integer',
        'camera_on' => 'boolean',
        'microphone_on' => 'boolean',
        'screen_sharing' => 'boolean'
    ];

    // Relationships
    public function attendance(): BelongsTo
    {
        return $this->belongsTo(Attendance::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // Methods
    public function getDeviceInfo(): array
    {
        $parser = new Parser($this->device_info);
        
        return [
            'browser' => $parser->browser->toString(),
            'os' => $parser->os->toString(),
            'device' => $parser->device->toString(),
        ];
    }

    public function calculateDuration()
    {
        if ($this->join_time && $this->leave_time) {
            $this->duration_minutes = $this->leave_time->diffInMinutes($this->join_time);
            $this->save();
        }
    }

    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d', $hours, $minutes);
        }

        return sprintf('%d minutes', $minutes);
    }

    // Scopes
    public function scopeToday($query)
    {
        return $query->whereDate('join_time', today());
    }

    public function scopeLoggedIn($query)
    {
        return $query->whereNotNull('join_time')->whereNull('leave_time');
    }

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('join_time')->whereNotNull('leave_time');
    }
} 