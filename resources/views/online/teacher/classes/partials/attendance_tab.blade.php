<div class="attendance-tab-content">
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="attendanceMatrixTable" width="100%" cellspacing="0">
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

<script>
    $(document).ready(function() {
        // Khởi tạo DataTable cho bảng điểm danh
        $('#attendanceMatrixTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
            },
            scrollX: true,
            fixedColumns: {
                leftColumns: 4
            },
            ordering: false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        
        // Kích hoạt tooltip
        $('[data-toggle="tooltip"]').tooltip();
    });
</script> 