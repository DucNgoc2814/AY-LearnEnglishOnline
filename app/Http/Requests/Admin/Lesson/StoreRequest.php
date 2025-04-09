<?php

namespace App\Http\Requests\Admin\Lesson;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Lesson
 * @author Your Name
 * @description Request validation cho tạo mới bài học
 */
class StoreRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order_number' => 'required|integer|min:1',
            'is_preview' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'course_id.required' => 'Vui lòng chọn khóa học',
            'course_id.exists' => 'Khóa học không tồn tại',
            'name.required' => 'Vui lòng nhập tên bài học',
            'name.max' => 'Tên bài học không được vượt quá 255 ký tự',
            'description.required' => 'Mô tả không được để trống',
            'order_number.required' => 'Vui lòng nhập thứ tự bài học',
            'order_number.integer' => 'Thứ tự bài học phải là số nguyên',
            'order_number.min' => 'Thứ tự bài học phải lớn hơn 0',
        ];
    }

    /**
     * Get custom attributes for validator errors
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'course_id' => 'Khóa học',
            'name' => 'Tên bài học',
            'description' => 'Mô tả',
            'order_number' => 'Thứ tự',
            'is_preview' => 'Cho phép xem thử',
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
