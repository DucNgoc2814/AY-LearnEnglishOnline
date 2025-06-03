<?php

namespace App\Models;

class VideoExerciseQuestion extends BaseModel
{
    public static function getBaseRules($id = null)
    {
        return [
            'video_exercise_lesson_id' => 'required|exists:video_exercise_lessons,id',
            'time_point' => 'required|integer|min:0',
            'question_text' => 'required|string',
            'context_text' => 'nullable|string',
            'correct_answer' => 'required|string'
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
                'options' => function() {
                    return VideoExerciseLesson::pluck('title', 'id')->toArray();
                }
            ],
            'time_point' => [
                'label' => 'Thời điểm (giây)',
                'type' => 'number',
                'min' => '0',
                'step' => '1',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'question_text' => [
                'label' => 'Nội dung câu hỏi',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'context_text' => [
                'label' => 'Ngữ cảnh',
                'type' => 'textarea',
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
}
