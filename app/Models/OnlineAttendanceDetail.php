<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OnlineAttendanceDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'online_room_id',
        'user_id',
        'join_time',
        'leave_time',
        'duration_minutes',
        'participant_id',
        'participant_name',
        'participant_email',
        'attendance_status',
        'ip_address',
        'device_info',
        'participation_data',
        'notes',
        'original_attendance_detail_id',
    ];

    protected $casts = [
        'online_room_id' => 'integer',
        'user_id' => 'integer',
        'join_time' => 'datetime',
        'leave_time' => 'datetime',
        'duration_minutes' => 'integer',
        'device_info' => 'json',
        'participation_data' => 'json',
        'original_attendance_detail_id' => 'integer',
    ];

    /**
     * Get the online room associated with this attendance detail
     */
    public function onlineRoom(): BelongsTo
    {
        return $this->belongsTo(OnlineRoom::class, 'online_room_id');
    }

    /**
     * Get the user associated with this attendance detail
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the formatted duration
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d hours', $hours, $minutes);
        } else {
            return sprintf('%d minutes', $minutes);
        }
    }

    /**
     * Check if the user attended for the minimum required time
     */
    public function hasMinimumAttendance(int $minimumMinutes = 15): bool
    {
        return $this->duration_minutes >= $minimumMinutes;
    }

    /**
     * Check if the user is currently in the meeting
     */
    public function isActive(): bool
    {
        return $this->join_time && !$this->leave_time;
    }

    /**
     * Calculate the attendance percentage for a specific online room
     */
    public static function getAttendancePercentage(int $onlineRoomId, int $userId): float
    {
        $room = OnlineRoom::find($onlineRoomId);
        if (!$room) {
            return 0;
        }
        
        $totalSessionMinutes = $room->duration_minutes;
        if ($totalSessionMinutes <= 0) {
            return 0;
        }
        
        $totalAttendanceMinutes = static::where('online_room_id', $onlineRoomId)
            ->where('user_id', $userId)
            ->sum('duration_minutes');
            
        return min(100, ($totalAttendanceMinutes / $totalSessionMinutes) * 100);
    }
} 