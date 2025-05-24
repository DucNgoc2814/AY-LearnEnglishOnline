<?php

namespace App\Models;


class VideoHandoutFile extends BaseModel
{
    public static function mediaFields(): array
    {
        return [
            'file_path' => [
                'type' => 'image',
                'max_size' => 102400,
                'mimes' => 'pdf',
                'label' => 'File PDF'
            ],
        ];
    }

    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:video_handout_lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'required|string|max:255',
        ];
    }

    public static function getFields()
    {
        $fields = [
            'lesson_id' => [
                'label' => 'Bài học',
                'type' => 'select',
                'options' => VideoHandoutLesson::pluck('title', 'id')->toArray(),
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
            'description' => [
                'label' => 'Mô tả',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'file_path' => [
                'label' => 'File PDF',
                'type' => 'file',
                'accept' => '.pdf',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
        ];
        // Thêm các trường media vào fields
        foreach (static::mediaFields() as $field => $config) {
            $fields[$field] = [
                'label' => $config['label'],
                'type' => 'file',
                'accept' => $config['type'] === 'image' ? 'image/*' : 'video/*',
                'max_size' => $config['max_size'],
                'editable' => true
            ];
        }

        return $fields;
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

    public static function getListFields()
    {
        return self::getFields();
    }

    public function lesson()
    {
        return $this->belongsTo(VideoHandoutLesson::class);
    }
}
