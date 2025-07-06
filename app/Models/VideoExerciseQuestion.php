<?php

namespace App\Models;

class VideoExerciseQuestion extends BaseModel
{
    public static function mediaFields(): array
    {
        return [
            'preview_video' => [
                'type' => 'video',
                'max_size' => 102400,
                'mimes' => 'mp4,webm,ogg',
                'label' => 'Video khóa học'
            ]
        ];
    }
    public static function getBaseRules($id = null)
    {
        return [
            'video_exercise_lesson_id' => 'required|exists:video_exercise_lessons,id',
            'question_text' => 'required|string',
            'context_text' => 'nullable|string',
            'correct_answer' => 'required|string',
            'time_point' => 'required|integer|min:0'
        ];
    }

    public static function getFields()
    {
        return [
            'video_exercise_lesson_id' => [
                'label' => 'Bài học video',
                'type' => 'select',
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'options' => VideoExerciseLesson::pluck('title', 'id')->toArray(),
            ],
            'time_point' => [
                'label' => 'Thời điểm xuất hiện (giây)',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'min' => 0
            ],
            'question_text' => [
                'label' => 'Nội dung câu hỏi',
                'type' => 'text',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'context_text' => [
                'label' => 'Đáp án hiển thị',
                'type' => 'text',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'correct_answer' => [
                'label' => 'Đáp án đúng',
                'type' => 'text',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ]
        ];
    }
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

    public function videoExerciseLesson()
    {
        return $this->belongsTo(VideoExerciseLesson::class);
    }

    public function getFormattedTimePointAttribute()
    {
        $minutes = floor($this->time_point / 60);
        $seconds = $this->time_point % 60;
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    // Kiểm tra đáp án
    public function checkAnswer($answer)
    {
        return strtolower(trim($answer)) === strtolower(trim($this->correct_answer));
    }
    protected static function bootHasSlug()
    {
        // Override to disable slug generation
    }
}
