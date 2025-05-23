@extends('online.layouts.master')

@section('title', 'Quản lý lớp học')

@push('styles')
    <style>
        .class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .class-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .class-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .class-card-header {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .class-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .class-code {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .class-card-body {
            padding: 1rem;
        }

        .class-info {
            margin-bottom: 1rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
        }

        .info-item i {
            width: 1rem;
            color: var(--primary-color);
        }

        .class-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .class-card-footer {
            padding: 1rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: var(--primary-color);
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--text-muted);
        }

        #url-debug {
            position: fixed;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 12px;
            z-index: 9999;
            display: none;
        }
    </style>
@endpush

@section('content')
    <div id="url-debug"></div>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Danh sách lớp học</h4>
        </div>

        @if (isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endif

        <!-- Current Classes -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    Lớp đang dạy
                </h5>
            </div>
            <div class="card-body">
                @if ($currentClasses->isEmpty())
                    <p class="text-muted mb-0">Không có lớp học nào đang diễn ra.</p>
                @else
                    <div class="row">
                        @foreach ($currentClasses as $class)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 class-card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $class->name }}</h5>
                                        <p class="card-text text-muted mb-2">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ $class->formatted_schedule }}
                                        </p>
                                        <div class="stats-grid mb-3">
                                            <div class="stat-item">
                                                <span class="stat-label">Học viên</span>
                                                <span class="stat-value">{{ $class->stats['total_students'] }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-label">Buổi học</span>
                                                <span class="stat-value">{{ $class->stats['total_sessions'] }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-label">Tỷ lệ ĐD</span>
                                                <span class="stat-value">{{ $class->stats['attendance_rate'] }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('online.teacher.classes.show', $class->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>Chi tiết
                                            </a>
                                            <a href="{{ route('online.attendance.sessions', $class->id) }}"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-clipboard-check me-1"></i>Điểm danh
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Upcoming Classes -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Lớp sắp mở
                </h5>
            </div>
            <div class="card-body">
                @if ($upcomingClasses->isEmpty())
                    <p class="text-muted mb-0">Không có lớp học nào sắp mở.</p>
                @else
                    <div class="row">
                        @foreach ($upcomingClasses as $class)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 class-card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $class->name }}</h5>
                                        <p class="card-text text-muted mb-2">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ $class->formatted_schedule }}
                                        </p>
                                        <div class="stats-grid mb-3">
                                            <div class="stat-item">
                                                <span class="stat-label">Học viên</span>
                                                <span class="stat-value">{{ $class->stats['total_students'] }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-label">Buổi học</span>
                                                <span class="stat-value">{{ $class->stats['total_sessions'] }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-label">Tỷ lệ ĐD</span>
                                                <span class="stat-value">{{ $class->stats['attendance_rate'] }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('online.teacher.classes.show', $class->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>Chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Completed Classes -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-check-circle me-2"></i>
                    Lớp đã kết thúc
                </h5>
            </div>
            <div class="card-body">
                @if ($completedClasses->isEmpty())
                    <p class="text-muted mb-0">Không có lớp học nào đã kết thúc.</p>
                @else
                    <div class="row">
                        @foreach ($completedClasses as $class)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 class-card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $class->name }}</h5>
                                        <p class="card-text text-muted mb-2">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ $class->formatted_schedule }}
                                        </p>
                                        <div class="stats-grid mb-3">
                                            <div class="stat-item">
                                                <span class="stat-label">Học viên</span>
                                                <span class="stat-value">{{ $class->stats['total_students'] }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-label">Buổi học</span>
                                                <span class="stat-value">{{ $class->stats['total_sessions'] }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-label">Tỷ lệ ĐD</span>
                                                <span class="stat-value">{{ $class->stats['attendance_rate'] }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('online.teacher.classes.show', $class->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>Chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
