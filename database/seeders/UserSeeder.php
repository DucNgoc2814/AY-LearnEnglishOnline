<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456789',
                'birth_date' => '1990-01-01',
                'role' => 'admin',
            ],
            [
                'name' => 'Teacher User',
                'email' => 'teacher@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456788',
                'birth_date' => '1992-02-02',
                'role' => 'user',
            ],
            [
                'name' => 'Student One',
                'email' => 'student1@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456787',
                'birth_date' => '2000-03-03',
                'role' => 'user',
            ],
            [
                'name' => 'Student Two',
                'email' => 'student2@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456786',
                'birth_date' => '2001-04-04',
                'role' => 'user',
            ],
            [
                'name' => 'Student Three',
                'email' => 'student3@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456785',
                'birth_date' => '1999-05-05',
                'role' => 'user',
            ],
            [
                'name' => 'Student Four',
                'email' => 'student4@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456784',
                'birth_date' => '1998-06-06',
                'role' => 'user',
            ],
            [
                'name' => 'Student Five',
                'email' => 'student5@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456783',
                'birth_date' => '1997-07-07',
                'role' => 'user',
            ],
            [
                'name' => 'Student Six',
                'email' => 'student6@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456782',
                'birth_date' => '1996-08-08',
                'role' => 'user',
            ],
            [
                'name' => 'Student Seven',
                'email' => 'student7@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456781',
                'birth_date' => '1995-09-09',
                'role' => 'user',
            ],
            [
                'name' => 'Student Eight',
                'email' => 'student8@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '0123456780',
                'birth_date' => '1994-10-10',
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}