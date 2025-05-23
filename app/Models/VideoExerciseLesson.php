<?php

namespace App\Models;


class VideoExerciseLesson extends BaseModel
{
    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'nullable|string|max:255',
            'video_url' => 'required|string',
            'description' => 'nullable|string|max:255',
        ];
    }

    public static function getFields()
    {
        return [
            'lesson_id' => [
                'label' => 'Bài học',
                'type' => 'select',
                'options' => Lesson::pluck('name', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'title' => [
                'label' => 'Tên bài tập',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'video_url' => [
                'label' => 'Video bài tập',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'description' => [
                'label' => 'Mô tả chi tiết',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
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

    // Relationship với bảng lessons
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // Relationship với bảng questions
    public function questions()
    {
        return $this->hasMany(VideoExerciseQuestion::class);
    }

    // Relationship với bảng clips
    public function clips()
    {
        return $this->hasMany(VideoExerciseClip::class);
    }

    // Relationship với bảng progress
    public function progress()
    {
        return $this->hasMany(VideoExerciseProgress::class);
    }

    // Lấy tiến độ của một user cụ thể
    public function getUserProgress($userId)
    {
        return $this->progress()->where('user_id', $userId)->first();
    }
}
