<?php

namespace App\Http\Requests\Admin\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;
use Illuminate\Validation\Rule;

/**
 * @package App\Http\Requests\Admin\Lesson
 * @author Your Name
 * @description Request validation cho cập nhật bài học
 */
class UpdateRequest extends FormRequest
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
            'description' => 'required|string',
            'order_number' => 'required|integer|min:1',
            'is_preview' => 'boolean'
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
            'course_id.required' => 'Khóa học không được để trống',
            'course_id.exists' => 'Khóa học không tồn tại',
            'name.required' => 'Tên bài học không được để trống',
            'name.max' => 'Tên bài học không được vượt quá 255 ký tự',
            'description.required' => 'Mô tả không được để trống',
            'order_number.required' => 'Thứ tự không được để trống',
            'order_number.integer' => 'Thứ tự phải là số nguyên',
            'order_number.min' => 'Thứ tự phải lớn hơn hoặc bằng 1'
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
            'is_preview' => 'Cho phép xem thử'
        ];
    }
}
