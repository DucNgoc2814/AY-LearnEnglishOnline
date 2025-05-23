<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoExerciseProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'video_exercise_lesson_id',
        'step1_progress',
        'step2_progress',
        'step3_progress',
        'video_watch_time',
        'completed_questions',
        'completed_clips',
        'total_progress',
        'last_accessed_at',
        'completed_at',
    ];

    protected $casts = [
        'completed_questions' => 'array',
        'completed_clips' => 'array',
        'last_accessed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relationship với user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship với video exercise lesson
    public function videoExerciseLesson()
    {
        return $this->belongsTo(VideoExerciseLesson::class);
    }

    // Cập nhật tiến độ hoàn thành câu hỏi
    public function completeQuestion($questionId)
    {
        $completedQuestions = $this->completed_questions ?? [];
        if (!in_array($questionId, $completedQuestions)) {
            $completedQuestions[] = $questionId;
            $this->completed_questions = $completedQuestions;
            $this->updateStep2Progress();
            $this->updateTotalProgress();
            $this->save();
        }
    }

    // Cập nhật tiến độ hoàn thành clip
    public function completeClip($clipId)
    {
        $completedClips = $this->completed_clips ?? [];
        if (!in_array($clipId, $completedClips)) {
            $completedClips[] = $clipId;
            $this->completed_clips = $completedClips;
            $this->updateStep3Progress();
            $this->updateTotalProgress();
            $this->save();
        }
    }

    // Cập nhật tiến độ xem video
    public function updateVideoProgress($watchTime, $totalDuration)
    {
        $this->video_watch_time = $watchTime;
        $this->step1_progress = min(100, ($watchTime / $totalDuration) * 100);
        $this->updateTotalProgress();
        $this->save();
    }

    // Cập nhật tổng tiến độ
    protected function updateTotalProgress()
    {
        $this->total_progress = ($this->step1_progress + $this->step2_progress + $this->step3_progress) / 3;
        if ($this->total_progress >= 100 && !$this->completed_at) {
            $this->completed_at = now();
        }
    }

    // Cập nhật tiến độ bước 2 (làm bài tập)
    protected function updateStep2Progress()
    {
        $totalQuestions = $this->videoExerciseLesson->questions()->count();
        if ($totalQuestions > 0) {
            $this->step2_progress = (count($this->completed_questions ?? []) / $totalQuestions) * 100;
        }
    }

    // Cập nhật tiến độ bước 3 (luyện nói)
    protected function updateStep3Progress()
    {
        $totalClips = $this->videoExerciseLesson->clips()->count();
        if ($totalClips > 0) {
            $this->step3_progress = (count($this->completed_clips ?? []) / $totalClips) * 100;
        }
    }
}
