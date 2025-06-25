@extends('online.layouts.master')

@section('title', 'Reflection Progress')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Reflection Progress</h1>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Tổng số học viên</div>
                            <div class="fs-4">30</div>
                        </div>
                        <i class="fas fa-users fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Đã hoàn thành</div>
                            <div class="fs-4">25</div>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Đang làm</div>
                            <div class="fs-4">3</div>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">Chưa làm</div>
                            <div class="fs-4">2</div>
                        </div>
                        <i class="fas fa-times-circle fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Progress Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tiến độ học viên
        </div>
        <div class="card-body">
            <table id="studentProgressTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Học viên</th>
                        <th>Trạng thái</th>
                        <th>Thời gian nộp</th>
                        <th>Đánh giá</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="" alt="Student Avatar" class="rounded-circle me-2" width="40" height="40">
                                <div>
                                    <div class="fw-bold">Nguyễn Văn A</div>
                                    <div class="small text-muted">ID: 12345</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-success">Đã hoàn thành</span></td>
                        <td>2024-03-20 15:30</td>
                        <td><span class="badge bg-success">Xuất sắc</span></td>
                        <td>
                            <a href="{{ route('online.teacher.classes.progress.reflection.detail', ['id' => $class->id, 'student_id' => 1]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Xem chi tiết
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="" alt="Student Avatar" class="rounded-circle me-2" width="40" height="40">
                                <div>
                                    <div class="fw-bold">Trần Thị B</div>
                                    <div class="small text-muted">ID: 12346</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-warning">Đang làm</span></td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <a href="{{ route('online.teacher.classes.progress.reflection.detail', ['id' => $class->id, 'student_id' => 2]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Xem chi tiết
                            </a>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
.badge {
    font-size: 0.8rem;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#studentProgressTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json'
        }
    });
});
</script>
@endpush
@endsection
