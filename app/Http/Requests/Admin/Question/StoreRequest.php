<?php

namespace App\Http\Requests\Admin\Question;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Question
 * @author Your Name
 * @description Request validation cho tạo mới câu hỏi
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
            'test_id' => 'required|exists:tests,id',
            'type' => 'required|in:text,image,video,audio',
            'question' => 'required|string|max:255',
            'media_url' => 'nullable|string|max:255',
            'correct_answer_explanation' => 'nullable|string',
            'order_number' => 'required|integer|min:0',
            'media_file' => 'nullable|file|max:102400',
        ];
    }

    public function messages(): array
    {
        return [
            'test_id.required' => 'Bài kiểm tra không được để trống',
            'test_id.exists' => 'Bài kiểm tra không tồn tại',
            'type.required' => 'Loại câu hỏi không được để trống',
            'type.in' => 'Loại câu hỏi không hợp lệ',
            'question.required' => 'Nội dung câu hỏi không được để trống',
            'question.max' => 'Nội dung câu hỏi không được vượt quá 255 ký tự',
            'media_url.max' => 'Đường dẫn tệp media không được vượt quá 255 ký tự',
            'correct_answer_explanation.string' => 'Giải thích đáp án đúng phải là chuỗi ký tự',
            'order_number.required' => 'Thứ tự câu hỏi không được để trống',
            'order_number.integer' => 'Thứ tự câu hỏi phải là số nguyên',
            'order_number.min' => 'Thứ tự câu hỏi phải lớn hơn hoặc bằng 0',
            'media_file.file' => 'Tệp media phải là một file hợp lệ',
            'media_file.max' => 'Kích thước tệp media không được vượt quá 100MB',
        ];
    }

    public function attributes(): array
    {
        return [
            'test_id' => 'Bài kiểm tra',
            'type' => 'Loại câu hỏi',
            'question' => 'Nội dung câu hỏi',
            'media_url' => 'Đường dẫn tệp media',
            'correct_answer_explanation' => 'Giải thích đáp án đúng',
            'order_number' => 'Thứ tự câu hỏi',
            'media_file' => 'Tệp media',
        ];
    }

    protected function prepareForValidation()
    {
        // Tự động tạo order_number nếu không được cung cấp
        if (!$this->has('order_number')) {
            $this->merge([
                'order_number' => 1,
            ]);
        }
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
