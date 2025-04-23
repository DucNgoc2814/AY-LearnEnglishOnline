@extends('online.layouts.master')

@section('title', $class->name)

@push('styles')
<style>
    .class-header {
        background: var(--card-bg, #fff);
        border-radius: var(--border-radius, 0.375rem);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color, #dee2e6);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .class-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-color, #343a40);
        margin-bottom: 1rem;
    }

    .class-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        color: var(--text-muted, #6c757d);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-item i {
        color: var(--primary-color, #0d6efd);
        width: 1rem;
        text-align: center;
    }

    .meta-label {
        font-weight: 500;
        color: var(--text-color, #343a40);
    }

    .tab-content {
        background: var(--card-bg, #fff);
        border-radius: var(--border-radius, 0.375rem);
        padding: 1.5rem;
        border: 1px solid var(--border-color, #dee2e6);
        min-height: 400px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .nav-tabs {
        border: none;
        margin-bottom: 1rem;
        gap: 0.5rem;
    }

    .nav-tabs .nav-link {
        border: 1px solid var(--border-color, #dee2e6);
        border-radius: var(--border-radius, 0.375rem);
        padding: 0.75rem 1.25rem;
        color: var(--text-muted, #6c757d);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .nav-tabs .nav-link:hover {
        background: var(--bg-color, #f8f9fa);
        color: var(--primary-color, #0d6efd);
    }

    .nav-tabs .nav-link.active {
        background: var(--primary-color, #0d6efd);
        color: white;
        border-color: var(--primary-color, #0d6efd);
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
        background: var(--card-bg, #fff);
        border-radius: var(--border-radius, 0.375rem);
        padding: 1rem;
        border: 1px solid var(--border-color, #dee2e6);
        text-align: center;
        transition: transform 0.2s ease;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 600;
        color: var(--primary-color, #0d6efd);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-muted, #6c757d);
        font-size: 0.875rem;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius, 0.375rem);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
    }

    .action-btn.primary {
        background: var(--primary-color, #0d6efd);
        color: white !important;
    }

    .action-btn.primary:hover {
        background: var(--primary-dark, #0a58ca);
        transform: translateY(-2px);
    }

    .action-btn.secondary {
        background: var(--bg-color, #f8f9fa);
        color: var(--text-color, #343a40) !important;
        border: 1px solid var(--border-color, #dee2e6);
    }

    .action-btn.secondary:hover {
        background: var(--hover-bg, #e9ecef);
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .class-meta {
            gap: 1rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .action-btn {
            width: 100%;
        }
        
        .quick-stats {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="class-header">
        <h1 class="class-title">{{ $class->name }} ({{ $class->code }})</h1>
        <div class="class-meta">
            <div class="meta-item">
                <i class="fas fa-user-tie"></i>
                <span class="meta-label">Giảng viên:</span>
                <span>{{ $class->teacher->name ?? $class->teacher->full_name ?? 'Chưa phân công' }}</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-users"></i>
                <span class="meta-label">Sĩ số:</span>
                <span>{{ $class->students->count() }} học viên</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-calendar"></i>
                <span class="meta-label">Lịch học:</span>
                <span>{{ $class->formatted_schedule }}</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-clock"></i>
                <span class="meta-label">Trạng thái:</span>
                <span class="badge {{ $class->status === 'active' ? 'bg-success' : ($class->status === 'pending' ? 'bg-warning' : 'bg-secondary') }}">
                    {{ $class->status === 'active' ? 'Đang diễn ra' : ($class->status === 'pending' ? 'Sắp diễn ra' : 'Đã kết thúc') }}
                </span>
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
            <div class="stat-label">Bài tập</div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="#schedule" class="action-btn primary">
            <i class="fas fa-calendar-alt"></i>
            Lịch học
        </a>
        <a href="#assignments" class="action-btn primary">
            <i class="fas fa-tasks"></i>
            Bài tập
        </a>
        <a href="#materials" class="action-btn primary">
            <i class="fas fa-book"></i>
            Tài liệu
        </a>
        <a href="#grades" class="action-btn secondary">
            <i class="fas fa-chart-line"></i>
            Xem điểm
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
            <a class="nav-link" data-bs-toggle="tab" href="#schedule">
                <i class="fas fa-calendar-alt"></i>
                Lịch học
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
            <a class="nav-link" data-bs-toggle="tab" href="#materials">
                <i class="fas fa-book"></i>
                Tài liệu
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#grades">
                <i class="fas fa-chart-bar"></i>
                Bảng điểm
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="overview">
            @include('online.classes.partials.overview', ['class' => $class, 'stats' => $stats])
        </div>
        <div class="tab-pane fade" id="schedule">
            @include('online.classes.partials.schedule', ['class' => $class])
        </div>
        <div class="tab-pane fade" id="attendance">
            @include('online.classes.partials.attendance', ['class' => $class])
        </div>
        <div class="tab-pane fade" id="assignments">
            @include('online.classes.partials.assignments', ['class' => $class])
        </div>
        <div class="tab-pane fade" id="materials">
            @include('online.classes.partials.materials', ['class' => $class])
        </div>
        <div class="tab-pane fade" id="grades">
            @include('online.classes.partials.grades', ['class' => $class])
        </div>
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
        
        // Handle action buttons
        document.querySelectorAll('.action-buttons .action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetTab = document.querySelector(`a[href="${targetId}"]`);
                if (targetTab) {
                    const tab = new bootstrap.Tab(targetTab);
                    tab.show();
                }
            });
        });
    });
</script>
@endpush 