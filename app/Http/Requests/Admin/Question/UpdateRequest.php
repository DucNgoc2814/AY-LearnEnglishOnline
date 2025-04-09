<?php

namespace App\Http\Requests\Admin\Question;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Question
 * @author Your Name
 * @description Request validation cho cập nhật câu hỏi
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
            'test_id' => 'sometimes|exists:tests,id',
            'type' => 'sometimes|in:text,image,video,audio',
            'question' => 'sometimes|string|max:255',
            'media_url' => 'nullable|string|max:255',
            'order_number' => 'sometimes|integer|min:0',
            'media_file' => 'nullable|file|max:102400',
            'remove_media' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'test_id.exists' => 'Bài kiểm tra không tồn tại',
            'type.in' => 'Loại câu hỏi không hợp lệ',
            'question.max' => 'Nội dung câu hỏi không được vượt quá 255 ký tự',
            'media_url.max' => 'Đường dẫn tệp media không được vượt quá 255 ký tự',
            'order_number.integer' => 'Thứ tự câu hỏi phải là số nguyên',
            'order_number.min' => 'Thứ tự câu hỏi phải lớn hơn hoặc bằng 0',
            'media_file.file' => 'Tệp media phải là một file hợp lệ',
            'media_file.max' => 'Kích thước tệp media không được vượt quá 100MB',
            'remove_media.boolean' => 'Giá trị xóa media phải là true hoặc false',
        ];
    }

    public function attributes(): array
    {
        return [
            'test_id' => 'Bài kiểm tra',
            'type' => 'Loại câu hỏi',
            'question' => 'Nội dung câu hỏi',
            'media_url' => 'Đường dẫn tệp media',
            'order_number' => 'Thứ tự câu hỏi',
            'media_file' => 'Tệp media',
            'remove_media' => 'Xóa tệp media',
        ];
    }

    /**
     * Xử lý dữ liệu trước khi xác thực
     */
    protected function prepareForValidation()
    {
        $data = [];

        // Chuyển đổi các checkbox thành boolean
        if ($this->has('remove_media')) {
            $data['remove_media'] = filter_var($this->remove_media, FILTER_VALIDATE_BOOLEAN);
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
