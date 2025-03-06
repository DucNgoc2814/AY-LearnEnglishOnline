<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'userId' => 1,
            'courseId' => 1,
            'orderStatus' => 'paid',
            'transactionId' => 'txn_123456',
            'paymentAmount' => 100.00,
            'price' => 100.00,
            'salePercentage' => null,
            'voucherCode' => null,
        ]);
    }
}
