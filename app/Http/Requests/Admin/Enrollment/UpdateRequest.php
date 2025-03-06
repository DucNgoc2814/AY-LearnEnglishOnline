<?php

namespace App\Http\Requests\Admin\Enrollment;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\Enrollment
 * @author Your Name
 * @description Request validation cho cập nhật đăng ký khóa học
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
            'userId' => CrudRules::RELATION_RULES['userId'],
            'courseId' => CrudRules::RELATION_RULES['courseId'],
            'status' => CrudRules::NUMBER_RULES['status'],
            'progress' => CrudRules::NUMBER_RULES['progress']
        ];
    }

    /**
     * Get custom messages for validator errors
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'userId.exists' => 'Người dùng không tồn tại',
                'courseId.exists' => 'Khóa học không tồn tại',
                'progress.min' => 'Tiến độ tối thiểu là 0%',
                'progress.max' => 'Tiến độ tối đa là 100%'
            ]
        );
    }

    /**
     * Get custom attributes for validator errors
     * 
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'userId' => 'Người dùng',
            'courseId' => 'Khóa học',
            'status' => 'Trạng thái',
            'progress' => 'Tiến độ học tập'
        ];
    }
}