<?php

namespace App\Http\Requests\Admin\Test;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Test
 * @author Your Name
 * @description Request validation cho cập nhật bài test
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
        $id = $this->route('id');
        return [
            'testable_type' => 'nullable|string',
            'testable_id' => 'nullable|integer',
            'name' => 'required|string|max:255|unique:tests,name,'.$id,
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'min_score' => 'required|integer|min:0',
            'max_score' => 'required|integer|min:0|gte:min_score',
            'is_required' => 'nullable|in:0,1,true,false',
            'total_attempt' => 'nullable|integer|min:0',
            'max_attempt' => 'nullable|integer|min:0',
            'type' => 'required|string|in:lesson_test,final_exam,entrance_test,session_test',
            'settings' => 'nullable|json',
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
                'name.required' => 'Tên bài test là bắt buộc',
                'name.unique' => 'Tên bài test đã tồn tại',
                'duration.integer' => 'Thời gian làm bài phải là số nguyên',
                'duration.min' => 'Thời gian làm bài phải lớn hơn 0',
                'min_score.required' => 'Điểm tối thiểu là bắt buộc',
                'min_score.integer' => 'Điểm tối thiểu phải là số nguyên',
                'min_score.min' => 'Điểm tối thiểu không được âm',
                'max_score.required' => 'Điểm tối đa là bắt buộc',
                'max_score.integer' => 'Điểm tối đa phải là số nguyên',
                'max_score.min' => 'Điểm tối đa không được âm',
                'max_score.gte' => 'Điểm tối đa phải lớn hơn hoặc bằng điểm tối thiểu',
                'is_required.in' => 'Trường bắt buộc phải là có hoặc không',
                'total_attempt.integer' => 'Tổng số lần làm bài phải là số nguyên',
                'total_attempt.min' => 'Tổng số lần làm bài không được âm',
                'max_attempt.integer' => 'Số lần thử tối đa phải là số nguyên',
                'max_attempt.min' => 'Số lần thử tối đa không được âm',
                'type.required' => 'Loại bài test là bắt buộc',
                'type.in' => 'Loại bài test không hợp lệ',
                'settings.json' => 'Cài đặt phải là định dạng JSON hợp lệ',
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
            'name' => 'Tên bài test',
            'description' => 'Mô tả',
            'duration' => 'Thời gian làm bài',
            'min_score' => 'Điểm tối thiểu',
            'max_score' => 'Điểm tối đa',
            'is_required' => 'Bắt buộc phải làm bài',
            'total_attempt' => 'Tổng số lần làm bài',
            'max_attempt' => 'Số lần thử tối đa',
            'type' => 'Loại bài test',
            'settings' => 'Cài đặt',
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
