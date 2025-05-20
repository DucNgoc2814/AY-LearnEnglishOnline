<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseRegistration extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_registrations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'class_id',
        'student_id',
        'status',
        'fee_amount',
        'payment_status',
        'payment_method',
        'payment_date',
        'invoice_number',
        'enrollment_date',
        'completion_date',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fee_amount' => 'decimal:2',
        'payment_date' => 'date',
        'enrollment_date' => 'date',
        'completion_date' => 'date',
    ];

    // Định nghĩa các giá trị cho status
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

    // Định nghĩa các giá trị cho payment_status
    const PAYMENT_PENDING = 'pending';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_REFUNDED = 'refunded';

    // Các payment_status có thể có
    public static $paymentStatuses = [
        self::PAYMENT_PENDING,
        self::PAYMENT_PAID,
        self::PAYMENT_REFUNDED
    ];

    /**
     * Lấy thông tin học viên
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Lấy danh sách các lớp học viên đã được xếp vào
     */
    public function classAssignments(): HasMany
    {
        return $this->hasMany(ClassStudent::class, 'registration_id');
    }

    /**
     * Lấy lớp học hiện tại của học viên (nếu có)
     */
    public function currentClass()
    {
        return $this->classAssignments()
            ->where('status', ClassStudent::STATUS_ACTIVE)
            ->first();
    }

    /**
     * Get the attendance records for this registration.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'student_id', 'student_id')
            ->whereHas('classSession', function ($query) {
                $query->where('class_id', $this->class_id);
            });
    }

    /**
     * Scope a query to only include active registrations.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include completed registrations.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include pending registrations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include dropped registrations.
     */
    public function scopeDropped($query)
    {
        return $query->where('status', 'dropped');
    }

    /**
     * Scope a query to filter by payment status.
     */
    public function scopePaymentStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }
}
