@php
    $totalSessions = $class->sessions->count();
    $completedSessions = $class->sessions->where('status', 'completed')->count();
    $scheduledSessions = $class->sessions->where('status', 'scheduled')->count();
    $cancelledSessions = $class->sessions->where('status', 'cancelled')->count();
@endphp

<div class="sessions-tab-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Danh sách buổi học</h4>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createSessionModal">
                <i class="fas fa-plus"></i> Thêm buổi học
            </button>
        </div>
    </div>

    <!-- Thống kê buổi học -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Tổng số buổi học: {{ $totalSessions }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Đã hoàn thành: {{ $completedSessions }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Sắp diễn ra: {{ $scheduledSessions }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Đã hủy: {{ $cancelledSessions }}</div>
            </div>
        </div>
    </div>

    <!-- Danh sách buổi học -->
    <div class="table-responsive">
        <table class="table table-bordered" id="sessionsDataTable" width="100%" cellspacing="0">
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
                @php
                    $totalStudents = $class->students->count();
                    $presentStudents = $session->attendances->whereIn('status', ['present', 'late'])->count();
                    $attendanceRate = $totalStudents > 0 ? round(($presentStudents / $totalStudents) * 100) : 0;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $session->session_date->format('d/m/Y') }} ({{ $session->session_date->format('l') }})</td>
                    <td>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</td>
                    <td>{{ $session->topic ?? 'Chưa có chủ đề' }}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $attendanceRate }}%;" 
                                 aria-valuenow="{{ $attendanceRate }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $attendanceRate }}%
                            </div>
                        </div>
                        <small>{{ $presentStudents }}/{{ $totalStudents }} học viên</small>
                    </td>
                    <td>
                        @if(!empty($session->session_materials))
                            @foreach($session->session_materials as $material)
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
                            <a href="{{ route('online.teacher.sessions.attendance', $session->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-clipboard-check"></i> Điểm danh
                            </a>
                            <a href="{{ route('online.teacher.classes.show', ['id' => $class->id, 'session_id' => $session->id]) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Khởi tạo DataTable
        $('#sessionsDataTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
            },
            responsive: true,
            order: [[1, 'desc']] // Sắp xếp theo ngày, mới nhất lên đầu
        });
        
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
@endpush 