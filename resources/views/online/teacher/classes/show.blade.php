@extends('online.layouts.master')

@section('title', 'Chi tiết lớp học - ' . $class->name)

@push('styles')
<style>
    .stats-card {
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        transition: transform 0.2s;
    }
    
    .stats-card:hover {
        transform: translateY(-3px);
    }
    
    .tab-content {
        padding: 1rem;
    }
    
    .progress {
        height: 20px;
    }
    
    .progress-bar {
        line-height: 20px;
        font-size: 0.875rem;
    }
    
    .student-attendance {
        width: 100px;
    }
    
    .debug-box {
        background: #ffffd0;
        border: 1px dashed #ccc;
        padding: 10px;
        margin-bottom: 15px;
        font-family: monospace;
        font-size: 12px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <!-- Debug Info (only visible in debug mode) -->
    @if(session('debug_class_show') || session('debug_info') || request()->has('debug'))
    <div class="debug-box">
        <h6>Debug Info:</h6>
        <ul>
            <li>Route: {{ request()->route()->getName() }}</li>
            <li>Controller: {{ request()->route()->getActionName() }}</li>
            <li>URL: {{ request()->url() }}</li>
            <li>Class ID: {{ $class->id ?? 'Not found' }}</li>
            <li>Teacher ID: {{ $class->teacher_id ?? 'N/A' }}</li>
            <li>Session User ID: {{ session('user_id') ?? 'Not set' }}</li>
            <li>Debug Mode: {{ session('debug_class_show') ? 'Yes' : 'No' }}</li>
            <li>Time: {{ now() }}</li>
        </ul>
        @if(session('debug_class_show'))
        <pre>{{ json_encode(session('debug_class_show'), JSON_PRETTY_PRINT) }}</pre>
        @endif
    </div>
    @endif

    <h1 class="mt-4">{{ $class->name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.classes.index') }}">Danh sách lớp</a></li>
        <li class="breadcrumb-item active">{{ $class->name }}</li>
    </ol>

    <!-- Thông tin cơ bản về lớp học -->
    <div class="row mb-4">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Thông tin lớp học
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">{{ $class->name }}</h5>
                        <span class="badge {{ $class->status == 'active' ? 'bg-success' : ($class->status == 'pending' ? 'bg-warning' : 'bg-secondary') }}">
                            {{ $class->status == 'active' ? 'Đang hoạt động' : ($class->status == 'pending' ? 'Sắp khai giảng' : 'Đã kết thúc') }}
                        </span>
                    </div>
                    <p><strong>Mã lớp:</strong> {{ $class->code }}</p>
                    <p><strong>Khóa học:</strong> {{ $class->course->name ?? 'N/A' }}</p>
                    <p><strong>Thời gian:</strong> {{ $class->start_date->format('d/m/Y') }} - {{ $class->end_date->format('d/m/Y') }}</p>
                    <p><strong>Lịch học:</strong> {{ $class->formatted_schedule ?? 'Chưa có lịch cụ thể' }}</p>
                    <p><strong>Số học viên:</strong> {{ $class->students->count() }}/{{ $class->max_students }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Thống kê
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body py-3">
                                    <h5 class="mb-0">{{ $class->stats['total_students'] ?? 0 }}</h5>
                                    <div>Học viên</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body py-3">
                                    <h5 class="mb-0">{{ $class->stats['total_sessions'] ?? 0 }}</h5>
                                    <div>Buổi học</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body py-3">
                                    <h5 class="mb-0">{{ $class->stats['attendance_rate'] ?? 0 }}%</h5>
                                    <div>Tỷ lệ điểm danh</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body py-3">
                                    <h5 class="mb-0">{{ $class->stats['attendance_rate'] ?? 0 }}%</h5>
                                    <div>Hoàn thành</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tỷ lệ hoàn thành:</span>
                            <span>{{ $class->stats['attendance_rate'] ?? 0 }}%</span>
                        </div>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: {{ $class->stats['attendance_rate'] ?? 0 }}%" 
                                aria-valuenow="{{ $class->stats['attendance_rate'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tỷ lệ điểm danh:</span>
                            <span>{{ $class->stats['attendance_rate'] ?? 0 }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $class->stats['attendance_rate'] ?? 0 }}%" 
                                aria-valuenow="{{ $class->stats['attendance_rate'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="card mb-4">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="classTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab == 'overview' ? 'active' : '' }}" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="{{ $activeTab == 'overview' }}">
                        <i class="fas fa-home me-1"></i> Tổng quan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab == 'attendance' ? 'active' : '' }}" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab" aria-controls="attendance" aria-selected="{{ $activeTab == 'attendance' }}">
                        <i class="fas fa-clipboard-check me-1"></i> Điểm danh
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab == 'sessions' ? 'active' : '' }}" id="sessions-tab" data-bs-toggle="tab" data-bs-target="#sessions" type="button" role="tab" aria-controls="sessions" aria-selected="{{ $activeTab == 'sessions' }}">
                        <i class="fas fa-calendar-alt me-1"></i> Buổi học
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab == 'materials' ? 'active' : '' }}" id="materials-tab" data-bs-toggle="tab" data-bs-target="#materials" type="button" role="tab" aria-controls="materials" aria-selected="{{ $activeTab == 'materials' }}">
                        <i class="fas fa-book me-1"></i> Tài liệu
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab == 'grades' ? 'active' : '' }}" id="grades-tab" data-bs-toggle="tab" data-bs-target="#grades" type="button" role="tab" aria-controls="grades" aria-selected="{{ $activeTab == 'grades' }}">
                        <i class="fas fa-graduation-cap me-1"></i> Đầu điểm
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="classTabContent">
                <!-- Tab Tổng quan -->
                <div class="tab-pane fade {{ $activeTab == 'overview' ? 'show active' : '' }}" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h4 class="mb-3">Danh sách học viên</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="studentsTable">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã HV</th>
                                            <th>Họ tên</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Ngày đăng ký</th>
                                            <th>Tỷ lệ tham gia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($class->students as $index => $student)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $student->code }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->pivot->enrollment_date ? date('d/m/Y', strtotime($student->pivot->enrollment_date)) : 'N/A' }}</td>
                                            <td>
                                                @php
                                                    $attendanceCount = 0;
                                                    $totalSessions = $class->sessions->count();
                                                    if ($totalSessions > 0) {
                                                        foreach ($class->sessions as $session) {
                                                            $attendance = $session->attendances->where('student_id', $student->id)->first();
                                                            if ($attendance && in_array($attendance->status, ['present', 'late'])) {
                                                                $attendanceCount++;
                                                            }
                                                        }
                                                        $attendanceRate = ($attendanceCount / $totalSessions) * 100;
                                                    } else {
                                                        $attendanceRate = 0;
                                                    }
                                                @endphp
                                                <div class="progress">
                                                    <div class="progress-bar {{ $attendanceRate < 80 ? 'bg-warning' : 'bg-success' }}" role="progressbar" 
                                                        style="width: {{ $attendanceRate }}%" 
                                                        aria-valuenow="{{ $attendanceRate }}" aria-valuemin="0" aria-valuemax="100">
                                                        {{ round($attendanceRate) }}%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4 class="mb-3">Buổi học gần đây</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ngày</th>
                                            <th>Thời gian</th>
                                            <th>Chủ đề</th>
                                            <th>Trạng thái</th>
                                            <th>Tỷ lệ điểm danh</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($class->sessions->take(5) as $session)
                                        <tr>
                                            <td>{{ $session->session_date->format('d/m/Y') }}</td>
                                            <td>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</td>
                                            <td>{{ $session->topic ?: 'Chưa có chủ đề' }}</td>
                                            <td>
                                                @if($session->status == 'completed')
                                                    <span class="badge bg-success">Đã kết thúc</span>
                                                @elseif($session->status == 'in_progress')
                                                    <span class="badge bg-primary">Đang diễn ra</span>
                                                @elseif($session->status == 'cancelled')
                                                    <span class="badge bg-danger">Đã hủy</span>
                                                @else
                                                    <span class="badge bg-warning">Sắp diễn ra</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    // Tính toán tỷ lệ điểm danh trực tiếp
                                                    $presentCount = $session->attendances->whereIn('status', ['present', 'late'])->count();
                                                    $totalStudents = $class->students->count();
                                                    $attendanceRate = $totalStudents > 0 ? round(($presentCount / $totalStudents) * 100) : 0;
                                                @endphp
                                                <div class="progress">
                                                    <div class="progress-bar {{ $attendanceRate < 80 ? 'bg-warning' : 'bg-success' }}" role="progressbar" 
                                                        style="width: {{ $attendanceRate }}%" 
                                                        aria-valuenow="{{ $attendanceRate }}" aria-valuemin="0" aria-valuemax="100">
                                                        {{ $attendanceRate }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $routeExists = false;
                                                    try {
                                                        route('online.teacher.sessions.show', $session->id);
                                                        $routeExists = true;
                                                    } catch (\Exception $e) {
                                                        $routeExists = false;
                                                    }
                                                @endphp
                                                
                                                @if ($routeExists)
                                                <a href="{{ route('online.teacher.sessions.show', $session->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i> Chi tiết
                                                </a>
                                                @else
                                                <button class="btn btn-sm btn-primary" onclick="alert('Tính năng đang phát triển')">
                                                    <i class="fas fa-eye"></i> Chi tiết
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Chưa có buổi học nào</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tab Điểm danh -->
                <div class="tab-pane fade {{ $activeTab == 'attendance' ? 'show active' : '' }}" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                    @include('online.teacher.classes.partials.attendance_tab', ['class' => $class])
                </div>
                
                <!-- Tab Buổi học -->
                <div class="tab-pane fade {{ $activeTab == 'sessions' ? 'show active' : '' }}" id="sessions" role="tabpanel" aria-labelledby="sessions-tab">
                    @if($selectedSession)
                        <div class="mb-4">
                            <h4>Chi tiết buổi học</h4>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Thông tin buổi học</h5>
                                            <table class="table">
                                                <tr>
                                                    <th>Ngày học:</th>
                                                    <td>{{ $selectedSession->session_date->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Thời gian:</th>
                                                    <td>{{ $selectedSession->start_time->format('H:i') }} - {{ $selectedSession->end_time->format('H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Chủ đề:</th>
                                                    <td>{{ $selectedSession->topic ?? 'Chưa có chủ đề' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Trạng thái:</th>
                                                    <td>
                                                        @if($selectedSession->status == 'completed')
                                                            <span class="badge bg-success">Đã hoàn thành</span>
                                                        @elseif($selectedSession->status == 'scheduled')
                                                            <span class="badge bg-warning">Đã lên lịch</span>
                                                        @elseif($selectedSession->status == 'in_progress')
                                                            <span class="badge bg-primary">Đang diễn ra</span>
                                                        @else
                                                            <span class="badge bg-secondary">{{ $selectedSession->status }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Thống kê điểm danh</h5>
                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <div class="card bg-primary text-white">
                                                        <div class="card-body">
                                                            <h6 class="card-title">Tổng số học viên</h6>
                                                            <h2 class="mb-0">{{ $selectedSession->stats['total_students'] }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <div class="card bg-success text-white">
                                                        <div class="card-body">
                                                            <h6 class="card-title">Có mặt</h6>
                                                            <h2 class="mb-0">{{ $selectedSession->stats['present_students'] }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <div class="card bg-danger text-white">
                                                        <div class="card-body">
                                                            <h6 class="card-title">Vắng mặt</h6>
                                                            <h2 class="mb-0">{{ $selectedSession->stats['absent_students'] }}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-3">
                                                    <div class="card bg-info text-white">
                                                        <div class="card-body">
                                                            <h6 class="card-title">Tỷ lệ điểm danh</h6>
                                                            <h2 class="mb-0">{{ $selectedSession->stats['attendance_rate'] }}%</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @include('online.teacher.classes.partials.sessions_tab')
                </div>
                
                <!-- Tab Tài liệu -->
                <div class="tab-pane fade {{ $activeTab == 'materials' ? 'show active' : '' }}" id="materials" role="tabpanel" aria-labelledby="materials-tab">
                    @include('online.teacher.classes.partials.materials_tab', ['class' => $class])
                </div>
                
                <!-- Tab Đầu điểm -->
                <div class="tab-pane fade {{ $activeTab == 'grades' ? 'show active' : '' }}" id="grades" role="tabpanel" aria-labelledby="grades-tab">
                    @include('online.teacher.classes.partials.grades_tab', ['class' => $class])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        // Kích hoạt DataTables cho bảng học viên
        $('#studentsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json'
            },
            responsive: true,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tất cả"]],
            pageLength: 10
        });
        
        // Xử lý chuyển tab
        $('#classTab button').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
@endpush 