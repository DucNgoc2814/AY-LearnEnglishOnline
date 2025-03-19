<?php
namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Admin\Blog
 * @author Your Name
 * @description Request validation cho tạo mới Blog
 */
class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:8',
            'remember' => 'nullable|boolean'
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
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống',
            'password_confirmation.min' => 'Mật khẩu xác nhận phải có ít nhất 8 ký tự',
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
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'remember' => 'Nhớ mật khẩu'
        ];
    }
}