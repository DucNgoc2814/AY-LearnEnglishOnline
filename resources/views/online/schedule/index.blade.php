@extends('online.layouts.master')

@section('title', 'Lịch học')

@push('styles')
    <style>
        .schedule-container {
            margin-bottom: 20px;
        }

        .time-filter {
            margin-bottom: 20px;
        }

        .filter-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .filter-select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            font-size: 14px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333333' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
            padding-right: 32px;
        }

        .filter-select::-ms-expand {
            display: none;
        }

        .filter-hint {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }

        .schedule-header {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .schedule-icon {
            margin-right: 10px;
            color: #0066cc;
        }

        .schedule-title {
            font-size: 18px;
            font-weight: 500;
            margin: 0;
        }

        .schedule-table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .schedule-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 850px;
            background-color: #fff;
        }

        .schedule-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            padding: 14px 16px;
            text-align: left;
            border-bottom: 2px solid #e9ecef;
            position: sticky;
            top: 0;
        }

        .schedule-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #edf2f7;
            color: #333;
            vertical-align: middle;
        }

        .schedule-table tr:last-child td {
            border-bottom: none;
        }

        .schedule-table tr:hover {
            background-color: #f8faff;
        }

        .schedule-table a {
            color: #0066cc;
            text-decoration: none;
            font-weight: 500;
        }

        .schedule-table a:hover {
            text-decoration: underline;
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

        .export-buttons {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }

        .export-btn {
            padding: 6px 12px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
        }

        .export-btn:hover {
            background-color: #e0e0e0;
        }

        /* Pagination Styles */
        .pagination-container {
            background-color: #f9f9f9;
            border-radius: 6px;
            padding: 10px 15px;
            margin-top: 15px;
        }

        .pagination-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination-text {
            font-size: 14px;
            color: #555;
        }

        .pagination-per-page {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination-select {
            min-width: 65px;
            padding: 6px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            font-size: 14px;
            text-align: center;
            cursor: pointer;
        }

        .pagination-nav {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .pagination-btn {
            min-width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border: 1px solid #ddd;
            background-color: white;
            color: #333;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .pagination-btn.active {
            background-color: #0066cc;
            color: white;
            border-color: #0066cc;
            font-weight: 500;
        }

        .pagination-btn:hover:not(.active) {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        @media (max-width: 991px) {
            .export-buttons {
                justify-content: flex-start;
            }
        }

        @media (max-width: 768px) {
            .pagination-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .pagination-nav {
                margin-top: 10px;
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 576px) {
            .filter-select {
                font-size: 16px; /* Prevents iOS zoom on focus */
                max-height: 50vh; /* Limits dropdown height on mobile */
            }

            .schedule-table th,
            .schedule-table td {
                padding: 8px;
                font-size: 14px;
            }

            .export-btn {
                padding: 5px 8px;
                font-size: 12px;
            }

            .pagination-container {
                padding: 8px 10px;
            }

            .pagination-btn {
                min-width: 32px;
                height: 32px;
                font-size: 13px;
            }
        }
    </style>
@endpush

@section('content')
    {{-- <div class="content-section"> --}}
        <div class="row mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-calendar-alt me-2"></i>Lịch học
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="scheduleTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="current-tab" data-bs-toggle="tab" data-bs-target="#current"
                                type="button" role="tab" aria-controls="current" aria-selected="true">Lịch học hiện tại</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="past-tab" data-bs-toggle="tab" data-bs-target="#past"
                                type="button" role="tab" aria-controls="past" aria-selected="false">Lịch học đã qua</button>
                        </li>
                    </ul>

                    <div class="tab-content mt-4" id="scheduleTabContent">
                        <!-- Current Schedule Tab -->
                        <div class="tab-pane fade show active" id="current" role="tabpanel" aria-labelledby="current-tab">
                            <div class="time-filter">
                                <label class="filter-label">Thời gian</label>
                                <select class="filter-select">
                                    <option>90 ngày trước</option>
                                    <option>60 ngày trước</option>
                                    <option>30 ngày trước</option>
                                    <option>7 ngày trước</option>
                                </select>
                                <p class="filter-hint">Lựa chọn thời gian để hiển thị chi tiết lịch học</p>
                            </div>

                            <div class="schedule-header">
                                <span class="schedule-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#0066cc"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM5 7V6h14v1H5z" />
                                        <path d="M7 11h5v5H7z" />
                                    </svg>
                                </span>
                                <h3 class="schedule-title">Lịch học</h3>
                            </div>

                            <div class="schedule-table-wrapper">
                                <table class="schedule-table">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ngày</th>
                                            <th>Mã môn</th>
                                            <th>Môn</th>
                                            <th>Lớp</th>
                                            <th>Giảng viên</th>
                                            <th>Thời gian</th>
                                            <th>Link học trực tuyến</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>05/05/2024</td>
                                            <td>WEB2033</td>
                                            <td>Xây dựng trang Web 2</td>
                                            <td>WD18304</td>
                                            <td>Nguyễn Văn A</td>
                                            <td>07:30 - 11:30</td>
                                            <td><a href="#" class="text-primary">Link</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>07/05/2024</td>
                                            <td>ENG2022</td>
                                            <td>Tiếng Anh giao tiếp</td>
                                            <td>ED18305</td>
                                            <td>Trần Thị B</td>
                                            <td>13:30 - 17:30</td>
                                            <td><a href="#" class="text-primary">Link</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>09/05/2024</td>
                                            <td>MOB1023</td>
                                            <td>Lập trình di động</td>
                                            <td>MD18301</td>
                                            <td>Lê Văn C</td>
                                            <td>18:00 - 21:00</td>
                                            <td><a href="#" class="text-primary">Link</a></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>11/05/2024</td>
                                            <td>WEB2033</td>
                                            <td>Xây dựng trang Web 2</td>
                                            <td>WD18304</td>
                                            <td>Nguyễn Văn A</td>
                                            <td>07:30 - 11:30</td>
                                            <td><button class="btn btn-primary btn-sm">Vào học</button></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>14/05/2024</td>
                                            <td>ENG2022</td>
                                            <td>Tiếng Anh giao tiếp</td>
                                            <td>ED18305</td>
                                            <td>Trần Thị B</td>
                                            <td>13:30 - 17:30</td>
                                            <td><a href="#" class="text-primary">Link</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination-container">
                                <div class="pagination-info">
                                    <div class="pagination-text">Đang xem <strong>1</strong> đến <strong>5</strong> trong tổng số
                                        <strong>10</strong> mục
                                    </div>
                                    <div class="pagination-per-page">
                                        <span>Hiển thị</span>
                                        <select class="pagination-select">
                                            <option>10</option>
                                            <option>25</option>
                                            <option>50</option>
                                            <option>100</option>
                                        </select>
                                        <span>mục trên trang</span>
                                    </div>
                                </div>

                                <div class="pagination-nav">
                                    <button class="pagination-btn disabled" aria-label="Trang đầu">
                                        <i class="fas fa-angle-double-left"></i>
                                    </button>
                                    <button class="pagination-btn disabled" aria-label="Trang trước">
                                        <i class="fas fa-angle-left"></i>
                                    </button>
                                    <button class="pagination-btn active">1</button>
                                    <button class="pagination-btn">2</button>
                                    <button class="pagination-btn" aria-label="Trang sau">
                                        <i class="fas fa-angle-right"></i>
                                    </button>
                                    <button class="pagination-btn" aria-label="Trang cuối">
                                        <i class="fas fa-angle-double-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Past Schedule Tab -->
                        <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg viewBox="0 0 24 24" fill="#adb5bd" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM5 7V6h14v1H5z" />
                                        <path d="M7 11h5v5H7z" />
                                    </svg>
                                </div>
                                <h4 class="empty-title">Lịch học đã qua hiện chưa có dữ liệu</h4>
                                <p class="empty-message">Lịch học đã qua sẽ được hiển thị ở đây khi có sẵn.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div>  --}}
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle filter change
            const filterSelect = document.querySelector('.filter-select');
            const paginationButtons = document.querySelectorAll('.pagination-btn:not(.disabled)');
            paginationButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (!this.classList.contains('active')) {
                        const pages = document.querySelectorAll(
                            '.pagination-btn:not([aria-label])');
                        pages.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');

                        console.log('Navigating to page:', this.textContent.trim() || this
                            .getAttribute('aria-label'));
                        // Page navigation logic would go here
                    }
                });
            });

        });
    </script>
@endpush
