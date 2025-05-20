<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Lesson extends BaseModel
{

    public static function getBaseRules($id = null)
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_number' => 'required|integer|min:1',
            'is_preview' => 'nullable|boolean',
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
                'label' => 'Tên bài học',
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
            'order_number' => [
                'label' => 'Thứ tự',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'is_preview' => [
                'label' => 'Xem thử',
                'type' => 'boolean',
                'searchable' => true,
                'sortable' => true,
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
    /**
     * Lấy khóa học của bài học
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function classSchedule(): HasMany
    {
        return $this->hasMany(ClassSchedule::class);
    }

    /**
     * Lấy danh sách tiến độ học tập
     */
    public function progress(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }

    /**
     * Lấy danh sách tài liệu
     */
    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * Lấy danh sách bình luận
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Kiểm tra xem học viên đã hoàn thành bài học hay chưa
     */
    public function isCompleted($studentId): bool
    {
        return $this->progress()
            ->whereHas('enrollment', function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->where('status', 'completed')
            ->exists();
    }

    /**
     * Đánh dấu là bài học tiếp theo dựa vào thứ tự
     */
    public function getIsNextAttribute(): bool
    {
        $nextLesson = $this->course->lessons()
            ->where('order', '>', $this->order)
            ->orderBy('order', 'asc')
            ->first();

        return $nextLesson ? $nextLesson->id === $this->id : false;
    }

    /**
     * Lấy bài học tiếp theo dựa vào thứ tự
     */
    public function getNextLessonAttribute()
    {
        return $this->course->lessons()
            ->where('order', '>', $this->order)
            ->orderBy('order', 'asc')
            ->first();
    }

    /**
     * Lấy bài học trước đó dựa vào thứ tự
     */
    public function getPreviousLessonAttribute()
    {
        return $this->course->lessons()
            ->where('order', '<', $this->order)
            ->orderBy('order', 'desc')
            ->first();
    }

    /**
     * Scope sắp xếp theo thứ tự
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Scope lấy bài học xem thử
     */
    public function scopePreviewable($query)
    {
        return $query->where('is_preview', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incrementView()
    {
        $this->increment('total_view');
    }

    public function incrementComment()
    {
        $this->increment('total_comment');
    }

    public function decrementComment()
    {
        $this->decrement('total_comment');
    }

    public function getProgress($studentId): float
    {
        $progress = $this->progress()
            ->whereHas('enrollment', function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->first();

        return $progress ? $progress->progress : 0;
    }

    public function getTimeSpent($studentId): int
    {
        $progress = $this->progress()
            ->whereHas('enrollment', function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->first();

        return $progress ? $progress->time_spent : 0;
    }

    public function getFormattedTimeSpent($studentId): string
    {
        $minutes = $this->getTimeSpent($studentId);
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $remainingMinutes);
        }

        return sprintf('%d phút', $minutes);
    }

    public function isAccessible($studentId): bool
    {
        if ($this->is_free) {
            return true;
        }

        return $this->course->hasEnrolledStudent($studentId);
    }

    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $minutes);
        }

        return sprintf('%d phút', $minutes);
    }

    public function videoLessons()
    {
        return $this->hasMany(LessonVideo::class, 'lesson_id');
    }

    public function totalVideo()
    {
        return $this->videoLessons->count();
    }

    public function totalVideoDuration()
    {
        $totalSeconds = $this->videoLessons->sum('duration');

        // Properly convert to HH:MM:SS
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    /**
     * Lấy danh sách bài kiểm tra của bài học
     */
    public function lessonTests()
    {
        return $this->morphMany(Test::class, 'testable')
                    ->where('type', 'lesson_test')
                    ->whereNull('deleted_at');
    }

    public function totalTests()
    {
        return $this->lessonTests()->count();
    }
}
