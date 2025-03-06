<?php

namespace App\Http\Requests\Admin\AnswerLessonTest;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\AnswerLessonTest
 * @author Your Name
 * @description Request validation cho cập nhật câu trả lời bài kiểm tra
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
            'questionLessonTestId' => CrudRules::RELATION_RULES['questionLessonTestId'],
            'answer' => CrudRules::TEXT_RULES['content']
        ];
    }

    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'questionId.exists' => 'Câu hỏi không tồn tại'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'questionId' => 'Câu hỏi',
            'answer' => 'Câu trả lời'
        ];
    }
}