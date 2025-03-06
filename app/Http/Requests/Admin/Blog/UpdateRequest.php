<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;
use Illuminate\Validation\Rule;

/**
 * @package App\Http\Requests\Admin\Blog
 * @author Your Name
 * @description Request validation cho cập nhật Blog
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
            'name' => CrudRules::TEXT_RULES['name'],
            'description' => CrudRules::TEXT_RULES['description'],
            'image' => CrudRules::FILE_RULES['image'],
            'language' => ['required', 'string', 'in:vi,en'],
            'category_id' => CrudRules::RELATION_RULES['category_id']
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
                'name.unique' => 'Tên bài viết đã tồn tại'
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
            'name' => 'Tên bài viết',
            'description' => 'Mô tả',
            'image' => 'Hình ảnh',
            'language' => 'Ngôn ngữ',
            'category_id' => 'Danh mục'
        ];
    }
}