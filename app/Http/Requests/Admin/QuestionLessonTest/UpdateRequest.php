<?php

namespace App\Http\Requests\Admin\QuestionLessonTest;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\QuestionLessonTest
 * @author Your Name
 * @description Request validation cho cập nhật câu hỏi bài kiểm tra
 */
class UpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'lessonTestId' => 'exists:lesson_tests,id',
            'type' => 'string|in:multiple_choice,single_choice,true_false,essay',
            'question' => 'string|max:1000',
            'mediaUrl' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,mp4|max:10240',
            'orderNumber' => 'integer|min:1'
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'lessonTestId.exists' => 'Bài kiểm tra không tồn tại',
            'type.in' => 'Loại câu hỏi không hợp lệ',
            'question.max' => 'Nội dung câu hỏi không được vượt quá 1000 ký tự',
            'mediaUrl.file' => 'File đính kèm không hợp lệ',
            'mediaUrl.mimes' => 'File đính kèm phải có định dạng JPEG, PNG, JPG, GIF, MP3 hoặc MP4',
            'mediaUrl.max' => 'File đính kèm không được vượt quá 10MB',
            'orderNumber.integer' => 'Thứ tự câu hỏi phải là số nguyên',
            'orderNumber.min' => 'Thứ tự câu hỏi phải lớn hơn 0'
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'lessonTestId' => 'Bài kiểm tra',
            'type' => 'Loại câu hỏi',
            'question' => 'Nội dung câu hỏi',
            'mediaUrl' => 'File đính kèm',
            'orderNumber' => 'Thứ tự câu hỏi'
        ];
    }
}
