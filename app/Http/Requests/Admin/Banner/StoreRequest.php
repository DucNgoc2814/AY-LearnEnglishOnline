<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Banner
 * @description Request validation cho tạo mới banner
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_url' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'position' => 'required|string|in:home_top,home_middle,home_bottom,sidebar',
        ];
    }

    /**
     * Get custom messages for validator errors
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'image.required' => 'Ảnh banner không được để trống',
            'image.image' => 'File phải là hình ảnh',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB',
            'link_url.url' => 'Đường dẫn liên kết không hợp lệ',
            'link_url.max' => 'Đường dẫn liên kết không được vượt quá 255 ký tự',
            'order.integer' => 'Thứ tự phải là số nguyên',
            'order.min' => 'Thứ tự không được nhỏ hơn 0',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ',
            'end_date.date' => 'Ngày kết thúc không hợp lệ',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu',
            'position.required' => 'Vị trí không được để trống',
            'position.in' => 'Vị trí không hợp lệ',
        ];
    }

    /**
     * Get custom attributes for validator errors
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề banner',
            'image' => 'Ảnh banner',
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
