<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class OnlineRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'roomable_type',
        'roomable_id',
        'room_id',
        'host_id',
        'meeting_id',
        'password',
        'provider',
        'settings',
        'start_url',
        'join_url',
        'start_time',
        'duration',
        'timezone',
        'status',
        'description',
        'is_active',
        'original_zoom_session_id'
    ];

    protected $casts = [
        'settings' => 'json',
        'start_time' => 'datetime',
        'duration' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Lấy buổi học của phòng học online
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(ClassSession::class, 'session_id');
    }

    /**
     * Lấy bản ghi của phòng học online
     */
    public function recording(): HasOne
    {
        return $this->hasOne(OnlineSessionRecording::class, 'room_id');
    }

    /**
     * Kiểm tra xem phòng học online đã bắt đầu chưa
     */
    public function isStarted(): bool
    {
        return $this->status === 'in_progress';
    }

    /**
     * Kiểm tra xem phòng học online đã kết thúc chưa
     */
    public function isEnded(): bool
    {
        return $this->status === 'ended';
    }

    /**
     * Kiểm tra xem phòng học online đã lên lịch chưa
     */
    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    /**
     * Lấy thời gian còn lại đến khi phòng học bắt đầu
     */
    public function getTimeToStartAttribute(): ?string
    {
        if (!$this->start_time || $this->isStarted() || $this->isEnded()) {
            return null;
        }
        
        $now = Carbon::now();
        if ($now->greaterThan($this->start_time)) {
            return 'Đã quá giờ bắt đầu';
        }
        
        $diff = $now->diff($this->start_time);
        
        if ($diff->days > 0) {
            return sprintf('%d ngày %d giờ', $diff->days, $diff->h);
        }
        
        if ($diff->h > 0) {
            return sprintf('%d giờ %d phút', $diff->h, $diff->i);
        }
        
        return sprintf('%d phút', $diff->i);
    }

    /**
     * Bắt đầu phòng học online
     */
    public function start()
    {
        $this->start_time = now();
        $this->status = 'in_progress';
        $this->save();
    }

    /**
     * Kết thúc phòng học online
     */
    public function end()
    {
        $this->end_time = now();
        $this->calculateDuration();
        $this->status = 'ended';
        $this->save();
    }

    /**
     * Hủy phòng học online
     */
    public function cancel(): self
    {
        $this->status = 'cancelled';
        $this->save();
        return $this;
    }

    /**
     * Tạo URL tham gia cho học viên
     */
    public function generateStudentJoinUrl(User $user, bool $isHost = false): string
    {
        // Xử lý URL tùy theo provider
        switch ($this->provider) {
            case 'zoom':
                $password = $isHost ? $this->password : $this->password;
                $url = $this->join_url;
                
                if (strpos($url, '?') !== false) {
                    $url .= '&';
                } else {
                    $url .= '?';
                }
                
                $url .= 'name=' . urlencode($user->name);
                
                if ($password) {
                    $url .= '&pwd=' . urlencode($password);
                }
                
                return $url;
                
            case 'google_meet':
                return $this->join_url;
                
            case 'microsoft_teams':
                return $this->join_url;
                
            default:
                return $this->join_url;
        }
    }

    /**
     * Scope lấy phòng học online sắp diễn ra
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'scheduled')
            ->where('start_time', '>', Carbon::now());
    }

    /**
     * Scope lấy phòng học online đang diễn ra
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Scope lấy phòng học online đã kết thúc
     */
    public function scopeEnded($query)
    {
        return $query->where('status', 'ended');
    }

    /**
     * Scope lấy phòng học online đã hủy
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope lấy phòng học online theo nhà cung cấp
     */
    public function scopeByProvider($query, $provider)
    {
        return $query->where('provider', $provider);
    }

    public function calculateDuration()
    {
        if ($this->start_time && $this->end_time) {
            $this->duration = $this->end_time->diffInMinutes($this->start_time);
        }
    }

    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $minutes);
        }

        return sprintf('%d phút', $minutes);
    }

    public function isActive(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function getTotalParticipants(): int
    {
        return $this->participants()->count();
    }

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function attendanceDetails(): HasMany
    {
        return $this->hasMany(OnlineAttendanceDetail::class);
    }

    public function roomable()
    {
        return $this->morphTo();
    }

    public function recordings()
    {
        return $this->hasMany(OnlineSessionRecording::class);
    }
} 