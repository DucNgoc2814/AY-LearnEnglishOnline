<?php

namespace App\Models;


class VocabularyListeningDictation extends BaseModel
{
    public static function mediaFields(): array
    {
        return [
            'audio_url' => [
                'type' => 'audio',
                'max_size' => 102400,
                'mimes' => 'mp3,wav,ogg',
                'label' => 'Audio'
            ],
        ];
    }
    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'audio_url' => 'required|string|max:255',
            'correct_text' => 'required|string',
            'display_text' => 'required|string',
            'blank_words' => 'required|array',
            'max_retries' => 'required|integer|min:1',
            'min_required_score' => 'required|numeric|min:0|max:100',
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
            'audio_url' => [
                'label' => 'URL Audio',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'correct_text' => [
                'label' => 'Văn bản đúng',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'display_text' => [
                'label' => 'Văn bản hiển thị',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'blank_words' => [
                'label' => 'Từ cần điền',
                'type' => 'tags',
                'searchable' => false,
                'sortable' => false,
                'editable' => true
            ],
            'max_retries' => [
                'label' => 'Số lần làm lại tối đa',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'min_required_score' => [
                'label' => 'Điểm tối thiểu (%)',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
        ];
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
        return $this->belongsTo(Lesson::class);
    }
}
