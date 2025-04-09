<?php

namespace App\Http\Requests\Admin\VideoLesson;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\VideoLesson
 * @author Your Name
 * @description Request validation cho cập nhật video bài học
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
            'lesson_id' => 'required|exists:lessons,id',
            'name' => 'required|string|max:255',
            'video_url' => 'nullable|mimes:mp4,mov,wmv,avi,flv|max:512000',
            'video_type' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'thumbnail_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_downloadable' => 'boolean',
            'is_preview' => 'boolean'
        ];
    }

    /**
     * Get custom messages for validator errors
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'lesson_id.required' => 'Bài học không được để trống',
            'lesson_id.exists' => 'Bài học không tồn tại',
            'name.required' => 'Tên video không được để trống',
            'name.max' => 'Tên video không được vượt quá 255 ký tự',
            'video_url.file' => 'File video không hợp lệ',
            'video_url.mimetypes' => 'File video phải có định dạng MP4, MOV, WMV, AVI hoặc FLV',
            'video_url.max' => 'File video không được vượt quá 500MB',
            'video_type.required_with' => 'Loại video không được để trống khi có file video',
            'video_type.string' => 'Loại video phải là chuỗi ký tự',
            'duration.required' => 'Thời lượng không được để trống',
            'duration.integer' => 'Thời lượng phải là số nguyên',
            'duration.min' => 'Thời lượng phải lớn hơn 0',
            'thumbnail_url.image' => 'File thumbnail phải là hình ảnh',
            'thumbnail_url.mimes' => 'Ảnh thumbnail phải có định dạng JPEG, PNG, JPG hoặc GIF',
            'thumbnail_url.max' => 'Ảnh thumbnail không được vượt quá 2MB',
            'is_downloadable.boolean' => 'Cho phép tải xuống phải là giá trị boolean',
            'is_preview.boolean' => 'Cho phép xem thử phải là giá trị boolean'
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
            'lesson_id' => 'Bài học',
            'name' => 'Tên video',
            'video_url' => 'File video',
            'video_type' => 'Loại video',
            'duration' => 'Thời lượng',
            'thumbnail_url' => 'Ảnh thumbnail',
            'is_downloadable' => 'Cho phép tải xuống',
            'is_preview' => 'Cho phép xem thử'
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
