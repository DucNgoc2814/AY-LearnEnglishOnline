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
            'paymentAmount' => 100.00,
            'price' => 100.00,
            'paymentMethod' => 'credit_card',
            'orderStatusId' => 1,
            'transactionId' => 'txn_123456',
            'paymentDate' => now(),
            'voucherCode' => null,
            'salePercentage' => 0
        ]);
        Order::create([
            'userId' => 2,
            'courseId' => 2,
            'paymentAmount' => 150.00,
            'price' => 150.00,
            'paymentMethod' => 'paypal',
            'orderStatusId' => 2,
            'transactionId' => 'txn_123457',
            'paymentDate' => now(),
            'voucherCode' => null,
            'salePercentage' => 0
        ]);
        Order::create([
            'userId' => 3,
            'courseId' => 3,
            'paymentAmount' => 200.00,
            'price' => 200.00,
            'paymentMethod' => 'bank_transfer',
            'orderStatusId' => 3,
            'transactionId' => 'txn_123458',
            'paymentDate' => now(),
            'voucherCode' => null,
            'salePercentage' => 0
        ]);
        Order::create([
            'userId' => 4,
            'courseId' => 4,
            'paymentAmount' => 250.00,
            'price' => 250.00,
            'paymentMethod' => 'credit_card',
            'orderStatusId' => 4,
            'transactionId' => 'txn_123459',
            'paymentDate' => now(),
            'voucherCode' => null,
            'salePercentage' => 0
        ]);
        Order::create([
            'userId' => 5,
            'courseId' => 5,
            'paymentAmount' => 300.00,
            'price' => 300.00,
            'paymentMethod' => 'paypal',
            'orderStatusId' => 1,
            'transactionId' => 'txn_123460',
            'paymentDate' => now(),
            'voucherCode' => null,
            'salePercentage' => 0
        ]);
    }
}
