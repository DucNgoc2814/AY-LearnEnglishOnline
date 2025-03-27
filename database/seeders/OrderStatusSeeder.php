<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            [
                'name' => 'pending',
                'display_name' => 'Chờ xử lý',
                'description' => 'Đơn hàng mới tạo'
            ],
            [
                'name' => 'processing',
                'display_name' => 'Đang xử lý',
                'description' => 'Đơn hàng đang được xử lý'
            ],
            [
                'name' => 'completed',
                'display_name' => 'Hoàn thành',
                'description' => 'Đơn hàng đã hoàn thành'
            ],
            [
                'name' => 'cancelled',
                'display_name' => 'Đã hủy',
                'description' => 'Đơn hàng đã bị hủy'
            ]
        ];

        foreach ($statuses as $status) {
            OrderStatus::create($status);
        }
    }
}