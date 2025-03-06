<?php

namespace App\Http\Requests\Admin\LessonTestResult;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\LessonTestResult
 * @author Your Name
 * @description Request validation cho cập nhật kết quả bài kiểm tra
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
            'userId' => CrudRules::RELATION_RULES['user_id'],
            'lessonTestId' => CrudRules::RELATION_RULES['lessonTestId'],
            'score' => CrudRules::NUMBER_RULES['score'],
            'timeTaken' => CrudRules::NUMBER_RULES['duration'],
            'attemptNumber' => CrudRules::NUMBER_RULES['attempts'],
            'status' => CrudRules::NUMBER_RULES['status']
        ];
    }

    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'userId.exists' => 'Người dùng không tồn tại',
                'lessonTestId.exists' => 'Bài kiểm tra không tồn tại',
                'score.min' => 'Điểm số tối thiểu là 0',
                'score.max' => 'Điểm số tối đa là 100',
                'timeTaken.min' => 'Thời gian làm bài không được âm',
                'attemptNumber.min' => 'Số lần làm bài tối thiểu là 1'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'userId' => 'Người dùng',
            'lessonTestId' => 'Bài kiểm tra',
            'score' => 'Điểm số',
            'timeTaken' => 'Thời gian làm bài',
            'attemptNumber' => 'Lần thử thứ',
            'status' => 'Trạng thái'
        ];
    }
}