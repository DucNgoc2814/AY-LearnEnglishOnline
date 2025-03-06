<?php

namespace App\Http\Requests\Admin\QuestionLessonTest;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\QuestionLessonTest
 * @author Your Name
 * @description Request validation cho cập nhật câu hỏi bài kiểm tra
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
            'lessonTestId' => array_merge(
                CrudRules::RELATION_RULES['parent_id'],
                ['exists:lesson_tests,id']
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
                'lessonTestId.exists' => 'Bài kiểm tra không tồn tại'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'lessonTestId' => 'Bài kiểm tra',
            'question' => 'Nội dung câu hỏi'
        ];
    }
}