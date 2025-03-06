<?php

namespace App\Http\Requests\Admin\AnswerLessonTest;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\AnswerLessonTest
 * @author Your Name
 * @description Request validation cho tạo mới câu trả lời bài kiểm tra
 */
class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'questionLessonTestId' => CrudRules::RELATION_RULES['questionLessonTestId'],
            'answer' => CrudRules::TEXT_RULES['content'],
            'isCorrect' => CrudRules::NUMBER_RULES['status']
        ];
    }

    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'questionLessonTestId.exists' => 'Câu hỏi không tồn tại',
                'isCorrect.required' => 'Vui lòng chọn đáp án đúng/sai'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'questionLessonTestId' => 'Câu hỏi',
            'answer' => 'Câu trả lời',
            'isCorrect' => 'Là câu trả lời đúng'
        ];
    }
}