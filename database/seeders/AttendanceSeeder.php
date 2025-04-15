<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\ClassSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    // Định nghĩa các trạng thái điểm danh có thể có
    protected $statuses = ['present', 'absent', 'late', 'excused'];
    
    // Tỉ lệ phần trăm cho mỗi trạng thái (tổng = 100)
    protected $statusDistribution = [
        'present' => 70,  // 70% học sinh có mặt
        'absent' => 10,   // 10% học sinh vắng
        'late' => 15,     // 15% học sinh đi trễ
        'excused' => 5    // 5% học sinh vắng có phép
    ];

    public function run()
    {
        // Tắt foreign key checks tạm thời
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Xóa dữ liệu cũ
        DB::table('attendances')->truncate();
        
        try {
            // Lấy tất cả các buổi học
            $sessions = ClassSession::with(['class.students'])->get();
            
            $totalAttendances = 0;
            $attendanceBatch = [];
            
            foreach ($sessions as $session) {
                // Nếu buổi học không có lớp hoặc lớp không có học sinh, bỏ qua
                if (!$session->class || $session->class->students->isEmpty()) {
                    continue;
                }
                
                // Xử lý điểm danh cho mỗi học sinh trong lớp
                foreach ($session->class->students as $student) {
                    // Chỉ tạo điểm danh cho các buổi học đã diễn ra (status = 'completed')
                    // hoặc là buổi học hiện tại (ngày hôm nay)
                    if ($session->status == 'completed' || Carbon::parse($session->session_date)->isToday()) {
                        // Xác định trạng thái điểm danh dựa trên phân phối xác suất
                        $status = $this->getRandomStatus();
                        
                        // Thời gian check-in (nếu có mặt hoặc đi trễ)
                        $checkInTime = null;
                        if (in_array($status, ['present', 'late'])) {
                            // Thời gian bắt đầu buổi học
                            $sessionStartTime = Carbon::parse($session->session_date . ' ' . $session->start_time);
                            
                            if ($status == 'present') {
                                // Học sinh đến sớm hoặc đúng giờ (0-5 phút trước giờ học)
                                $checkInTime = $sessionStartTime->copy()->subMinutes(rand(0, 5));
                            } else { // late
                                // Học sinh đến trễ (1-15 phút sau giờ học)
                                $checkInTime = $sessionStartTime->copy()->addMinutes(rand(1, 15));
                            }
                        }
                        
                        // Ghi chú điểm danh
                        $notes = $this->getNotes($status);
                        
                        // Thêm vào batch để insert hàng loạt
                        $attendanceBatch[] = [
                            'session_id' => $session->id,
                            'student_id' => $student->id,
                            'status' => $status,
                            'check_in_time' => $checkInTime,
                            'notes' => $notes,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                        
                        $totalAttendances++;
                        
                        // Insert theo batch để tránh quá tải bộ nhớ
                        if (count($attendanceBatch) >= 100) {
                            DB::table('attendances')->insert($attendanceBatch);
                            $attendanceBatch = [];
                        }
                    }
                }
            }
            
            // Insert batch còn lại
            if (!empty($attendanceBatch)) {
                DB::table('attendances')->insert($attendanceBatch);
            }
            
            Log::info("AttendanceSeeder: Successfully created $totalAttendances attendance records");
            
        } catch (\Exception $e) {
            Log::error('AttendanceSeeder: Error occurred', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
        
        // Bật lại foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    
    /**
     * Lấy trạng thái điểm danh ngẫu nhiên dựa trên phân phối xác suất
     */
    private function getRandomStatus()
    {
        $rand = rand(1, 100);
        $cumulative = 0;
        
        foreach ($this->statusDistribution as $status => $probability) {
            $cumulative += $probability;
            if ($rand <= $cumulative) {
                return $status;
            }
        }
        
        // Mặc định trả về 'present' nếu có lỗi
        return 'present';
    }
    
    /**
     * Tạo ghi chú ngẫu nhiên cho điểm danh
     */
    private function getNotes($status)
    {
        $notes = [
            'present' => [
                'Tham gia đầy đủ buổi học',
                'Tích cực phát biểu trong lớp',
                'Hoàn thành tốt bài tập trong lớp',
                null, // Có thể không có ghi chú
                null
            ],
            'absent' => [
                'Không tham dự, không thông báo lý do',
                'Không tham dự',
                'Không liên lạc được',
                null
            ],
            'late' => [
                'Đến muộn do kẹt xe',
                'Đến muộn, đã thông báo trước',
                'Đến muộn nhưng tham gia đầy đủ phần còn lại',
                null
            ],
            'excused' => [
                'Nghỉ ốm, có giấy xác nhận',
                'Nghỉ có phép, phụ huynh đã thông báo',
                'Nghỉ do việc gia đình',
                'Nghỉ do có công việc đột xuất'
            ]
        ];
        
        // Lấy ngẫu nhiên một ghi chú từ mảng tương ứng với trạng thái
        $statusNotes = $notes[$status] ?? [null];
        return $statusNotes[array_rand($statusNotes)];
    }
}