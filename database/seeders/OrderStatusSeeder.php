<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        OrderStatus::create(['status' => 'pending']);
        OrderStatus::create(['status' => 'paid']);
        OrderStatus::create(['status' => 'completed']);
        OrderStatus::create(['status' => 'cancelled']);
    }
}
