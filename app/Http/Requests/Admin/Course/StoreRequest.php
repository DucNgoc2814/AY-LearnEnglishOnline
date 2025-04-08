<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Course
 * @author Your Name
 * @description Request validation cho tạo mới khóa học
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
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'course_type' => 'required|in:self_paced,instructor_led,hybrid',
            'course_format' => 'required|in:online,offline,hybrid',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'estimated_hours' => 'nullable|integer|min:0',
            'has_certificate' => 'boolean',
            'requires_enrollment' => 'boolean',
            'thumbnail' => 'required|image|max:2048',
            'preview_video' => 'nullable|file|mimes:mp4,webm,ogg|max:102400',
            'course_outline' => 'nullable|json',
            'requirements' => 'nullable|array',
            'learning_outcomes' => 'nullable|array',
            'release_date' => 'nullable|date',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Danh mục không được để trống',
            'category_id.exists' => 'Danh mục không tồn tại',
            'title.required' => 'Tiêu đề khóa học không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'course_type.required' => 'Loại khóa học không được để trống',
            'course_type.in' => 'Loại khóa học không hợp lệ',
            'course_format.required' => 'Hình thức học không được để trống',
            'course_format.in' => 'Hình thức học không hợp lệ',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là số',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0',
            'sale_price.numeric' => 'Giá khuyến mãi phải là số',
            'sale_price.min' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0',
            'sale_price.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc',
            'estimated_hours.integer' => 'Số giờ học phải là số nguyên',
            'estimated_hours.min' => 'Số giờ học phải lớn hơn hoặc bằng 0',
            'thumbnail.required' => 'Ảnh đại diện không được để trống',
            'thumbnail.image' => 'File phải là ảnh',
            'thumbnail.max' => 'Kích thước ảnh tối đa là 2MB',
            'release_date.date' => 'Ngày phát hành không hợp lệ',
            'order.integer' => 'Thứ tự phải là số nguyên',
            'order.min' => 'Thứ tự phải lớn hơn hoặc bằng 0',
            'preview_video.file' => 'Video giới thiệu phải là file',
            'preview_video.mimes' => 'Video giới thiệu phải có định dạng: mp4, webm, ogg',
            'preview_video.max' => 'Video giới thiệu không được vượt quá 100MB'
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'Danh mục',
            'title' => 'Tiêu đề khóa học',
            'description' => 'Mô tả',
            'short_description' => 'Mô tả ngắn',
            'course_type' => 'Loại khóa học',
            'course_format' => 'Hình thức học',
            'price' => 'Giá',
            'sale_price' => 'Giá khuyến mãi',
            'estimated_hours' => 'Số giờ học',
            'has_certificate' => 'Có chứng chỉ',
            'requires_enrollment' => 'Yêu cầu đăng ký',
            'thumbnail' => 'Ảnh đại diện',
            'preview_video' => 'Video giới thiệu',
            'course_outline' => 'Đề cương khóa học',
            'requirements' => 'Yêu cầu đầu vào',
            'learning_outcomes' => 'Kết quả đầu ra',
            'release_date' => 'Ngày phát hành',
            'order' => 'Thứ tự',
            'is_featured' => 'Nổi bật',
            'is_active' => 'Kích hoạt'
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
