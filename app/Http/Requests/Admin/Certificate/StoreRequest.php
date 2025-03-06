<?php

namespace App\Http\Requests\Admin\Certificate;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\Certificate
 * @author Your Name
 * @description Request validation cho tạo mới chứng chỉ
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
            'userId' => CrudRules::RELATION_RULES['userId'],
            'courseId' => CrudRules::RELATION_RULES['courseId'],
            'issueDate' => CrudRules::DATE_RULES['date'],
            'file' => CrudRules::FILE_RULES['document']
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
                'file.required' => 'Vui lòng chọn file chứng chỉ'
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
            'issueDate' => 'Ngày cấp',
            'file' => 'File chứng chỉ'
        ];
    }
}