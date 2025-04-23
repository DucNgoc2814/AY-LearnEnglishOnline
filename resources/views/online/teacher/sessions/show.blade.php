@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết buổi học</h3>
                    <div class="card-tools">
                        <a href="{{ route('online.teacher.classes.show', $session->class->id) }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Thông tin cơ bản -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Thông tin buổi học</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Lớp học</th>
                                    <td>{{ $session->class->name }}</td>
                                </tr>
                                <tr>
                                    <th>Giảng viên</th>
                                    <td>{{ $session->class->teacher->name }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày học</th>
                                    <td>{{ $session->session_date->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Thời gian</th>
                                    <td>{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Chủ đề</th>
                                    <td>{{ $session->topic }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        @if($session->status == 'completed')
                                            <span class="badge bg-success">Đã hoàn thành</span>
                                        @elseif($session->status == 'scheduled')
                                            <span class="badge bg-warning">Đã lên lịch</span>
                                        @elseif($session->status == 'in_progress')
                                            <span class="badge bg-primary">Đang diễn ra</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $session->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Thống kê điểm danh</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tổng số học viên</span>
                                            <span class="info-box-number">{{ $totalStudents }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tỷ lệ điểm danh</span>
                                            <span class="info-box-number">{{ $attendanceRate }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Có mặt</span>
                                            <span class="info-box-number">{{ $presentStudents }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Vắng mặt</span>
                                            <span class="info-box-number">{{ $absentStudents }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="sessionTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="attendance-tab" data-bs-toggle="tab" href="#attendance" role="tab">
                                Điểm danh
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="materials-tab" data-bs-toggle="tab" href="#materials" role="tab">
                                Tài liệu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="grades-tab" data-bs-toggle="tab" href="#grades" role="tab">
                                Bảng điểm
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="sessionTabContent">
                        <!-- Tab Điểm danh -->
                        <div class="tab-pane fade show active" id="attendance" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã học viên</th>
                                            <th>Họ tên</th>
                                            <th>Trạng thái</th>
                                            <th>Ghi chú</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($session->class->students as $index => $student)
                                            @php
                                                $attendance = $session->attendances->where('student_id', $student->id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $student->code }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>
                                                    @if($attendance)
                                                        @if($attendance->status == 'present')
                                                            <span class="badge bg-success">Có mặt</span>
                                                        @elseif($attendance->status == 'late')
                                                            <span class="badge bg-warning">Đi muộn</span>
                                                        @else
                                                            <span class="badge bg-danger">Vắng mặt</span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-secondary">Chưa điểm danh</span>
                                                    @endif
                                                </td>
                                                <td>{{ $attendance->notes ?? '' }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary" 
                                                            onclick="updateAttendance({{ $student->id }})">
                                                        <i class="fas fa-edit"></i> Cập nhật
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tab Tài liệu -->
                        <div class="tab-pane fade" id="materials" role="tabpanel">
                            <div class="mb-3">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                                    <i class="fas fa-plus"></i> Thêm tài liệu
                                </button>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên tài liệu</th>
                                            <th>Mô tả</th>
                                            <th>Ngày tải lên</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($session->session_materials))
                                            @foreach($session->session_materials as $index => $material)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $material['name'] }}</td>
                                                    <td>{{ $material['description'] ?? '' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($material['uploaded_at'])->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <a href="{{ $material['url'] }}" class="btn btn-sm btn-info" target="_blank">
                                                            <i class="fas fa-download"></i> Tải xuống
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger" 
                                                                onclick="deleteMaterial({{ $index }})">
                                                            <i class="fas fa-trash"></i> Xóa
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tab Bảng điểm -->
                        <div class="tab-pane fade" id="grades" role="tabpanel">
                            <div class="mb-3">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addGradeModal">
                                    <i class="fas fa-plus"></i> Thêm điểm
                                </button>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã học viên</th>
                                            <th>Họ tên</th>
                                            <th>Loại điểm</th>
                                            <th>Điểm</th>
                                            <th>Nhận xét</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($grades as $index => $grade)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $grade->student->code }}</td>
                                                <td>{{ $grade->student->name }}</td>
                                                <td>{{ $grade->item_name }}</td>
                                                <td>{{ $grade->score }}</td>
                                                <td>{{ $grade->comment }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary" 
                                                            onclick="editGrade({{ $grade->id }})">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" 
                                                            onclick="deleteGrade({{ $grade->id }})">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal thêm tài liệu -->
@include('online.teacher.sessions.partials.add_material_modal')

<!-- Modal thêm điểm -->
@include('online.teacher.sessions.partials.add_grade_modal')

@endsection

@push('scripts')
<script>
    function updateAttendance(studentId) {
        // TODO: Implement attendance update logic
    }
    
    function deleteMaterial(index) {
        // TODO: Implement material deletion logic
    }
    
    function editGrade(gradeId) {
        // TODO: Implement grade editing logic
    }
    
    function deleteGrade(gradeId) {
        // TODO: Implement grade deletion logic
    }
</script>
@endpush 