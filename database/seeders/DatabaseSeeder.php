<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\LessonSeeder;
use Database\Seeders\LessonTestSeeder;
use Database\Seeders\FinalExamSeeder;
use Database\Seeders\ExamResultSeeder;
use Database\Seeders\CertificateSeeder;
use Database\Seeders\EnrollmentSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\RatingSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\VoucherSeeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\ResetPasswordSeeder;
use Database\Seeders\ProgressSeeder;
use Database\Seeders\VideoRecordSeeder;
use Database\Seeders\ZoomSessionSeeder;
use Database\Seeders\QuestionLessonTestSeeder;
use Database\Seeders\AnswerLessonTestSeeder;
use Database\Seeders\QuestionFinalExamSeeder;
use Database\Seeders\AnswerFinalExamSeeder;
use Database\Seeders\BannerSeeder;
use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\VideoLessonSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OrderStatusSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            LessonTestSeeder::class,
            FinalExamSeeder::class,
            ExamResultSeeder::class,
            CertificateSeeder::class,
            EnrollmentSeeder::class,
            OrderSeeder::class,
            RatingSeeder::class,
            CommentSeeder::class,
            VoucherSeeder::class,
            BlogSeeder::class,
            ProgressSeeder::class,
            ZoomSessionSeeder::class,
            VideoRecordSeeder::class,
            QuestionLessonTestSeeder::class,
            AnswerLessonTestSeeder::class,
            QuestionFinalExamSeeder::class,
            AnswerFinalExamSeeder::class,
            BannerSeeder::class,
            VideoLessonSeeder::class,
        ]);
    }
}
