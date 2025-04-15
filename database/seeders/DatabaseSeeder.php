<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // 1. Core System Data
            OrderStatusSeeder::class,     // Trạng thái đơn hàng cơ bản
            
            // 2. User Management - Users phải được tạo trước vì các bảng khác reference
            UserSeeder::class,            // Base users table
            StudentSeeder::class,         // Students (references users)
            EmployeeSeeder::class,        // Employees (references users)
            
            // 3. Course Management - Categories trước, sau đó đến courses
            CategorySeeder::class,        // Course categories
            CourseSeeder::class,          // Courses (references categories)
            
            // 4. Class Management - Theo thứ tự: lớp học -> lịch học -> buổi học
            ClassSeeder::class,           // Classes (references courses, employees as teachers)
            ClassScheduleSeeder::class,   // Class schedules (references classes)
            ClassSessionSeeder::class,    // Class sessions (generated from schedules)
            
            // 5. Learning Resources - Tests và câu hỏi
            ResourceSeeder::class,        // Learning materials
            TestSeeder::class,           // Tests for courses
            QuestionSeeder::class,       // Questions (references tests)
            AnswerSeeder::class,         // Answers (references questions)
            
            // 6. Student Activities - Các hoạt động của học viên
            EnrollmentSeeder::class,     // Class enrollments (references students, classes)
            AttendanceSeeder::class,     // Session attendance (references sessions, students)
            
            // 7. E-commerce - Đơn hàng và thanh toán
            VoucherSeeder::class,        // Vouchers/Coupons
            OrderSeeder::class,          // Orders (references users, vouchers)
            
            // 8. Achievements - Chứng chỉ và đánh giá
            CertificateSeeder::class,    // Certificates (references students, courses)
            RatingSeeder::class,         // Course ratings (references users, courses)
            CommentSeeder::class,        // User comments
            
            // 9. Content Management - Nội dung website
            BlogSeeder::class,           // Blog posts
            BannerSeeder::class,         // Website banners
            
            // 10. Online Learning - Phòng học trực tuyến và tương tác
            OnlineRoomSeeder::class,     // Virtual classrooms
            LearningLogSeeder::class,    // Student learning logs
            LessonAndTestSeeder::class,  // Online lessons and tests
            SessionInteractionSeeder::class, // Session interactions (references sessions)
        ]);
    }
}