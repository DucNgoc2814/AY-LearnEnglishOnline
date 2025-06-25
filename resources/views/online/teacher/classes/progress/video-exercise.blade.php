@extends('online.layouts.master')

@section('title', 'Video Exercise Progress')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Video Exercise Progress</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.classes.index') }}">Danh sách lớp</a></li>
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.classes.show', ['id' => 1]) }}">Lớp IELTS 7.0</a></li>
        <li class="breadcrumb-item active">Video Exercise Progress</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-film me-1"></i>
                Lesson 1: Introduction to English - Video Exercise
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm">
                    <i class="fas fa-download me-1"></i>Xuất Excel
                </button>
                <button class="btn btn-success btn-sm">
                    <i class="fas fa-sync-alt me-1"></i>Làm mới
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Progress Summary -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-dark">
                                    <div class="small text-muted mb-1">Tổng số bài tập</div>
                                    <div class="fw-bold h5 mb-0">5</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-tasks fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-dark">
                                    <div class="small text-muted mb-1">Đã nộp</div>
                                    <div class="fw-bold h5 mb-0">3/5</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-dark">
                                    <div class="small text-muted mb-1">Tỷ lệ nộp</div>
                                    <div class="fw-bold h5 mb-0">60.00%</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-dark">
                                    <div class="small text-muted mb-1">Đang diễn ra</div>
                                    <div class="fw-bold h5 mb-0">2</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Trạng thái</option>
                        <option value="completed">Đã hoàn thành</option>
                        <option value="in_progress">Đang làm</option>
                        <option value="not_started">Chưa bắt đầu</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Kết quả</option>
                        <option value="passed">Đạt</option>
                        <option value="failed">Chưa đạt</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm học viên...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Students Progress Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 50px">#</th>
                            <th>Học viên</th>
                            <th>Email</th>
                            <th style="width: 150px">Trạng thái</th>
                            <th style="width: 150px">Kết quả</th>
                            <th style="width: 150px">Tiến độ</th>
                            <th style="width: 180px">Thời gian nộp</th>
                            <th style="width: 100px">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data -->
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <div class="fw-bold">Nguyễn Văn A</div>
                                        <small class="text-muted">ID: 12345</small>
                                    </div>
                                </div>
                            </td>
                            <td>nguyenvana@gmail.com</td>
                            <td>
                                <span class="badge bg-success">Đã hoàn thành</span>
                            </td>
                            <td>
                                <span class="badge bg-success">Đạt (90%)</span>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" style="width: 100%">100%</div>
                                </div>
                            </td>
                            <td>15/03/2024 14:30</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-info" title="Gửi nhắc nhở">
                                        <i class="fas fa-bell"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <div class="fw-bold">Trần Thị B</div>
                                        <small class="text-muted">ID: 12346</small>
                                    </div>
                                </div>
                            </td>
                            <td>tranthib@gmail.com</td>
                            <td>
                                <span class="badge bg-warning">Đang làm</span>
                            </td>
                            <td>
                                <span class="badge bg-warning">Chưa hoàn thành</span>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" style="width: 60%">60%</div>
                                </div>
                            </td>
                            <td>-</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-info" title="Gửi nhắc nhở">
                                        <i class="fas fa-bell"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <div class="fw-bold">Lê Văn C</div>
                                        <small class="text-muted">ID: 12347</small>
                                    </div>
                                </div>
                            </td>
                            <td>levanc@gmail.com</td>
                            <td>
                                <span class="badge bg-danger">Chưa bắt đầu</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">-</span>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width: 0%">0%</div>
                                </div>
                            </td>
                            <td>-</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-info" title="Gửi nhắc nhở">
                                        <i class="fas fa-bell"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Hiển thị 1-3 của 20 học viên
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Trước</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Tiếp</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal Chi tiết tiến độ -->
<div class="modal fade" id="progressDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết tiến độ học viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="student-info mb-4">
                    <div class="d-flex align-items-center">
                        <img src="" class="rounded-circle me-3" width="60" height="60" id="studentAvatar">
                        <div>
                            <h5 class="mb-1" id="studentName"></h5>
                            <p class="mb-0 text-muted" id="studentEmail"></p>
                        </div>
                    </div>
                </div>

                <!-- Tiến độ các loại bài tập -->
                <div class="progress-sections">
                    <!-- Bài tập kéo thả -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Bài tập điền từ kéo thả</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <strong>Số câu đã làm:</strong>
                                        <span id="dragDropProgress">0/0</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <strong>Lần làm gần nhất:</strong>
                                        <span id="dragDropLastAttempt">-</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bài tập điền từ -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Bài tập điền từ vào chỗ trống</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <strong>Số câu đã làm:</strong>
                                        <span id="fillInProgress">0/0</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <strong>Lần làm gần nhất:</strong>
                                        <span id="fillInLastAttempt">-</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bài tập ghi âm -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Bài tập ghi âm</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <strong>Số clip đã ghi:</strong>
                                        <span id="recordingCount">0</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <strong>Lần ghi gần nhất:</strong>
                                        <span id="recordingLastAttempt">-</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Danh sách recordings -->
                            <div class="recording-history">
                                <h6 class="mb-3">Lịch sử ghi âm</h6>
                                <div class="list-group" id="recordingList">
                                    <!-- Recording items will be added here dynamically -->
                                </div>
                            </div>
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

