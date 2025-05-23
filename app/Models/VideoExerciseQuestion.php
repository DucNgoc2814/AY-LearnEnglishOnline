<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoExerciseQuestion extends Model
{

    protected $fillable = [
        'video_exercise_lesson_id',
        'time_point',
        'question_text',
        'context_text',
        'correct_answer',
    ];
    public static function getFields()
    {
        return [
            'time_point' => [
                'label' => 'Thời điểm',
                'type' => 'date',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'question_text' => [
                'label' => 'Câu hỏi',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'context_text' => [
                'label' => 'Ngữ cảnh',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'correct_answer' => [
                'label' => 'Đáp án',
                'type' => 'text',
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

    // Relationship với bảng video_exercise_lessons
    public function videoExerciseLesson()
    {
        return $this->belongsTo(VideoExerciseLesson::class);
    }

    // Kiểm tra đáp án
    public function checkAnswer($answer)
    {
        return strtolower(trim($answer)) === strtolower(trim($this->correct_answer));
    }

    // Format thời gian hiển thị
    public function getFormattedTimeAttribute()
    {
        $minutes = floor($this->time_point / 60);
        $seconds = $this->time_point % 60;
        return sprintf('%02d:%02d', $minutes, $seconds);
    }
}
