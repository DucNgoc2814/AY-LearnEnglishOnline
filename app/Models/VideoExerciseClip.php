<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoExerciseClip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'video_exercise_lesson_id',
        'title',
        'start_time',
        'audio_url',
        'transcript',
        'translation',
    ];

    // Relationship với bảng video_exercise_lessons
    public function videoExerciseLesson()
    {
        return $this->belongsTo(VideoExerciseLesson::class);
    }

    // Format thời gian bắt đầu
    public function getFormattedStartTimeAttribute()
    {
        $minutes = floor($this->start_time / 60);
        $seconds = $this->start_time % 60;
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    // Kiểm tra xem clip đã được hoàn thành bởi user chưa
    public function isCompletedByUser($userId)
    {
        $progress = $this->videoExerciseLesson->getUserProgress($userId);
        if (!$progress) return false;

        $completedClips = json_decode($progress->completed_clips ?? '[]', true);
        return in_array($this->id, $completedClips);
    }
}
