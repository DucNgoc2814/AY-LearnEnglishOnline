<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Banner
 * @description Request validation cho cập nhật banner
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
            'title' => 'required|string|max:255',
            'image_url' => 'nullable|image|max:2048',
            'link_url' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'position' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề banner không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'image_url.image' => 'File phải là ảnh',
            'image_url.max' => 'Kích thước ảnh tối đa là 2MB',
            'link_url.url' => 'Đường dẫn không hợp lệ',
            'link_url.max' => 'Đường dẫn không được vượt quá 255 ký tự',
            'order.integer' => 'Thứ tự phải là số nguyên',
            'order.min' => 'Thứ tự phải lớn hơn hoặc bằng 0',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ',
            'end_date.date' => 'Ngày kết thúc không hợp lệ',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu',
            'position.required' => 'Vị trí banner không được để trống',
            'position.max' => 'Vị trí không được vượt quá 255 ký tự'
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề banner',
            'image_url' => 'Ảnh banner',
            'link_url' => 'Đường dẫn',
            'order' => 'Thứ tự',
            'is_active' => 'Trạng thái',
            'start_date' => 'Ngày bắt đầu',
            'end_date' => 'Ngày kết thúc',
            'position' => 'Vị trí'
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
