<?php

namespace App\Models;

class VideoExerciseLesson extends BaseModel
{

    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|string',
            'description' => 'nullable|string'
        ];
    }

    public static function getFields()
    {
        return [
            'lesson_id' => [
                'label' => 'Bài học',
                'type' => 'select',
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'options' => Lesson::pluck('name', 'id')->toArray(),
            ],
            'title' => [
                'label' => 'Tiêu đề',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'video_url' => [
                'label' => 'URL video bài học',
                'type' => 'text',
                'searchable' => false,
                'sortable' => false,
                'editable' => true
            ],
            'description' => [
                'label' => 'Mô tả',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
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
    protected static function bootHasSlug()
    {
        // Override to disable slug generation
    }

    // Relationship với bảng lessons
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // Relationship với bảng questions
    public function videoExerciseQuestions()
    {
        return $this->hasMany(VideoExerciseQuestion::class);
    }

    // Relationship với bảng clips
    public function videoExerciseClips()
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
