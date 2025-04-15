<?php

namespace App\Models\Traits;

use App\Models\LessonProgress;
use Illuminate\Support\Facades\Auth;

trait HasProgress
{
    /**
     * Boot the trait
     */
    protected static function bootHasProgress()
    {
        static::updating(function ($model) {
            if ($model->isDirty('watched_time')) {
                $model->updateProgress();
            }
        });
    }

    /**
     * Cập nhật tiến độ học tập
     */
    public function updateProgress()
    {
        if (!Auth::check()) {
            return;
        }

        $enrollment = Auth::user()->enrollments()
            ->where('course_id', $this->course_id)
            ->first();

        if (!$enrollment) {
            return;
        }

        $progress = $this->progress()
            ->where('enrollment_id', $enrollment->id)
            ->firstOrNew();

        if (!$progress->exists) {
            $progress->enrollment_id = $enrollment->id;
            $progress->lesson_id = $this->id;
            $progress->total_time = $this->videoLessons->sum('duration');
            $progress->status = 'in_progress';
        }

        // Cập nhật thời gian đã xem
        $progress->watched_time = $this->watched_time;
        
        // Tính phần trăm hoàn thành
        $percentComplete = ($progress->watched_time / $progress->total_time) * 100;
        
        // Nếu đã xem hơn 80% thì đánh dấu là đã hoàn thành
        if ($percentComplete >= 80 && $progress->status !== 'completed') {
            $progress->status = 'completed';
            $progress->completed_at = now();
        }

        $progress->last_watched_at = now();
        $progress->save();

        return $percentComplete;
    }

    /**
     * Kiểm tra xem bài học đã hoàn thành chưa
     */
    public function isCompleted()
    {
        if (!Auth::check()) {
            return false;
        }

        $enrollment = Auth::user()->enrollments()
            ->where('course_id', $this->course_id)
            ->first();

        if (!$enrollment) {
            return false;
        }

        $progress = $this->progress()
            ->where('enrollment_id', $enrollment->id)
            ->first();

        return $progress && $progress->status === 'completed';
    }

    /**
     * Lấy phần trăm hoàn thành
     */
    public function getProgressPercentage()
    {
        if (!Auth::check()) {
            return 0;
        }

        $enrollment = Auth::user()->enrollments()
            ->where('course_id', $this->course_id)
            ->first();

        if (!$enrollment) {
            return 0;
        }

        $progress = $this->progress()
            ->where('enrollment_id', $enrollment->id)
            ->first();

        if (!$progress) {
            return 0;
        }

        return ($progress->watched_time / $progress->total_time) * 100;
    }
} 