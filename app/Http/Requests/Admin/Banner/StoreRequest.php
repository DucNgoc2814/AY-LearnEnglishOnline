<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\Banner
 * @author Your Name
 * @description Request validation cho tạo mới banner
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
            'image' => CrudRules::FILE_RULES['image'],
            'content' => CrudRules::TEXT_RULES['content'],
            'isActive' => CrudRules::NUMBER_RULES['status']
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
                'image.required' => 'Vui lòng chọn hình ảnh banner',
                'isActive.required' => 'Vui lòng chọn trạng thái'
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
            'image' => 'Hình ảnh banner',
            'content' => 'Nội dung',
            'isActive' => 'Trạng thái kích hoạt'
        ];
    }
}