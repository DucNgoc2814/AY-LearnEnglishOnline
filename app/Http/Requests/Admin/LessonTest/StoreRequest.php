<?php

namespace App\Http\Requests\Admin\LessonTest;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\LessonTest
 * @author Your Name
 * @description Request validation cho tạo mới bài kiểm tra
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
            'lessonId' => 'required|exists:lessons,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'minScore' => 'required|numeric|min:0|max:100',
            'maxScore' => 'required|numeric|min:0|max:100|gt:minScore',
            'isRequired' => 'boolean',
            'maxAttempt' => 'required|integer|min:1'
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
            'name.required' => 'Tên bài kiểm tra không được để trống',
            'name.max' => 'Tên bài kiểm tra không được vượt quá 255 ký tự',
            'description.required' => 'Mô tả không được để trống',
            'duration.required' => 'Thời gian làm bài không được để trống',
            'duration.integer' => 'Thời gian làm bài phải là số nguyên',
            'duration.min' => 'Thời gian làm bài phải lớn hơn hoặc bằng 1',
            'minScore.required' => 'Điểm tối thiểu không được để trống',
            'minScore.numeric' => 'Điểm tối thiểu phải là số',
            'minScore.between' => 'Điểm tối thiểu phải nằm trong khoảng từ 0 đến 100',
            'maxScore.required' => 'Điểm tối đa không được để trống',
            'maxScore.numeric' => 'Điểm tối đa phải là số',
            'maxScore.between' => 'Điểm tối đa phải nằm trong khoảng từ 0 đến 100',
            'maxScore.gt' => 'Điểm tối đa phải lớn hơn điểm tối thiểu',
            'maxAttempt.required' => 'Số lần làm tối đa không được để trống',
            'maxAttempt.integer' => 'Số lần làm tối đa phải là số nguyên',
            'maxAttempt.min' => 'Số lần làm tối đa phải lớn hơn hoặc bằng 1',
            'isRequired.boolean' => 'Trường bắt buộc phải là true hoặc false'
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
