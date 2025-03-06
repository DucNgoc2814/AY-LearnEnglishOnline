<?php

namespace App\Http\Requests\LessonTest;

use App\Http\Controllers\Config\CrudRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'lessonId' => CrudRules::RELATION_RULES['lessonId'],
            'minScore' => CrudRules::NUMBER_RULES['minScore'],
            'isRequired' => CrudRules::NUMBER_RULES['status']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return CrudRules::MESSAGES;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return CrudRules::ATTRIBUTES;
    }
}
