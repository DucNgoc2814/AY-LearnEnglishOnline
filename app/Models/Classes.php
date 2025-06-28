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
            // 'end_date' => [
            //     'nullable',
            //     'date',
            //     'after:start_date',
            // ],
            // 'enrollment_deadline' => [
            //     'nullable',
            //     'date',
            //     'before_or_equal:start_date',
            // ],
            'max_students' => [
                'required',
                'integer',
                'min:1',
                'gte:min_students',
            ],
            'min_students' => [
                'required',
                'integer',
                'min:1',
            ],
            'status' => [
                'required',
                'string',
                'in:pending,active,completed,cancelled',
            ],
            'description' => ['nullable', 'string'],
            // 'schedule' => ['nullable', 'json'],
            // 'is_active' => ['boolean'],
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
            // 'end_date' => [
            //     'label' => 'Ngày kết thúc',
            //     'type' => 'date',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
            // 'enrollment_deadline' => [
            //     'label' => 'Ngày đăng ký',
            //     'type' => 'date',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
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
            'status' => [
                'label' => 'Trạng thái',
                'type' => 'select',
                'options' => [
                    'pending' => 'Chưa bắt đầu',
                    'active' => 'Đang diễn ra',
                    'completed' => 'Đã hoàn tất',
                    'cancelled' => 'Đã hủy bỏ'
                ],
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
            // 'schedule' => [
            //     'label' => 'Lịch trình',
            //     'type' => 'json_editor',
            //     'searchable' => false,
            //     'sortable' => false,
            //     'editable' => false
            // ],
            // 'is_active' => [
            //     'label' => 'Hoạt động',
            //     'type' => 'checkbox',
            //     'searchable' => true,
            //     'sortable' => true,
            //     'editable' => true
            // ],
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
            'class_id', // Foreign key on class_students table
            'id', // Foreign key on students table
            'id', // Local key on classes table
            'registration_id' // Local key on class_students table
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
