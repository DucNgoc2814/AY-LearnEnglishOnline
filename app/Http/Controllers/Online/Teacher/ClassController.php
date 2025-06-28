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
                Log::error('Teacher ID not found in session');
                return redirect()->route('online.login')
                    ->with('notification', [
                        'message' => 'Vui lòng đăng nhập lại.',
                        'type' => 'error'
                    ]);
            }

            // Kiểm tra xem có tồn tại giáo viên với ID này không
            $teacher = \App\Models\Employee::find($teacherId);
            if (!$teacher) {
                Log::error('Teacher not found with ID: ' . $teacherId);
                return redirect()->route('online.login')
                    ->with('notification', [
                        'message' => 'Không tìm thấy thông tin giảng viên. Vui lòng đăng nhập lại.',
                        'type' => 'error'
                    ]);
            }

            // Kiểm tra role của giảng viên
            if (!in_array($teacher->role, ['teacher', 'teaching_assistant'])) {
                Log::error('Invalid teacher role: ' . $teacher->role);
                return redirect()->route('online.login')
                    ->with('notification', [
                        'message' => 'Bạn không có quyền truy cập trang này.',
                        'type' => 'error'
                    ]);
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
            \Illuminate\Support\Facades\Log::info('Accessing class details', [
                'class_id' => $id,
                'user_id' => session('user_id'),
                'route' => request()->route()->getName(),
                'url' => request()->url()
            ]);

            $class = Classes::with([
                'teacher',
                'students',
                'sessions' => function ($query) {
                    $query->orderBy('session_date', 'asc');
                },
                'sessions.attendances'
            ])->findOrFail($id);

            // Set active tab
            $activeTab = request()->get('tab', 'overview');

            return view('online.teacher.classes.show', [
                'class' => $class,
                'activeTab' => $activeTab,
                'selectedSession' => null
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error showing class details', [
                'error' => $e->getMessage(),
                'class_id' => $id
            ]);

            return redirect()->route('online.teacher.classes.index')
                ->with('error', 'Không thể tải thông tin lớp học. ' . $e->getMessage());
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
                'session_id' => 'nullable|exists:class_sessions,id',
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
            $material->resourceable_type = Classes::class;
            $material->resourceable_id = $class->id;
            $material->title = $request->material_name;
            $material->description = $request->material_description;
            $material->file_path = $filePath;
            $material->type = 'material';
            $material->is_active = true;
            $material->is_public = true;
            $material->file_type = $fileExtension;
            $material->file_size = $fileSize;
            $material->created_by = session('user_id');

            // Lưu session_id nếu có
            if ($request->filled('session_id')) {
                $material->session_id = $request->session_id;
            }

            // Hiện thị debug để kiểm tra
            Log::debug('Resource data before save', [
                'resourceable_type' => $material->resourceable_type,
                'resourceable_id' => $material->resourceable_id,
                'title' => $material->title,
                'file_path' => $material->file_path,
                'file_size' => $material->file_size,
                'file_type' => $material->file_type,
                'session_id' => $material->session_id ?? null
            ]);

            // Lưu resource
            $material->save();

            // Log thông tin resource sau khi lưu
            Log::debug('Resource after save', [
                'id' => $material->id,
                'resourceable_type' => $material->resourceable_type,
                'resourceable_id' => $material->resourceable_id,
                'session_id' => $material->session_id ?? null
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

    /**
     * Show video exercise progress for a class
     */
    public function videoExerciseProgress($id)
    {
        return view('online.teacher.classes.progress.video-exercise');
    }

    /**
     * Show vocabulary progress for a class
     */
    public function vocabularyProgress($id)
    {
        return view('online.teacher.classes.progress.vocabulary');
    }

    /**
     * Show handout progress for a class
     */
    public function handoutProgress($id)
    {
        return view('online.teacher.classes.progress.handout');
    }

    /**
     * Show shadowing progress for a class
     */
    public function shadowingProgress($id)
    {
        return view('online.teacher.classes.progress.shadowing');
    }

    /**
     * Show reflection progress for a class
     */
    public function reflectionProgress($id)
    {
        $class = Classes::findOrFail($id);
        return view('online.teacher.classes.progress.reflection', compact('class'));
    }

    public function reflectionDetail($id, $student_id)
    {
        $class = Classes::findOrFail($id);
        $student = $class->students()->findOrFail($student_id);
        return view('online.teacher.classes.progress.reflection-detail', compact('class', 'student'));
    }

    public function saveReflection(Request $request, $id, $student_id)
    {
        $class = Classes::findOrFail($id);
        $student = $class->students()->findOrFail($student_id);

        // Validate request
        $request->validate([
            'answer1' => 'required|string',
            'answer2' => 'required|string',
            'answer3' => 'required|string',
            'reflection1' => 'required|string',
            'reflection2' => 'required|string',
            'reflection3' => 'required|string',
            'reflection4' => 'required|string',
            'reflection5' => 'required|string',
            'evaluation' => 'required|string|in:excellent,good,average,needsImprovement',
            'teacherFeedback' => 'required|string'
        ]);

        // Save reflection data
        $reflection = $student->reflections()->where('class_id', $id)->first();
        if (!$reflection) {
            $reflection = $student->reflections()->create([
                'class_id' => $id
            ]);
        }

        $reflection->update([
            'answers' => [
                'sentence_structures' => [
                    $request->answer1,
                    $request->answer2,
                    $request->answer3
                ],
                'reflections' => [
                    $request->reflection1,
                    $request->reflection2,
                    $request->reflection3,
                    $request->reflection4,
                    $request->reflection5
                ]
            ],
            'evaluation' => $request->evaluation,
            'teacher_feedback' => $request->teacherFeedback,
            'last_edited_by' => auth()->id(),
            'last_edited_at' => now()
        ]);

        return response()->json([
            'message' => 'Reflection saved successfully',
            'data' => $reflection
        ]);
    }
}
