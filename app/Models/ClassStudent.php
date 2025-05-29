<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ClassStudent extends BaseModel
{

    /**
     * Các trạng thái có thể có của học viên trong lớp
     */
    const STATUS_ACTIVE = 'active';
    const STATUS_TRANSFERRED = 'transferred';
    const STATUS_DROPPED = 'dropped';

    protected $appends = ['student_name', 'invoice_number'];

    public function getStudentNameAttribute()
    {
        return $this->student ? $this->student->full_name : 'N/A';
    }

    public function getInvoiceNumberAttribute()
    {
        return $this->registration ? $this->registration->invoice_number : 'N/A';
    }

    public static function getBaseRules($id = null)
    {
        return [
            'class_id' => [
                'required',
                'exists:classes,id'
            ],
            'registration_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Extract registration_id from the composite key if needed
                    $registrationId = explode('-', $value)[0] ?? $value;

                    if (!is_numeric($registrationId)) {
                        $fail('The registration ID must be a valid number.');
                        return;
                    }

                    if (!CourseRegistration::where('id', $registrationId)->exists()) {
                        $fail('The selected registration does not exist.');
                    }
                },
                function ($attribute, $value, $fail) use ($id) {
                    // Extract registration_id from the composite key if needed
                    $registrationId = explode('-', $value)[0] ?? $value;

                    $exists = ClassStudent::where('registration_id', $registrationId)
                        ->where('id', '!=', $id)
                        ->whereNull('deleted_at')
                        ->exists();

                    if ($exists) {
                        $fail('This registration is already assigned to a class.');
                    }
                }
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
                'display_field' => 'name'
            ],
            'student_name' => [
                'label' => 'Học viên',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => false
            ],
            'invoice_number' => [
                'label' => 'Mã hóa đơn',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => false,
                'prefix' => 'HD'
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
        $fields = parent::getFormFields();

        // Thêm trường registration_id cho form
        $fields['registration_id'] = [
            'label' => 'Học viên',
            'type' => 'select',
            'options' => function ($formData) {
                if (empty($formData['class_id'])) {
                    return [];
                }

                $class = Classes::find($formData['class_id']);
                if (!$class) {
                    Log::info('Không tìm thấy lớp học: ' . $formData['class_id']);
                    return [];
                }

                Log::info('Tìm học viên cho khóa học: ' . $class->course_id);

                // Lấy tất cả học viên đã đăng ký khóa học
                $registrations = CourseRegistration::where('course_id', $class->course_id)
                    ->with(['students' => function($query) {
                        $query->select('students.*');
                    }])
                    ->get();

                Log::info('Số lượng đăng ký tìm thấy: ' . $registrations->count());

                $options = [];
                foreach ($registrations as $registration) {
                    // Lấy danh sách học viên từ bảng trung gian
                    $students = DB::table('course_registration_student')
                        ->join('students', 'students.id', '=', 'course_registration_student.student_id')
                        ->where('course_registration_student.course_registration_id', $registration->id)
                        ->whereNull('students.deleted_at')
                        ->select('students.*', 'course_registration_student.course_registration_id')
                        ->get();

                    foreach ($students as $student) {
                        // Tạo key duy nhất cho mỗi học viên
                        $key = $registration->id;

                        // Kiểm tra xem học viên đã được xếp vào lớp nào chưa
                        $currentClass = ClassStudent::where('registration_id', $registration->id)
                            ->where('status', 'active')
                            ->first();

                        $classInfo = $currentClass
                            ? " (Đang học lớp: {$currentClass->class->name})"
                            : " (Chưa xếp lớp)";

                        $options[$key] = sprintf(
                            "%s - HD%s%s",
                            $student->full_name,
                            $registration->invoice_number,
                            $classInfo
                        );
                    }
                }

                return $options;
            },
            'depends' => ['class_id'],
            'searchable' => true,
            'sortable' => true,
            'editable' => true,
            'placeholder' => 'Chọn lớp học trước',
            'help' => 'Chọn học viên đã đăng ký khóa học'
        ];

        // Sắp xếp lại các trường
        $orderedFields = [
            'class_id' => $fields['class_id'],
            'registration_id' => $fields['registration_id'],
            'status' => $fields['status'],
            'start_date' => $fields['start_date'],
            'end_date' => $fields['end_date'],
            'notes' => $fields['notes']
        ];

        return $orderedFields;
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

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // If registration_id contains a hyphen, extract only the registration_id part
            if (is_string($model->registration_id) && str_contains($model->registration_id, '-')) {
                $model->registration_id = explode('-', $model->registration_id)[0];
            }
        });
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
            CourseRegistrationStudent::class,
            'course_registration_id', // Khóa ngoại trên bảng trung gian (course_registration_student)
            'id', // Khóa chính của bảng đích (students)
            'registration_id', // Khóa ngoại trên bảng hiện tại (class_students)
            'student_id' // Khóa ngoại trên bảng trung gian trỏ đến bảng đích
        );
    }

    /**
     * Lấy thông tin học viên thông qua bảng trung gian
     */
    public function students()
    {
        return $this->hasManyThrough(
            Student::class,
            CourseRegistrationStudent::class,
            'course_registration_id',
            'id',
            'registration_id',
            'student_id'
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
