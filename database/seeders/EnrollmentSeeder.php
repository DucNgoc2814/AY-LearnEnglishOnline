<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        Enrollment::create([
            'userId' => 1,
            'courseId' => 1,
            'status' => 'in-progress',
            'progress' => 0,
        ]);
    }
}
