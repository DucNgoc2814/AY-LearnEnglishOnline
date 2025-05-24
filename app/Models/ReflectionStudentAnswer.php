<?php

namespace App\Models;

class ReflectionStudentAnswer extends BaseModel
{
    public static function getBaseRules($id = null)
    {
        return [
            'reflection_exercise_question_id' => 'required|exists:reflection_exercise_questions,id',
            'answer_text' => 'required|string',
        ];
    }

    public static function getFields()
    {
        return [
            'reflection_exercise_question_id' => [
                'label' => 'Câu hỏi',
                'type' => 'select',
                'options' => ReflectionExerciseQuestion::pluck('question_text', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'answer_text' => [
                'label' => 'Câu trả lời',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reflectionExercise()
    {
        return $this->belongsTo(ReflectionExercise::class);
    }

    public function question()
    {
        return $this->belongsTo(ReflectionExerciseQuestion::class, 'reflection_exercise_question_id');
    }
}
