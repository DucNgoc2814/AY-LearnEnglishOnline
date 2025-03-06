<?php

namespace App\Http\Requests\Admin\LessonTest;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\LessonTest
 * @author Your Name
 * @description Request validation cho tạo mới bài kiểm tra
 */
class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lessonId' => CrudRules::RELATION_RULES['lessonId'],
            'minScore' => CrudRules::NUMBER_RULES['minScore'],
            'isRequired' => CrudRules::NUMBER_RULES['status']
        ];
    }

    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'lessonId.exists' => 'Bài học không tồn tại'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'lessonId' => 'Bài học',
            'title' => 'Tiêu đề',
            'description' => 'Mô tả'
        ];
    }
}