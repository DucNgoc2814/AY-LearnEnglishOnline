<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use App\Models\ClassSchedule;
use App\Models\ClassSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ClassScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tắt foreign key checks tạm thời
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu cũ
        DB::table('class_schedules')->truncate();
        DB::table('class_sessions')->truncate();
        if (Schema::hasTable('course_registrations')) {
            DB::table('course_registrations')->truncate();
        }

        // Lấy tất cả các lớp học
        $classes = Classes::all();

        foreach ($classes as $class) {
            $this->createSchedulesForClass($class);
        }

        // Tạo đăng ký khóa học sau khi đã tạo lịch học
        $this->createCourseRegistrations();

        // Bật lại foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Tạo lịch học cho một lớp
     */
    private function createSchedulesForClass($class)
    {
        try {
            // Tạo 1-2 lịch học cho mỗi lớp
            $scheduleCount = rand(1, 2);

            // Lấy ngày bắt đầu và kết thúc từ lớp học
            $startDate = Carbon::parse($class->start_date);
            $endDate = Carbon::parse($class->end_date);

            // Nếu không có ngày bắt đầu/kết thúc, tạo giá trị mặc định
            if (!$startDate->isValid()) {
                $startDate = Carbon::now()->subDays(rand(0, 30));
            }

            if (!$endDate->isValid() || $endDate->lessThan($startDate)) {
                $endDate = (clone $startDate)->addMonths(3);
            }

            // Tạo các lịch học
            for ($i = 0; $i < $scheduleCount; $i++) {
                // Chọn thứ trong tuần (1-7)
                $dayOfWeek = rand(1, 7);

                // Giờ bắt đầu (giữa 8h-19h)
                $startHour = rand(8, 19);
                $startMinute = [0, 30][rand(0, 1)]; // 0 hoặc 30 phút
                $startTime = sprintf('%02d:%02d:00', $startHour, $startMinute);

                // Giờ kết thúc (1.5 giờ sau khi bắt đầu)
                $endHour = $startHour + 1;
                $endMinute = $startMinute + 30;
                if ($endMinute >= 60) {
                    $endHour++;
                    $endMinute -= 60;
                }
                $endTime = sprintf('%02d:%02d:00', $endHour, $endMinute);

                // Xác định loại lớp học
                $isOnline = rand(0, 1) === 1;
                $roomOrLink = '';

                if ($isOnline) {
                    // Link Zoom cho lớp học online
                    $roomOrLink = 'https://zoom.us/j/' . rand(1000000000, 9999999999) . '?pwd=' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 6);
                } else {
                    // Phòng học cho lớp offline
                    $roomOrLink = 'P' . rand(101, 999);
                }

                // Tạo lịch học
                $schedule = ClassSchedule::create([
                    'class_id' => $class->id,
                    'day_of_week' => $dayOfWeek,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'room_number' => $isOnline ? null : $roomOrLink,
                    'meeting_url' => $isOnline ? $roomOrLink : null,
                    'is_repeating' => true,
                    'is_active' => true,
                    'is_online' => $isOnline,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'notes' => 'Lịch học tự động tạo bởi ClassScheduleSeeder'
                ]);

                // Tạo các buổi học từ lịch học
                $this->createSessionsFromSchedule($schedule);

                Log::info("Đã tạo lịch học cho lớp {$class->name} vào thứ $dayOfWeek, {$startTime}-{$endTime}");
            }
        } catch (\Exception $e) {
            Log::error("Lỗi khi tạo lịch học cho lớp {$class->name}: {$e->getMessage()}");
        }
    }

    /**
     * Tạo các buổi học từ lịch học
     */
    private function createSessionsFromSchedule($schedule)
    {
        try {
            $startDate = Carbon::parse($schedule->start_date);
            $endDate = Carbon::parse($schedule->end_date);
            $dayOfWeek = $schedule->day_of_week;

            // Điều chỉnh ngày bắt đầu để bắt đầu vào đúng thứ
            while ($startDate->dayOfWeekIso != $dayOfWeek) {
                $startDate->addDay();
            }

            // Tạo các buổi học hàng tuần
            $currentDate = clone $startDate;
            $sessionNumber = 1;

            while ($currentDate->lte($endDate)) {
                // Xác định trạng thái buổi học
                $status = 'scheduled';
                if ($currentDate->lt(Carbon::today())) {
                    $status = rand(1, 10) > 2 ? 'completed' : 'cancelled';
                } elseif ($currentDate->isToday()) {
                    $status = rand(1, 10) > 5 ? 'scheduled' : 'completed';
                }

                // Tạo nội dung buổi học
                $topics = [
                    'Giới thiệu môn học',
                    'Ngữ pháp cơ bản',
                    'Kỹ năng đọc hiểu',
                    'Kỹ năng nghe',
                    'Thực hành nói',
                    'Luyện tập viết',
                    'Ôn tập và bài kiểm tra',
                    'Thảo luận nhóm',
                    'Thuyết trình',
                    'Bài tập thực hành'
                ];

                $topic = $topics[$sessionNumber % count($topics)];
                $content = "Buổi học số $sessionNumber: $topic";

                // Tạo buổi học
                ClassSession::create([
                    'schedule_id' => $schedule->id,
                    'resource_id' => null,
                    'session_date' => $currentDate->format('Y-m-d'),
                    'start_time' => $schedule->start_time,
                    'end_time' => $schedule->end_time,
                    'topic' => $topic,
                    'content' => $content,
                    'session_materials' => null,
                    'recording_url' => $schedule->is_online ? 'https://zoom.us/rec/' . uniqid() : null,
                    'notes' => "Buổi học số $sessionNumber: $topic - " . ($schedule->is_online ? 'Học trực tuyến' : 'Học tại phòng ' . $schedule->room_number),
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Thêm 1 tuần
                $currentDate->addWeek();
                $sessionNumber++;
            }

            Log::info("Đã tạo {$sessionNumber} buổi học cho lịch học ID: {$schedule->id}");
        } catch (\Exception $e) {
            Log::error("Lỗi khi tạo buổi học từ lịch học {$schedule->id}: {$e->getMessage()}");
        }
    }

    /**
     * Tạo đăng ký khóa học cho học viên
     */
    private function createCourseRegistrations()
    {
        try {
            // Lấy tất cả học viên
            $students = DB::table('students')->get();
            if ($students->isEmpty()) {
                Log::warning("Không có học viên nào trong hệ thống!");
                return;
            }

            // Lấy tất cả lớp học
            $classes = Classes::all();
            if ($classes->isEmpty()) {
                Log::warning("Không có lớp học nào trong hệ thống!");
                return;
            }

            // Mỗi học viên đăng ký 1-3 lớp học
            foreach ($students as $student) {
                // Chọn ngẫu nhiên số lượng lớp học để đăng ký
                $classesToRegister = $classes->random(rand(1, min(3, $classes->count())));

                foreach ($classesToRegister as $class) {
                    // Kiểm tra xem đã đăng ký chưa
                    $exists = DB::table('course_registrations')
                        ->where('student_id', $student->id)
                        ->where('class_id', $class->id)
                        ->exists();

                    if (!$exists) {
                        // Tạo ngày đăng ký (1-30 ngày trước)
                        $enrollmentDate = Carbon::now()->subDays(rand(1, 30));

                        // Hầu hết các đăng ký đều là active để dễ kiểm tra
                        $status = 'active';
                        if (rand(1, 10) > 8) { // 20% trường hợp là completed
                            $status = 'completed';
                        }

                        // Tạo bản ghi đăng ký
                        DB::table('course_registrations')->insert([
                            'student_id' => $student->id,
                            'class_id' => $class->id,
                            'status' => $status,
                            'fee_amount' => rand(500000, 5000000),
                            'payment_status' => rand(1, 10) > 2 ? 'paid' : 'pending',
                            'payment_method' => ['cash', 'bank_transfer', 'credit_card'][rand(0, 2)],
                            'payment_date' => rand(1, 10) > 2 ? $enrollmentDate : null,
                            'invoice_number' => 'INV-' . strtoupper(substr(md5(rand()), 0, 8)),
                            'enrollment_date' => $enrollmentDate,
                            'completion_date' => $status == 'completed' ? Carbon::now()->subDays(rand(1, 5)) : null,
                            'notes' => 'Đăng ký tự động tạo bởi ClassScheduleSeeder',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        Log::info("Đã đăng ký học viên ID {$student->id} vào lớp {$class->name}");
                    }
                }
            }

            Log::info("Đã hoàn thành việc tạo đăng ký khóa học");
        } catch (\Exception $e) {
            Log::error("Lỗi khi tạo đăng ký khóa học: {$e->getMessage()}");
        }
    }
}
