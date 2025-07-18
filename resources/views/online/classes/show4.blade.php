@extends('online.layouts.master')

@section('title', 'Khóa học IELTS Chuyên sâu')

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

        .tab-pane {
            padding: 1.5rem;
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
            <h1 class="class-title">Khóa học IELTS Chuyên sâu</h1>
            <div class="class-meta">
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span class="meta-label">Thời lượng:</span>
                    <span>6 tháng</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-book"></i>
                    <span class="meta-label">Số bài học:</span>
                    <span>24 bài học</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-signal"></i>
                    <span class="meta-label">Trình độ:</span>
                    <span>Chuyên sâu</span>
                </div>
            </div>
        </div>

        <div class="quick-stats">
            <div class="stat-card">
                <div class="stat-value">24</div>
                <div class="stat-label">Tổng số bài học</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['completed_lessons'] ?? 0 }}</div>
                <div class="stat-label">Bài học đã hoàn thành</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['completion_rate'] ?? 0 }}%</div>
                <div class="stat-label">Tỷ lệ hoàn thành</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['total_exercises'] ?? 0 }}</div>
                <div class="stat-label">Bài tập</div>
            </div>
        </div>

        <ul class="nav simple-tabs" id="classTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="materials-tab" data-bs-toggle="tab" href="#materials" role="tab">
                    <i class="fas fa-book"></i>
                    Tài liệu học
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="zoom-tab" data-bs-toggle="tab" href="#zoom" role="tab">
                    <i class="fas fa-video"></i>
                    Lớp học trực tuyến
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="exercises-tab" data-bs-toggle="tab" href="#exercises" role="tab">
                    <i class="fas fa-tasks"></i>
                    Bài tập
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="progress-tab" data-bs-toggle="tab" href="#progress" role="tab">
                    <i class="fas fa-chart-line"></i>
                    Tiến độ học tập
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="materials" role="tabpanel">
                @include('online.classes.partials.materials', ['course' => 4])
            </div>
            <div class="tab-pane fade" id="zoom" role="tabpanel">
                @include('online.classes.partials.zoom', ['course' => 4])
            </div>
            <div class="tab-pane fade" id="exercises" role="tabpanel">
                @include('online.classes.partials.exercises', ['course' => 4])
            </div>
            <div class="tab-pane fade" id="progress" role="tabpanel">
                @include('online.classes.partials.progress', ['course' => 4])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const activeTab = localStorage.getItem('activeClassTab');
            if (activeTab) {
                const tab = new bootstrap.Tab(document.querySelector(`a[href="${activeTab}"]`));
                tab.show();
            }

            document.querySelectorAll('.simple-tabs .nav-link').forEach(tab => {
                tab.addEventListener('shown.bs.tab', function(e) {
                    localStorage.setItem('activeClassTab', e.target.getAttribute('href'));
                });
            });
        });
    </script>
@endpush
