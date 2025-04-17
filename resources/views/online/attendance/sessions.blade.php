@extends('online.layouts.master')

@section('title', 'Danh sách buổi học')

@push('styles')
    <style>
        .sessions-header {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .sessions-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
        }

        .class-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .class-info {
            color: var(--text-muted);
            font-size: 0.875rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .class-info i {
            color: var(--primary-color);
        }

        .sessions-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .stat-card.total {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        }

        .stat-card.completed {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        }

        .stat-card.remaining {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.75rem;
        }

        .stat-card.total .stat-value {
            color: #0284c7;
        }

        .stat-card.completed .stat-value {
            color: var(--success-color);
        }

        .stat-card.remaining .stat-value {
            color: #d97706;
        }

        .stat-label {
            color: var(--text-color);
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-card.total .stat-label i {
            color: #0284c7;
        }

        .stat-card.completed .stat-label i {
            color: var(--success-color);
        }

        .stat-card.remaining .stat-label i {
            color: #d97706;
        }

        .table-status {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            gap: 0.25rem;
            justify-content: center;
        }

        .status-completed {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-in-progress {
            background: #fef9c3;
            color: #ca8a04;
        }

        .status-upcoming {
            background: #fee2e2;
            color: #dc2626;
        }

        @media (max-width: 768px) {
            .sessions-header {
                padding: 1.5rem;
            }

            .class-title {
                font-size: 1.25rem;
            }

            .sessions-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
        <div class="row mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-calendar-alt me-2"></i>Buổi học lớp {{ $class->name }}
                    </h5>
                    <a href="{{ route('online.attendance.index') }}" class="btn btn-sm btn-outline-primary back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
                <div class="card-body">
                    <!-- Class Info Section -->
                    <div class="sessions-header">
                        <div class="class-info">
                            <span><i class="fas fa-graduation-cap me-2"></i><strong>Mã lớp:</strong> {{ $class->code }}</span>
                            <span><i class="fas fa-users me-2"></i><strong>Sĩ số:</strong> {{ $class->students->count() ?? 0 }} học viên</span>
                            @if(is_array($class->schedule))
                                <span><i class="fas fa-calendar me-2"></i><strong>Lịch học:</strong> 
                                {{ implode(', ', array_map(function($day) {
                                    return 'Thứ ' . $day;
                                }, $class->schedule['days'] ?? [])) }}
                                </span>
                                <span><i class="fas fa-clock me-2"></i><strong>Giờ học:</strong> 
                                {{ $class->schedule['start_time'] ?? '' }} - {{ $class->schedule['end_time'] ?? '' }}
                                </span>
                            @endif
                        </div>

                        <!-- Stats -->
                        @php
                            $today = \Carbon\Carbon::now();
                            $totalSessions = $class->sessions->count();
                            $completedSessions = $class->sessions->filter(function($session) use ($today) {
                                return $session->session_date && \Carbon\Carbon::parse($session->session_date)->lt($today);
                            })->count();
                            $remainingSessions = $totalSessions - $completedSessions;
                        @endphp
                        <div class="sessions-stats">
                            <div class="stat-card total">
                                <div class="stat-value">{{ $totalSessions }}</div>
                                <div class="stat-label">
                                    <i class="fas fa-book"></i>
                                    <span>Tổng số buổi</span>
                                </div>
                            </div>
                            <div class="stat-card completed">
                                <div class="stat-value">{{ $completedSessions }}</div>
                                <div class="stat-label">
                                    <i class="fas fa-check"></i>
                                    <span>Đã học</span>
                                </div>
                            </div>
                            <div class="stat-card remaining">
                                <div class="stat-value">{{ $remainingSessions }}</div>
                                <div class="stat-label">
                                    <i class="fas fa-hourglass-half"></i>
                                    <span>Còn lại</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sessions Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Buổi học</th>
                                    <th>Nội dung</th>
                                    <th>Ngày học</th>
                                    <th>Giờ học</th>
                                    <th>Sĩ số</th>
                                    <th>Có mặt</th>
                                    <th>Vắng mặt</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($class->sessions as $index => $session)
                                @php
                                    $sessionDate = $session->session_date ? \Carbon\Carbon::parse($session->session_date) : null;
                                    $startTime = $session->start_time ? \Carbon\Carbon::parse($session->start_time)->format('H:i') : null;
                                    $endTime = $session->end_time ? \Carbon\Carbon::parse($session->end_time)->format('H:i') : null;
                                    
                                    $attendances = $session->attendances ?? collect();
                                    $presentCount = $attendances->where('status', 'present')->count();
                                    $absentCount = $attendances->where('status', 'absent')->count();
                                    
                                    $now = \Carbon\Carbon::now();
                                    $status = '';
                                    $statusClass = '';
                                    $statusIcon = '';
                                    
                                    if (!$sessionDate) {
                                        $status = 'Chưa lên lịch';
                                        $statusClass = 'status-upcoming';
                                        $statusIcon = 'fa-hourglass';
                                    } elseif ($sessionDate->lt($now)) {
                                        $status = 'Đã học';
                                        $statusClass = 'status-completed';
                                        $statusIcon = 'fa-check';
                                    } elseif ($sessionDate->isToday()) {
                                        $status = 'Đang học';
                                        $statusClass = 'status-in-progress';
                                        $statusIcon = 'fa-clock';
                                    } else {
                                        $status = 'Chưa học';
                                        $statusClass = 'status-upcoming';
                                        $statusIcon = 'fa-hourglass';
                                    }
                                @endphp
                                <tr>
                                    <td class="fw-medium">Buổi {{ $index + 1 }}</td>
                                    <td>{{ $session->topic ?? $session->content ?? 'Chưa cập nhật' }}</td>
                                    <td>
                                        @if($sessionDate)
                                            <i class="fas fa-calendar-day text-primary me-1"></i>{{ $sessionDate->format('d/m/Y') }}
                                        @else
                                            <span class="text-muted">Chưa lên lịch</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($startTime && $endTime)
                                            <i class="fas fa-clock text-primary me-1"></i>{{ $startTime }} - {{ $endTime }}
                                        @else
                                            <span class="text-muted">Chưa cập nhật</span>
                                        @endif
                                    </td>
                                    <td>{{ $class->students->count() ?? 0 }}/{{ $class->max_students ?? 0 }}</td>
                                    <td class="text-success">{{ $presentCount ?: '-' }}</td>
                                    <td class="text-danger">{{ $absentCount ?: '-' }}</td>
                                    <td>
                                        <span class="table-status {{ $statusClass }}">
                                            <i class="fas {{ $statusIcon }} me-1"></i>{{ $status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('online.attendance.detail', ['id' => $session->id]) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye me-1"></i>Điểm danh
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-info-circle me-2"></i>Chưa có buổi học nào
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
