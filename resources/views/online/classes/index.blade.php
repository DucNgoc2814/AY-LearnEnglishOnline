@extends('online.layouts.master')

@section('title', 'Lớp học của tôi')

@push('styles')
    <style>
        .classes-container {
            margin-bottom: 20px;
        }

        .class-tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            /* For Firefox */
        }

        .class-tabs::-webkit-scrollbar {
            display: none;
            /* For Chrome, Safari and Opera */
        }

        .class-tab {
            padding: 10px 15px;
            cursor: pointer;
            margin-right: 5px;
            background: none;
            border: none;
            font-weight: 500;
            white-space: nowrap;
        }

        .class-tab.active {
            border-bottom: 2px solid #0066cc;
            color: #0066cc;
        }

        .tab-content-wrapper {
            padding: 15px 0;
        }

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

        .empty-state {
            text-align: center;
            padding: 50px 0;
        }

        .empty-icon {
            display: inline-block;
            width: 150px;
            height: 120px;
            margin-bottom: 20px;
            max-width: 100%;
        }

        .empty-title {
            font-size: 20px;
            margin-bottom: 10px;
            color: #6c757d;
        }

        .empty-message {
            color: #6c757d;
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
    </style>
@endpush

@section('content')
    <div class="content-section">
        <h2 class="mb-4">Lớp học của tôi</h2>

        <!-- Tabs -->
        <div class="class-tabs">
            <button class="class-tab active" data-target="current">Lớp đang tham gia</button>
            <button class="class-tab" data-target="completed">Lớp đã kết thúc</button>
        </div>

        <div class="tab-content-wrapper">
            <div class="tab-content active" id="current">
                <!-- Sample class data -->
                <div class="class-list">
                    <div class="class-card" data-class-id="1">
                        <div class="class-card-body">
                            <div class="class-header">
                                <div class="class-info-container">
                                    <h3 class="class-title">Xây dựng trang Web 2 (WEB2033) - WD18304</h3>
                                    <p class="class-info"><span class="teacher-name">Giảng viên: Nguyễn Văn A</span></p>
                                    <p class="class-info"><span class="status-badge status-active">Đang học</span></p>
                                </div>
                                <button class="toggle-btn">Xem lịch học</button>
                            </div>
                        </div>
                        <div class="schedule-container">
                            <h4 class="schedule-title">Lịch học và lộ trình</h4>
                            <div class="schedule-table-wrapper">
                                <table class="schedule-table">
                                    <thead>
                                        <tr>
                                            <th>Buổi học</th>
                                            <th>Ngày</th>
                                            <th>Ca</th>
                                            <th>Người điểm danh</th>
                                            <th>Mô tả</th>
                                            <th>Trạng thái đi học</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>06/05/2024 - Monday</td>
                                            <td>1</td>
                                            <td>trangnt253</td>
                                            <td>Tích hợp(LT+TH)</td>
                                            <td><span class="status-badge status-active">Present</span></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>08/05/2024 - Wednesday</td>
                                            <td>1</td>
                                            <td>dieulinh2</td>
                                            <td>Tích hợp(LT+TH)</td>
                                            <td><span class="status-badge status-active">Present</span></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>10/05/2024 - Friday</td>
                                            <td>1</td>
                                            <td>dieulinh2</td>
                                            <td>Tích hợp(LT+TH)</td>
                                            <td><span class="status-badge status-active">Present</span></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>13/05/2024 - Monday</td>
                                            <td>1</td>
                                            <td>dieulinh2</td>
                                            <td>Tích hợp(LT+TH)</td>
                                            <td><span class="status-badge status-active">Present</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="attendance-summary">Vắng: 0/17 (0% trên tổng số buổi điểm danh)</p>
                        </div>
                    </div>

                    <div class="class-card" data-class-id="2">
                        <div class="class-card-body">
                            <div class="class-header">
                                <div class="class-info-container">
                                    <h3 class="class-title">Tiếng Anh giao tiếp (ENG2022) - ED18305</h3>
                                    <p class="class-info"><span class="teacher-name">Giảng viên: Trần Thị B</span></p>
                                    <p class="class-info"><span class="status-badge status-active">Đang học</span></p>
                                </div>
                                <button class="toggle-btn">Xem lịch học</button>
                            </div>
                        </div>
                        <div class="schedule-container">
                            <h4 class="schedule-title">Lịch học và lộ trình</h4>
                            <div class="schedule-table-wrapper">
                                <table class="schedule-table">
                                    <thead>
                                        <tr>
                                            <th>Buổi học</th>
                                            <th>Ngày</th>
                                            <th>Ca</th>
                                            <th>Người điểm danh</th>
                                            <th>Mô tả</th>
                                            <th>Trạng thái đi học</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>07/05/2024 - Tuesday</td>
                                            <td>2</td>
                                            <td>minhthu</td>
                                            <td>Tích hợp(LT+TH)</td>
                                            <td><span class="status-badge status-active">Present</span></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>09/05/2024 - Thursday</td>
                                            <td>2</td>
                                            <td>minhthu</td>
                                            <td>Tích hợp(LT+TH)</td>
                                            <td><span class="status-badge status-absent">Absent</span></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>14/05/2024 - Tuesday</td>
                                            <td>2</td>
                                            <td>minhthu</td>
                                            <td>Tích hợp(LT+TH)</td>
                                            <td><span class="status-badge status-active">Present</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="attendance-summary">Vắng: 1/15 (6.7% trên tổng số buổi điểm danh)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="completed" style="display: none;">
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg viewBox="0 0 24 24" fill="#adb5bd" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3L2 9l10 6 10-6-10-6zM2 12l10 6 10-6M2 15l10 6 10-6"></path>
                        </svg>
                    </div>
                    <h4 class="empty-title">Bạn chưa hoàn thành lớp học nào</h4>
                    <p class="empty-message">Các lớp học đã hoàn thành sẽ hiển thị ở đây.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle tab switching
            const tabs = document.querySelectorAll('.class-tab');
            const tabContents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');

                    // Update active tab
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // Show target content
                    tabContents.forEach(content => {
                        content.style.display = 'none';
                        content.classList.remove('active');
                    });

                    const targetContent = document.getElementById(target);
                    targetContent.style.display = 'block';
                    targetContent.classList.add('active');
                });
            });

            // Toggle schedule visibility
            const toggleButtons = document.querySelectorAll('.toggle-btn');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const scheduleContainer = this.closest('.class-card-body').nextElementSibling;

                    if (scheduleContainer.style.display === 'block') {
                        scheduleContainer.style.display = 'none';
                        this.textContent = 'Xem lịch học';
                    } else {
                        scheduleContainer.style.display = 'block';
                        this.textContent = 'Ẩn lịch học';
                    }
                });
            });
        });
    </script>
@endpush
