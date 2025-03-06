<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;
use Illuminate\Validation\Rule;

/**
 * @package App\Http\Requests\Admin\Course
 * @author Your Name
 * @description Request validation cho cập nhật khóa học
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
            'name' => CrudRules::TEXT_RULES['name'],
            'description' => CrudRules::TEXT_RULES['description'],
            'price' => CrudRules::NUMBER_RULES['price'],
            'type' => CrudRules::TEXT_RULES['type'],
            'learningPath' => CrudRules::TEXT_RULES['content'],
            'categoryId' => CrudRules::RELATION_RULES['categoryId'],
            'lessons' => CrudRules::RELATION_RULES['lessons'],
            'paymentContent' => CrudRules::TEXT_RULES['content'],
            'totalRating' => CrudRules::NUMBER_RULES['totalRating']
        ];
    }

    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'name.unique' => 'Tên khóa học đã tồn tại',
                'price.min' => 'Giá không được âm',
                'categoryId.exists' => 'Danh mục không tồn tại',
                'totalRating.min' => 'Đánh giá tối thiểu là 0',
                'totalRating.max' => 'Đánh giá tối đa là 5'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên khóa học',
            'description' => 'Mô tả',
            'price' => 'Giá',
            'type' => 'Loại khóa học',
            'learningPath' => 'Lộ trình học',
            'categoryId' => 'Danh mục',
            'lessons' => 'Bài học',
            'paymentContent' => 'Nội dung thanh toán',
            'totalRating' => 'Đánh giá trung bình'
        ];
    }
}