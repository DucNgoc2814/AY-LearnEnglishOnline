<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassStudent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_id',
        'registration_id',
        'status',
        'start_date',
        'end_date',
        'notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Các trạng thái có thể có của học viên trong lớp
     */
    const STATUS_ACTIVE = 'active';
    const STATUS_TRANSFERRED = 'transferred';
    const STATUS_DROPPED = 'dropped';

    /**
     * Lấy thông tin lớp học
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * Lấy thông tin đăng ký khóa học
     */
    public function registration(): BelongsTo
    {
        return $this->belongsTo(CourseRegistration::class, 'registration_id');
    }

    /**
     * Lấy thông tin học viên thông qua đăng ký khóa học
     */
    public function student()
    {
        return $this->hasOneThrough(
            Student::class,
            CourseRegistration::class,
            'id', // Khóa ngoại trên bảng trung gian (course_registrations)
            'id', // Khóa chính của bảng đích (students)
            'registration_id', // Khóa ngoại trên bảng hiện tại (class_students)
            'student_id' // Khóa ngoại trên bảng trung gian trỏ đến bảng đích
        );
    }

    /**
     * Scope query để lấy học viên đang active trong lớp
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Kiểm tra học viên có đang active trong lớp không
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Kiểm tra học viên đã chuyển lớp chưa
     */
    public function isTransferred(): bool
    {
        return $this->status === self::STATUS_TRANSFERRED;
    }

    /**
     * Kiểm tra học viên đã nghỉ học chưa
     */
    public function isDropped(): bool
    {
        return $this->status === self::STATUS_DROPPED;
    }
}
