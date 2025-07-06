<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassStudent extends BaseModel
{
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
        $fields = self::getFields();

        // Thêm trường registration_id cho form
        $fields['registration_id'] = [
            'label' => 'Học viên',
            'type' => 'select',
            'options' => [],  // Options sẽ được load động qua AJAX
            'searchable' => true,
            'sortable' => true,
            'editable' => true,
            'depends' => ['class_id'],
            'placeholder' => 'Chọn lớp học trước',
            'help' => 'Chọn học viên đã đăng ký khóa học',
            'ajax' => [
                'url' => '/admin/class-students/get-students',
                'depends' => 'class_id'
            ]
        ];

        // Sắp xếp lại các trường
        $orderedFields = [
            'class_id' => $fields['class_id'],
            'registration_id' => $fields['registration_id'],
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
                $parts = explode('-', $model->registration_id);
                $model->registration_id = $parts[0];
            }
        });
    }

    /**
     * Lấy thông tin lớp học
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * Lấy thông tin đăng ký khóa học
     */
    public function registration()
    {
        return $this->belongsTo(CourseRegistration::class, 'registration_id');
    }

    /**
     * Lấy thông tin học viên thông qua đăng ký khóa học
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
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
     * Scope lấy danh sách học viên theo lớp
     */
    public function scopeByClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }
}
