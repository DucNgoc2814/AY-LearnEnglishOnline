<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'phoneNumber' => '123456789', 'birthDate' => now(), 'authGoogleId' => null, 'role' => 'admin', 'roleToken' => null, 'refreshToken' => null]);
        User::create(['name' => 'User 1', 'email' => 'user1@example.com', 'password' => bcrypt('password'), 'phoneNumber' => '987654321', 'birthDate' => now(), 'authGoogleId' => null, 'role' => 'student', 'roleToken' => null, 'refreshToken' => null]);
        User::create(['name' => 'User 2', 'email' => 'user2@example.com', 'password' => bcrypt('password'), 'phoneNumber' => '456789123', 'birthDate' => now(), 'authGoogleId' => null, 'role' => 'student', 'roleToken' => null, 'refreshToken' => null]);
        User::create(['name' => 'User 3', 'email' => 'user3@example.com', 'password' => bcrypt('password'), 'phoneNumber' => '321654987', 'birthDate' => now(), 'authGoogleId' => null, 'role' => 'student', 'roleToken' => null, 'refreshToken' => null]);
        User::create(['name' => 'User 4', 'email' => 'user4@example.com', 'password' => bcrypt('password'), 'phoneNumber' => '654321789', 'birthDate' => now(), 'authGoogleId' => null, 'role' => 'student', 'roleToken' => null, 'refreshToken' => null]);
    }
}
