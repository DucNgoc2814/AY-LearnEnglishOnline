@extends('online.layouts.master')

@section('title', 'Bảng điểm')

@push('styles')
    <style>
        .class-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .class-card-body {
            padding: 16px;
        }

        .class-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 10px;
        }

        .class-info-container {
            flex: 1;
            min-width: 200px;
        }

        .class-title {
            font-size: 18px;
            margin-bottom: 8px;
            word-break: break-word;
        }

        .class-info {
            margin-bottom: 5px;
        }

        .teacher-name {
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            color: white;
        }

        .status-active {
            background-color: #28a745;
        }

        .status-absent {
            background-color: #ffc107;
        }

        .average-score {
            font-size: 16px;
            font-weight: 600;
            color: #0066cc;
        }

        .toggle-btn {
            padding: 8px 16px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            white-space: nowrap;
        }

        .toggle-btn:hover {
            background-color: #0056b3;
        }

        .schedule-container {
            padding: 16px;
            border-top: 1px solid #e0e0e0;
            display: none;
        }

        .schedule-title {
            font-size: 16px;
            margin-bottom: 16px;
        }

        .schedule-table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 10px;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .schedule-table th,
        .schedule-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .schedule-table th {
            background-color: #f5f5f5;
            font-weight: 500;
            position: sticky;
            top: 0;
        }

        .schedule-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .attendance-summary {
            margin-top: 12px;
            color: #6c757d;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .class-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .toggle-btn {
                width: 100%;
                text-align: center;
                margin-top: 10px;
            }
        }

        @media (max-width: 576px) {
            .class-card-body {
                padding: 12px;
            }

            .class-title {
                font-size: 16px;
            }

            .schedule-container {
                padding: 12px;
            }

            .schedule-table th,
            .schedule-table td {
                padding: 8px;
                font-size: 14px;
            }
        }

        /* Modal Responsive Styles */
        .modal {
            padding: 0 !important;
        }

        .modal-dialog {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 20px;
        }

        .modal-content {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .modal-body {
            padding: 20px;
            max-height: calc(100vh - 150px);
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #e0e0e0;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px !important;
                margin: 1.75rem auto !important;
                padding: 0;
            }
        }

        @media (min-width: 768px) {
            .modal-dialog {
                max-width: 700px !important;
            }
        }

        @media (min-width: 992px) {
            .modal-dialog {
                max-width: 900px !important;
            }
        }

        /* Fix for mobile scrolling */
        .modal-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
        }

        /* Ensure modal content is scrollable on mobile */
        .modal-content {
            height: auto;
            min-height: calc(100vh - 60px);
            border-radius: 0;
        }

        @media (min-width: 576px) {
            .modal-content {
                min-height: auto;
                border-radius: 8px;
            }
        }

        /* Improve modal backdrop */
        .modal-backdrop {
            opacity: 0.5;
        }

        /* Fix for iOS scrolling */
        .modal-body {
            -webkit-overflow-scrolling: touch;
        }

        /* Improve button touch targets on mobile */
        .modal .btn {
            padding: 12px 20px;
            min-height: 44px;
        }

        @media (min-width: 576px) {
            .modal .btn {
                padding: 8px 16px;
                min-height: auto;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-section">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 text-primary">
                    <i class="fas fa-chart-line me-2"></i>Bảng điểm
                </h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="gradesTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="current-tab" data-bs-toggle="tab" data-bs-target="#current"
                            type="button" role="tab" aria-controls="current" aria-selected="true">Học kỳ: Spring 2024</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="previous-tab" data-bs-toggle="tab" data-bs-target="#previous"
                            type="button" role="tab" aria-controls="previous" aria-selected="false">Học kỳ: Fall 2023</button>
                    </li>
                </ul>

                <div class="tab-content mt-4" id="gradesTabContent">
                    <!-- Current Semester Tab -->
                    <div class="tab-pane fade show active" id="current" role="tabpanel" aria-labelledby="current-tab">
                        <div class="class-list">
                            <div class="class-card" data-class-id="WD18304">
                                <div class="class-card-body">
                                    <div class="class-header">
                                        <div class="class-info-container">
                                            <h3 class="class-title">Xây dựng trang Web 2 (WEB2033) - WD18304</h3>
                                            <p class="class-info"><span class="teacher-name">Giảng viên: Nguyễn Văn A</span></p>
                                            <p class="class-info">
                                                <span class="status-badge status-active">Đang học</span>
                                                <span class="ms-2">Điểm trung bình: <span class="average-score">9.8</span></span>
                                            </p>
                                        </div>
                                        <button class="toggle-btn">Xem điểm</button>
                                    </div>
                                </div>
                                <div class="schedule-container">
                                    <h4 class="schedule-title">Bảng điểm chi tiết</h4>
                                    <div class="schedule-table-wrapper">
                                        <table class="schedule-table">
                                            <thead>
                                                <tr>
                                                    <th>Đánh giá</th>
                                                    <th>Trọng số</th>
                                                    <th>Điểm</th>
                                                    <th>Ghi chú</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Lab 1</td>
                                                    <td>10%</td>
                                                    <td><span class="status-badge status-active">10.0</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                                <tr>
                                                    <td>Lab 2</td>
                                                    <td>10%</td>
                                                    <td><span class="status-badge status-active">9.5</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                                <tr>
                                                    <td>Assignment</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-active">9.8</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                                <tr>
                                                    <td>Giữa kỳ</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-active">9.7</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                                <tr>
                                                    <td>Cuối kỳ</td>
                                                    <td>40%</td>
                                                    <td><span class="status-badge status-active">9.9</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="class-card" data-class-id="FE18301">
                                <div class="class-card-body">
                                    <div class="class-header">
                                        <div class="class-info-container">
                                            <h3 class="class-title">Lập trình Javascript (MOB1023) - FE18301</h3>
                                            <p class="class-info"><span class="teacher-name">Giảng viên: Trần Thị B</span></p>
                                            <p class="class-info">
                                                <span class="status-badge status-active">Đang học</span>
                                                <span class="ms-2">Điểm trung bình: <span class="average-score">8.5</span></span>
                                            </p>
                                        </div>
                                        <button class="toggle-btn">Xem điểm</button>
                                    </div>
                                </div>
                                <div class="schedule-container">
                                    <h4 class="schedule-title">Bảng điểm chi tiết</h4>
                                    <div class="schedule-table-wrapper">
                                        <table class="schedule-table">
                                            <thead>
                                                <tr>
                                                    <th>Đánh giá</th>
                                                    <th>Trọng số</th>
                                                    <th>Điểm</th>
                                                    <th>Ghi chú</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Lab 1</td>
                                                    <td>10%</td>
                                                    <td><span class="status-badge status-active">8.0</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                                <tr>
                                                    <td>Lab 2</td>
                                                    <td>10%</td>
                                                    <td><span class="status-badge status-active">8.5</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                                <tr>
                                                    <td>Assignment</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-active">9.0</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                                <tr>
                                                    <td>Giữa kỳ</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-active">8.2</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                                <tr>
                                                    <td>Cuối kỳ</td>
                                                    <td>40%</td>
                                                    <td><span class="status-badge status-active">8.6</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="class-card" data-class-id="IT18202">
                                <div class="class-card-body">
                                    <div class="class-header">
                                        <div class="class-info-container">
                                            <h3 class="class-title">Cơ sở dữ liệu (COM1024) - IT18202</h3>
                                            <p class="class-info"><span class="teacher-name">Giảng viên: Phạm Văn C</span></p>
                                            <p class="class-info">
                                                <span class="status-badge status-active">Đang học</span>
                                                <span class="ms-2">Điểm trung bình: <span class="average-score">7.2</span></span>
                                            </p>
                                        </div>
                                        <button class="toggle-btn">Xem điểm</button>
                                    </div>
                                </div>
                                <div class="schedule-container">
                                    <h4 class="schedule-title">Bảng điểm chi tiết</h4>
                                    <div class="schedule-table-wrapper">
                                        <table class="schedule-table">
                                            <thead>
                                                <tr>
                                                    <th>Đánh giá</th>
                                                    <th>Trọng số</th>
                                                    <th>Điểm</th>
                                                    <th>Ghi chú</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Lab 1</td>
                                                    <td>10%</td>
                                                    <td><span class="status-badge status-absent">7.0</span></td>
                                                    <td>Cần cải thiện</td>
                                                </tr>
                                                <tr>
                                                    <td>Lab 2</td>
                                                    <td>10%</td>
                                                    <td><span class="status-badge status-active">8.0</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                                <tr>
                                                    <td>Assignment</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-absent">6.5</span></td>
                                                    <td>Cần cải thiện</td>
                                                </tr>
                                                <tr>
                                                    <td>Giữa kỳ</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-absent">7.0</span></td>
                                                    <td>Cần cải thiện</td>
                                                </tr>
                                                <tr>
                                                    <td>Cuối kỳ</td>
                                                    <td>40%</td>
                                                    <td><span class="status-badge status-absent">7.5</span></td>
                                                    <td>Cần cải thiện</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Previous Semester Tab -->
                    <div class="tab-pane fade" id="previous" role="tabpanel" aria-labelledby="previous-tab">
                        <div class="class-list">
                            <div class="class-card" data-class-id="IT17302">
                                <div class="class-card-body">
                                    <div class="class-header">
                                        <div class="class-info-container">
                                            <h3 class="class-title">Lập trình Java (PRO1014) - IT17302</h3>
                                            <p class="class-info"><span class="teacher-name">Giảng viên: Lê Thị D</span></p>
                                            <p class="class-info">
                                                <span class="status-badge status-active">Đã hoàn thành</span>
                                                <span class="ms-2">Điểm trung bình: <span class="average-score">8.7</span></span>
                                            </p>
                                        </div>
                                        <button class="toggle-btn">Xem điểm</button>
                                    </div>
                                </div>
                                <div class="schedule-container">
                                    <h4 class="schedule-title">Bảng điểm chi tiết</h4>
                                    <div class="schedule-table-wrapper">
                                        <table class="schedule-table">
                                            <thead>
                                                <tr>
                                                    <th>Đánh giá</th>
                                                    <th>Trọng số</th>
                                                    <th>Điểm</th>
                                                    <th>Ghi chú</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Lab 1</td>
                                                    <td>5%</td>
                                                    <td><span class="status-badge status-active">9.0</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                                <tr>
                                                    <td>Lab 2</td>
                                                    <td>5%</td>
                                                    <td><span class="status-badge status-active">8.5</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                                <tr>
                                                    <td>Lab 3</td>
                                                    <td>5%</td>
                                                    <td><span class="status-badge status-active">9.0</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                                <tr>
                                                    <td>Assignment 1</td>
                                                    <td>15%</td>
                                                    <td><span class="status-badge status-active">8.8</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                                <tr>
                                                    <td>Assignment 2</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-active">8.5</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                                <tr>
                                                    <td>Cuối kỳ</td>
                                                    <td>50%</td>
                                                    <td><span class="status-badge status-active">8.7</span></td>
                                                    <td>Hoàn thành tốt</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="class-card" data-class-id="GD17308">
                                <div class="class-card-body">
                                    <div class="class-header">
                                        <div class="class-info-container">
                                            <h3 class="class-title">Thiết kế UI/UX (DES1024) - GD17308</h3>
                                            <p class="class-info"><span class="teacher-name">Giảng viên: Trần Văn E</span></p>
                                            <p class="class-info">
                                                <span class="status-badge status-active">Đã hoàn thành</span>
                                                <span class="ms-2">Điểm trung bình: <span class="average-score">9.2</span></span>
                                            </p>
                                        </div>
                                        <button class="toggle-btn">Xem điểm</button>
                                    </div>
                                </div>
                                <div class="schedule-container">
                                    <h4 class="schedule-title">Bảng điểm chi tiết</h4>
                                    <div class="schedule-table-wrapper">
                                        <table class="schedule-table">
                                            <thead>
                                                <tr>
                                                    <th>Đánh giá</th>
                                                    <th>Trọng số</th>
                                                    <th>Điểm</th>
                                                    <th>Ghi chú</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Project 1</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-active">9.5</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                                <tr>
                                                    <td>Project 2</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-active">9.0</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                                <tr>
                                                    <td>Giữa kỳ</td>
                                                    <td>20%</td>
                                                    <td><span class="status-badge status-active">9.2</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                                <tr>
                                                    <td>Cuối kỳ</td>
                                                    <td>40%</td>
                                                    <td><span class="status-badge status-active">9.3</span></td>
                                                    <td>Hoàn thành xuất sắc</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle schedule visibility
            const toggleButtons = document.querySelectorAll('.toggle-btn');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const scheduleContainer = this.closest('.class-card-body').nextElementSibling;

                    if (scheduleContainer.style.display === 'block') {
                        scheduleContainer.style.display = 'none';
                        this.textContent = 'Xem điểm';
                    } else {
                        scheduleContainer.style.display = 'block';
                        this.textContent = 'Ẩn điểm';
                    }
                });
            });

            // Fix modal scrolling on mobile
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('shown.bs.modal', function() {
                    document.body.style.overflow = 'hidden';
                });

                modal.addEventListener('hidden.bs.modal', function() {
                    document.body.style.overflow = '';
                });
            });

            // Prevent modal from closing when clicking inside
            document.querySelectorAll('.modal-content').forEach(content => {
                content.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
@endpush 