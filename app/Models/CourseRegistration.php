<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CourseRegistration extends BaseModel
{
    public static function getBaseRules($id = null)
    {
        return [
            'course_id' => [
                'required',
                'exists:courses,id',
            ],
            'student_ids' => [
                'required',
                'array',
                'min:1',
            ],
            'student_ids.*' => [
                'required',
                'exists:students,id',
            ],
            // 'status' => [
            //     'nullable',
            //     'in:pending,active,completed,cancelled',
            // ],
            // 'fee_amount' => [
            //     'nullable',
            //     'numeric',
            //     'min:0',
            // ],
            // 'payment_status' => [
            //     'nullable',
            //     'in:pending,paid,refunded',
            // ],
            // 'payment_method' => [
            //     'nullable',
            //     'string',
            // ],
            // 'payment_date' => [
            //     'nullable',
            //     'date',
            // ],
            // 'invoice_number' => [
            //     'nullable',
            //     'string',
            // ],
            // 'enrollment_date' => [
            //     'nullable',
            //     'date',
            // ],
            // 'completion_date' => [
            //     'nullable',
            //     'date',
            //     'after:enrollment_date',
            // ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    public static function getFields()
    {
        return [
            'course_id' => [
                'label' => 'Khóa học',
                'type' => 'select',
                'options' => Course::pluck('title', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'student_ids' => [
                'label' => 'Học viên',
                'type' => 'select',
                'options' => Student::pluck('full_name', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'multiple' => true,
                'relation' => 'students', // Quan hệ với bảng students
                'display_fields' => ['student_code', 'full_name'], //Chọn các trường cần hiển thị
                'badge_color' => 'blue', // Tùy chỉnh màu sắc badge
                'separator' => ' - ', //Tùy chỉnh ký tự ngăn cách
                'help' => 'Có thể chọn nhiều học viên cùng lúc'
            ],
            // 'status' => [
            //     'label' => 'Trạng thái',
            //     'type' => 'select',
            //     'options' => [
            //         'pending' => 'Chờ xử lý',
            //         'active' => 'Đang học',
            //         'completed' => 'Đã hoàn thành',
            //         'cancelled' => 'Đã hủy'
            //     ],
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
            // 'fee_amount' => [
            //     'label' => 'Học phí',
            //     'type' => 'number',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
            // 'payment_status' => [
            //     'label' => 'Trạng thái thanh toán',
            //     'type' => 'select',
            //     'options' => [
            //         'pending' => 'Chờ thanh toán',
            //         'paid' => 'Đã thanh toán',
            //         'refunded' => 'Đã hoàn tiền'
            //     ],
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
            // 'payment_method' => [
            //     'label' => 'Phương thức thanh toán',
            //     'type' => 'text',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
            // 'payment_date' => [
            //     'label' => 'Ngày thanh toán',
            //     'type' => 'date',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
            // 'invoice_number' => [
            //     'label' => 'Số hóa đơn',
            //     'type' => 'text',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
            // 'enrollment_date' => [
            //     'label' => 'Ngày đăng ký',
            //     'type' => 'date',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
            // 'completion_date' => [
            //     'label' => 'Ngày hoàn thành',
            //     'type' => 'date',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
            'notes' => [
                'label' => 'Ghi chú',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
        ];
    }
    public static function getFormFields()
    {
        $fields = [];
        foreach (self::getFields() as $key => $field) {
            if (!isset($field['editable']) || $field['editable']) {
                $fields[$key] = $field;
            }
        }
        return $fields;
    }

    /**
     * Get fields for listing
     */
    public static function getListFields()
    {
        return self::getFields();
    }

    protected static function bootHasSlug()
    {
        // Override to disable slug generation
    }
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
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_registration_student')
                    ->withTimestamps();
    }

    /**
     * Lấy danh sách các lớp học của học viên
     */
    public function classStudents()
    {
        return $this->hasMany(ClassStudent::class, 'registration_id');
    }

    /**
     * Lấy lớp học hiện tại của học viên (nếu có)
     */
    public function currentClass()
    {
        return $this->classStudents()
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

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
