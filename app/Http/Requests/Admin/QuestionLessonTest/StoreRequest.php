<?php

namespace App\Http\Requests\Admin\QuestionLessonTest;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\QuestionLessonTest
 * @author Your Name
 * @description Request validation cho tạo mới câu hỏi bài kiểm tra
 */
class StoreRequest extends FormRequest
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
            'lessonTestId' => 'required|exists:lesson_tests,id',
            'type' => 'required|in:text,image,video,audio',
            'question' => 'required|string',
            'mediaUrl' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,wmv,mp3,wav,ogg|max:102400',
            'orderNumber' => 'required|integer|min:1',
            'answerType' => 'required|in:single_choice,multiple_choice,fill_in_blank',
            'answers' => 'required|array|min:1',
            'answers.*.answer' => 'required|string',
            'answers.*.orderNumber' => 'required|integer|min:1',
            'answers.*.isCorrect' => 'boolean',
            'answers.*.caseSensitive' => 'boolean',
            'answers.*.alternativeAnswers' => 'nullable|string',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'lessonTestId.required' => 'Bài kiểm tra không được để trống',
            'lessonTestId.exists' => 'Bài kiểm tra không tồn tại',
            'type.required' => 'Loại câu hỏi không được để trống',
            'type.in' => 'Loại câu hỏi không hợp lệ',
            'question.required' => 'Nội dung câu hỏi không được để trống',
            'question.max' => 'Nội dung câu hỏi không được vượt quá 1000 ký tự',
            'mediaUrl.file' => 'File đính kèm không hợp lệ',
            'mediaUrl.mimes' => 'File đính kèm phải có định dạng JPEG, PNG, JPG, GIF, MP4, WAV, MP3',
            'mediaUrl.max' => 'File đính kèm không được vượt quá 10MB',
            'orderNumber.required' => 'Thứ tự câu hỏi không được để trống',
            'orderNumber.integer' => 'Thứ tự câu hỏi phải là số nguyên',
            'orderNumber.min' => 'Thứ tự câu hỏi phải lớn hơn 0',
            'answerType.required' => 'Loại câu trả lời không được để trống',
            'answerType.in' => 'Loại câu trả lời không hợp lệ',
            'answers.required' => 'Câu trả lời không được để trống',
            'answers.array' => 'Câu trả lời phải là một mảng',
            'answers.*.answer.required' => 'Nội dung câu trả lời không được để trống',
            'answers.*.orderNumber.required' => 'Thứ tự câu trả lời không được để trống',
            'answers.*.orderNumber.integer' => 'Thứ tự câu trả lời phải là số nguyên',
            'answers.*.orderNumber.min' => 'Thứ tự câu trả lời phải lớn hơn 0',
            'answers.*.isCorrect.boolean' => 'Tùy chọn đúng/sai phải là boolean',
            'answers.*.caseSensitive.boolean' => 'Tùy chọn phân biệt hoa/thường phải là boolean',
            'answers.*.alternativeAnswers.string' => 'Các đáp án thay thế phải là chuỗi',
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
            'orderNumber' => 'Thứ tự câu hỏi',
            'answerType' => 'Loại câu trả lời',
            'answers' => 'Câu trả lời',
            'answers.*.answer' => 'Nội dung câu trả lời',
            'answers.*.orderNumber' => 'Thứ tự câu trả lời',
            'answers.*.isCorrect' => 'Đúng/Sai',
            'answers.*.caseSensitive' => 'Phân biệt hoa/thường',
            'answers.*.alternativeAnswers' => 'Các đáp án thay thế',
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
