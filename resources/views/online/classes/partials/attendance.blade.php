@php
    $sessions = $class->sessions()
        ->orderBy('start_time', 'desc')
        ->paginate(10);

    $attendanceStats = $class->students->map(function($student) use ($class) {
        $total = $class->sessions()->count();
        $attended = $student->attendances()
            ->whereIn('session_id', $class->sessions()->pluck('id'))
            ->whereIn('status', [1, 2]) // Present or Late
            ->count();
        
        return [
            'student' => $student,
            'total' => $total,
            'attended' => $attended,
            'rate' => $total > 0 ? round(($attended / $total) * 100, 1) : 0
        ];
    })->sortByDesc('rate');
@endphp

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Lịch sử điểm danh</h5>
            </div>
            <div class="card-body">
                @if($sessions->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Buổi học</th>
                                    <th>Thời gian</th>
                                    <th class="text-center">Có mặt</th>
                                    <th class="text-center">Vắng mặt</th>
                                    <th class="text-center">Đi muộn</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessions as $session)
                                @php
                                    $stats = $session->attendances->groupBy('status');
                                    $present = $stats->get(1, collect())->count();
                                    $absent = $stats->get(0, collect())->count();
                                    $late = $stats->get(2, collect())->count();
                                @endphp
                                <tr>
                                    <td>
                                        <div class="fw-bold">Buổi {{ $session->order }}</div>
                                        <div class="text-muted small">{{ $session->content }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $session->start_time->format('d/m/Y') }}</div>
                                        <div class="text-muted small">{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success">{{ $present }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-danger">{{ $absent }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning">{{ $late }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('online.teacher.classes.attendance', ['class' => $class->id, 'session' => $session->id]) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                            Chi tiết
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $sessions->links() }}
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-calendar-times fa-3x mb-3"></i>
                        <p>Chưa có buổi học nào</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thống kê điểm danh</h5>
            </div>
            <div class="card-body">
                @foreach($attendanceStats as $stat)
                <div class="attendance-stat-item mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="d-flex align-items-center">
                            <img src="{{ $stat['student']->avatar_url }}" 
                                 alt="{{ $stat['student']->name }}" 
                                 class="rounded-circle me-2"
                                 width="32" height="32">
                            <span>{{ $stat['student']->name }}</span>
                        </div>
                        <span class="badge bg-{{ $stat['rate'] >= 80 ? 'success' : ($stat['rate'] >= 60 ? 'warning' : 'danger') }}">
                            {{ $stat['rate'] }}%
                        </span>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-{{ $stat['rate'] >= 80 ? 'success' : ($stat['rate'] >= 60 ? 'warning' : 'danger') }}" 
                             role="progressbar" 
                             style="width: {{ $stat['rate'] }}%" 
                             aria-valuenow="{{ $stat['rate'] }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                        </div>
                    </div>
                    <div class="text-muted small mt-1">
                        Có mặt {{ $stat['attended'] }}/{{ $stat['total'] }} buổi
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
.attendance-stat-item {
    padding: 10px;
    border-radius: var(--border-radius);
    transition: background-color 0.2s;
}

.attendance-stat-item:hover {
    background-color: var(--bs-gray-100);
}

.progress {
    background-color: var(--bs-gray-200);
}
</style> 