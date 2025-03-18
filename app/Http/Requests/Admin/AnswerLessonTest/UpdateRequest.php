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
            'questionLessonTestId' => 'exists:question_lesson_tests,id',
            'answer' => 'string|max:255',
            'isCorrect' => 'boolean',
            'type' => 'in:single_choice,fill_in_blank,multiple_choice',
            'order_number' => 'integer|min:0',
            'case_sensitive' => 'boolean',
            'alternative_answers' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'questionLessonTestId.exists' => 'Câu hỏi không tồn tại',
            'answer.string' => 'Câu trả lời phải là chuỗi ký tự',
            'answer.max' => 'Câu trả lời không được vượt quá 255 ký tự',
            'isCorrect.boolean' => 'Đáp án đúng/sai không hợp lệ',
            'type.in' => 'Loại câu trả lời không hợp lệ',
            'order_number.integer' => 'Số thứ tự phải là số nguyên',
            'order_number.min' => 'Số thứ tự phải lớn hơn hoặc bằng 0',
            'case_sensitive.boolean' => 'Giá trị phân biệt chữ hoa/thường không hợp lệ'
        ];
    }

    public function attributes(): array
    {
        return [
            'questionLessonTestId' => 'Câu hỏi',
            'answer' => 'Câu trả lời',
            'isCorrect' => 'Là câu trả lời đúng',
            'type' => 'Loại câu trả lời',
            'order_number' => 'Số thứ tự',
            'case_sensitive' => 'Phân biệt chữ hoa/thường',
            'alternative_answers' => 'Các đáp án thay thế'
        ];
    }
}