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
            'courseId' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'orderNumber' => 'required|integer|min:1',
            'isPreview' => 'boolean'
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
            'courseId.required' => 'Khóa học không được để trống',
            'courseId.exists' => 'Khóa học không tồn tại',
            'name.required' => 'Tên bài học không được để trống',
            'name.max' => 'Tên bài học không được vượt quá 255 ký tự',
            'description.required' => 'Mô tả không được để trống',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.integer' => 'Thứ tự phải là số nguyên',
            'orderNumber.min' => 'Thứ tự phải lớn hơn hoặc bằng 1'
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
            'courseId' => 'Khóa học',
            'name' => 'Tên bài học',
            'description' => 'Mô tả',
            'orderNumber' => 'Thứ tự',
            'isPreview' => 'Cho phép xem thử'
        ];
    }
}
