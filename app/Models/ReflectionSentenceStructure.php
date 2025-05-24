<?php

namespace App\Models;

class ReflectionSentenceStructure extends BaseModel
{
    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'pattern_text' => 'required|string|max:255',
            'pattern_translation' => 'required|string|max:255',
            'example' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
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
            'pattern_text' => [
                'label' => 'Mẫu câu tiếng Anh',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'pattern_translation' => [
                'label' => 'Bản dịch tiếng Việt',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'example' => [
                'label' => 'Ví dụ',
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

    public static function getListFields()
    {
        return self::getFields();
    }
}
