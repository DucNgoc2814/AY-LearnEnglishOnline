<?php

namespace App\Http\Requests\Admin\LessonTest;

use Illuminate\Foundation\Http\FormRequest;

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
            'lessonId' => 'exists:lessons,id',
            'name' => 'string|max:255',
            'description' => 'string',
            'duration' => 'integer|min:1',
            'minScore' => 'integer|min:0',
            'maxScore' => 'integer|gt:minScore',
            'isRequired' => 'boolean',
            'maxAttempt' => 'integer|min:1'
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
            'lessonId.exists' => 'Bài học không tồn tại',
            'name.max' => 'Tên bài kiểm tra không được vượt quá 255 ký tự',
            'duration.integer' => 'Thời gian làm bài phải là số nguyên',
            'duration.min' => 'Thời gian làm bài phải lớn hơn hoặc bằng 1',
            'minScore.integer' => 'Điểm tối thiểu phải là số nguyên',
            'minScore.min' => 'Điểm tối thiểu không được nhỏ hơn 0',
            'maxScore.integer' => 'Điểm tối đa phải là số nguyên',
            'maxScore.gt' => 'Điểm tối đa phải lớn hơn điểm tối thiểu',
            'maxAttempt.integer' => 'Số lần làm tối đa phải là số nguyên',
            'maxAttempt.min' => 'Số lần làm tối đa phải lớn hơn hoặc bằng 1'
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
            'name' => 'Tên bài kiểm tra',
            'description' => 'Mô tả',
            'duration' => 'Thời gian làm bài',
            'minScore' => 'Điểm tối thiểu',
            'maxScore' => 'Điểm tối đa',
            'isRequired' => 'Bắt buộc',
            'maxAttempt' => 'Số lần làm tối đa'
        ];
    }
}
