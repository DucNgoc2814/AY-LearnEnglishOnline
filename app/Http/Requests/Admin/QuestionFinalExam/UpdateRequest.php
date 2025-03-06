<?php

namespace App\Http\Requests\Admin\QuestionFinalExam;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\QuestionFinalExam
 * @author Your Name
 * @description Request validation cho cập nhật câu hỏi bài thi cuối khóa
 */
class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'finalExamId' => array_merge(
                CrudRules::RELATION_RULES['parent_id'],
                ['exists:final_exams,id']
            ),
            'question' => array_merge(
                CrudRules::TEXT_RULES['content'],
                ['required']
            )
        ];
    }

    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'finalExamId.exists' => 'Bài thi cuối khóa không tồn tại'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'finalExamId' => 'Bài thi cuối khóa',
            'question' => 'Nội dung câu hỏi'
        ];
    }
}