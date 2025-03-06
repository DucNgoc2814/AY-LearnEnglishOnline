<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResetPassword;

class ResetPasswordSeeder extends Seeder
{
    public function run()
    {
        ResetPassword::create([
            'userId' => 1,
            'token' => 'reset_token',
            'expiresAt' => now()->addHours(1),
        ]);
    }
}
