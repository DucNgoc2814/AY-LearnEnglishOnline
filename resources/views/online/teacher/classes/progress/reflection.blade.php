@extends('online.layouts.master')

@section('title', 'Reflection Progress')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Reflection Progress</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.classes.index') }}">Danh sách lớp</a></li>
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.classes.show', ['id' => 1]) }}">Lớp IELTS 7.0</a></li>
        <li class="breadcrumb-item active">Reflection Progress</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-comments me-1"></i>
                Lesson 1: Introduction to English - Reflection Exercises
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
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">17/20</h4>
                            <div>Học viên đã nộp</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">14</h4>
                            <div>Đạt yêu cầu</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">85%</h4>
                            <div>Chất lượng TB</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">3</h4>
                            <div>Chưa nộp</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Topics Summary -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-list me-1"></i>
                            Danh sách chủ đề reflection
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Chủ đề</th>
                                            <th class="text-center">Số HV hoàn thành</th>
                                            <th class="text-center">Số từ TB</th>
                                            <th class="text-center">Thời gian TB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Learning Goals & Expectations</td>
                                            <td class="text-center">17/20</td>
                                            <td class="text-center">250 từ</td>
                                            <td class="text-center">30 phút</td>
                                        </tr>
                                        <tr>
                                            <td>Study Habits & Challenges</td>
                                            <td class="text-center">15/20</td>
                                            <td class="text-center">300 từ</td>
                                            <td class="text-center">35 phút</td>
                                        </tr>
                                        <tr>
                                            <td>Progress & Improvements</td>
                                            <td class="text-center">16/20</td>
                                            <td class="text-center">280 từ</td>
                                            <td class="text-center">32 phút</td>
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
                        <option value="">Chủ đề</option>
                        <option value="goals">Learning Goals & Expectations</option>
                        <option value="habits">Study Habits & Challenges</option>
                        <option value="progress">Progress & Improvements</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Trạng thái</option>
                        <option value="completed">Đã hoàn thành</option>
                        <option value="in_progress">Đang làm</option>
                        <option value="not_started">Chưa bắt đầu</option>
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
                            <th style="width: 150px">Learning Goals</th>
                            <th style="width: 150px">Study Habits</th>
                            <th style="width: 150px">Progress Review</th>
                            <th style="width: 150px">Đánh giá</th>
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
                                    <div class="me-2">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </div>
                                    <div>
                                        <small class="d-block">300 từ</small>
                                        <a href="#" class="text-muted" title="Xem bài viết">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </div>
                                    <div>
                                        <small class="d-block">280 từ</small>
                                        <a href="#" class="text-muted" title="Xem bài viết">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <i class="fas fa-check-circle text-success"></i>
                                    </div>
                                    <div>
                                        <small class="d-block">320 từ</small>
                                        <a href="#" class="text-muted" title="Xem bài viết">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="badge bg-success">Xuất sắc</span>
                                    <small class="d-block text-muted mt-1">Đã phản hồi</small>
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
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <i class="fas fa-check-circle text-warning"></i>
                                    </div>
                                    <div>
                                        <small class="d-block">200 từ</small>
                                        <a href="#" class="text-muted" title="Xem bài viết">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <i class="fas fa-check-circle text-warning"></i>
                                    </div>
                                    <div>
                                        <small class="d-block">180 từ</small>
                                        <a href="#" class="text-muted" title="Xem bài viết">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <i class="fas fa-clock text-warning"></i>
                                    </div>
                                    <div>
                                        <small class="d-block">Đang làm</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="badge bg-warning">Cần cải thiện</span>
                                    <small class="d-block text-muted mt-1">Đã phản hồi</small>
                                </div>
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
                                <span class="badge bg-secondary">Chưa nộp bài</span>
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
});
</script>
@endpush
@endsection
