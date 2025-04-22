@extends('layouts.teacher')

@section('title', 'Quản lý buổi học - ' . $class->name)

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Quản lý buổi học - {{ $class->name }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.classes.index') }}">Lớp học</a></li>
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.classes.show', $class->id) }}">{{ $class->name }}</a></li>
        <li class="breadcrumb-item active">Quản lý buổi học</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                Thông tin lớp học
            </div>
            <div>
                <a href="{{ route('online.teacher.classes.attendance', $class->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-clipboard-check"></i> Điểm danh ngày hôm nay
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Mã lớp:</strong> {{ $class->code }}</p>
                    <p><strong>Khóa học:</strong> {{ $class->course->name ?? 'N/A' }}</p>
                    <p><strong>Trạng thái:</strong> 
                        @if($class->status == 'active')
                            <span class="badge bg-success">Đang hoạt động</span>
                        @elseif($class->status == 'pending')
                            <span class="badge bg-warning">Sắp khai giảng</span>
                        @elseif($class->status == 'completed')
                            <span class="badge bg-secondary">Đã kết thúc</span>
                        @else
                            <span class="badge bg-dark">{{ $class->status }}</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Giảng viên:</strong> {{ $class->teacher->name ?? 'N/A' }}</p>
                    <p><strong>Thời gian:</strong> {{ $class->start_date->format('d/m/Y') }} - {{ $class->end_date->format('d/m/Y') }}</p>
                    <p><strong>Số học viên:</strong> {{ $class->students->count() }}/{{ $class->max_students }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Thống kê tổng quan về các buổi học -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-pie me-1"></i>
            Thống kê buổi học
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Tổng số buổi học: {{ count($sessionStats) }}</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Đã hoàn thành: {{ $class->sessions->where('status', 'completed')->count() }}</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Sắp diễn ra: {{ $class->sessions->where('status', 'scheduled')->count() }}</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Đã hủy: {{ $class->sessions->where('status', 'cancelled')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách buổi học -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-calendar me-1"></i>
            Danh sách buổi học
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="sessionsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày</th>
                            <th>Thời gian</th>
                            <th>Chủ đề</th>
                            <th>Tỷ lệ điểm danh</th>
                            <th>Tài liệu</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($class->sessions as $index => $session)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sessionStats[$session->id]['date'] ?? '' }} ({{ $sessionStats[$session->id]['day_of_week'] ?? '' }})</td>
                            <td>{{ $sessionStats[$session->id]['time'] ?? '' }}</td>
                            <td>{{ $sessionStats[$session->id]['topic'] ?? 'Chưa có chủ đề' }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $sessionStats[$session->id]['attendance_rate'] ?? 0 }}%;" 
                                         aria-valuenow="{{ $sessionStats[$session->id]['attendance_rate'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $sessionStats[$session->id]['attendance_rate'] ?? 0 }}%
                                    </div>
                                </div>
                                <small>{{ $sessionStats[$session->id]['present_students'] ?? 0 }}/{{ $sessionStats[$session->id]['total_students'] ?? 0 }} học viên</small>
                            </td>
                            <td>
                                @if(!empty($sessionStats[$session->id]['materials']))
                                    @foreach($sessionStats[$session->id]['materials'] as $material)
                                        <div><a href="{{ $material['url'] ?? '#' }}" target="_blank">{{ $material['name'] ?? 'Tài liệu' }}</a></div>
                                    @endforeach
                                @else
                                    <span class="text-muted">Chưa có tài liệu</span>
                                @endif
                                <button type="button" class="btn btn-sm btn-outline-primary mt-1" data-bs-toggle="modal" data-bs-target="#addMaterialModal" data-session-id="{{ $session->id }}">
                                    <i class="fas fa-plus"></i> Thêm
                                </button>
                            </td>
                            <td>
                                @if($session->status == 'completed')
                                    <span class="badge bg-success">Đã hoàn thành</span>
                                @elseif($session->status == 'scheduled')
                                    <span class="badge bg-warning">Đã lên lịch</span>
                                @elseif($session->status == 'in_progress')
                                    <span class="badge bg-primary">Đang diễn ra</span>
                                @elseif($session->status == 'cancelled')
                                    <span class="badge bg-danger">Đã hủy</span>
                                @else
                                    <span class="badge bg-secondary">{{ $session->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('online.teacher.attendance.session', $session->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-clipboard-check"></i> Điểm danh
                                    </a>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#sessionDetailModal" data-session-id="{{ $session->id }}">
                                        <i class="fas fa-eye"></i> Chi tiết
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSessionModal" data-session-id="{{ $session->id }}">
                                        <i class="fas fa-edit"></i> Sửa
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bảng điểm danh học viên -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-check me-1"></i>
            Bảng điểm danh học viên
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="attendanceMatrix" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã HV</th>
                            <th>Họ tên</th>
                            <th>Tỷ lệ tham gia</th>
                            @foreach($class->sessions as $session)
                                <th data-toggle="tooltip" title="{{ $session->session_date->format('d/m/Y') }}">
                                    {{ $session->session_date->format('d/m') }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendanceMatrix as $studentId => $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data['student_code'] }}</td>
                            <td>{{ $data['student_name'] }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar {{ $data['attendance_rate'] < 80 ? 'bg-warning' : 'bg-success' }}" 
                                         role="progressbar" style="width: {{ $data['attendance_rate'] }}%;" 
                                         aria-valuenow="{{ $data['attendance_rate'] }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $data['attendance_rate'] }}%
                                    </div>
                                </div>
                                <small>{{ $data['present_sessions'] }}/{{ $data['total_sessions'] }} buổi</small>
                            </td>
                            @foreach($class->sessions as $session)
                                <td class="{{ isset($data['sessions'][$session->id]) ? ($data['sessions'][$session->id]['status'] == 'present' ? 'table-success' : ($data['sessions'][$session->id]['status'] == 'late' ? 'table-warning' : ($data['sessions'][$session->id]['status'] == 'absent' ? 'table-danger' : 'table-secondary'))) : 'table-secondary' }}">
                                    @if(isset($data['sessions'][$session->id]))
                                        @if($data['sessions'][$session->id]['status'] == 'present')
                                            <i class="fas fa-check text-success" data-toggle="tooltip" title="Có mặt"></i>
                                        @elseif($data['sessions'][$session->id]['status'] == 'late')
                                            <i class="fas fa-clock text-warning" data-toggle="tooltip" title="Đi muộn"></i>
                                        @elseif($data['sessions'][$session->id]['status'] == 'absent')
                                            <i class="fas fa-times text-danger" data-toggle="tooltip" title="Vắng mặt"></i>
                                        @elseif($data['sessions'][$session->id]['status'] == 'excused')
                                            <i class="fas fa-exclamation-triangle text-info" data-toggle="tooltip" title="Có phép"></i>
                                        @else
                                            <i class="fas fa-question text-secondary" data-toggle="tooltip" title="Không xác định"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-question text-secondary" data-toggle="tooltip" title="Không xác định"></i>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal thêm tài liệu -->
<div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="addMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('online.teacher.sessions.add-material') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="session_id" id="materialSessionId">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="addMaterialModalLabel">Thêm tài liệu buổi học</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="material_name" class="form-label">Tên tài liệu</label>
                        <input type="text" class="form-control" id="material_name" name="material_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="material_file" class="form-label">File tài liệu</label>
                        <input type="file" class="form-control" id="material_file" name="material_file" required>
                    </div>
                    <div class="mb-3">
                        <label for="material_description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="material_description" name="material_description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu tài liệu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal chi tiết buổi học -->
<div class="modal fade" id="sessionDetailModal" tabindex="-1" aria-labelledby="sessionDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionDetailModalLabel">Chi tiết buổi học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="sessionDetailContent">
                    <!-- Nội dung chi tiết buổi học sẽ được load bằng AJAX -->
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal sửa buổi học -->
<div class="modal fade" id="editSessionModal" tabindex="-1" aria-labelledby="editSessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editSessionForm" action="{{ route('online.teacher.sessions.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="session_id" id="editSessionId">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="editSessionModalLabel">Sửa thông tin buổi học</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_topic" class="form-label">Chủ đề buổi học</label>
                        <input type="text" class="form-control" id="edit_topic" name="topic">
                    </div>
                    <div class="mb-3">
                        <label for="edit_content" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="edit_content" name="content" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="edit_status" name="status">
                            <option value="scheduled">Đã lên lịch</option>
                            <option value="in_progress">Đang diễn ra</option>
                            <option value="completed">Đã hoàn thành</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_notes" class="form-label">Ghi chú</label>
                        <textarea class="form-control" id="edit_notes" name="notes" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Initialize DataTables
    $(document).ready(function() {
        $('#sessionsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
            },
            responsive: true
        });
        
        $('#attendanceMatrix').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
            },
            scrollX: true,
            fixedColumns: {
                leftColumns: 3
            }
        });
        
        // Enable tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Set session ID for add material modal
        $('#addMaterialModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var sessionId = button.data('session-id');
            $('#materialSessionId').val(sessionId);
        });
        
        // Load session details for modal
        $('#sessionDetailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var sessionId = button.data('session-id');
            
            // Load session details via AJAX
            $.ajax({
                url: '{{ route("online.teacher.sessions.detail") }}',
                method: 'GET',
                data: {
                    session_id: sessionId
                },
                success: function(response) {
                    $('#sessionDetailContent').html(response);
                },
                error: function() {
                    $('#sessionDetailContent').html('<div class="alert alert-danger">Không thể tải thông tin buổi học. Vui lòng thử lại sau.</div>');
                }
            });
        });
        
        // Load session data for edit modal
        $('#editSessionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var sessionId = button.data('session-id');
            $('#editSessionId').val(sessionId);
            
            // Load session data via AJAX
            $.ajax({
                url: '{{ route("online.teacher.sessions.get") }}',
                method: 'GET',
                data: {
                    session_id: sessionId
                },
                dataType: 'json',
                success: function(response) {
                    $('#edit_topic').val(response.topic);
                    $('#edit_content').val(response.content);
                    $('#edit_status').val(response.status);
                    $('#edit_notes').val(response.notes);
                },
                error: function() {
                    alert('Không thể tải thông tin buổi học. Vui lòng thử lại sau.');
                }
            });
        });
    });
</script>
@endsection 