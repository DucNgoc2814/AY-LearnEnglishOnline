<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Classes extends BaseModel
{

    public static function getBaseRules($id = null)
    {
        return [
            'course_id' => [
                'required',
                'exists:courses,id',
            ],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:classes,code'],
            'teacher_id' => [
                'required',
                'exists:employees,id',
            ],
            'start_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'max_students' => [
                'nullable',
                'integer',
                'min:1',
                'gte:min_students',
            ],
            'min_students' => [
                'nullable',
                'integer',
                'min:1',
            ],
            'description' => ['nullable', 'string'],
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
            'name' => [
                'label' => 'Tên lớp học',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'code' => [
                'label' => 'Mã lớp',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'teacher_id' => [
                'label' => 'Giáo viên',
                'type' => 'select',
                'options' => Employee::pluck('name', 'id')->toArray(),
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
            'max_students' => [
                'label' => 'Số lượng học viên tối đa',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'min_students' => [
                'label' => 'Số lượng học viên tối thiểu',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'description' => [
                'label' => 'Mô tả',
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

    public function students()
    {
        return $this->hasManyThrough(
            Student::class,
            'App\Models\ClassStudent',
            'class_id',
            'id',
            'id',
            'registration_id'
        );
    }

    public function classStudents()
    {
        return $this->hasMany(ClassStudent::class, 'class_id');
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
            'class_id',
            'schedule_id',
            'id',
            'id'
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
        $this->current_students = $this->students()->count();
        $this->save();
        return $this;
    }

    public function getAvailableSeats(): int
    {
        return max(0, $this->max_students - $this->current_students);
    }

    public function isEnrollmentOpen(): bool
    {
        if (!$this->start_date) {
            return true;
        }
        return now()->lessThanOrEqualTo($this->start_date);
    }

    public function getProgress(): float
    {
        if (!$this->start_date) {
            return 0;
        }

        $elapsed = now()->diffInDays($this->start_date);
        return min(100, round(($elapsed / 30) * 100, 2)); // Assuming a standard 30-day period
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
