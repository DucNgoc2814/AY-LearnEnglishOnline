<?php

namespace App\Http\Requests\Admin\AnswerFinalExam;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\AnswerFinalExam
 * @author Your Name
 * @description Request validation cho cập nhật câu trả lời bài thi cuối khóa
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
            'questionFinalExamId' => CrudRules::RELATION_RULES['questionFinalExamId'],
            'answer' => CrudRules::TEXT_RULES['content'],
            'isCorrect' => CrudRules::NUMBER_RULES['status']
        ];
    }

    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'questionFinalExamId.exists' => 'Câu hỏi không tồn tại'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'questionFinalExamId' => 'Câu hỏi',
            'answer' => 'Câu trả lời',
            'isCorrect' => 'Là câu trả lời đúng'
        ];
    }
}