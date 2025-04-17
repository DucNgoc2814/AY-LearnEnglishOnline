<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'session_id',
        'student_id',
        'status',
        'notes'
    ];

    /**
     * Các trạng thái điểm danh
     */
    const STATUS_PRESENT = 'present';
    const STATUS_ABSENT = 'absent';
    const STATUS_LATE = 'late';
    const STATUS_EXCUSED = 'excused';
    const STATUS_PENDING = 'pending';

    // Relationships
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function markedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marked_by');
    }

    public function onlineDetails(): HasMany
    {
        return $this->hasMany(OnlineAttendanceDetail::class);
    }

    // Methods
    public function checkIn()
    {
        $this->check_in_time = now();
        $this->status = 'present';
        $this->save();
    }

    public function checkOut()
    {
        $this->check_out_time = now();
        $this->calculateDuration();
        $this->save();
    }

    public function calculateDuration()
    {
        if ($this->check_in_time && $this->check_out_time) {
            $this->duration_minutes = $this->check_out_time->diffInMinutes($this->check_in_time);
        }
    }

    public function markAsAbsent()
    {
        $this->status = 'absent';
        $this->save();
    }

    public function markAsLate()
    {
        $this->status = 'late';
        $this->save();
    }

    public function isPresent(): bool
    {
        return $this->status === 'present';
    }

    public function isAbsent(): bool
    {
        return $this->status === 'absent';
    }

    public function isLate(): bool
    {
        return $this->status === 'late';
    }

    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $minutes);
        }

        return sprintf('%d phút', $minutes);
    }

    /**
     * Kiểm tra xem học viên có được phép vắng mặt không
     */
    public function isExcused(): bool
    {
        return $this->status === self::STATUS_EXCUSED;
    }

    /**
     * Kiểm tra xem học viên có tham dự (có mặt hoặc đi trễ) không
     */
    public function didAttend(): bool
    {
        return in_array($this->status, [self::STATUS_PRESENT, self::STATUS_LATE]);
    }

    /**
     * Cập nhật trạng thái điểm danh
     */
    public function updateStatus(string $status, ?string $remarks = null): self
    {
        $this->status = $status;
        
        if ($remarks) {
            $this->remarks = $remarks;
        }
        
        if ($status === self::STATUS_PRESENT && !$this->check_in_time) {
            $this->check_in_time = now();
        }
        
        $this->save();
        
        return $this;
    }

    /**
     * Đánh dấu học viên có mặt
     */
    public function markPresent(?\DateTime $checkInTime = null): self
    {
        $this->status = self::STATUS_PRESENT;
        $this->save();
        
        return $this;
    }

    /**
     * Đánh dấu học viên vắng mặt
     */
    public function markAbsent(?string $remarks = null): self
    {
        $this->status = self::STATUS_ABSENT;
        
        if ($remarks) {
            $this->remarks = $remarks;
        }
        
        $this->save();
        
        return $this;
    }

    /**
     * Đánh dấu học viên đi trễ
     */
    public function markLate(?\DateTime $checkInTime = null, ?int $lateMinutes = null): self
    {
        $this->status = self::STATUS_LATE;
        $this->check_in_time = $checkInTime ?? now();
        
        if ($lateMinutes !== null) {
            $this->late_minutes = $lateMinutes;
        } else {
            // Tính số phút trễ dựa trên thời gian bắt đầu buổi học
            $sessionStartTime = $this->session->start_time;
            $checkIn = $this->check_in_time;
            
            if ($sessionStartTime && $checkIn) {
                // Convert to Carbon if needed and calculate difference
                $carbonCheckIn = $checkIn instanceof \DateTime ? \Carbon\Carbon::instance($checkIn) : $checkIn;
                $carbonSessionStart = $sessionStartTime instanceof \DateTime ? \Carbon\Carbon::instance($sessionStartTime) : $sessionStartTime;
                $this->late_minutes = max(0, $carbonCheckIn->diffInMinutes($carbonSessionStart));
            }
        }
        
        $this->save();
        
        return $this;
    }

    /**
     * Đánh dấu học viên được phép vắng mặt
     */
    public function markExcused(string $remarks): self
    {
        $this->status = self::STATUS_EXCUSED;
        $this->remarks = $remarks;
        $this->save();
        
        return $this;
    }

    /**
     * Lấy thời lượng tham dự theo định dạng giờ:phút
     */
    public function getFormattedDurationAttribute(): string
    {
        if (!$this->duration_minutes) {
            return '00:00';
        }
        
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        
        return sprintf('%02d:%02d', $hours, $minutes);
    }

    /**
     * Scope lấy những học viên có mặt
     */
    public function scopePresent($query)
    {
        return $query->where('status', self::STATUS_PRESENT);
    }

    /**
     * Scope lấy những học viên vắng mặt
     */
    public function scopeAbsent($query)
    {
        return $query->where('status', self::STATUS_ABSENT);
    }

    /**
     * Scope lấy những học viên đi trễ
     */
    public function scopeLate($query)
    {
        return $query->where('status', self::STATUS_LATE);
    }

    /**
     * Scope lấy những học viên được phép vắng mặt
     */
    public function scopeExcused($query)
    {
        return $query->where('status', self::STATUS_EXCUSED);
    }

    /**
     * Scope lấy những học viên có tham dự (có mặt hoặc đi trễ)
     */
    public function scopeAttended($query)
    {
        return $query->whereIn('status', [self::STATUS_PRESENT, self::STATUS_LATE]);
    }
} 