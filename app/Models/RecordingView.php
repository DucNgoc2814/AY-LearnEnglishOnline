<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecordingView extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'recording_id',
        'user_id',
        'session_id',
        'start_time',
        'end_time',
        'duration_seconds',
        'completion_percentage',
        'watch_position',
        'view_count',
        'last_viewed_at',
        'ip_address',
        'device_info',
        'is_downloaded',
    ];

    protected $casts = [
        'recording_id' => 'integer',
        'user_id' => 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'duration_seconds' => 'integer',
        'completion_percentage' => 'decimal:2',
        'watch_position' => 'integer',
        'view_count' => 'integer',
        'last_viewed_at' => 'datetime',
        'device_info' => 'json',
        'is_downloaded' => 'boolean',
    ];

    /**
     * Get the recording associated with this view
     */
    public function recording(): BelongsTo
    {
        return $this->belongsTo(OnlineSessionRecording::class, 'recording_id');
    }

    /**
     * Get the user associated with this view
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Check if the recording was watched completely
     */
    public function isCompleted(): bool
    {
        return $this->completion_percentage >= 90;
    }

    /**
     * Get the formatted duration
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration_seconds / 3600);
        $minutes = floor(($this->duration_seconds % 3600) / 60);
        $seconds = $this->duration_seconds % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
    }

    /**
     * Get the formatted watch position
     */
    public function getFormattedWatchPosition(): string
    {
        $hours = floor($this->watch_position / 3600);
        $minutes = floor(($this->watch_position % 3600) / 60);
        $seconds = $this->watch_position % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
    }

    /**
     * Update the view with the current watch position
     * Returns the updated completion percentage
     */
    public function updateWatchPosition(int $position, int $totalDuration = null): float
    {
        $this->watch_position = $position;
        $this->last_viewed_at = now();
        
        // If total duration is provided, update completion percentage
        if ($totalDuration) {
            $this->completion_percentage = min(100, ($position / $totalDuration) * 100);
        }
        
        $this->save();
        
        return $this->completion_percentage;
    }

    /**
     * Update the view time for a recording
     */
    public function recordViewTime(int $duration): void
    {
        $this->duration_seconds += $duration;
        $this->end_time = now();
        $this->save();
    }

    /**
     * Get the device type from device info
     */
    public function getDeviceType(): string
    {
        $deviceInfo = $this->device_info;
        
        if (isset($deviceInfo['user_agent'])) {
            $ua = $deviceInfo['user_agent'];
            
            if (preg_match('/mobile|android|iphone/i', $ua)) {
                return 'Mobile';
            } elseif (preg_match('/ipad|tablet/i', $ua)) {
                return 'Tablet';
            } else {
                return 'Desktop';
            }
        }
        
        return 'Unknown';
    }
} 