<?php

namespace App\Http\Controllers\Online\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    /**
     * Display the teacher's schedule.
     */
    public function index(Request $request)
    {
        try {
            $teacherId = session('user_id');
            
            if (!$teacherId) {
                return view('online.teacher.schedule', [
                    'sessions' => collect(),
                    'classes' => collect(),
                    'error' => 'Không tìm thấy thông tin giảng viên'
                ]);
            }
            
            // Lấy ngày bắt đầu và kết thúc từ request, mặc định là tuần hiện tại
            $now = Carbon::now();
            $weekStart = $now->copy()->startOfWeek();
            $weekEnd = $now->copy()->endOfWeek();
            
            $startDate = $request->input('start_date') 
                ? Carbon::parse($request->input('start_date')) 
                : $weekStart;
                
            $endDate = $request->input('end_date') 
                ? Carbon::parse($request->input('end_date')) 
                : $weekEnd;
            
            // Đảm bảo khoảng thời gian hợp lệ
            if ($startDate > $endDate) {
                $endDate = $startDate->copy()->addDays(6);
            }
            
            // Lấy các lớp học của giảng viên
            $classes = ClassRoom::where(function($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId)
                      ->orWhere('assistant_id', $teacherId);
            })
            ->get();
            
            Log::info('Teacher ID: ' . $teacherId);
            Log::info('Classes for schedule count: ' . $classes->count());
            
            $classIds = $classes->pluck('id')->toArray();
            
            // Lọc theo lớp cụ thể nếu có
            if ($request->filled('class_id')) {
                $classId = $request->input('class_id');
                if (in_array($classId, $classIds)) {
                    $classIds = [$classId];
                }
            }
            
            // Lấy tất cả các buổi học trong khoảng thời gian
            $sessions = Session::whereIn('class_id', $classIds)
                ->whereBetween('session_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->with(['class', 'attendances'])
                ->orderBy('session_date')
                ->orderBy('start_time')
                ->get();
            
            // Tạo mảng dữ liệu cho lịch biểu
            $calendar = [];
            
            // Tạo khung thời gian với các buổi học trong ngày
            $timeSlots = [
                ['07:30', '09:00'],
                ['09:15', '10:45'],
                ['11:00', '12:30'],
                ['13:30', '15:00'],
                ['15:15', '16:45'],
                ['18:00', '19:30'],
                ['19:45', '21:15']
            ];
            
            // Tạo khung thời gian cho các ngày trong khoảng đã chọn
            $currentDate = $startDate->copy();
            while ($currentDate <= $endDate) {
                $dayOfWeek = $currentDate->dayOfWeek;
                $dateFormatted = $currentDate->format('Y-m-d');
                
                // Các buổi học trong ngày này
                $daySessions = $sessions->filter(function($session) use ($dateFormatted) {
                    return $session->session_date == $dateFormatted;
                });
                
                $calendar[$dateFormatted] = [
                    'date' => $currentDate->format('Y-m-d'),
                    'day_name' => ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'][$dayOfWeek],
                    'sessions' => $daySessions,
                    'time_slots' => $timeSlots
                ];
                
                $currentDate->addDay();
            }
            
            return view('online.teacher.schedule', [
                'calendar' => $calendar,
                'classes' => $classes,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'selectedClassId' => $request->input('class_id')
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị lịch giảng dạy: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return view('online.teacher.schedule', [
                'calendar' => [],
                'classes' => collect(),
                'error' => 'Có lỗi xảy ra khi tải lịch giảng dạy. Vui lòng thử lại sau.'
            ]);
        }
    }
} 