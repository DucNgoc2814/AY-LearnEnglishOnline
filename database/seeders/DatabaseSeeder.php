<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            EmployeeSeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
            ClassSeeder::class,
            ResourceSeeder::class,
            ClassScheduleSeeder::class,
            ClassSessionSeeder::class,
            TestSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            EnrollmentSeeder::class,
            CertificateSeeder::class,
            OrderStatusSeeder::class,
            OrderSeeder::class,
            VoucherSeeder::class,
            RatingSeeder::class,
            CommentSeeder::class,
            BlogSeeder::class,
            BannerSeeder::class,
            AttendanceSeeder::class,
            OnlineRoomSeeder::class,
            SessionInteractionSeeder::class,
            LearningLogSeeder::class
        ]);
    }
}