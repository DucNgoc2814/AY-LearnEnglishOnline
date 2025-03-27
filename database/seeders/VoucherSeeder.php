<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    public function run()
    {
        $vouchers = [
            [
                'code' => 'WELCOME2024',
                'sale' => 10,
                'start_date' => '2024-01-01 00:00:00',
                'end_date' => '2024-12-31 23:59:59',
                'max_usage' => 100,
                'usage_count' => 0,
                'min_order_value' => 1000000,
                'max_discount' => 500000
            ],
            [
                'code' => 'NEWYEAR24',
                'sale' => 200000,
                'start_date' => '2024-01-01 00:00:00',
                'end_date' => '2024-01-31 23:59:59',
                'max_usage' => 50,
                'usage_count' => 0,
                'min_order_value' => 1500000,
                'max_discount' => 200000
            ],
            // Thêm 8 voucher khác...
        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
} 