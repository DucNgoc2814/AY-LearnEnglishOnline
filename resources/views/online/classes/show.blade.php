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
        border: 1px solid var(--border-color, #dee2e6);
        min-height: 400px;
        margin-top: -1px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    /* Tab thiết kế nhỏ gọn hơn */
    .simple-tabs {
        display: flex;
        width: 100%;
        margin-bottom: 0;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        overflow: hidden;
    }

    .simple-tabs .nav-item {
        flex: 1;
    }

    .simple-tabs .nav-link {
        text-align: center;
        color: #495057;
        font-weight: 500;
        padding: 0.75rem 0.5rem;
        border: none;
        border-radius: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        background-color: #f8f9fa;
        position: relative;
    }

    .simple-tabs .nav-link i {
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
    }

    .simple-tabs .nav-link.active {
        color: #0d6efd;
        background-color: #fff;
        border-bottom: 3px solid #0d6efd;
    }

    .simple-tabs .nav-link:hover:not(.active) {
        background: #e9ecef;
    }

    /* Nội dung tab */
    .tab-pane {
        padding: 1.5rem;
    }

    /* Lesson layout */
    .lesson-header {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .lesson-header .icon {
        font-size: 1.5rem;
        margin-right: 1rem;
        color: #0d6efd;
    }

    .lesson-title {
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 0;
        flex-grow: 1;
    }

    .resource-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 1rem;
        transition: all 0.2s;
    }

    .resource-card:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .resource-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
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

    /* Filter button */
    .filter-btn {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        border-radius: 4px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #495057;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .filter-btn:hover {
        background-color: #e9ecef;
    }

    .filter-btn i {
        margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
        .class-meta {
            gap: 1rem;
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

    <ul class="nav simple-tabs" id="classTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="materials-tab" data-bs-toggle="tab" href="#materials" role="tab">
                <i class="fas fa-book"></i>
                Tài liệu
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="zoom-tab" data-bs-toggle="tab" href="#zoom" role="tab">
                <i class="fas fa-video"></i>
                Link Zoom
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tests-tab" data-bs-toggle="tab" href="#tests" role="tab">
                <i class="fas fa-tasks"></i>
                Bài test
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="resources-tab" data-bs-toggle="tab" href="#resources" role="tab">
                <i class="fas fa-graduation-cap"></i>
                Học liệu
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="progress-tab" data-bs-toggle="tab" href="#progress" role="tab">
                <i class="fas fa-chart-line"></i>
                Tiến độ làm bài
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="materials" role="tabpanel">
            @include('online.classes.partials.materials', ['class' => $class])
        </div>
        <div class="tab-pane fade" id="zoom" role="tabpanel">
            @include('online.classes.partials.zoom', ['class' => $class])
        </div>
        <div class="tab-pane fade" id="tests" role="tabpanel">
            @include('online.classes.partials.tests', ['class' => $class])
        </div>
        <div class="tab-pane fade" id="resources" role="tabpanel">
            @include('online.classes.partials.resources', ['class' => $class])
        </div>
        <div class="tab-pane fade" id="progress" role="tabpanel">
            @include('online.classes.partials.progress', ['class' => $class])
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
        document.querySelectorAll('.simple-tabs .nav-link').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function(e) {
                localStorage.setItem('activeClassTab', e.target.getAttribute('href'));
            });
        });
    });
</script>
@endpush