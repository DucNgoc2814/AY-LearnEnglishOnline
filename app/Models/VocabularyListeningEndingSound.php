<?php

namespace App\Models;

class VocabularyListeningEndingSound extends BaseModel
{

    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'word' => 'required|string|max:255',
            'word_with_ending' => 'required|string|max:255',
            'base_phonetic' => 'required|string|max:255',
            'ending_phonetic' => 'required|string|max:255',
            'full_phonetic' => 'required|string|max:255',
            'full_phonetic_with_ending' => 'required|string|max:255',
            'sound_group' => 'required|in:1,2,3',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
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
            'word' => [
                'label' => 'Từ gốc',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'word_with_ending' => [
                'label' => 'Từ thêm s/es',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'base_phonetic' => [
                'label' => 'Phiên âm gốc',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'ending_phonetic' => [
                'label' => 'Âm cuối',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'full_phonetic' => [
                'label' => 'Phiên âm đầy đủ',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'full_phonetic_with_ending' => [
                'label' => 'Phiên âm đầy đủ với s/es',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'sound_group' => [
                'label' => 'Nhóm âm',
                'type' => 'select',
                'options' => [
                    '1' => 'Voiceless',
                    '2' => 'Fricative/Affricate',
                    '3' => 'Other'
                ],
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'display_order' => [
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
    protected static function bootHasSlug()
    {
        // Override to disable slug generation
    }
}