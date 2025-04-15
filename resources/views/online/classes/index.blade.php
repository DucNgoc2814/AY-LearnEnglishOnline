@extends('online.layouts.master')

@section('title', 'Lớp học của tôi')

@push('styles')
    <style>
        :root {
            --primary-color: #2962ff;
            --primary-hover: #1565c0;
            --success-color: #2e7d32;
            --success-light: #e8f5e9;
            --warning-color: #ed6c02;
            --warning-light: #fff4e5;
            --info-color: #0288d1;
            --info-light: #e1f5fe;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
        }

        .class-card {
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            background: #fff;
            overflow: hidden;
        }

        .class-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .class-header {
            padding: 20px;
            border-bottom: 1px solid var(--gray-300);
        }

        .class-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 10px;
        }

        .class-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

        .info-item {
            display: flex;
            align-items: center;
            color: var(--gray-600);
            font-size: 14px;
        }

        .info-item i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        .class-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-active {
            background-color: var(--success-light);
            color: var(--success-color);
        }

        .status-completed {
            background-color: var(--info-light);
            color: var(--info-color);
        }

        .class-content {
            padding: 20px;
        }

        .progress-section {
            margin-bottom: 15px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--gray-600);
        }

        .progress {
            height: 8px;
            border-radius: 4px;
            background-color: var(--gray-200);
        }

        .progress-bar {
            background-color: var(--primary-color);
            border-radius: 4px;
        }

        .class-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            min-width: 120px;
        }

        .btn-schedule {
            background-color: var(--warning-color);
            color: white !important;
            border: none;
        }

        .btn-schedule:hover {
            background-color: #c25e02;
            color: white !important;
        }

        .btn-assignment {
            background-color: var(--success-color);
            color: white !important;
            border: none;
        }

        .btn-assignment:hover {
            background-color: #1b5e20;
            color: white !important;
        }

        .btn-grade {
            background-color: var(--info-color);
            color: white !important;
            border: none;
        }

        .btn-grade:hover {
            background-color: #01579b;
            color: white !important;
        }

        .btn-outline-schedule {
            border: 1px solid var(--warning-color);
            color: var(--warning-color) !important;
            background-color: transparent;
        }

        .btn-outline-schedule:hover {
            background-color: var(--warning-color);
            color: white !important;
        }

        .btn-outline-assignment {
            border: 1px solid var(--success-color);
            color: var(--success-color) !important;
            background-color: transparent;
        }

        .btn-outline-assignment:hover {
            background-color: var(--success-color);
            color: white !important;
        }

        .btn-outline-grade {
            border: 1px solid var(--info-color);
            color: var(--info-color) !important;
            background-color: transparent;
        }

        .btn-outline-grade:hover {
            background-color: var(--info-color);
            color: white !important;
        }

        .filter-section {
            margin-bottom: 20px;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 8px 20px;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-btn.active {
            background-color: var(--primary-color);
            color: white;
        }

        .filter-btn:not(.active) {
            background-color: var(--gray-200);
            color: var(--gray-700);
        }

        .filter-btn:hover:not(.active) {
            background-color: var(--gray-300);
        }

        @media (max-width: 768px) {
            .class-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .class-actions {
                flex-direction: column;
            }

            .action-btn {
                width: 100%;
            }
        }

        /* Modal styles */
        .schedule-modal .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto;
        }

        @media (max-width: 576px) {
            .schedule-modal .modal-dialog {
                margin: 0.5rem;
            }
        }

        .schedule-modal .modal-content {
            border: none;
            border-radius: 8px;
            overflow: hidden;
        }

        .schedule-modal .modal-header {
            background-color: #0d6efd;
            color: white;
            padding: 1rem;
        }

        .schedule-modal .btn-close-white {
            filter: brightness(0) invert(1);
        }

        .schedule-modal .modal-body {
            padding: 0;
        }

        .schedule-modal .schedule-info {
            background-color: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .schedule-modal .table {
            margin-bottom: 0;
        }

        .schedule-modal .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .schedule-modal .table td {
            vertical-align: middle;
            padding: 0.75rem;
        }

        .schedule-modal .badge {
            font-weight: 500;
            padding: 0.5em 0.75em;
        }

        .schedule-modal .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 1rem;
        }

        .schedule-modal .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 0.5rem 1.5rem;
        }

        .schedule-modal .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Table Responsive Fix */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        @media (max-width: 576px) {
            .schedule-modal .table {
                font-size: 0.875rem;
            }
            
            .schedule-modal .badge {
                font-size: 0.75rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-section">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 text-primary">
                    <i class="fas fa-graduation-cap me-2"></i>Lớp học của tôi
                </h5>
            </div>
            <div class="card-body">
                <div class="filter-section">
                    <div class="filter-buttons">
                        <button class="filter-btn active">Tất cả lớp học</button>
                        <button class="filter-btn">Đang học</button>
                        <button class="filter-btn">Đã hoàn thành</button>
                    </div>
                </div>

                <div class="class-list">
                    <!-- Lớp đang học -->
                    <div class="class-card">
                        <div class="class-header">
                            <h3 class="class-title">Xây dựng trang Web 2 (WEB2033) - WD18304</h3>
                            <div class="class-info">
                                <div class="info-item">
                                    <i class="fas fa-user"></i>
                                    <span>Giảng viên: Nguyễn Văn A</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>Thời gian: T2, T4 (7:30 - 11:30)</span>
                                </div>
                                <span class="class-status status-active">Đang học</span>
                            </div>
                        </div>
                        <div class="class-content">
                            <div class="progress-section">
                                <div class="progress-label">
                                    <span>Tiến độ học tập</span>
                                    <span>75%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="class-actions">
                                <a href="#" class="action-btn btn-schedule" data-bs-toggle="modal" data-bs-target="#scheduleModal0">
                                    <i class="fas fa-calendar-alt me-2"></i>Lịch học
                                </a>
                                <a href="{{ route('online.classes.tests', ['class_id' => 'WD18304']) }}" class="action-btn btn-assignment">
                                    <i class="fas fa-tasks me-2"></i>Bài tập
                                </a>
                                <a href="{{ route('online.grades.index', ['class_id' => 'WD18304']) }}" class="action-btn btn-grade">
                                    <i class="fas fa-chart-line me-2"></i>Xem điểm
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Lớp đã hoàn thành -->
                    <div class="class-card">
                        <div class="class-header">
                            <h3 class="class-title">Lập trình Java (PRO1014) - IT17302</h3>
                            <div class="class-info">
                                <div class="info-item">
                                    <i class="fas fa-user"></i>
                                    <span>Giảng viên: Lê Thị D</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>Thời gian: T3, T5 (13:30 - 17:30)</span>
                                </div>
                                <span class="class-status status-completed">Đã hoàn thành</span>
                            </div>
                        </div>
                        <div class="class-content">
                            <div class="progress-section">
                                <div class="progress-label">
                                    <span>Tiến độ học tập</span>
                                    <span>100%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="class-actions">
                                <a href="#" class="action-btn btn-outline-schedule">
                                    <i class="fas fa-calendar-alt me-2"></i>Lịch học
                                </a>
                                <a href="#" class="action-btn btn-outline-assignment">
                                    <i class="fas fa-tasks me-2"></i>Bài tập
                                </a>
                                <a href="#" class="action-btn btn-outline-grade">
                                    <i class="fas fa-chart-line me-2"></i>Xem điểm
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Modal -->
    <div class="modal fade schedule-modal" id="scheduleModal0" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="scheduleModalLabel">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Lịch học - Xây dựng trang Web 2 (WEB2033)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="schedule-info bg-light border-bottom p-3">
                        <i class="fas fa-info-circle text-primary"></i>
                        <strong>Thời gian học:</strong> Thứ 2, Thứ 4 (7:30 - 11:30)
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Buổi</th>
                                    <th>Ngày</th>
                                    <th>Phòng</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>06/05/2024</td>
                                    <td>T1105</td>
                                    <td>Giới thiệu môn học + Ôn tập HTML, CSS</td>
                                    <td><span class="badge bg-success">Đã học</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>08/05/2024</td>
                                    <td>T1105</td>
                                    <td>JavaScript cơ bản</td>
                                    <td><span class="badge bg-success">Đã học</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>13/05/2024</td>
                                    <td>T1105</td>
                                    <td>JavaScript DOM</td>
                                    <td><span class="badge bg-warning text-dark">Sắp học</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>15/05/2024</td>
                                    <td>T1105</td>
                                    <td>JavaScript Events</td>
                                    <td><span class="badge bg-secondary">Chưa học</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
@endpush
