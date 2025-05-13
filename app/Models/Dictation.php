<?php

namespace App\Models;


class Dictation extends BaseModel
{
    public static function mediaFields(): array
    {
        return [
            'audio_url' => [
                'type' => 'audio',
                'max_size' => 2048, // 2MB
                'mimes' => 'mp3,wav,ogg',
                'label' => 'Audio'
            ],
        ];
    }
    public static function getBaseRules($id = null)
    {
        return [
            'audio_url' => 'required|string|max:255',
            'content' => 'nullable|string',
        ];
    }

    public static function getFields()
    {
        $fields = [
            'content' => [
                'label' => 'Nội dung',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
        ];

        // Thêm các trường media vào fields
        foreach (static::mediaFields() as $field => $config) {
            $fields[$field] = [
                'label' => $config['label'],
                'type' => 'file',
                'accept' => $config['type'] === 'image' ? 'image/*' : 'audio/*',
                'max_size' => $config['max_size'],
                'editable' => true
            ];
        }

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
    protected static function bootHasSlug()
    {
        // Override to disable slug generation
    }
}
