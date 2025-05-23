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
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">15/20</h4>
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
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">3</h4>
                            <div>Cần cải thiện</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <h4 class="mb-0">5</h4>
                            <div>Chưa nộp</div>
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
