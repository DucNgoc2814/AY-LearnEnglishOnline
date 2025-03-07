<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\Category
 * @author Your Name
 * @description Request validation cho tạo mới danh mục
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
            'name' => CrudRules::TEXT_RULES['name'],
            'description' => CrudRules::TEXT_RULES['description'],
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
                'name.required' => 'Tên danh mục là bắt buộc',
                'name.unique' => 'Tên danh mục đã tồn tại'
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
            'name' => 'Tên danh mục'
        ];
    }
}