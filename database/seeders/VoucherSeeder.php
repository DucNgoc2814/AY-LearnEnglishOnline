<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    public function run()
    {
        Voucher::create([
            'code' => 'DISCOUNT10',
            'sale' => 10,
            'startDate' => now(),
            'endDate' => now()->addDays(30),
            'usageCount' => 0,
            'condition' => null,
        ]);
    }
}
