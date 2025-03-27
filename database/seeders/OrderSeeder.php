<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                'user_id' => 5,
                'course_id' => 1,
                'order_status_id' => 1,
                'transaction_id' => 'ORD003',
                'payment_amount' => 1100000,
                'price' => 1200000,
                'sale_percentage' => 10,
                'voucher_code' => null,
                'payment_method' => 'bank_transfer',
                'payment_date' => null,
                'note' => 'Đang chờ xác nhận thanh toán'
            ],
            [
                'user_id' => 3,
                'course_id' => 1,
                'order_status_id' => 3,
                'transaction_id' => 'ORD001',
                'payment_amount' => 1500000,
                'price' => 1500000,
                'sale_percentage' => 0,
                'voucher_code' => null,
                'payment_method' => 'momo',
                'payment_date' => '2024-01-01 10:00:00',
                'note' => 'Thanh toán khóa học Laravel Basic'
            ],
            [
                'user_id' => 4,
                'course_id' => 2,
                'order_status_id' => 1,
                'transaction_id' => 'TRANS002',
                'payment_amount' => 1800000,
                'price' => 2000000,
                'sale_percentage' => 10,
                'voucher_code' => 'SAVE10',
                'payment_method' => 'vnpay',
                'payment_date' => '2024-01-02 11:30:00',
                'note' => 'Thanh toán khóa học React Advanced'
            ],
            // Thêm 7 order khác...
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}