<?php

namespace App\Http\Requests\Admin\ExamResult;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\ExamResult
 * @author Your Name
 * @description Request validation cho cập nhật kết quả thi
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
            'finalExamId' => CrudRules::RELATION_RULES['finalExamId'],
            'score' => CrudRules::NUMBER_RULES['score'],
            'status' => CrudRules::NUMBER_RULES['status']
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
                'finalExamId.exists' => 'Bài thi không tồn tại',
                'score.min' => 'Điểm tối thiểu là 0',
                'score.max' => 'Điểm tối đa là 100'
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
            'finalExamId' => 'Bài thi cuối khóa',
            'score' => 'Điểm số',
            'status' => 'Trạng thái'
        ];
    }
}