@push('styles')
<style>
.progress {
    height: 20px;
}
.progress-bar {
    line-height: 20px;
    font-size: 0.875rem;
}
.table > :not(caption) > * > * {
    vertical-align: middle;
}

/* Styles cho modal chi tiết */
.student-info {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 1rem;
}

.recording-history {
    max-height: 300px;
    overflow-y: auto;
}

.recording-item {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    margin-bottom: 0.5rem;
    background-color: #f8f9fa;
}

.recording-item:hover {
    background-color: #e9ecef;
}

.recording-item .recording-info {
    flex-grow: 1;
}

.recording-item .recording-actions {
    display: flex;
    gap: 0.5rem;
}

.recording-item audio {
    width: 100%;
    margin-top: 0.5rem;
}

.card-header {
    background-color: #f8f9fa;
}

.progress-sections .card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Handle filters
    $('select, input').on('change keyup', function() {
        // Add your filter logic here
    });

    // Handle refresh button
    $('.btn-success').on('click', function() {
        // Add your refresh logic here
    });

    // Handle export button
    $('.btn-primary').on('click', function() {
        // Add your export logic here
    });

    // Khởi tạo modal
    const progressModal = new bootstrap.Modal(document.getElementById('progressDetailModal'));

    // Xử lý khi click nút xem chi tiết
    $('.btn-primary[title="Xem chi tiết"]').on('click', function() {
        const row = $(this).closest('tr');
        const studentId = row.find('small.text-muted').text().replace('ID: ', '');

        // Cập nhật thông tin học viên trong modal
        $('#studentAvatar').attr('src', row.find('img').attr('src'));
        $('#studentName').text(row.find('.fw-bold').text());
        $('#studentEmail').text(row.find('td:eq(2)').text());

        // Gọi API để lấy dữ liệu chi tiết
        fetchStudentProgress(studentId);

        // Hiển thị modal
        progressModal.show();
    });

    // Hàm lấy dữ liệu chi tiết tiến độ học viên
    function fetchStudentProgress(studentId) {
        // Giả lập dữ liệu API - Thay thế bằng call API thực tế
        const mockData = {
            dragDrop: {
                completed: 15,
                total: 20,
                lastAttempt: '2024-03-15 14:30'
            },
            fillIn: {
                completed: 8,
                total: 10,
                lastAttempt: '2024-03-15 13:45'
            },
            recordings: {
                count: 3,
                lastAttempt: '2024-03-15 14:15',
                items: [
                    {
                        id: 1,
                        timestamp: '2024-03-15 14:15',
                        duration: '00:35',
                        audioUrl: '/path/to/audio1.mp3'
                    },
                    {
                        id: 2,
                        timestamp: '2024-03-15 14:00',
                        duration: '00:42',
                        audioUrl: '/path/to/audio2.mp3'
                    },
                    {
                        id: 3,
                        timestamp: '2024-03-15 13:45',
                        duration: '00:28',
                        audioUrl: '/path/to/audio3.mp3'
                    }
                ]
            }
        };

        // Cập nhật thông tin bài tập kéo thả
        $('#dragDropProgress').text(`${mockData.dragDrop.completed}/${mockData.dragDrop.total}`);
        $('#dragDropLastAttempt').text(mockData.dragDrop.lastAttempt);

        // Cập nhật thông tin bài tập điền từ
        $('#fillInProgress').text(`${mockData.fillIn.completed}/${mockData.fillIn.total}`);
        $('#fillInLastAttempt').text(mockData.fillIn.lastAttempt);

        // Cập nhật thông tin bài tập ghi âm
        $('#recordingCount').text(mockData.recordings.count);
        $('#recordingLastAttempt').text(mockData.recordings.lastAttempt);

        // Cập nhật danh sách recordings
        const recordingList = $('#recordingList');
        recordingList.empty();

        mockData.recordings.items.forEach(recording => {
            const recordingItem = `
                <div class="recording-item">
                    <div class="recording-info">
                        <div class="mb-2">
                            <strong>Thời gian:</strong> ${recording.timestamp}
                            <span class="ms-3"><strong>Độ dài:</strong> ${recording.duration}</span>
                        </div>
                        <audio controls>
                            <source src="${recording.audioUrl}" type="audio/mpeg">
                            Trình duyệt của bạn không hỗ trợ phát audio.
                        </audio>
                    </div>
                </div>
            `;
            recordingList.append(recordingItem);
        });
    }
});
</script>
@endpush
@endsection
