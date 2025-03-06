<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        Enrollment::create(['userId' => 1, 'courseId' => 1, 'status' => 'active', 'progress' => 0, 'startDate' => now(), 'completionDate' => null, 'lastAccessDate' => now()]);
        Enrollment::create(['userId' => 2, 'courseId' => 1, 'status' => 'active', 'progress' => 20, 'startDate' => now(), 'completionDate' => null, 'lastAccessDate' => now()]);
        Enrollment::create(['userId' => 3, 'courseId' => 2, 'status' => 'completed', 'progress' => 100, 'startDate' => now()->subDays(10), 'completionDate' => now()->subDays(5), 'lastAccessDate' => now()->subDays(5)]);
        Enrollment::create(['userId' => 4, 'courseId' => 2, 'status' => 'active', 'progress' => 50, 'startDate' => now(), 'completionDate' => null, 'lastAccessDate' => now()]);
        Enrollment::create(['userId' => 5, 'courseId' => 3, 'status' => 'active', 'progress' => 10, 'startDate' => now(), 'completionDate' => null, 'lastAccessDate' => now()]);
    }
}
