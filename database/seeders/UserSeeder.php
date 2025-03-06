<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'phoneNumber' => '123456789',
            'birthDate' => now(),
            'authGoogleId' => null,
            'role' => 'admin',
            'roleToken' => null,
            'refreshToken' => null,
        ]);
    }
}
