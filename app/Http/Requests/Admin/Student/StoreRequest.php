<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|unique:students,email',
            'password' => ['required', 'string', 'min:6', 'regex:/^[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/', 'max:20'],
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048', // 2MB max
            'bio' => 'nullable|string',

            // Parent 1 information
            'parent1_name' => 'nullable|string|max:255',
            'parent1_relationship' => 'nullable|in:father,mother,guardian,other',
            'parent1_phone' => 'nullable|string|max:20',
            'parent1_email' => 'nullable|email',
            'parent1_occupation' => 'nullable|string|max:255',
            'parent1_is_emergency_contact' => 'boolean',

            // Parent 2 information
            'parent2_name' => 'nullable|string|max:255',
            'parent2_relationship' => 'nullable|in:father,mother,guardian,other',
            'parent2_phone' => 'nullable|string|max:20',
            'parent2_email' => 'nullable|email',
            'parent2_occupation' => 'nullable|string|max:255',
            'parent2_is_emergency_contact' => 'boolean',

            'is_active' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'ID người dùng là bắt buộc',
            'user_id.exists' => 'ID người dùng không tồn tại',
            'full_name.required' => 'Họ tên là bắt buộc',
            'email.required' => 'Email là bắt buộc',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được vượt quá 20 ký tự',
            'password.regex' => 'Mật khẩu phải bắt đầu bằng chữ hoa, có ít nhất một chữ thường, một số và một ký tự đặc biệt (@$!%*#?&)',
            'date_of_birth.date' => 'Ngày sinh không hợp lệ',
            'gender.in' => 'Giới tính không hợp lệ',
            'phone.max' => 'Số điện thoại không được quá 20 ký tự',
            'avatar.image' => 'File ảnh đại diện không hợp lệ',
            'avatar.max' => 'Kích thước ảnh không được vượt quá 2MB',
            'parent1_email.email' => 'Email phụ huynh 1 không hợp lệ',
            'parent2_email.email' => 'Email phụ huynh 2 không hợp lệ',
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
