<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin
 * @author Your Name
 * @description Request validation cho AnswerFinalExam
 */
class AnswerFinalExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     * 
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'questionFinalExamId' => CrudRules::RELATION_RULES['questionFinalExamId'],
            'answer' => CrudRules::TEXT_RULES['content'],
            'isCorrect' => CrudRules::NUMBER_RULES['status']
        ];
    }

    /**
     * Get custom messages for validator errors
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return CrudRules::MESSAGES;
    }

    /**
     * Get custom attributes for validator errors
     * 
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'questionFinalExamId' => 'Câu hỏi thi cuối khóa',
            'answer' => 'Câu trả lời',
            'isCorrect' => 'Là câu trả lời đúng'
        ];
    }
}