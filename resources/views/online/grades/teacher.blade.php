@extends('online.layouts.master')

@section('title', 'Quản lý điểm số')

@push('styles')
    <style>
        .class-filter {
            margin-bottom: 1.5rem;
        }
        
        .grades-header {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .grades-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
        }

        .class-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .tab-buttons {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .tab-btn {
            padding: 0.75rem 1.5rem;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            color: var(--text-muted);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .tab-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .tab-btn:hover:not(.active) {
            background: var(--bg-color);
            color: var(--text-color);
        }

        .assessment-type {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .type-quiz {
            background: rgba(56, 189, 248, 0.1);
            color: #0284c7;
        }

        .type-assignment {
            background: rgba(168, 85, 247, 0.1);
            color: #7e22ce;
        }

        .type-exam {
            background: rgba(249, 115, 22, 0.1);
            color: #c2410c;
        }

        .type-final {
            background: rgba(34, 197, 94, 0.1);
            color: #15803d;
        }

        .action-btn {
            background: transparent;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
            padding: 0.25rem;
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            color: var(--primary-dark);
            transform: scale(1.1);
        }

        .action-btn i {
            font-size: 1.25rem;
        }

        .grade-value {
            font-weight: 600;
        }

        .grade-passed {
            color: var(--success-color);
        }

        .grade-failed {
            color: var(--danger-color);
        }

        .grade-pending {
            color: var(--warning-color);
        }

        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-complete {
            background: rgba(34, 197, 94, 0.1);
            color: #15803d;
        }

        .status-pending {
            background: rgba(234, 179, 8, 0.1);
            color: #a16207;
        }

        .grade-input {
            width: 70px;
            text-align: center;
            padding: 0.375rem;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
        }

        .search-bar {
            margin-bottom: 1rem;
        }

        .batch-actions {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="content-section">
        <div class="row mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-chart-line me-2"></i>Quản lý điểm số
                    </h5>
                    <a href="{{ route('online.classes.index') }}" class="btn btn-sm btn-outline-primary back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại lớp học
                    </a>
                </div>
                <div class="card-body">
                    <!-- Class Filter -->
                    <div class="class-filter">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="classSelect" class="form-label">Chọn lớp học</label>
                                <select class="form-select" id="classSelect">
                                    <option selected>-- Chọn lớp học --</option>
                                    <option value="WD18304">WEB2033 - WD18304 - Xây dựng trang Web 2</option>
                                    <option value="WD18305">WEB2033 - WD18305 - Xây dựng trang Web 2</option>
                                    <option value="FE18301">MOB1023 - FE18301 - Lập trình Javascript</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="semesterSelect" class="form-label">Học kỳ</label>
                                <select class="form-select" id="semesterSelect">
                                    <option selected value="Spring2024">Spring 2024</option>
                                    <option value="Fall2023">Fall 2023</option>
                                    <option value="Summer2023">Summer 2023</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Class Info -->
                    <div class="grades-header">
                        <h3 class="class-title">Xây dựng trang Web 2 (WEB2033) - WD18304</h3>
                        <div class="class-info">
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">Số lượng học viên:</small>
                                    <h5 class="mb-0">35 học viên</h5>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Học kỳ:</small>
                                    <h5 class="mb-0">Spring 2024</h5>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Trạng thái:</small>
                                    <h5 class="mb-0 text-success">Đang diễn ra</h5>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Tỷ lệ hoàn thành:</small>
                                    <h5 class="mb-0">65%</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <div class="tab-buttons">
                        <button class="tab-btn active" data-target="all">Tất cả học viên</button>
                        <button class="tab-btn" data-target="incomplete">Chưa hoàn thành</button>
                        <button class="tab-btn" data-target="complete">Đã hoàn thành</button>
                    </div>

                    <!-- Search and Actions -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="search-bar">
                                <div class="input-group">
                                    <span class="input-group-text" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Tìm kiếm học viên..." aria-label="Search" aria-describedby="search-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="batch-actions d-flex justify-content-end">
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-2"></i>Thêm đánh giá
                                </button>
                                <button class="btn btn-outline-success">
                                    <i class="fas fa-file-excel me-2"></i>Xuất Excel
                                </button>
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-file-import me-2"></i>Nhập điểm
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Grades Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 40px">STT</th>
                                    <th>Mã học viên</th>
                                    <th>Họ và tên</th>
                                    <th>Lab 1 (10%)</th>
                                    <th>Quiz 1 (5%)</th>
                                    <th>Lab 2 (10%)</th>
                                    <th>Midterm (30%)</th>
                                    <th>Lab 3 (10%)</th>
                                    <th>Quiz 2 (5%)</th>
                                    <th>Lab 4 (10%)</th>
                                    <th>Final (20%)</th>
                                    <th>Trung bình</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 100px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>PS12345</td>
                                    <td>Nguyễn Văn A</td>
                                    <td><input type="text" class="grade-input" value="9.0"></td>
                                    <td><input type="text" class="grade-input" value="8.5"></td>
                                    <td><input type="text" class="grade-input" value="8.0"></td>
                                    <td><input type="text" class="grade-input" value="7.5"></td>
                                    <td><input type="text" class="grade-input" value="9.5"></td>
                                    <td><input type="text" class="grade-input" value="4.5"></td>
                                    <td><input type="text" class="grade-input" value="8.0"></td>
                                    <td><input type="text" class="grade-input" value=""></td>
                                    <td class="grade-value grade-passed">8.0</td>
                                    <td><span class="status-badge status-pending">Đang học</span></td>
                                    <td>
                                        <button class="action-btn" title="Lưu điểm">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button class="action-btn" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>PS12346</td>
                                    <td>Trần Thị B</td>
                                    <td><input type="text" class="grade-input" value="8.0"></td>
                                    <td><input type="text" class="grade-input" value="7.5"></td>
                                    <td><input type="text" class="grade-input" value="9.0"></td>
                                    <td><input type="text" class="grade-input" value="8.5"></td>
                                    <td><input type="text" class="grade-input" value="8.0"></td>
                                    <td><input type="text" class="grade-input" value="7.5"></td>
                                    <td><input type="text" class="grade-input" value="9.0"></td>
                                    <td><input type="text" class="grade-input" value="8.5"></td>
                                    <td class="grade-value grade-passed">8.3</td>
                                    <td><span class="status-badge status-complete">Hoàn thành</span></td>
                                    <td>
                                        <button class="action-btn" title="Lưu điểm">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button class="action-btn" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>PS12347</td>
                                    <td>Lê Văn C</td>
                                    <td><input type="text" class="grade-input" value="7.0"></td>
                                    <td><input type="text" class="grade-input" value="6.5"></td>
                                    <td><input type="text" class="grade-input" value="7.0"></td>
                                    <td><input type="text" class="grade-input" value="6.5"></td>
                                    <td><input type="text" class="grade-input" value="7.0"></td>
                                    <td><input type="text" class="grade-input" value="6.5"></td>
                                    <td><input type="text" class="grade-input" value="7.0"></td>
                                    <td><input type="text" class="grade-input" value=""></td>
                                    <td class="grade-value grade-passed">6.8</td>
                                    <td><span class="status-badge status-pending">Đang học</span></td>
                                    <td>
                                        <button class="action-btn" title="Lưu điểm">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button class="action-btn" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>PS12348</td>
                                    <td>Phạm Thị D</td>
                                    <td><input type="text" class="grade-input" value="9.5"></td>
                                    <td><input type="text" class="grade-input" value="9.0"></td>
                                    <td><input type="text" class="grade-input" value="9.5"></td>
                                    <td><input type="text" class="grade-input" value="9.0"></td>
                                    <td><input type="text" class="grade-input" value="9.5"></td>
                                    <td><input type="text" class="grade-input" value="9.0"></td>
                                    <td><input type="text" class="grade-input" value="9.5"></td>
                                    <td><input type="text" class="grade-input" value="9.0"></td>
                                    <td class="grade-value grade-passed">9.3</td>
                                    <td><span class="status-badge status-complete">Hoàn thành</span></td>
                                    <td>
                                        <button class="action-btn" title="Lưu điểm">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button class="action-btn" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>PS12349</td>
                                    <td>Hoàng Văn E</td>
                                    <td><input type="text" class="grade-input" value="5.0"></td>
                                    <td><input type="text" class="grade-input" value="4.5"></td>
                                    <td><input type="text" class="grade-input" value="5.0"></td>
                                    <td><input type="text" class="grade-input" value="4.5"></td>
                                    <td><input type="text" class="grade-input" value="5.0"></td>
                                    <td><input type="text" class="grade-input" value="4.5"></td>
                                    <td><input type="text" class="grade-input" value="5.0"></td>
                                    <td><input type="text" class="grade-input" value=""></td>
                                    <td class="grade-value grade-failed">4.8</td>
                                    <td><span class="status-badge status-pending">Đang học</span></td>
                                    <td>
                                        <button class="action-btn" title="Lưu điểm">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button class="action-btn" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Trước</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Sau</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab handling
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tableRows = document.querySelectorAll('tbody tr');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    const target = this.getAttribute('data-target');
                    
                    // Filter table rows based on selected tab
                    if (target === 'all') {
                        tableRows.forEach(row => row.style.display = '');
                    } else if (target === 'complete') {
                        tableRows.forEach(row => {
                            const status = row.querySelector('.status-badge').textContent.toLowerCase();
                            if (status.includes('hoàn thành')) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    } else if (target === 'incomplete') {
                        tableRows.forEach(row => {
                            const status = row.querySelector('.status-badge').textContent.toLowerCase();
                            if (status.includes('đang học')) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    }
                });
            });

            // Class selection change
            document.getElementById('classSelect').addEventListener('change', function() {
                // Here you would typically load data for the selected class
                // This is just a placeholder
                console.log('Selected class: ' + this.value);
            });

            // Save grades button (just a placeholder functionality)
            document.querySelectorAll('.action-btn[title="Lưu điểm"]').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const studentName = row.querySelector('td:nth-child(3)').textContent;
                    alert('Đã lưu điểm cho học viên: ' + studentName);
                });
            });
        });
    </script>
@endpush 