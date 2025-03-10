<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string|max:255',
            'categoryId' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'sortDescription' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'salePrice' => 'nullable|numeric|min:0|lt:price',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'learningPath' => 'nullable|string',
            'lessons' => 'nullable|array',
            'paymentContent' => 'nullable|string',
            'totalRating' => 'nullable|numeric|min:0|max:5'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên khóa học không được để trống',
            'categoryId.required' => 'Danh mục không được để trống',
            'categoryId.exists' => 'Danh mục không tồn tại',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là số',
            'price.min' => 'Giá phải lớn hơn 0',
            'salePrice.numeric' => 'Giá khuyến mãi phải là số',
            'salePrice.min' => 'Giá khuyến mãi phải lớn hơn 0',
            'description.required' => 'Mô tả không được để trống',
            'thumbnail.image' => 'File phải là ảnh',
            'thumbnail.max' => 'Kích thước ảnh tối đa là 2MB',
            'name.unique' => 'Tên khóa học đã tồn tại',
            'totalRating.min' => 'Đánh giá tối thiểu là 0',
            'totalRating.max' => 'Đánh giá tối đa là 5'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên khóa học',
            'description' => 'Mô tả',
            'price' => 'Giá',
            'salePrice' => 'Giá khuyến mãi',
            'sortDescription' => 'Mô tả ngắn',
            'thumbnail' => 'Ảnh đại diện',
            'learningPath' => 'Lộ trình học',
            'lessons' => 'Bài học',
            'paymentContent' => 'Nội dung thanh toán',
            'totalRating' => 'Đánh giá trung bình'
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
