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
            'questionLessonTestId' => 'required|exists:question_lesson_tests,id',
            'answer' => 'required|string|max:255',
            'isCorrect' => 'required|boolean',
            'answerType' => 'required|in:single_choice,multiple_choice,fill_in_blank',
            'orderNumber' => 'required|integer|min:0',
            'caseSensitive' => 'boolean',
            'alternativeAnswers' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'questionLessonTestId.required' => 'Câu hỏi không được để trống',
            'questionLessonTestId.exists' => 'Câu hỏi không tồn tại',
            'answer.required' => 'Câu trả lời không được để trống',
            'answer.string' => 'Câu trả lời phải là chuỗi ký tự',
            'answer.max' => 'Câu trả lời không được vượt quá 255 ký tự',
            'isCorrect.required' => 'Vui lòng chọn đáp án đúng/sai',
            'isCorrect.boolean' => 'Đáp án đúng/sai không hợp lệ',
            'answerType.required' => 'Loại câu trả lời không được để trống',
            'answerType.in' => 'Loại câu trả lời không hợp lệ',
            'orderNumber.required' => 'Số thứ tự không được để trống',
            'orderNumber.integer' => 'Số thứ tự phải là số nguyên',
            'orderNumber.min' => 'Số thứ tự phải lớn hơn hoặc bằng 0',
            'caseSensitive.boolean' => 'Giá trị phân biệt chữ hoa/thường không hợp lệ'
        ];
    }

    public function attributes(): array
    {
        return [
            'questionLessonTestId' => 'Câu hỏi',
            'answer' => 'Câu trả lời',
            'isCorrect' => 'Là câu trả lời đúng',
            'answerType' => 'Loại câu trả lời',
            'orderNumber' => 'Số thứ tự',
            'caseSensitive' => 'Phân biệt chữ hoa/thường',
            'alternativeAnswers' => 'Các đáp án thay thế'
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}