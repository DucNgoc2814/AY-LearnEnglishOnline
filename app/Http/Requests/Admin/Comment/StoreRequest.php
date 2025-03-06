<?php

namespace App\Http\Requests\Admin\Comment;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\Comment
 * @author Your Name
 * @description Request validation cho tạo mới bình luận
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
            'lessonId' => CrudRules::RELATION_RULES['lessonId'],
            'content' => CrudRules::TEXT_RULES['content'],
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
                'lessonId.exists' => 'Bài học không tồn tại'
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
            'lessonId' => 'Bài học',
            'content' => 'Nội dung',
            'timestamp' => 'Thời gian',
            'status' => 'Trạng thái'
        ];
    }
}