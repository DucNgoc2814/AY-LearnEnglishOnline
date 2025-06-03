<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoExerciseClip extends BaseModel
{
    public static function mediaFields(): array
    {
        return [
            'audio_url' => [
                'type' => 'audio',
                'max_size' => 102400,
                'mimes' => 'mp3,wav,ogg',
                'label' => 'Audio clip'
            ]
        ];
    }
    public static function getBaseRules($id = null)
    {
        return [
            'video_exercise_lesson_id' => 'required|exists:video_exercise_lessons,id',
            'title' => 'required|string|max:255',
            'start_time' => 'required|integer|min:0',
            'audio_url' => 'required|string',
            'transcript' => 'required|string',
            'translation' => 'required|string'
        ];
    }

    public static function getFields()
    {
        $fields = [
            'video_exercise_lesson_id' => [
                'label' => 'Bài học video',
                'type' => 'select',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'title' => [
                'label' => 'Tiêu đề',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'start_time' => [
                'label' => 'Thời điểm bắt đầu (giây)',
                'type' => 'number',
                'min' => '0',
                'step' => '1',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'audio_url' => [
                'label' => 'Video clip',
                'type' => 'file',
                'accept' => 'video/*',
                'max_size' => 102400,
                'searchable' => false,
                'sortable' => false,
                'editable' => true
            ],
            'transcript' => [
                'label' => 'Phụ đề gốc',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'translation' => [
                'label' => 'Bản dịch',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ]
        ];

        return $fields;
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
        if (!$progress)
            return false;

        $completedClips = json_decode($progress->completed_clips ?? '[]', true);
        return in_array($this->id, $completedClips);
    }
}
