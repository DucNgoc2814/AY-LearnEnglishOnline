<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecordingView extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'recording_id',
        'user_id',
        'view_date',
        'duration_watched',
        'ip_address',
        'device',
        'browser',
        'notes'
    ];

    protected $casts = [
        'view_date' => 'datetime',
        'duration_watched' => 'integer'
    ];

    /**
     * Lấy bản ghi được xem
     */
    public function recording(): BelongsTo
    {
        return $this->belongsTo(OnlineSessionRecording::class, 'recording_id');
    }

    /**
     * Lấy người dùng đã xem
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Cập nhật thời gian xem và vị trí cuối cùng
     */
    public function updateProgress($currentTime)
    {
        $totalDuration = $this->recording->duration;
        if ($totalDuration > 0) {
            $this->progress = min(100, ($currentTime / $totalDuration) * 100);
            $this->duration = $currentTime;
            $this->save();
        }
    }

    /**
     * Kiểm tra xem video đã xem xong chưa
     */
    public function isCompleted(): bool
    {
        return $this->progress >= 90;
    }

    /**
     * Format thời lượng xem theo định dạng phút:giây
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        }

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Lấy loại thiết bị từ user agent
     */
    public function getDeviceTypeFromUserAgent(): string
    {
        $userAgent = $this->user_agent;
        
        if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $userAgent)) {
            return 'mobile';
        }
        
        if (preg_match('/android|ipad|playbook|silk/i', $userAgent)) {
            return 'tablet';
        }
        
        return 'desktop';
    }

    /**
     * Scope lấy các lượt xem đã hoàn thành
     */
    public function scopeCompleted($query)
    {
        return $query->where('progress', '>=', 90);
    }

    /**
     * Scope lấy các lượt xem theo loại thiết bị
     */
    public function scopeByDevice($query, string $deviceType)
    {
        return $query->where('device_type', $deviceType);
    }

    /**
     * Scope lấy các lượt xem trong khoảng thời gian
     */
    public function scopeInPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('viewed_at', [$startDate, $endDate]);
    }

    public function getFormattedProgress(): string
    {
        return round($this->progress * 100) . '%';
    }

    public function calculateDuration()
    {
        if ($this->started_at && $this->ended_at) {
            $this->duration = $this->ended_at->diffInSeconds($this->started_at);
            $this->save();
        }
    }
} 