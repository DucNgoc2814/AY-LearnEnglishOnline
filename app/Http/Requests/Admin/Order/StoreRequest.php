<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Config\CrudRules;

/**
 * @package App\Http\Requests\Admin\Order
 * @author Your Name
 * @description Request validation cho tạo mới đơn hàng
 */
class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userId' => array_merge(
                CrudRules::RELATION_RULES['user_id'],
                ['required', 'exists:users,id']
            ),
            'courseId' => array_merge(
                CrudRules::RELATION_RULES['parent_id'],
                ['required', 'exists:courses,id']
            ),
            'amount' => array_merge(
                CrudRules::NUMBER_RULES['price'],
                ['required', 'numeric', 'min:0']
            ),
            'paymentMethod' => ['required', 'string'],
            'status' => array_merge(
                CrudRules::NUMBER_RULES['status'],
                ['required']
            ),
            'transactionCode' => ['required', 'string', 'unique:orders,transaction_code'],
            'paymentDate' => array_merge(
                CrudRules::DATE_RULES['datetime'],
                ['required']
            ),
            'voucherId' => array_merge(
                CrudRules::RELATION_RULES['parent_id'],
                ['nullable', 'exists:vouchers,id']
            ),
            'discountAmount' => array_merge(
                CrudRules::NUMBER_RULES['price'],
                ['nullable', 'numeric', 'min:0']
            )
        ];
    }

    public function messages(): array
    {
        return array_merge(
            CrudRules::MESSAGES,
            [
                'userId.exists' => 'Người dùng không tồn tại',
                'courseId.exists' => 'Khóa học không tồn tại',
                'amount.min' => 'Số tiền không được âm',
                'transactionCode.unique' => 'Mã giao dịch đã tồn tại',
                'voucherId.exists' => 'Mã giảm giá không tồn tại',
                'discountAmount.min' => 'Số tiền giảm giá không được âm'
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'userId' => 'Người dùng',
            'courseId' => 'Khóa học',
            'amount' => 'Số tiền',
            'paymentMethod' => 'Phương thức thanh toán',
            'status' => 'Trạng thái',
            'transactionCode' => 'Mã giao dịch',
            'paymentDate' => 'Ngày thanh toán',
            'voucherId' => 'Mã giảm giá',
            'discountAmount' => 'Số tiền giảm giá'
        ];
    }
}