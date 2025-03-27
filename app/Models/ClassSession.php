<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class ClassSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_id',
        'schedule_id',
        'resource_id',
        'session_date',
        'start_time',
        'end_time',
        'room_number',
        'session_type',
        'topic',
        'content',
        'homework',
        'session_materials',
        'recording_url',
        'attendance_required',
        'notes',
        'status'
    ];

    protected $casts = [
        'session_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'attendance_required' => 'boolean',
        'session_materials' => 'array'
    ];

    /**
     * Lấy lớp học của buổi học
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    /**
     * Lấy lịch học của buổi học
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(ClassSchedule::class);
    }

    /**
     * Lấy tài nguyên của buổi học
     */
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

    /**
     * Lấy danh sách điểm danh của buổi học
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'session_id');
    }

    /**
     * Lấy phòng học online của buổi học
     */
    public function onlineRoom(): HasOne
    {
        return $this->hasOne(OnlineRoom::class);
    }

    /**
     * Lấy bản ghi buổi học
     */
    public function recording(): HasOne
    {
        return $this->hasOne(OnlineSessionRecording::class, 'session_id');
    }

    /**
     * Lấy danh sách hoạt động trong buổi học
     */
    public function activities(): HasMany
    {
        return $this->hasMany(SessionActivity::class, 'session_id');
    }

    /**
     * Lấy danh sách tương tác trong buổi học
     */
    public function interactions(): HasMany
    {
        return $this->hasMany(SessionInteraction::class, 'session_id');
    }

    /**
     * Kiểm tra xem buổi học đã kết thúc chưa
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Kiểm tra xem buổi học đã bị hủy
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Lấy tỷ lệ điểm danh của buổi học
     */
    public function getAttendanceRate(): float
    {
        $totalStudents = $this->class->students()->count();
        if ($totalStudents === 0) {
            return 0;
        }
        
        $presentCount = $this->attendances()
            ->whereIn('status', ['present', 'late'])
            ->count();
        return round(($presentCount / $totalStudents) * 100, 2);
    }

    /**
     * Lấy thời lượng của buổi học (phút)
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * Lấy thời lượng của buổi học dạng text
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;
        
        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $minutes);
        }
        
        return sprintf('%d phút', $minutes);
    }

    /**
     * Lấy trạng thái hiện tại dựa trên thời gian
     */
    public function getCurrentStatus(): string
    {
        $now = Carbon::now();
        $sessionDate = Carbon::parse($this->session_date);
        $startTime = Carbon::parse($this->start_time)->setDateFrom($sessionDate);
        $endTime = Carbon::parse($this->end_time)->setDateFrom($sessionDate);
        
        if ($this->status === 'cancelled') {
            return 'cancelled';
        }
        
        if ($now->lessThan($startTime)) {
            return 'upcoming';
        }
        
        if ($now->between($startTime, $endTime)) {
            return 'active';
        }
        
        return 'completed';
    }

    /**
     * Chuyển trạng thái buổi học thành đang diễn ra
     */
    public function start()
    {
        $this->status = 'in_progress';
        $this->save();
    }

    /**
     * Chuyển trạng thái buổi học thành đã hoàn thành
     */
    public function complete()
    {
        $this->status = 'completed';
        $this->save();
    }

    /**
     * Hủy buổi học
     */
    public function cancel()
    {
        $this->status = 'cancelled';
        $this->save();
    }

    /**
     * Scope lấy các buổi học sắp diễn ra
     */
    public function scopeUpcoming($query)
    {
        return $query->where('session_date', '>=', now()->toDateString())
            ->orderBy('session_date')
            ->orderBy('start_time');
    }

    /**
     * Scope lấy các buổi học đã hoàn thành
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope lấy các buổi học đang diễn ra
     */
    public function scopeInProgress($query)
    {
        return $query->whereDate('session_date', today())
            ->where('status', 'in_progress');
    }

    /**
     * Scope lấy các buổi học đã bị hủy
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope lấy các buổi học theo loại phiên
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('session_type', $type);
    }

    /**
     * Kiểm tra xem buổi học có phải là online không
     */
    public function isOnline(): bool
    {
        return $this->session_type === 'online';
    }

    /**
     * Kiểm tra xem buổi học đã bắt đầu chưa
     */
    public function hasStarted(): bool
    {
        return now()->greaterThanOrEqualTo($this->start_time);
    }

    /**
     * Kiểm tra xem buổi học đã kết thúc chưa
     */
    public function hasEnded(): bool
    {
        return now()->greaterThan($this->end_time);
    }

    /**
     * Kiểm tra xem buổi học đang diễn ra
     */
    public function isInProgress(): bool
    {
        return $this->hasStarted() && !$this->hasEnded();
    }

    /**
     * Kiểm tra xem buổi học có thể bắt đầu được không
     */
    public function canStart(): bool
    {
        return $this->status === 'scheduled' && 
            now()->between(
                $this->start_time->subMinutes(15),
                $this->end_time
            );
    }

    /**
     * Kiểm tra xem buổi học có phải là sắp diễn ra
     */
    public function isUpcoming(): bool
    {
        return $this->session_date->isFuture();
    }

    /**
     * Kiểm tra xem buổi học có phải là đã kết thúc
     */
    public function isPast(): bool
    {
        return $this->session_date->isPast();
    }

    /**
     * Kiểm tra xem buổi học có phải là đang diễn ra
     */
    public function isActive(): bool
    {
        return $this->status === 'in_progress';
    }

    /**
     * Lấy tỷ lệ hoàn thành hoạt động của buổi học
     */
    public function getActivityCompletionRate(): float
    {
        $totalActivities = $this->activities()->count();
        if ($totalActivities === 0) {
            return 0;
        }

        $completedActivities = $this->activities()
            ->where('status', 'completed')
            ->count();

        return round(($completedActivities / $totalActivities) * 100, 2);
    }
} 