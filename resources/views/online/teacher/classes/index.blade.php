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
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
</style>
@endpush

@section('content')
<div class="container">
    @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @else
        @if($currentClasses->count() > 0)
            <div class="section-title">
                <i class="fas fa-chalkboard-teacher"></i>
                Lớp học đang giảng dạy
            </div>
            <div class="class-grid">
                @foreach($currentClasses as $class)
                <div class="class-card">
                    <div class="class-card-header">
                        <div class="class-name">{{ $class->name }}</div>
                        <div class="class-code">Mã lớp: {{ $class->code }}</div>
                    </div>
                    <div class="class-card-body">
                        <div class="class-info">
                            <div class="info-item">
                                <i class="fas fa-users"></i>
                                <span>{{ $class->stats['total_students'] }} học viên</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $class->formatted_schedule }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $class->stats['total_sessions'] }} buổi học</span>
                            </div>
                        </div>
                        <div class="class-stats">
                            <div class="stat-item">
                                <div class="stat-value">{{ $class->stats['attendance_rate'] }}%</div>
                                <div class="stat-label">Tỷ lệ điểm danh</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $class->stats['total_attendances'] }}</div>
                                <div class="stat-label">Lượt điểm danh</div>
                            </div>
                        </div>
                    </div>
                    <div class="class-card-footer">
                        <a href="{{ route('online.teacher.classes.show', $class->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i>
                            Chi tiết
                        </a>
                        <a href="{{ route('online.teacher.classes.attendance', $class->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-clipboard-check"></i>
                            Điểm danh
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        @if($upcomingClasses->count() > 0)
            <div class="section-title">
                <i class="fas fa-clock"></i>
                Lớp học sắp mở
            </div>
            <div class="class-grid">
                @foreach($upcomingClasses as $class)
                <div class="class-card">
                    <div class="class-card-header">
                        <div class="class-name">{{ $class->name }}</div>
                        <div class="class-code">Mã lớp: {{ $class->code }}</div>
                    </div>
                    <div class="class-card-body">
                        <div class="class-info">
                            <div class="info-item">
                                <i class="fas fa-users"></i>
                                <span>{{ $class->stats['total_students'] }} học viên</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $class->formatted_schedule }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-play"></i>
                                <span>Bắt đầu: {{ $class->start_date->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="class-card-footer">
                        <a href="{{ route('online.teacher.classes.show', $class->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i>
                            Chi tiết
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        @if($completedClasses->count() > 0)
            <div class="section-title">
                <i class="fas fa-check-circle"></i>
                Lớp học đã kết thúc
            </div>
            <div class="class-grid">
                @foreach($completedClasses as $class)
                <div class="class-card">
                    <div class="class-card-header">
                        <div class="class-name">{{ $class->name }}</div>
                        <div class="class-code">Mã lớp: {{ $class->code }}</div>
                    </div>
                    <div class="class-card-body">
                        <div class="class-info">
                            <div class="info-item">
                                <i class="fas fa-users"></i>
                                <span>{{ $class->stats['total_students'] }} học viên</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-calendar-check"></i>
                                <span>{{ $class->stats['total_sessions'] }} buổi học</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-chart-line"></i>
                                <span>{{ $class->stats['attendance_rate'] }}% điểm danh</span>
                            </div>
                        </div>
                    </div>
                    <div class="class-card-footer">
                        <a href="{{ route('online.teacher.classes.show', $class->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i>
                            Chi tiết
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        @if($currentClasses->count() === 0 && $upcomingClasses->count() === 0 && $completedClasses->count() === 0)
            <div class="empty-state">
                <i class="fas fa-school"></i>
                <p>Bạn chưa được phân công lớp học nào.</p>
            </div>
        @endif
    @endif
</div>
@endsection 