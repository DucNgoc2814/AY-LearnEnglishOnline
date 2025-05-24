<?php

namespace App\Models;


class VideoHandoutLesson extends BaseModel
{
    public static function mediaFields(): array
    {
        return [
            'video_url' => [
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
            'unit_id' => 'required|exists:video_handout_units,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ];
    }

    public static function getFields()
    {
        $fields =  [
            'unit_id' => [
                'label' => 'Unit',
                'type' => 'select',
                'options' => VideoHandoutUnit::pluck('name', 'id')->toArray(),
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
            'video_url' => [
                'label' => 'URL Video',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'order' => [
                'label' => 'Thứ tự hiển thị',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'is_active' => [
                'label' => 'Kích hoạt',
                'type' => 'boolean',
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

    public function unit()
    {
        return $this->belongsTo(VideoHandoutUnit::class);
    }

    public function files()
    {
        return $this->hasMany(VideoHandoutFile::class, 'lesson_id');
    }
}
