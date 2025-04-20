<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Carbon\Carbon;

class ClassSession extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'class_id',
        'schedule_id',
        'session_date',
        'start_time',
        'end_time',
        'topic',
        'content',
        'session_materials',
        'recording_url',
        'attendance_required',
        'notes',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'session_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'attendance_required' => 'boolean',
        'session_materials' => 'array'
    ];

    /**
     * Get the class to which this session belongs
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * Get the schedule that this session belongs to.
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(ClassSchedule::class, 'schedule_id');
    }

    /**
     * Get the resource used in this session.
     */
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    /**
     * Get the attendance records for this session.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'session_id');
    }

    /**
     * Get the students who are enrolled in this class.
     */
    public function students()
    {
        return $this->class->students();
    }

    /**
     * Lấy phòng học online của buổi học
     */
    public function onlineRoom(): MorphOne
    {
        return $this->morphOne(OnlineRoom::class, 'roomable');
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
     * Scope a query to only include future sessions.
     */
    public function scopeFuture($query)
    {
        return $query->where('session_date', '>=', now()->toDateString());
    }

    /**
     * Scope a query to only include past sessions.
     */
    public function scopePast($query)
    {
        return $query->where('session_date', '<', now()->toDateString());
    }

    /**
     * Scope a query to only include sessions for a specific date.
     */
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('session_date', $date);
    }

    /**
     * Scope a query to only include sessions for a specific class.
     */
    public function scopeForClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include sessions where attendance is required.
     */
    public function scopeAttendanceRequired($query)
    {
        return $query->where('attendance_required', true);
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

    /**
     * Kiểm tra xem buổi học có thể tham gia được không (hiển thị nút vào học)
     * Chỉ cho phép tham gia trong vòng 15 phút trước khi bắt đầu
     */
    public function canJoin(): bool
    {
        if (!$this->session_date || !$this->start_time) {
            return false;
        }

        // Tạo datetime đầy đủ từ session_date và start_time
        $sessionDateTime = Carbon::parse($this->session_date->format('Y-m-d') . ' ' . $this->start_time->format('H:i:s'));

        // Lấy thời gian hiện tại
        $now = Carbon::now();

        // Tính số phút còn lại trước khi buổi học bắt đầu
        $minutesUntilSession = $now->diffInMinutes($sessionDateTime, false);

        // Cho phép tham gia trong vòng 15 phút trước khi bắt đầu và trong suốt thời gian diễn ra buổi học
        return $minutesUntilSession <= 15 && $minutesUntilSession >= -60;
    }
}
