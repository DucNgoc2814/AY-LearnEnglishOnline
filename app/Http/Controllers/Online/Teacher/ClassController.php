<?php

namespace App\Http\Controllers\Online\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Attendance;
use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Resource;
use App\Models\ClassSession;

class ClassController extends Controller
{
    /**
     * Display a listing of classes for the teacher.
     */
    public function index()
    {
        try {
            // Lấy ID giảng viên từ session
            $teacherId = session('user_id');
            if (!$teacherId) {
                return view('online.teacher.classes.index', [
                    'currentClasses' => collect(),
                    'upcomingClasses' => collect(),
                    'completedClasses' => collect(),
                    'error' => 'Không tìm thấy thông tin giảng viên. Vui lòng đăng nhập lại.'
                ]);
            }
            
            // Kiểm tra xem có tồn tại giáo viên với ID này không
            $teacher = \App\Models\Employee::find($teacherId);
            if (!$teacher) {
                Log::warning('Teacher not found with ID: ' . $teacherId);
            } else {
                Log::info('Teacher found: ' . $teacher->name);
            }
            
            $classes = Classes::where('teacher_id', $teacherId)
                ->with([
                    'students',
                    'sessions' => function($query) {
                        $query->orderBy('session_date', 'asc');
                    },
                    'sessions.attendances'
                ])
                ->get();
            
            // In ra log để kiểm tra dữ liệu
            Log::info('Teacher ID: ' . $teacherId);
            Log::info('Classes count: ' . $classes->count());
            
            // Tính toán thống kê cho mỗi lớp học
            foreach ($classes as $class) {
                $totalStudents = $class->students->count();
                $totalSessions = $class->sessions->count();
                $totalAttendances = $class->sessions->pluck('attendances')->flatten()->count();
                
                // Tính tỷ lệ điểm danh
                $attendanceRate = 0;
                if ($totalStudents > 0 && $totalSessions > 0) {
                    $expectedAttendances = $totalStudents * $totalSessions;
                    $attendanceRate = $expectedAttendances > 0 
                        ? round(($totalAttendances / $expectedAttendances) * 100) 
                        : 0;
                }
                
                $class->stats = [
                    'total_students' => $totalStudents,
                    'total_sessions' => $totalSessions,
                    'total_attendances' => $totalAttendances,
                    'attendance_rate' => $attendanceRate
                ];
                
                // Format lịch học
                $schedules = $class->schedule ?? [];
                $scheduleDays = [];
                
                if (is_string($schedules)) {
                    $schedules = json_decode($schedules, true) ?? [];
                }
                
                foreach ((array)$schedules as $day => $times) {
                    $dayIndex = (int)$day % 7;
                    $dayName = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'][$dayIndex];
                    $scheduleDays[] = $dayName;
                }
                
                $class->formatted_schedule = !empty($scheduleDays) 
                    ? implode(', ', $scheduleDays) 
                    : 'Chưa có lịch cụ thể';
            }
            
            // Phân loại lớp học CHỈ dựa trên status
            $currentClasses = $classes->filter(function($class) {
                return $class->status === 'active';
            });
            
            $upcomingClasses = $classes->filter(function($class) {
                return $class->status === 'pending';
            });
            
            $completedClasses = $classes->filter(function($class) {
                return $class->status === 'completed';
            });
            
            // Log để kiểm tra
            Log::info('Classes by status - Active: ' . $currentClasses->count() . 
                     ', Pending: ' . $upcomingClasses->count() . 
                     ', Completed: ' . $completedClasses->count());
            
            return view('online.teacher.classes.index', [
                'currentClasses' => $currentClasses,
                'upcomingClasses' => $upcomingClasses,
                'completedClasses' => $completedClasses
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị lớp học giảng viên: ' . $e->getMessage());
            
            if (config('app.debug')) {
                return view('online.teacher.classes.index', [
                    'currentClasses' => collect(),
                    'upcomingClasses' => collect(),
                    'completedClasses' => collect(),
                    'error' => 'Lỗi: ' . $e->getMessage()
                ]);
            }
            
            return view('online.teacher.classes.index', [
                'currentClasses' => collect(),
                'upcomingClasses' => collect(),
                'completedClasses' => collect(),
                'error' => 'Có lỗi xảy ra khi tải lớp học. Vui lòng thử lại sau.'
            ]);
        }
    }

    /**
     * Display the specified class.
     */
    public function show($id)
    {
        try {
            // Check if we're using a test route
            $routeName = request()->route()->getName();
            $isTestRoute = in_array($routeName, ['test.class.details', 'direct.class', 'super.test']);
            
            if ($isTestRoute) {
                \Illuminate\Support\Facades\Log::info('TEST ROUTE ACCESSED', [
                    'route_name' => $routeName,
                    'class_id' => $id
                ]);
            }
            
            // Get user ID from session only if not a test route
            $user_id = $isTestRoute ? null : session('user_id');
            
            if (!$isTestRoute && !$user_id) {
                return redirect()->route('login')->with('error', 'Please login to view class details.');
            }
            
            // Build the query
            $query = Classes::with([
                'teacher',
                'students',
                'sessions' => function ($query) {
                    $query->orderBy('session_date', 'asc');
                },
                'sessions.attendances'
            ]);
            
            // Only filter by teacher_id if this is not a test route
            if (!$isTestRoute && $user_id) {
                $query->where('teacher_id', $user_id);
            }
            
            // Get the class
            $class = $query->findOrFail($id);

            // For test routes, automatically set the session with the teacher's info
            if ($isTestRoute && $class->teacher_id) {
                session(['user_id' => $class->teacher_id]);
                
                // Log this action
                \Illuminate\Support\Facades\Log::info('TEST ROUTE: Set user_id to teacher_id', [
                    'teacher_id' => $class->teacher_id,
                    'route_name' => $routeName
                ]);
            }
            
            // Get students for the class
            $students = $class->students()->with('grades')->get()->map(function($student) {
                return [
                    'id' => $student->id,
                    'student_id' => $student->student_code,
                    'name' => $student->full_name,
                    'grades' => $student->grades->pluck('grade', 'grade_item_id')->toArray()
                ];
            });
            
            // Calculate stats for the class
            if (!isset($class->stats)) {
                $totalStudents = $students->count();
                $totalSessions = $class->sessions->count();
                $totalAttendances = $class->sessions->pluck('attendances')->flatten()->count();
                
                // Calculate attendance rate
                $attendanceRate = 0;
                if ($totalStudents > 0 && $totalSessions > 0) {
                    $expectedAttendances = $totalStudents * $totalSessions;
                    $attendanceRate = $expectedAttendances > 0 
                        ? round(($totalAttendances / $expectedAttendances) * 100) 
                        : 0;
                }
                
                $class->stats = [
                    'total_students' => $totalStudents,
                    'total_sessions' => $totalSessions,
                    'total_attendances' => $totalAttendances,
                    'attendance_rate' => $attendanceRate
                ];
            }
            
            // Get selected session if session_id is provided
            $selectedSession = null;
            $activeTab = 'overview';
            if ($sessionId = request('session_id')) {
                $selectedSession = $class->sessions->firstWhere('id', $sessionId);
                if ($selectedSession) {
                    $activeTab = 'sessions';
                    
                    // Calculate session attendance stats
                    $sessionStats = [
                        'total_students' => $class->students->count(),
                        'present_students' => $selectedSession->attendances->where('status', 'present')->count(),
                        'absent_students' => $selectedSession->attendances->where('status', 'absent')->count(),
                    ];
                    $sessionStats['attendance_rate'] = $sessionStats['total_students'] > 0 
                        ? round(($sessionStats['present_students'] / $sessionStats['total_students']) * 100) 
                        : 0;
                    
                    $selectedSession->stats = $sessionStats;
                }
            }
            
            // Get attendance matrix for this class
            $attendanceMatrix = $this->getAttendanceMatrix($class);
            
            // Get session statistics
            $sessionStats = $this->getSessionStats($class);

            // Lấy tài liệu từ bảng resources (có quan hệ polymorphic với class)
            $resources = Resource::where('resourceable_type', 'App\Models\Classes')
                ->where('resourceable_id', $class->id)
                ->where('type', 'text')
                ->orderBy('created_at', 'desc')
                ->get();
                
            // Debug để xem có lấy được resource không
            Log::debug('Resources found', [
                'count' => $resources->count(),
                'resources' => $resources->pluck('id', 'title')->toArray()
            ]);
            
            // Chuẩn bị dữ liệu tài liệu cho view
            $materials = $resources->map(function($resource) {
                return [
                    'id' => $resource->id,
                    'name' => $resource->title,
                    'description' => $resource->description,
                    'url' => Storage::url($resource->file_path),
                    'session_id' => $resource->session_id ?? null,
                    'session_date' => $resource->session_id ? ClassSession::find($resource->session_id)->session_date->format('d/m/Y') : 'N/A',
                    'uploaded_at' => $resource->created_at->format('d/m/Y H:i'),
                    'file_size' => $resource->getFormattedFileSize(), 
                    'file_type' => $resource->file_type,
                    'icon_class' => $resource->getIconClass()
                ];
            });
            
            Log::debug('Materials prepared for view', [
                'count' => $materials->count(),
                'first_item' => $materials->first()
            ]);

            return view('online.teacher.classes.show', [
                'class' => $class,
                'students' => $students,
                'routeName' => $routeName,
                'isTestRoute' => $isTestRoute,
                'attendanceMatrix' => $attendanceMatrix,
                'sessionStats' => $sessionStats,
                'selectedSession' => $selectedSession,
                'activeTab' => $activeTab,
                'materials' => $materials
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error showing class: ' . $e->getMessage());
            
            // Redirect back with error message
            return redirect()->route('online.teacher.classes.index')
                ->with('error', 'Class not found or you do not have permission to view it.');
        }
    }

    /**
     * Show attendance for a class.
     */
    public function attendance($id)
    {
        try {
            $teacherId = session('user_id');
            
            // Lấy thông tin lớp học
            $class = Classes::where('id', $id)
                ->where(function($query) use ($teacherId) {
                    $query->where('teacher_id', $teacherId)
                        ->orWhere('assistant_id', $teacherId);
                })
                ->with(['students', 'sessions' => function($query) {
                    $query->orderBy('session_date', 'desc');
                }])
                ->firstOrFail();
            
            // Lấy buổi học hôm nay hoặc buổi gần nhất
            $today = Carbon::today()->format('Y-m-d');
            $todaySession = $class->sessions->firstWhere('session_date', $today);
            
            // Nếu không có buổi học hôm nay, chọn buổi học gần nhất
            if (!$todaySession) {
                $upcomingSessions = $class->sessions->filter(function($session) use ($today) {
                    return $session->session_date >= $today;
                })->sortBy('session_date');
                
                $todaySession = $upcomingSessions->first() ?? $class->sessions->sortByDesc('session_date')->first();
            }
            
            // Lấy danh sách học sinh với thông tin điểm danh cho buổi học này
            $students = $class->students;
            foreach ($students as $student) {
                if ($todaySession) {
                    $attendance = Attendance::where('student_id', $student->id)
                        ->where('session_id', $todaySession->id)
                        ->first();
                    
                    $student->attendance = $attendance;
                }
            }
            
            return view('online.teacher.classes.attendance', [
                'class' => $class,
                'students' => $students,
                'session' => $todaySession,
                'sessions' => $class->sessions
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị điểm danh: ' . $e->getMessage());
            return redirect()->route('online.teacher.classes.index')
                ->with('notification', [
                    'type' => 'error',
                    'message' => 'Không thể hiển thị điểm danh. Vui lòng thử lại sau.'
                ]);
        }
    }

    /**
     * Generate attendance matrix for a class
     *
     * @param Classes $class
     * @return array
     */
    private function getAttendanceMatrix(Classes $class)
    {
        $attendanceMatrix = [];
        $totalSessions = $class->sessions->count();
        
        foreach ($class->students as $student) {
            $presentSessions = 0;
            $sessionData = [];
            
            foreach ($class->sessions as $session) {
                $attendance = $session->attendances->where('student_id', $student->id)->first();
                if ($attendance) {
                    $sessionData[$session->id] = [
                        'status' => $attendance->status,
                        'notes' => $attendance->notes
                    ];
                    
                    if (in_array($attendance->status, ['present', 'late'])) {
                        $presentSessions++;
                    }
                }
            }
            
            $attendanceRate = $totalSessions > 0 ? round(($presentSessions / $totalSessions) * 100) : 0;
            
            $attendanceMatrix[$student->id] = [
                'student_name' => $student->full_name,
                'student_code' => $student->student_code,
                'present_sessions' => $presentSessions,
                'total_sessions' => $totalSessions,
                'attendance_rate' => $attendanceRate,
                'sessions' => $sessionData
            ];
        }
        
        return $attendanceMatrix;
    }
    
    /**
     * Generate session statistics for a class
     *
     * @param Classes $class
     * @return array
     */
    private function getSessionStats(Classes $class)
    {
        $sessionStats = [];
        foreach ($class->sessions as $session) {
            // Convert date to friendly format
            $sessionDate = $session->session_date;
            $dayNames = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
            $dayOfWeek = $dayNames[$sessionDate->dayOfWeek];
            
            // Calculate attendance rate for this session
            $totalStudents = $class->students->count();
            $presentStudents = $session->attendances->whereIn('status', ['present', 'late'])->count();
            $attendanceRate = $totalStudents > 0 ? round(($presentStudents / $totalStudents) * 100) : 0;
            
            // Get session materials
            $materials = [];
            if (!empty($session->session_materials)) {
                $materials = is_array($session->session_materials) 
                    ? $session->session_materials 
                    : json_decode($session->session_materials, true);
            }
            
            $sessionStats[$session->id] = [
                'date' => $sessionDate->format('d/m/Y'),
                'day_of_week' => $dayOfWeek,
                'time' => ($session->start_time ? $session->start_time->format('H:i') : '00:00') . ' - ' . 
                          ($session->end_time ? $session->end_time->format('H:i') : '00:00'),
                'topic' => $session->topic,
                'content' => $session->content,
                'status' => $session->status,
                'attendance_rate' => $attendanceRate,
                'total_students' => $totalStudents,
                'present_students' => $presentStudents,
                'materials' => $materials
            ];
        }
        
        return $sessionStats;
    }

    /**
     * Upload material for a class
     */
    public function uploadMaterial(Request $request, $id)
    {
        try {
            $request->validate([
                'material_name' => 'required|string|max:255',
                'material_file' => 'required|file|max:10240', // Max 10MB
                'material_description' => 'nullable|string',
            ]);

            $class = Classes::findOrFail($id);
            
            // Kiểm tra quyền
            if ($class->teacher_id != session('user_id')) {
                return back()->with('error', 'Bạn không có quyền tải lên tài liệu cho lớp học này.');
            }

            // Lưu file
            $file = $request->file('material_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('class_materials/' . $id, $fileName, 'public');

            // Lấy thông tin file
            $fileSize = $file->getSize();
            $fileType = $file->getClientMimeType();
            $fileExtension = $file->getClientOriginalExtension();

            // Lưu resource vào bảng resources
            $material = new Resource();
            $material->resourceable_type = 'App\\Models\\Classes'; 
            $material->resourceable_id = $class->id;
            $material->title = $request->material_name;
            $material->description = $request->material_description;
            $material->file_path = $filePath;
            $material->type = 'text';
            $material->is_active = true;
            $material->file_type = $fileExtension;
            $material->file_size = $fileSize;
            $material->created_by = session('user_id');
            $material->order = 0;
            
            // Hiện thị debug để kiểm tra
            Log::debug('Resource data before save', [
                'resourceable_type' => $material->resourceable_type,
                'resourceable_id' => $material->resourceable_id,
                'title' => $material->title,
                'file_path' => $material->file_path,
                'file_size' => $material->file_size,
                'file_type' => $material->file_type
            ]);
            
            // Lưu resource
            $material->save();
            
            // Log thông tin resource sau khi lưu
            Log::debug('Resource after save', [
                'id' => $material->id,
                'resourceable_type' => $material->resourceable_type,
                'resourceable_id' => $material->resourceable_id,
            ]);

            return back()->with('success', 'Tài liệu đã được tải lên thành công.');
        } catch (\Exception $e) {
            Log::error('Error uploading material: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return back()->with('error', 'Có lỗi xảy ra khi tải lên tài liệu. Vui lòng thử lại.');
        }
    }

    /**
     * Delete a material
     */
    public function deleteMaterial($id)
    {
        try {
            $material = Resource::findOrFail($id);
            
            // Kiểm tra quyền
            $class = $material->resourceable;
            if (!$class || $class->teacher_id != session('user_id')) {
                return back()->with('error', 'Bạn không có quyền xóa tài liệu này.');
            }

            // Xóa file
            if (Storage::disk('public')->exists($material->file_path)) {
                Storage::disk('public')->delete($material->file_path);
            }

            // Xóa record trong database
            $material->delete();

            return back()->with('success', 'Tài liệu đã được xóa thành công.');
        } catch (\Exception $e) {
            Log::error('Error deleting material: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi xóa tài liệu. Vui lòng thử lại.');
        }
    }
} 