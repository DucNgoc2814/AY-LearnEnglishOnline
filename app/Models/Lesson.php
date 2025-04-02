<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsToThrough;
use App\Models\User;
use App\Models\Student;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'name',
        'slug',
        'description',
        'order_number',
        'is_preview',
        'total_view',
        'total_comment'
    ];

    protected $casts = [
        'is_preview' => 'boolean',
        'total_view' => 'integer',
        'total_comment' => 'integer'
    ];

    /**
     * Lấy khóa học của bài học
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
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
    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
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
        return $this->hasMany(LessonVideo::class);
    }

    public function totalVideo()
    {
        return $this->videoLessons()->count();
    }

    public function totalVideoDuration()
    {
        return $this->videoLessons()->sum('duration');
    }

    /**
     * Lấy danh sách bài kiểm tra của bài học
     */
    public function lessonTests(): MorphMany
    {
        return $this->morphMany(Test::class, 'testable')
            ->where('type', 'lesson_test');
    }
}
