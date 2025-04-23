<div class="session-detail">
    <div class="row mb-4">
        <div class="col-md-6">
            <h5 class="border-bottom pb-2">Thông tin buổi học</h5>
            <p><strong>Ngày:</strong> {{ $session->session_date->format('d/m/Y') }} ({{ $session->session_date->format('l') }})</p>
            <p><strong>Thời gian:</strong> {{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</p>
            <p>
                <strong>Trạng thái:</strong> 
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
            </p>
            <p><strong>Chủ đề:</strong> {{ $session->topic ?? 'Chưa có chủ đề' }}</p>
        </div>
        <div class="col-md-6">
            <h5 class="border-bottom pb-2">Thống kê điểm danh</h5>
            <div class="d-flex justify-content-between mb-2">
                <span>Tổng số học viên:</span>
                <strong>{{ $totalStudents }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Có mặt:</span>
                <strong class="text-success">{{ $presentStudents }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Vắng mặt:</span>
                <strong class="text-danger">{{ $absentStudents }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Tỷ lệ điểm danh:</span>
                <strong>{{ $attendanceRate }}%</strong>
            </div>
            <div class="progress">
                <div class="progress-bar {{ $attendanceRate < 80 ? 'bg-warning' : 'bg-success' }}" 
                     role="progressbar" style="width: {{ $attendanceRate }}%;" 
                     aria-valuenow="{{ $attendanceRate }}" aria-valuemin="0" aria-valuemax="100">
                    {{ $attendanceRate }}%
                </div>
            </div>
        </div>
    </div>

    @if(!empty($session->content))
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="border-bottom pb-2">Nội dung buổi học</h5>
            <div class="p-3 bg-light rounded">
                {!! nl2br(e($session->content)) !!}
            </div>
        </div>
    </div>
    @endif

    @if(!empty($session->session_materials))
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="border-bottom pb-2">Tài liệu học tập</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tên tài liệu</th>
                            <th>Mô tả</th>
                            <th>Ngày đăng</th>
                            <th>Tải xuống</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($session->session_materials as $material)
                        <tr>
                            <td>{{ $material['name'] ?? 'Tài liệu' }}</td>
                            <td>{{ $material['description'] ?? 'Không có mô tả' }}</td>
                            <td>{{ \Carbon\Carbon::parse($material['uploaded_at'] ?? now())->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ $material['url'] ?? '#' }}" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fas fa-download"></i> Tải xuống
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="border-bottom pb-2">Tài liệu học tập</h5>
            <div class="alert alert-info">
                Chưa có tài liệu nào cho buổi học này.
            </div>
        </div>
    </div>
    @endif

    @if(!empty($session->notes))
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="border-bottom pb-2">Ghi chú</h5>
            <div class="p-3 bg-light rounded">
                {!! nl2br(e($session->notes)) !!}
            </div>
        </div>
    </div>
    @endif

    <div class="row mb-4">
        <div class="col-12">
            <h5 class="border-bottom pb-2">Danh sách điểm danh</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã học viên</th>
                            <th>Họ tên</th>
                            <th>Trạng thái</th>
                            <th>Thời gian điểm danh</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($session->attendances as $index => $attendance)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $attendance->student->code ?? 'N/A' }}</td>
                            <td>{{ $attendance->student->name ?? 'N/A' }}</td>
                            <td>
                                @if($attendance->status == 'present')
                                    <span class="badge bg-success">Có mặt</span>
                                @elseif($attendance->status == 'late')
                                    <span class="badge bg-warning">Đi muộn</span>
                                @elseif($attendance->status == 'absent')
                                    <span class="badge bg-danger">Vắng mặt</span>
                                @elseif($attendance->status == 'excused')
                                    <span class="badge bg-info">Có phép</span>
                                @else
                                    <span class="badge bg-secondary">{{ $attendance->status }}</span>
                                @endif
                            </td>
                            <td>{{ $attendance->check_in_time ? $attendance->check_in_time->format('H:i:s') : 'N/A' }}</td>
                            <td>{{ $attendance->note ?? '' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Chưa có thông tin điểm danh</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 