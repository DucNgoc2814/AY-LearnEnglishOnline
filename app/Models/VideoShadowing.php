<?php

namespace App\Models;

class VideoShadowing extends BaseModel
{
    public static function mediaFields(): array
    {
        return [
            'audio_url' => [
                'type' => 'audio',
                'max_size' => 51200, // 50MB
                'mimes' => 'mp3,wav,ogg',
                'label' => 'Audio Shadowing'
            ]
        ];
    }
    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'audio_url' => 'required|string|max:255',
        ];
    }

    public static function getFields()
    {
        $fields = [
            'lesson_id' => [
                'label' => 'Bài học',
                'type' => 'select',
                'options' => Lesson::pluck('name', 'id')->toArray(),
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
            'audio_url' => [
                'label' => 'URL Audio',
                'type' => 'file',
                'accept' => 'audio/*',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
        ];
        foreach (static::mediaFields() as $field => $config) {
            $fields[$field] = [
                'label' => $config['label'],
                'type' => 'file',
                'accept' => 'audio/*',
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
        return $this->belongsTo(Lesson::class);
    }

    public function segments()
    {
        return $this->hasMany(VideoShadowingSegment::class);
    }
    protected static function bootHasSlug()
    {
        // Override to disable slug generation
    }

}
