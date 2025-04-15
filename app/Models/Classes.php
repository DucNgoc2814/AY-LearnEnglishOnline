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
        'name',
        'code',
        'teacher_id',
        'start_date',
        'end_date',
        'enrollment_deadline',
        'max_students',
        'min_students',
        'current_students',
        'status',
        'description',
        'schedule',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'enrollment_deadline' => 'date',
        'max_students' => 'integer',
        'min_students' => 'integer',
        'current_students' => 'integer',
        'schedule' => 'json',
        'is_active' => 'boolean'
    ];

    /**
     * Các giá trị enum cho status
     */
    const STATUS_PENDING = 'pending';
    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Lấy giáo viên của lớp
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'teacher_id');
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
     * Kiểm tra xem lớp có đủ học sinh chưa
     */
    public function hasMinimumStudents(): bool
    {
        return $this->current_students >= $this->min_students;
    }

    /**
     * Kiểm tra xem lớp có còn chỗ không
     */
    public function hasAvailableSlots(): bool
    {
        return $this->current_students < $this->max_students;
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
        $this->current_students = $this->students()->wherePivot('status', 'active')->count();
        $this->save();
        return $this;
    }

    /**
     * Scope cho lớp đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
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
        return max(0, $this->max_students - $this->current_students);
    }

    /**
     * Kiểm tra xem đăng ký đã mở chưa
     */
    public function isEnrollmentOpen(): bool
    {
        return now()->lessThanOrEqualTo($this->enrollment_deadline);
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
        $this->status = self::STATUS_ACTIVE;
        $this->save();
    }

    public function complete()
    {
        $this->status = self::STATUS_COMPLETED;
        $this->save();
    }

    public function cancel()
    {
        $this->status = self::STATUS_CANCELLED;
        $this->save();
    }

    public function incrementEnrolledCount()
    {
        $this->increment('current_students');
    }

    public function decrementEnrolledCount()
    {
        $this->decrement('current_students');
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
