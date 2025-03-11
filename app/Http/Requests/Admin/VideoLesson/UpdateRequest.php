<?php

namespace App\Http\Requests\Admin\VideoLesson;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;
use Illuminate\Validation\Rule;

/**
 * @package App\Http\Requests\Admin\Lesson
 * @author Your Name
 * @description Request validation cho cập nhật bài học
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
            'lessonId' => 'required|exists:lessons,id',
            'name' => 'required|string|max:255',
            'videoUrl' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/x-ms-wmv,video/x-msvideo,video/x-flv|max:512000',
            'videoType' => 'required_with:videoUrl',
            'duration' => 'required|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
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
            'lessonId.required' => 'Bài học không được để trống',
            'lessonId.exists' => 'Bài học không tồn tại',
            'name.required' => 'Tên video không được để trống',
            'name.max' => 'Tên video không được vượt quá 255 ký tự',
            'videoUrl.file' => 'File video không hợp lệ',
            'videoUrl.mimetypes' => 'File video phải có định dạng MP4, MOV, WMV, AVI hoặc FLV',
            'videoUrl.max' => 'File video không được vượt quá 500MB',
            'videoType.required_with' => 'Loại video không được để trống khi có file video',
            'duration.required' => 'Thời lượng không được để trống',
            'duration.integer' => 'Thời lượng phải là số nguyên',
            'thumbnail.image' => 'File thumbnail phải là hình ảnh',
            'thumbnail.mimes' => 'Ảnh thumbnail phải có định dạng JPEG, PNG, JPG hoặc GIF',
            'thumbnail.max' => 'Ảnh thumbnail không được vượt quá 2MB'
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
            'lessonId' => 'Bài học',
            'name' => 'Tên video',
            'videoUrl' => 'File video',
            'videoType' => 'Loại video',
            'duration' => 'Thời lượng',
            'thumbnail' => 'Ảnh thumbnail'
        ];
    }
}
