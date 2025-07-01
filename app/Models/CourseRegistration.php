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
                'relation' => 'students',
                'display_fields' => ['student_code', 'full_name'],
                'badge_color' => 'blue',
                'separator' => ' - ',
                'help' => 'Có thể chọn nhiều học viên cùng lúc'
            ],
            'notes' => [
                'label' => 'Ghi chú',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
        ];
    }

    /**
     * Get fields for form (create/edit)
     */
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
            ->first();
    }

    /**
     * Get the attendance records for this registration.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id', 'student_id')
            ->whereHas('classSession', function ($query) {
                $query->where('class_id', $this->class_id);
            });
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
