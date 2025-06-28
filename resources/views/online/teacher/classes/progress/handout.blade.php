@extends('online.layouts.master')

@section('title', 'Handout Progress')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Handout Progress</h1>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-file-alt me-1"></i>
                Lesson 1: Introduction to English - Handout Materials
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
                                    <div class="small text-muted mb-1">Tổng số học viên</div>
                                    <div class="fw-bold h5 mb-0">20</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-users fa-2x"></i>
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
                                    <div class="small text-muted mb-1">Đã nộp trung bình</div>
                                    <div class="fw-bold h5 mb-0">14/20</div>
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
                                    <div class="small text-muted mb-1">Tỷ lệ đúng TB</div>
                                    <div class="fw-bold h5 mb-0">80.00%</div>
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
                                    <div class="small text-muted mb-1">Thời gian TB</div>
                                    <div class="fw-bold h5 mb-0">20 phút</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exercise Types Summary -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Kết quả theo loại bài tập
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Loại bài tập</th>
                                            <th class="text-center">Số HV hoàn thành</th>
                                            <th class="text-center">Tỷ lệ đúng TB</th>
                                            <th class="text-center">Thời gian TB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bài tập điền từ</td>
                                            <td class="text-center">15/20</td>
                                            <td class="text-center">85%</td>
                                            <td class="text-center">15 phút</td>
                                        </tr>
                                        <tr>
                                            <td>Bài tập ghi âm</td>
                                            <td class="text-center">14/20</td>
                                            <td class="text-center">80%</td>
                                            <td class="text-center">20 phút</td>
                                        </tr>
                                        <tr>
                                            <td>Bài tập trắc nghiệm</td>
                                            <td class="text-center">13/20</td>
                                            <td class="text-center">75%</td>
                                            <td class="text-center">25 phút</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Tài liệu</option>
                        <option value="reading">IELTS Reading Guide</option>
                        <option value="grammar">Grammar Exercises</option>
                        <option value="vocabulary">Vocabulary List</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Trạng thái</option>
                        <option value="viewed">Đã xem</option>
                        <option value="downloaded">Đã tải</option>
                        <option value="not_viewed">Chưa xem</option>
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
                            <th style="width: 150px">Điền từ</th>
                            <th style="width: 150px">Ghi âm</th>
                            <th style="width: 150px">Trắc nghiệm</th>
                            <th style="width: 150px">Tổng điểm</th>
                            <th style="width: 180px">Cập nhật cuối</th>
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
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-success" style="width: 90%">90%</div>
                                    </div>
                                    <span class="badge bg-success">9/10</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-success" style="width: 85%">85%</div>
                                    </div>
                                    <span class="badge bg-success">3/3</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-success" style="width: 80%">80%</div>
                                    </div>
                                    <span class="badge bg-success">8/10</span>
                                </div>
                            </td>
                            <td>
                                <h5 class="mb-0 text-center text-success">85%</h5>
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
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 60%">60%</div>
                                    </div>
                                    <span class="badge bg-warning">6/10</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 50%">50%</div>
                                    </div>
                                    <span class="badge bg-warning">1/3</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 40%">40%</div>
                                    </div>
                                    <span class="badge bg-warning">4/10</span>
                                </div>
                            </td>
                            <td>
                                <h5 class="mb-0 text-center text-warning">50%</h5>
                            </td>
                            <td>15/03/2024 10:15</td>
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
                            <td colspan="4" class="text-center">
                                <span class="badge bg-secondary">Chưa làm bài</span>
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

<!-- Student Progress Detail Modal -->
<div class="modal fade" id="studentProgressModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết tiến độ học viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="student-info mb-4">
                    <div class="d-flex align-items-center">
                        <img src="" alt="Student Avatar" class="rounded-circle me-3" width="60" height="60" id="modalStudentAvatar">
                        <div>
                            <h4 class="mb-1" id="modalStudentName"></h4>
                            <p class="text-muted mb-0" id="modalStudentId"></p>
                        </div>
                    </div>
                </div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#fillInExercises">
                            <i class="fas fa-pen me-2"></i>Bài tập điền từ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#recordingExercises">
                            <i class="fas fa-microphone me-2"></i>Bài tập ghi âm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#multipleChoice">
                            <i class="fas fa-tasks me-2"></i>Bài tập trắc nghiệm
                        </a>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content">
                    <!-- Fill in Exercises Tab -->
                    <div class="tab-pane fade show active" id="fillInExercises">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Câu hỏi</th>
                                        <th width="150">Đáp án</th>
                                        <th width="150">Kết quả</th>
                                        <th width="120">Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Complete the sentence: "I ___ to school every day."</td>
                                        <td>go</td>
                                        <td>
                                            <span class="badge bg-success">Đúng</span>
                                        </td>
                                        <td>30 giây</td>
                                    </tr>
                                    <tr>
                                        <td>Fill in the blank: "She ___ a doctor."</td>
                                        <td>is</td>
                                        <td>
                                            <span class="badge bg-danger">Sai</span>
                                        </td>
                                        <td>45 giây</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recording Exercises Tab -->
                    <div class="tab-pane fade" id="recordingExercises">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Câu hỏi</th>
                                        <th width="150">Ghi âm</th>
                                        <th width="150">Điểm số</th>
                                        <th width="120">Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Read the following sentence: "The quick brown fox jumps over the lazy dog."</td>
                                        <td>
                                            <audio controls class="w-100">
                                                <source src="#" type="audio/mpeg">
                                            </audio>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">85%</span>
                                        </td>
                                        <td>2 phút</td>
                                    </tr>
                                    <tr>
                                        <td>Pronounce the word: "Beautiful"</td>
                                        <td>
                                            <audio controls class="w-100">
                                                <source src="#" type="audio/mpeg">
                                            </audio>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning">75%</span>
                                        </td>
                                        <td>1 phút</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Multiple Choice Tab -->
                    <div class="tab-pane fade" id="multipleChoice">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Câu hỏi</th>
                                        <th width="150">Đáp án đúng</th>
                                        <th width="150">Đáp án chọn</th>
                                        <th width="120">Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>What is the past tense of "go"?</td>
                                        <td>went</td>
                                        <td>
                                            <span class="badge bg-success">went</span>
                                        </td>
                                        <td>20 giây</td>
                                    </tr>
                                    <tr>
                                        <td>Choose the correct article: "___ apple"</td>
                                        <td>an</td>
                                        <td>
                                            <span class="badge bg-danger">a</span>
                                        </td>
                                        <td>15 giây</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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

    // Handle view detail button
    $('.btn-primary[title="Xem chi tiết"]').on('click', function() {
        const row = $(this).closest('tr');
        const studentName = row.find('.fw-bold').text();
        const studentId = row.find('.text-muted').text();
        const studentAvatar = row.find('img').attr('src');

        // Update modal content
        $('#modalStudentName').text(studentName);
        $('#modalStudentId').text(studentId);
        $('#modalStudentAvatar').attr('src', studentAvatar);

        // Show modal
        $('#studentProgressModal').modal('show');
    });

    // Handle tab changes
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        // Add your tab change logic here if needed
    });
});
</script>
@endpush
@endsection
