@extends('online.layouts.master')

@section('title', $class->name)

@push('styles')
<style>
    .class-header {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .class-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 1rem;
    }

    .class-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        color: var(--text-muted);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-item i {
        color: var(--primary-color);
        width: 1rem;
        text-align: center;
    }

    .meta-label {
        font-weight: 500;
        color: var(--text-color);
    }

    .tab-content {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        min-height: 400px;
    }

    .nav-tabs {
        border: none;
        margin-bottom: 1rem;
        gap: 0.5rem;
    }

    .nav-tabs .nav-link {
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        padding: 0.75rem 1.25rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .nav-tabs .nav-link:hover {
        background: var(--bg-color);
        color: var(--primary-color);
    }

    .nav-tabs .nav-link.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .nav-tabs .nav-link i {
        font-size: 1rem;
    }

    .quick-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 1rem;
        border: 1px solid var(--border-color);
        text-align: center;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.875rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .action-btn.primary {
        background: var(--primary-color);
        color: white;
    }

    .action-btn.primary:hover {
        background: var(--primary-dark);
    }

    .action-btn.secondary {
        background: var(--bg-color);
        color: var(--text-color);
        border: 1px solid var(--border-color);
    }

    .action-btn.secondary:hover {
        background: var(--hover-bg);
    }
</style>
@endpush

@section('content')
<div class="class-header">
    <h1 class="class-title">{{ $class->name }} ({{ $class->code }})</h1>
    <div class="class-meta">
        <div class="meta-item">
            <i class="fas fa-user-tie"></i>
            <span class="meta-label">Giảng viên:</span>
            <span>{{ $class->teacher->name }}</span>
        </div>
        <div class="meta-item">
            <i class="fas fa-users"></i>
            <span class="meta-label">Sĩ số:</span>
            <span>{{ $class->students->count() }} học viên</span>
        </div>
        <div class="meta-item">
            <i class="fas fa-calendar"></i>
            <span class="meta-label">Lịch học:</span>
            <span>{{ $class->schedule }}</span>
        </div>
        <div class="meta-item">
            <i class="fas fa-clock"></i>
            <span class="meta-label">Trạng thái:</span>
            <span>{{ $class->status }}</span>
        </div>
    </div>
</div>

<div class="quick-stats">
    <div class="stat-card">
        <div class="stat-value">{{ $stats['total_sessions'] }}</div>
        <div class="stat-label">Tổng số buổi học</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $stats['completed_sessions'] }}</div>
        <div class="stat-label">Buổi đã học</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $stats['attendance_rate'] }}%</div>
        <div class="stat-label">Tỷ lệ điểm danh</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $stats['assignment_count'] }}</div>
        <div class="stat-label">Bài tập đã giao</div>
    </div>
</div>

<div class="action-buttons">
    <a href="{{ route('online.teacher.classes.attendance', $class->id) }}" class="action-btn primary">
        <i class="fas fa-clipboard-check"></i>
        Điểm danh
    </a>
    <a href="{{ route('online.teacher.classes.assignments.create', $class->id) }}" class="action-btn primary">
        <i class="fas fa-tasks"></i>
        Giao bài tập
    </a>
    <a href="{{ route('online.teacher.classes.grades.export', $class->id) }}" class="action-btn secondary">
        <i class="fas fa-download"></i>
        Xuất điểm
    </a>
</div>

<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#overview">
            <i class="fas fa-home"></i>
            Tổng quan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#attendance">
            <i class="fas fa-clipboard-check"></i>
            Điểm danh
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#assignments">
            <i class="fas fa-tasks"></i>
            Bài tập
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#grades">
            <i class="fas fa-chart-bar"></i>
            Bảng điểm
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#students">
            <i class="fas fa-users"></i>
            Học viên
        </a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="overview">
        @include('online.classes.partials.overview')
    </div>
    <div class="tab-pane fade" id="attendance">
        @include('online.classes.partials.attendance')
    </div>
    <div class="tab-pane fade" id="assignments">
        @include('online.classes.partials.assignments')
    </div>
    <div class="tab-pane fade" id="grades">
        @include('online.classes.partials.grades')
    </div>
    <div class="tab-pane fade" id="students">
        @include('online.classes.partials.students')
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle tab persistence
        const activeTab = localStorage.getItem('activeClassTab');
        if (activeTab) {
            const tab = new bootstrap.Tab(document.querySelector(`a[href="${activeTab}"]`));
            tab.show();
        }

        // Store active tab
        document.querySelectorAll('a[data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function(e) {
                localStorage.setItem('activeClassTab', e.target.getAttribute('href'));
            });
        });
    });
</script>
@endpush 