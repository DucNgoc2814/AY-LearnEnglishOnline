<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassStudent extends BaseModel
{

    /**
     * Các trạng thái có thể có của học viên trong lớp
     */
    const STATUS_ACTIVE = 'active';
    const STATUS_TRANSFERRED = 'transferred';
    const STATUS_DROPPED = 'dropped';

    public static function getBaseRules($id = null)
    {
        return [
            'class_id' => [
                'required',
                'exists:classes,id'
            ],
            'registration_id' => [
                'required',
                'exists:course_registrations,id',
                'unique:class_students,registration_id,' . $id . ',id,deleted_at,NULL'
            ],
            'status' => [
                'required',
                'in:active,transferred,dropped'
            ],
            'start_date' => [
                'required',
                'date',
                'before_or_equal:end_date'
            ],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ],
            'notes' => [
                'nullable',
                'string',
                'max:1000'
            ]
        ];
    }

    public static function getFields()
    {
        return [
            'class_id' => [
                'label' => 'Lớp học',
                'type' => 'select',
                'options' => Classes::pluck('name', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'onchange' => 'updateRegistrationOptions'
            ],
            'registration_id' => [
                'label' => 'Học viên',
                'type' => 'select',
                'options' => function ($formData) {
                    if (empty($formData['class_id'])) {
                        return [];
                    }

                    $class = Classes::find($formData['class_id']);
                    if (!$class) {
                        return [];
                    }

                    // Lấy tất cả học viên đã đăng ký và thanh toán khóa học
                    return CourseRegistration::where('course_id', $class->course_id)
                        ->where('status', 'active')
                        ->where('payment_status', 'paid')
                        ->with(['student' => function($query) {
                            $query->select('id', 'name', 'code');
                        }])
                        ->get()
                        ->mapWithKeys(function ($registration) {
                            // Kiểm tra xem học viên đã được xếp vào lớp nào chưa
                            $currentClass = $registration->classStudent()
                                ->where('status', 'active')
                                ->first();

                            $classInfo = $currentClass ? " (Đang học lớp: {$currentClass->class->name})" : " (Chưa xếp lớp)";

                            return [
                                $registration->id =>
                                    "[{$registration->student->code}] {$registration->student->name} - {$registration->invoice_number}{$classInfo}"
                            ];
                        })
                        ->toArray();
                },
                'depends' => ['class_id'],
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'placeholder' => 'Chọn lớp học trước'
            ],
            'status' => [
                'label' => 'Trạng thái',
                'type' => 'select',
                'options' => [
                    'active' => 'Đang học',
                    'transferred' => 'Đã chuyển lớp',
                    'dropped' => 'Đã nghỉ học'
                ],
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'start_date' => [
                'label' => 'Ngày bắt đầu',
                'type' => 'date',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'end_date' => [
                'label' => 'Ngày kết thúc',
                'type' => 'date',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'notes' => [
                'label' => 'Ghi chú',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ]
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
     * Kiểm tra xem học viên có đang học không
     */
    public function isActive(): bool
    {
        return $this->status === 'active' &&
            (!$this->end_date || $this->end_date->isFuture());
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

    /**
     * Scope lấy danh sách học viên đang học
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            });
    }

    /**
     * Scope lấy danh sách học viên theo lớp
     */
    public function scopeByClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }

    /**
     * Chuyển học viên sang lớp khác
     */
    public function transferToClass($newClassId, $notes = null)
    {
        $this->update([
            'status' => 'transferred',
            'end_date' => now(),
            'notes' => $notes
        ]);

        return self::create([
            'class_id' => $newClassId,
            'registration_id' => $this->registration_id,
            'status' => 'active',
            'start_date' => now(),
            'notes' => "Chuyển từ lớp {$this->class->name}"
        ]);
    }

    /**
     * Cho học viên nghỉ học
     */
    public function dropOut($reason = null)
    {
        return $this->update([
            'status' => 'dropped',
            'end_date' => now(),
            'notes' => $reason
        ]);
    }
}
