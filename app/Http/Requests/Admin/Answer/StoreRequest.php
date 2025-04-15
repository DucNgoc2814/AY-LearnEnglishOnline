<?php

namespace App\Http\Requests\Admin\Answer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Answer
 * @description Request validation cho tạo mới câu trả lời
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
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
            'type' => 'required|string|in:single,multiple',
            'order_number' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'question_id.required' => 'Câu hỏi không được để trống',
            'question_id.exists' => 'Câu hỏi không tồn tại',
            'answer.required' => 'Nội dung câu trả lời không được để trống',
            'answer.max' => 'Nội dung câu trả lời không được vượt quá 255 ký tự',
            'is_correct.required' => 'Trạng thái đúng/sai không được để trống',
            'is_correct.boolean' => 'Trạng thái đúng/sai phải là true hoặc false',
            'type.required' => 'Loại câu trả lời không được để trống',
            'type.string' => 'Loại câu trả lời phải là chuỗi',
            'type.in' => 'Loại câu trả lời phải là single hoặc multiple',
            'order_number.required' => 'Thứ tự câu trả lời không được để trống',
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
            'order_number' => 'Thứ tự câu trả lời',
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        // Tự động tạo order_number nếu không được cung cấp
        if (!$this->has('order_number')) {
            $data['order_number'] = 1;
        }

        // Chuyển đổi is_correct thành boolean
        if ($this->has('is_correct')) {
            $data['is_correct'] = filter_var($this->is_correct, FILTER_VALIDATE_BOOLEAN);
        }

        // Mặc định type là single nếu không được cung cấp
        if (!$this->has('type')) {
            $data['type'] = 'single';
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
