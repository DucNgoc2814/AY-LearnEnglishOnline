<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Auth
 * @author Your Name
 * @description Request validation cho đăng ký
 */
class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phoneNumber' => 'required|string|unique:users,phoneNumber',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
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
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phoneNumber.required' => 'Số điện thoại không được để trống',
            'phoneNumber.string' => 'Số điện thoại không đúng định dạng',
            'phoneNumber.max' => 'Số điện thoại không được quá 255 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'confirm_password.required' => 'Mật khẩu không được để trống',
            'confirm_password.same' => 'Mật khẩu không khớp',
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
            'name' => 'Tên',
            'email' => 'Email',
            'numberPhone' => 'Số điện thoại',
            'password' => 'Mật khẩu',
            'confirm_password' => 'Mật khẩu xác nhận'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json([
            'status' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ]));
    }
}