<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Classes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'category_id',
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
        'is_active' => 'boolean',
        'class_type' => 'string'
    ];

    // Định nghĩa các giá trị cho class_type
    const TYPE_ONLINE = 'online';
    const TYPE_OFFLINE = 'offline';
    const TYPE_HYBRID = 'hybrid';

    // Các class_type có thể có
    public static $types = [
        self::TYPE_ONLINE,
        self::TYPE_OFFLINE,
        self::TYPE_HYBRID
    ];

    // Định nghĩa các giá trị enum cho status
    const STATUS_PENDING = 'pending';
    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    // Các status có thể có
    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_ACTIVE,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'teacher_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class, 'class_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_registrations', 'class_id', 'student_id')
            ->withPivot(['status', 'fee_amount', 'payment_status', 'payment_method', 'payment_date', 'invoice_number', 'enrollment_date', 'completion_date', 'notes'])
            ->withTimestamps();
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(ClassSchedule::class, 'class_id');
    }

    /**
     * Lấy tất cả các phiên học thuộc lớp này thông qua bảng class_schedules.
     */
    public function sessions()
    {
        return $this->hasManyThrough(
            ClassSession::class,
            ClassSchedule::class,
            'class_id',    // Foreign key on class_schedules table
            'schedule_id', // Foreign key on class_sessions table
            'id',          // Local key on classes table
            'id'           // Local key on class_schedules table
        );
    }

    public function hasMinimumStudents(): bool
    {
        return $this->current_students >= $this->max_students;
    }

    public function hasAvailableSlots(): bool
    {
        return $this->current_students < $this->max_students;
    }

    public function hasStudent($studentId): bool
    {
        return $this->students()->where('students.id', $studentId)->exists();
    }

    public function updateCurrentStudents(): self
    {
        $this->current_students = $this->students()->wherePivot('status', 'active')->count();
        $this->save();
        return $this;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }
    public function scopeCompleted($query)
    {
        return $query->where('end_date', '<', now());
    }

    public function getAvailableSeats(): int
    {
        return max(0, $this->max_students - $this->current_students);
    }

    public function isEnrollmentOpen(): bool
    {
        if (!$this->start_date || !$this->end_date) {
            return true;
        }
        return now()->lessThanOrEqualTo($this->end_date);
    }

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
        $this->status = 'active';
        $this->save();
    }

    public function complete()
    {
        $this->status = 'completed';
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

    /**
     * Get the assistant teacher associated with the class.
     */
    public function assistant()
    {
        return $this->belongsTo(Employee::class, 'assistant_id');
    }

    /**
     * Get the resources for the class.
     */
    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }
}
