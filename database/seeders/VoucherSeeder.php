<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    public function run()
    {
        Voucher::create(['code' => 'DISCOUNT10', 'sale' => 10, 'startDate' => now(), 'endDate' => now()->addDays(30), 'usageCount' => 0]);
        Voucher::create(['code' => 'DISCOUNT20', 'sale' => 20, 'startDate' => now(), 'endDate' => now()->addDays(30), 'usageCount' => 0]);
        Voucher::create(['code' => 'DISCOUNT30', 'sale' => 30, 'startDate' => now(), 'endDate' => now()->addDays(30), 'usageCount' => 0]);
        Voucher::create(['code' => 'DISCOUNT40', 'sale' => 40, 'startDate' => now(), 'endDate' => now()->addDays(30), 'usageCount' => 0]);
        Voucher::create(['code' => 'DISCOUNT50', 'sale' => 50, 'startDate' => now(), 'endDate' => now()->addDays(30), 'usageCount' => 0]);
    }
}
