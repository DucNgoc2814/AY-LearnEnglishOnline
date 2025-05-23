@extends('online.layouts.master')

@section('title', 'Shadowing Progress')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Shadowing Progress</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.classes.index') }}">Danh sách lớp</a></li>
        <li class="breadcrumb-item"><a href="{{ route('online.teacher.classes.show', ['id' => 1]) }}">Lớp IELTS 7.0</a></li>
        <li class="breadcrumb-item active">Shadowing Progress</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-microphone me-1"></i>
                Lesson 1: Introduction to English - Shadowing Practice
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
                            <h4 class="mb-0">16/20</h4>
                            <div>Học viên đã nộp</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">12</h4>
                            <div>Đạt yêu cầu</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">80%</h4>
                            <div>Độ chính xác TB</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">4</h4>
                            <div>Chưa nộp</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audio Passages Summary -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-list me-1"></i>
                            Danh sách đoạn hội thoại
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tên đoạn hội thoại</th>
                                            <th class="text-center">Số HV hoàn thành</th>
                                            <th class="text-center">Độ chính xác TB</th>
                                            <th class="text-center">Thời gian TB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Daily Conversation 1</td>
                                            <td class="text-center">16/20</td>
                                            <td class="text-center">85%</td>
                                            <td class="text-center">5 phút</td>
                                        </tr>
                                        <tr>
                                            <td>Business Meeting</td>
                                            <td class="text-center">14/20</td>
                                            <td class="text-center">75%</td>
                                            <td class="text-center">8 phút</td>
                                        </tr>
                                        <tr>
                                            <td>Travel Dialogue</td>
                                            <td class="text-center">15/20</td>
                                            <td class="text-center">80%</td>
                                            <td class="text-center">6 phút</td>
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
                        <option value="">Đoạn hội thoại</option>
                        <option value="conversation">Daily Conversation 1</option>
                        <option value="meeting">Business Meeting</option>
                        <option value="travel">Travel Dialogue</option>
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
                            <th style="width: 150px">Daily Conversation</th>
                            <th style="width: 150px">Business Meeting</th>
                            <th style="width: 150px">Travel Dialogue</th>
                            <th style="width: 150px">Độ chính xác TB</th>
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
                                    <a href="#" class="text-muted" title="Nghe bản ghi">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-success" style="width: 85%">85%</div>
                                    </div>
                                    <a href="#" class="text-muted" title="Nghe bản ghi">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-success" style="width: 88%">88%</div>
                                    </div>
                                    <a href="#" class="text-muted" title="Nghe bản ghi">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <h5 class="mb-0 text-center text-success">88%</h5>
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
                                        <div class="progress-bar bg-warning" style="width: 65%">65%</div>
                                    </div>
                                    <a href="#" class="text-muted" title="Nghe bản ghi">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 60%">60%</div>
                                    </div>
                                    <a href="#" class="text-muted" title="Nghe bản ghi">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 70%">70%</div>
                                    </div>
                                    <a href="#" class="text-muted" title="Nghe bản ghi">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <h5 class="mb-0 text-center text-warning">65%</h5>
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
