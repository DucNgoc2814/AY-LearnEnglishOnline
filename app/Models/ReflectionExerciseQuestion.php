<?php

namespace App\Models;

class ReflectionExerciseQuestion extends BaseModel
{

    public static function getBaseRules($id = null)
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'reflection_exercise_id' => 'required|exists:reflection_exercises,id',
            'question_text' => 'required|string|max:255',
            'description' => 'nullable|string',
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
            'reflection_exercise_id' => [
                'label' => 'Bài tập Reflection',
                'type' => 'select',
                'options' => ReflectionExercise::pluck('title', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'question_text' => [
                'label' => 'Nội dung câu hỏi',
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

    public function reflectionExercise()
    {
        return $this->belongsTo(ReflectionExercise::class);
    }

    public function studentAnswers()
    {
        return $this->hasMany(ReflectionStudentAnswer::class);
    }
}
