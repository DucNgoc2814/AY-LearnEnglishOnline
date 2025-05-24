<?php

namespace App\Models;

class VocabularyListeningSentenceBuilding extends BaseModel
{

    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'sentence_number' => 'required|string|max:255',
            'correct_sentence' => 'required|string|max:255',
            'max_retries' => 'required|integer|min:1',
            'min_required_score' => 'required|numeric|min:0|max:100',
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
            'sentence_number' => [
                'label' => 'Số thứ tự câu',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'correct_sentence' => [
                'label' => 'Câu đúng',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
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
