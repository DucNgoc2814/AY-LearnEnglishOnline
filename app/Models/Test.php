<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends BaseModel
{
    public static function getBaseRules($id = null)
    {
        return [
            'name' => 'required|string|max:255|unique:tests,name' . ($id ? ','. $id : ''),
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'min_score' => 'required|integer|min:0',
            'max_score' => 'required|integer|min:0|gte:min_score',
            'is_required' => 'boolean',
            'max_attempt' => 'nullable|integer|min:0',
            'total_attempt' => 'nullable|integer|min:0',
            'type' => 'required|string|in:lesson_test,entrance_test,after_class,before_class',
            'lesson_id' => 'required_if:type,lesson_test,after_class,before_class|nullable|exists:lessons,id',
            'role' => 'nullable|integer',
            'settings' => 'nullable|json'
        ];
    }

    public static function getFields()
    {
        return [
            'name' => [
                'label' => 'Tên bài kiểm tra',
                'type' => 'text',
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
            'duration' => [
                'label' => 'Thời gian làm bài (phút)',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'min_score' => [
                'label' => 'Điểm tối thiểu',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'max_score' => [
                'label' => 'Điểm tối đa',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'default' => 100,
                'editable' => true
            ],
            'is_required' => [
                'label' => 'Bắt buộc làm bài',
                'type' => 'checkbox',
                'searchable' => true,
                'sortable' => true,
                'default' => true,
                'editable' => true
            ],
            'total_attempt' => [
                'label' => 'Tổng số lần làm bài',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => false // Trường này chỉ hiển thị, không cho phép sửa
            ],
            'max_attempt' => [
                'label' => 'Số lần được phép làm lại',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'type' => [
                'label' => 'Loại bài kiểm tra',
                'type' => 'select',
                'options' => [
                    'lesson_test' => 'Kiểm tra bài học',
                    'entrance_test' => 'Kiểm tra đầu vào',
                    'after_class' => 'Kiểm tra sau lớp',
                    'before_class' => 'Kiểm tra trước lớp'
                ],
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'lesson_id' => [
                'label' => 'Bài học',
                'type' => 'select',
                'options' => Lesson::pluck('name', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'depends_on' => [
                    'field' => 'type',
                    'values' => ['lesson_test', 'after_class', 'before_class'],
                    'show_if_in' => true
                ],
                'editable' => true
            ],
            'role' => [
                'label' => 'Thứ tự sắp xếp',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'default' => 0,
                'editable' => true
            ],
            'settings' => [
                'label' => 'Cài đặt',
                'type' => 'json',
                'searchable' => false,
                'sortable' => false,
                'editable' => true
            ]
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

    // Relationships
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(TestResult::class);
    }

    // Methods
    public function getFormattedTimeLimit(): string
    {
        if (!$this->duration) {
            return 'Không giới hạn';
        }

        $minutes = floor($this->duration / 60);
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $remainingMinutes);
        }

        return sprintf('%d phút', $minutes);
    }

    public function canAttempt($studentId): bool
    {
        if ($this->max_attempt === null || $this->max_attempt === 0) {
            return true;
        }

        return $this->getAttemptCount($studentId) < $this->max_attempt;
    }

    public function getAttemptCount($studentId): int
    {
        return $this->results()
            ->where('student_id', $studentId)
            ->count();
    }

    public function getRemainingAttempts($studentId): int
    {
        if ($this->max_attempt === null || $this->max_attempt === 0) {
            return PHP_INT_MAX; // Unlimited
        }

        $attemptCount = $this->getAttemptCount($studentId);
        return max(0, $this->max_attempt - $attemptCount);
    }

    public function hasPassed($studentId): bool
    {
        $highestScore = $this->results()
            ->where('student_id', $studentId)
            ->max('score');

        return $highestScore >= $this->min_score;
    }

    public function getBestResult($studentId)
    {
        return $this->results()
            ->where('student_id', $studentId)
            ->orderByDesc('score')
            ->first();
    }

    public function getLatestResult($studentId)
    {
        return $this->results()
            ->where('student_id', $studentId)
            ->latest()
            ->first();
    }

    // Scopes
    public function scopeForLesson($query, $lessonId)
    {
        return $query->where('lesson_id', $lessonId);
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('role', 'asc');
    }

    /**
     * Get the grade items related to this test
     */
    public function gradeItems()
    {
        return $this->belongsToMany(GradeItem::class, 'grade_item_test')
                    ->withPivot('metadata')
                    ->withTimestamps();
    }
}
