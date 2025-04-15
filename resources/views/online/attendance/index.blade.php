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
        <div class="row mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-user-check me-2"></i>Quản lý điểm danh
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="attendanceTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="classes-tab" data-bs-toggle="tab" data-bs-target="#classes"
                                type="button" role="tab" aria-controls="classes" aria-selected="true">Lớp học</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="filter-tab" data-bs-toggle="tab" data-bs-target="#filter"
                                type="button" role="tab" aria-controls="filter" aria-selected="false">Bộ lọc</button>
                        </li>
                    </ul>

                    <div class="tab-content mt-4" id="attendanceTabContent">
                        <!-- Classes Tab -->
                        <div class="tab-pane fade show active" id="classes" role="tabpanel" aria-labelledby="classes-tab">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Mã lớp</th>
                                            <th>Tên lớp</th>
                                            <th>Trạng thái</th>
                                            <th>Học viên</th>
                                            <th>Lịch học</th>
                                            <th>Giờ học</th>
                                            <th>Tiến độ</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Lớp 1: Đang học -->
                                        <tr>
                                            <td><span class="badge bg-light text-dark">TA-CB-A1-01</span></td>
                                            <td class="fw-medium">Tiếng Anh cơ bản A1</td>
                                            <td>
                                                <span class="badge bg-success rounded-pill">
                                                    <i class="fas fa-play me-1"></i>Đang học
                                                </span>
                                            </td>
                                            <td><i class="fas fa-users text-primary me-1"></i>25 học viên</td>
                                            <td><i class="fas fa-calendar-alt text-primary me-1"></i>T2 - T4 - T6</td>
                                            <td><i class="fas fa-clock text-primary me-1"></i>18:00 - 20:00</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66.7%;" aria-valuenow="16" aria-valuemin="0" aria-valuemax="24"></div>
                                                    </div>
                                                    <span class="small text-muted">16/24 buổi</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('online.attendance.sessions', ['class' => 1]) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-calendar-check me-1"></i>Xem buổi học
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        <!-- Lớp 2: Sắp khai giảng -->
                                        <tr>
                                            <td><span class="badge bg-light text-dark">TA-GT-B1-01</span></td>
                                            <td class="fw-medium">Tiếng Anh giao tiếp B1</td>
                                            <td>
                                                <span class="badge bg-info rounded-pill">
                                                    <i class="fas fa-hourglass-start me-1"></i>Sắp khai giảng
                                                </span>
                                            </td>
                                            <td><i class="fas fa-users text-primary me-1"></i>20 học viên</td>
                                            <td><i class="fas fa-calendar-alt text-primary me-1"></i>T3 - T5 - T7</td>
                                            <td><i class="fas fa-clock text-primary me-1"></i>18:30 - 20:30</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="30"></div>
                                                    </div>
                                                    <span class="small text-muted">0/30 buổi</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('online.attendance.sessions', ['class' => 2]) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-calendar-check me-1"></i>Xem buổi học
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        <!-- Lớp 3: Đã kết thúc -->
                                        <tr>
                                            <td><span class="badge bg-light text-dark">TA-TM-B2-01</span></td>
                                            <td class="fw-medium">Tiếng Anh thương mại B2</td>
                                            <td>
                                                <span class="badge bg-secondary rounded-pill">
                                                    <i class="fas fa-check me-1"></i>Đã kết thúc
                                                </span>
                                            </td>
                                            <td><i class="fas fa-users text-primary me-1"></i>15 học viên</td>
                                            <td><i class="fas fa-calendar-alt text-primary me-1"></i>T2 - T4 - T6</td>
                                            <td><i class="fas fa-clock text-primary me-1"></i>19:00 - 21:00</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="36" aria-valuemin="0" aria-valuemax="36"></div>
                                                    </div>
                                                    <span class="small text-muted">36/36 buổi</span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('online.attendance.sessions', ['class' => 3]) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-calendar-check me-1"></i>Xem buổi học
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Filter Tab -->
                        <div class="tab-pane fade" id="filter" role="tabpanel" aria-labelledby="filter-tab">
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
                </div>
            </div>
        </div>
    </div>
@endsection
