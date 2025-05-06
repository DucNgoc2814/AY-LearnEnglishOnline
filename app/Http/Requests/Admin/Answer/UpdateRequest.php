<?php

namespace App\Http\Requests\Admin\Answer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Answer
 * @description Request validation cho cập nhật câu trả lời
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
            'question_id' => 'sometimes|exists:questions,id',
            'answer' => 'sometimes|string|max:255',
            'is_correct' => 'sometimes|boolean',
            'type' => 'sometimes|string|in:single,multiple',
            'url' => 'nullable|file|max:51200',
            'remove_url' => 'nullable|in:0,1',
            'order_number' => 'sometimes|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'question_id.exists' => 'Câu hỏi không tồn tại',
            'answer.max' => 'Nội dung câu trả lời không được vượt quá 255 ký tự',
            'is_correct.boolean' => 'Trạng thái đúng/sai phải là true hoặc false',
            'type.string' => 'Loại câu trả lời phải là chuỗi',
            'type.in' => 'Loại câu trả lời phải là single hoặc multiple',
            'url.file' => 'File đính kèm không hợp lệ',
            'url.max' => 'Kích thước file không được vượt quá 50MB',
            'remove_url.in' => 'Giá trị xóa URL không hợp lệ',
            'order_number.integer' => 'Thứ tự câu trả lời phải là số nguyên',
            'order_number.min' => 'Thứ tự câu trả lời phải lớn hơn hoặc bằng 0',
        ];
    }

    public function attributes(): array
    {
        return [
            'question_id' => 'Câu hỏi',
            'answer' => 'Nội dung câu trả lời',
            'is_correct' => 'Trạng thái đúng/sai',
            'type' => 'Loại câu trả lời',
            'url' => 'File đính kèm',
            'remove_url' => 'Xóa file đính kèm',
            'order_number' => 'Thứ tự câu trả lời',
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        // Chuyển đổi is_correct thành boolean nếu được cung cấp
        if ($this->has('is_correct')) {
            $data['is_correct'] = filter_var($this->is_correct, FILTER_VALIDATE_BOOLEAN);
        }

        // Chuyển đổi remove_url thành boolean
        if ($this->has('remove_url')) {
            $data['remove_url'] = filter_var($this->remove_url, FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
        }

        if (!empty($data)) {
            $this->merge($data);
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
