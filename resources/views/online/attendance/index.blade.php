@extends('online.layouts.master')

@section('title', 'Quản lý điểm danh')

@push('styles')
    <style>
        .class-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: var(--transition);
            height: 100%;
            position: relative;
        }
        
        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-color);
        }
        
        .class-header {
            background: var(--bg-color);
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .class-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
        }
        
        .class-body {
            padding: 1.5rem;
            background: var(--card-bg);
        }
        
        .class-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .class-info {
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .class-info i {
            color: var(--primary-color);
            width: 1.25rem;
        }
        
        .class-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--border-color);
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .class-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            gap: 0.375rem;
        }

        .badge-active {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: var(--success-color);
        }

        .badge-completed {
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            color: var(--text-muted);
        }

        .badge-upcoming {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: var(--primary-color);
        }

        .filter-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            margin-bottom: 1.5rem;
        }

        .filter-card .card-body {
            padding: 1.5rem;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .form-select {
            border-radius: var(--border-radius-sm);
            border-color: var(--border-color);
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            color: var(--text-color);
            transition: var(--transition);
        }

        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border: none;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            border-radius: var(--border-radius-sm);
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        .btn-outline-primary {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            border-radius: var(--border-radius-sm);
            transition: var(--transition);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        @media (max-width: 768px) {
            .class-header, .class-body {
                padding: 1rem;
            }

            .class-stats {
                gap: 0.75rem;
                margin-top: 1rem;
                padding-top: 1rem;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .filter-card .card-body {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-section">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Danh sách lớp học</h2>
            <div>
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter me-2"></i>Lọc lớp học
                </button>
            </div>
        </div>

        <!-- Form lọc lớp học -->
        <div class="filter-card">
            <div class="card-body">
                <form action="" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="course_type" class="form-label">Loại khóa học</label>
                        <select name="course_type" id="course_type" class="form-select">
                            <option value="">Tất cả loại</option>
                            <option value="basic">Tiếng Anh cơ bản</option>
                            <option value="communication">Tiếng Anh giao tiếp</option>
                            <option value="business">Tiếng Anh thương mại</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="level" class="form-label">Cấp độ</label>
                        <select name="level" id="level" class="form-select">
                            <option value="">Tất cả cấp độ</option>
                            <option value="a1">A1</option>
                            <option value="a2">A2</option>
                            <option value="b1">B1</option>
                            <option value="b2">B2</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active">Đang học</option>
                            <option value="completed">Đã kết thúc</option>
                            <option value="upcoming">Sắp khai giảng</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Áp dụng
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danh sách lớp học -->
        <div class="row g-4">
            <!-- Lớp 1: Đang học -->
            <div class="col-md-6 col-lg-4">
                <div class="class-card">
                    <div class="class-header">
                        <div class="class-title">
                            <span>Tiếng Anh cơ bản A1</span>
                            <span class="class-badge badge-active">
                                <i class="fas fa-play"></i>
                                <span>Đang học</span>
                            </span>
                        </div>
                        <div class="class-info">
                            <i class="fas fa-users"></i>
                            <span>25 học viên</span>
                        </div>
                        <div class="class-info">
                            <i class="fas fa-calendar-alt"></i>
                            <span>T2 - T4 - T6</span>
                        </div>
                        <div class="class-info">
                            <i class="fas fa-clock"></i>
                            <span>18:00 - 20:00</span>
                        </div>
                    </div>
                    <div class="class-body">
                        <div class="class-stats">
                            <div class="stat-item">
                                <div class="stat-value">24</div>
                                <div class="stat-label">Tổng buổi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">16</div>
                                <div class="stat-label">Đã học</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">8</div>
                                <div class="stat-label">Còn lại</div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('online.attendance.sessions', ['class' => 1]) }}" class="btn btn-primary w-100">
                                <i class="fas fa-calendar-check me-2"></i>Xem buổi học
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lớp 2: Sắp khai giảng -->
            <div class="col-md-6 col-lg-4">
                <div class="class-card">
                    <div class="class-header">
                        <div class="class-title">
                            <span>Tiếng Anh giao tiếp B1</span>
                            <span class="class-badge badge-upcoming">
                                <i class="fas fa-hourglass-start"></i>
                                <span>Sắp khai giảng</span>
                            </span>
                        </div>
                        <div class="class-info">
                            <i class="fas fa-users"></i>
                            <span>20 học viên</span>
                        </div>
                        <div class="class-info">
                            <i class="fas fa-calendar-alt"></i>
                            <span>T3 - T5 - T7</span>
                        </div>
                        <div class="class-info">
                            <i class="fas fa-clock"></i>
                            <span>18:30 - 20:30</span>
                        </div>
                    </div>
                    <div class="class-body">
                        <div class="class-stats">
                            <div class="stat-item">
                                <div class="stat-value">30</div>
                                <div class="stat-label">Tổng buổi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Đã học</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">30</div>
                                <div class="stat-label">Còn lại</div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('online.attendance.sessions', ['class' => 2]) }}" class="btn btn-primary w-100">
                                <i class="fas fa-calendar-check me-2"></i>Xem buổi học
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lớp 3: Đã kết thúc -->
            <div class="col-md-6 col-lg-4">
                <div class="class-card">
                    <div class="class-header">
                        <div class="class-title">
                            <span>Tiếng Anh thương mại B2</span>
                            <span class="class-badge badge-completed">
                                <i class="fas fa-check"></i>
                                <span>Đã kết thúc</span>
                            </span>
                        </div>
                        <div class="class-info">
                            <i class="fas fa-users"></i>
                            <span>15 học viên</span>
                        </div>
                        <div class="class-info">
                            <i class="fas fa-calendar-alt"></i>
                            <span>T2 - T4 - T6</span>
                        </div>
                        <div class="class-info">
                            <i class="fas fa-clock"></i>
                            <span>19:00 - 21:00</span>
                        </div>
                    </div>
                    <div class="class-body">
                        <div class="class-stats">
                            <div class="stat-item">
                                <div class="stat-value">36</div>
                                <div class="stat-label">Tổng buổi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">36</div>
                                <div class="stat-label">Đã học</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Còn lại</div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('online.attendance.sessions', ['class' => 3]) }}" class="btn btn-primary w-100">
                                <i class="fas fa-calendar-check me-2"></i>Xem buổi học
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
