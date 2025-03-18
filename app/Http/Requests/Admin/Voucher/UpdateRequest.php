<?php

namespace App\Http\Requests\Admin\Voucher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @package App\Http\Requests\Admin\Voucher
 * @author Your Name
 * @description Request validation cho cập nhật mã giảm giá
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
            'code' => ['required', 'string', 'unique:vouchers,code,'.$id],
            'sale' => ['required', 'numeric', 'min:0'],
            'startDate' => ['required', 'date'],
            'endDate' => ['required', 'date', 'after:startDate'],
            'maxUsage' => ['required', 'integer', 'min:1'],
            'minOrderValue' => ['required', 'numeric', 'min:0'],
            'maxDiscount' => ['required', 'numeric', 'min:0']
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
                'code.required' => 'Mã giảm giá không được để trống',
                'code.unique' => 'Mã giảm giá đã tồn tại',
                'sale.required' => 'Giá trị giảm không được để trống',
                'sale.min' => 'Giá trị giảm phải lớn hơn 0',
                'startDate.required' => 'Ngày bắt đầu không được để trống',
                'endDate.required' => 'Ngày kết thúc không được để trống',
                'endDate.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
                'maxUsage.required' => 'Số lần sử dụng tối đa không được để trống',
                'maxUsage.min' => 'Số lần sử dụng tối đa phải lớn hơn 0',
                'minOrderValue.required' => 'Giá trị đơn hàng tối thiểu không được để trống',
                'maxDiscount.required' => 'Giá trị giảm tối đa không được để trống'
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
            'code' => 'Mã giảm giá',
            'sale' => 'Giá trị giảm',
            'startDate' => 'Ngày bắt đầu',
            'endDate' => 'Ngày kết thúc',
            'maxUsage' => 'Số lần sử dụng tối đa',
            'minOrderValue' => 'Giá trị đơn hàng tối thiểu',
            'maxDiscount' => 'Giá trị giảm tối đa'
        ];
    }

} 