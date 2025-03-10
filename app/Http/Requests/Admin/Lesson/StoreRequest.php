<?php

namespace App\Http\Requests\Admin\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\Lesson
 * @author Your Name
 * @description Request validation cho tạo mới bài học
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
            'courseId' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:lessons',
            'videoUrl' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|integer|min:0',
            'orderNumber' => 'required|integer|min:0',
            'isPreview' => 'required|boolean',
            'totalView' => 'required|integer|min:0',
            'totalComment' => 'required|integer|min:0'
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
            [
            'courseId.required' => 'Khóa học không được để trống',
            'courseId.exists' => 'Khóa học không tồn tại',
            'name.required' => 'Tên bài học không được để trống',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'videoUrl.required' => 'URL video không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'duration.required' => 'Thời lượng không được để trống',
            'duration.min' => 'Thời lượng phải lớn hơn 0',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.min' => 'Thứ tự phải lớn hơn 0',
            'isPreview.required' => 'Trạng thái xem trước không được để trống'
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
            'courseId' => 'Khóa học',
            'title' => 'Tiêu đề bài học',
            'description' => 'Mô tả',
            'content' => 'Nội dung',
            'duration' => 'Thời lượng (phút)',
            'order' => 'Thứ tự',
            'type' => 'Loại bài học',
            'videoUrl' => 'Đường dẫn video',
            'documentUrl' => 'Đường dẫn tài liệu',
            'isActive' => 'Trạng thái kích hoạt'
        ];
    }
}
