<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'teacher_id',
        'name',
        'code',
        'description',
        'start_date',
        'end_date',
        'capacity',
        'enrolled_count',
        'status',
        'meta_data'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'capacity' => 'integer',
        'enrolled_count' => 'integer',
        'meta_data' => 'array'
    ];

    /**
     * Lấy khóa học của lớp
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Lấy giáo viên của lớp
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Lấy danh sách học viên
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'class_student')
            ->withPivot(['status', 'enrolled_at'])
            ->withTimestamps();
    }

    /**
     * Lấy lịch học
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(ClassSession::class, 'class_id');
    }

    /**
     * Lấy danh sách online room của lớp
     */
    public function onlineRooms(): HasMany
    {
        return $this->hasMany(OnlineRoom::class, 'roomable_id')
            ->where('roomable_type', Classes::class);
    }

    /**
     * Kiểm tra xem lớp có đủ học sinh chưa
     */
    public function hasMinimumStudents(): bool
    {
        return $this->enrolled_count >= $this->capacity;
    }

    /**
     * Kiểm tra xem lớp có còn chỗ không
     */
    public function hasAvailableSlots(): bool
    {
        return $this->enrolled_count < $this->capacity;
    }

    /**
     * Kiểm tra xem một học viên đã đăng ký lớp hay chưa
     */
    public function hasStudent($studentId): bool
    {
        return $this->students()->where('students.id', $studentId)->exists();
    }

    /**
     * Cập nhật số lượng học viện hiện tại
     */
    public function updateCurrentStudents(): self
    {
        $this->enrolled_count = $this->students()->wherePivot('status', 'active')->count();
        $this->save();
        return $this;
    }

    /**
     * Scope cho lớp đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope cho lớp sắp khai giảng
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    /**
     * Scope cho lớp đang diễn ra
     */
    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    /**
     * Scope cho lớp đã kết thúc
     */
    public function scopeCompleted($query)
    {
        return $query->where('end_date', '<', now());
    }

    /**
     * Kiểm tra xem lớp có còn chỗ không
     */
    public function getAvailableSeats(): int
    {
        return max(0, $this->capacity - $this->enrolled_count);
    }

    /**
     * Kiểm tra xem đăng ký đã mở chưa
     */
    public function isEnrollmentOpen(): bool
    {
        if (!$this->start_date || !$this->end_date) {
            return true;
        }
        return now()->lessThanOrEqualTo($this->end_date);
    }

    /**
     * Lấy tiến độ học tập của lớp
     */
    public function getProgress(): float
    {
        if (!$this->start_date || !$this->end_date) {
            return 0;
        }

        $total = $this->end_date->diffInDays($this->start_date);
        if ($total === 0) {
            return 0;
        }

        $elapsed = now()->diffInDays($this->start_date);
        return min(100, round(($elapsed / $total) * 100, 2));
    }

    public function start()
    {
        $this->status = 'in_progress';
        $this->save();
    }

    public function complete()
    {
        $this->status = 'completed';
        $this->save();
    }

    public function incrementEnrolledCount()
    {
        $this->increment('enrolled_count');
    }

    public function decrementEnrolledCount()
    {
        $this->decrement('enrolled_count');
    }

    public function getCompletionRate(): float
    {
        $totalSessions = $this->sessions()->count();
        if ($totalSessions === 0) {
            return 0;
        }

        $completedSessions = $this->sessions()
            ->where('status', 'completed')
            ->count();

        return round(($completedSessions / $totalSessions) * 100, 2);
    }

    public function getAttendanceRate(): float
    {
        $sessions = $this->sessions;
        if ($sessions->isEmpty()) {
            return 0;
        }

        $rates = $sessions->map(function ($session) {
            return $session->getAttendanceRate();
        });

        return round($rates->avg(), 2);
    }

    public function isStudentEnrolled($studentId): bool
    {
        return $this->students()
            ->where('student_id', $studentId)
            ->exists();
    }

    public function getNextSession()
    {
        return $this->sessions()
            ->where('session_date', '>=', now())
            ->orderBy('session_date')
            ->orderBy('start_time')
            ->first();
    }
} 