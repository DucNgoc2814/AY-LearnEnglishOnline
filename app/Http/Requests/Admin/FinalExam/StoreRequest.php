<?php

namespace App\Http\Requests\Admin\FinalExam;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\FinalExam
 * @author Your Name
 * @description Request validation cho tạo mới bài thi cuối khóa
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
            'courseId' => CrudRules::RELATION_RULES['courseId'],
            'title' => CrudRules::TEXT_RULES['title'],
            'description' => CrudRules::TEXT_RULES['content']
        ];
    }

    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'courseId.exists' => 'Khóa học không tồn tại'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'courseId' => 'Khóa học',
            'title' => 'Tiêu đề',
            'description' => 'Mô tả'
        ];
    }
}