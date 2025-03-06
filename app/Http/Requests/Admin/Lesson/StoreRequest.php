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
            'courseId' => CrudRules::RELATION_RULES['courseId'],
            'name' => CrudRules::TEXT_RULES['name'],
            'type' => CrudRules::TEXT_RULES['type'],
            'videoUrl' => CrudRules::TEXT_RULES['url'],
            'description' => CrudRules::TEXT_RULES['description'],
            'sortDescription' => CrudRules::TEXT_RULES['sortDescription'],
            'startTime' => CrudRules::DATE_RULES['start_time'],
            'endTime' => CrudRules::DATE_RULES['end_time'],
            'duration' => CrudRules::NUMBER_RULES['duration'],
            'notes' => CrudRules::TEXT_RULES['notes']
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
                'courseId.exists' => 'Khóa học không tồn tại',
                'name.unique' => 'Tên bài học đã tồn tại',
                'duration.min' => 'Thời lượng bài học tối thiểu là 1 phút',
                'type.in' => 'Loại bài học không hợp lệ',
                'videoUrl.url' => 'Đường dẫn video không hợp lệ',
                'startTime.date' => 'Thời gian bắt đầu không hợp lệ',
                'endTime.date' => 'Thời gian kết thúc không hợp lệ',
                'endTime.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu',
                'notes.max' => 'Mô tả bài học không được quá 1000 ký tự',
                'sortDescription.max' => 'Mô tả ngắn bài học không được quá 255 ký tự',
                'sortDescription.string' => 'Mô tả ngắn bài học phải là chuỗi ký tự',
                'description.max' => 'Mô tả bài học không được quá 1000 ký tự',
                'description.string' => 'Mô tả bài học phải là chuỗi ký tự',
                'notes.string' => 'Mô tả bài học phải là chuỗi ký tự',
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