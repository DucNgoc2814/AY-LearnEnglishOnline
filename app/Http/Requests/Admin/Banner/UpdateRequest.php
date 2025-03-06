<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\Banner
 * @author Your Name
 * @description Request validation cho cập nhật banner
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
            'image' => CrudRules::FILE_RULES['image'],
            'content' => CrudRules::TEXT_RULES['content'],
            'isActive' => CrudRules::NUMBER_RULES['status']
        ];
    }

    public function messages(): array
    {
        return CrudRules::MESSAGES;
    }

    public function attributes(): array
    {
        return [
            'image' => 'Hình ảnh banner',
            'content' => 'Nội dung',
            'isActive' => 'Trạng thái kích hoạt'
        ];
    }
} 