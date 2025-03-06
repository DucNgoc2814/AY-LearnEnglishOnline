<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin
 * @author Your Name
 * @description Request validation cho Example
 */
class ExampleRequest extends FormRequest
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
            'price' => CrudRules::NUMBER_RULES['price'],
            'category_id' => CrudRules::RELATION_RULES['category_id'],
            'status' => CrudRules::NUMBER_RULES['status'],
            'image' => CrudRules::FILE_RULES['image'],
            'published_at' => CrudRules::DATE_RULES['published_at']
        ];
    }

    /**
     * Get custom messages for validator errors
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return CrudRules::MESSAGES;
    }

    /**
     * Get custom attributes for validator errors
     * 
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return CrudRules::ATTRIBUTES;
    }
} 