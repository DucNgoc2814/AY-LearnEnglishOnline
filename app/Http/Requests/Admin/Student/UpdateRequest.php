<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->route('student');

        return [
            'user_id' => 'exists:users,id',
            'student_code' => 'string|unique:students,student_code,' . $studentId,
            'full_name' => 'string|max:255',
            'email' => 'string|unique:students,email,' . $studentId,
            'password' => [
                'nullable',
                'string',
                'min:6',
                'max:20',
                'regex:/^[A-Z]/',    // Bắt đầu bằng chữ hoa
                'regex:/[a-z]/',     // Có ít nhất một chữ thường
                'regex:/[0-9]/',     // Có ít nhất một số
                'regex:/[@$!%*#?&]/' // Có ít nhất một ký tự đặc biệt
            ],
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
            'user_id.exists' => 'ID người dùng không tồn tại',
            'student_code.unique' => 'Mã học viên đã tồn tại',
            'email.unique' => 'Email đã tồn tại',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được vượt quá 20 ký tự',
            'password.regex' => 'Mật khẩu phải bắt đầu bằng chữ hoa, có ít nhất một chữ thường, một số và một ký tự đặc biệt (@$!%*#?&)',
            'full_name.max' => 'Họ tên không được quá 255 ký tự',
            'date_of_birth.date' => 'Ngày sinh không hợp lệ',
            'gender.in' => 'Giới tính không hợp lệ',
            'phone.max' => 'Số điện thoại không được quá 20 ký tự',
            'avatar.image' => 'File ảnh đại diện không hợp lệ',
            'avatar.max' => 'Kích thước ảnh không được vượt quá 2MB',
            'parent1_email.email' => 'Email phụ huynh 1 không hợp lệ',
            'parent2_email.email' => 'Email phụ huynh 2 không hợp lệ',
        ];
    }
}
