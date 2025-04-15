@extends('online.layouts.master')

@section('title', 'Danh sách buổi học')

@push('styles')
    <style>
        .sessions-header {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .sessions-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
        }

        .class-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .class-info {
            color: var(--text-muted);
            font-size: 0.875rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .class-info i {
            color: var(--primary-color);
        }

        .sessions-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .stat-card.total {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        }

        .stat-card.completed {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        }

        .stat-card.remaining {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.75rem;
        }

        .stat-card.total .stat-value {
            color: #0284c7;
        }

        .stat-card.completed .stat-value {
            color: var(--success-color);
        }

        .stat-card.remaining .stat-value {
            color: #d97706;
        }

        .stat-label {
            color: var(--text-color);
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-card.total .stat-label i {
            color: #0284c7;
        }

        .stat-card.completed .stat-label i {
            color: var(--success-color);
        }

        .stat-card.remaining .stat-label i {
            color: #d97706;
        }

        .sessions-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .session-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: var(--transition);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .session-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .session-card.completed {
            border-left: 4px solid #22c55e;
        }

        .session-card.in-progress {
            border-left: 4px solid #eab308;
        }

        .session-card.upcoming {
            border-left: 4px solid #ef4444;
        }

        .session-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background: var(--bg-color);
        }

        .session-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .session-title i {
            color: var(--primary-color);
        }

        .session-date {
            color: var(--text-muted);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .session-date i {
            color: var(--primary-color);
        }

        .session-body {
            padding: 1.5rem;
        }

        .session-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-color);
            font-size: 0.875rem;
        }

        .info-item i {
            width: 1.5rem;
            height: 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary-color);
            font-size: 0.75rem;
        }

        .session-footer {
            padding: 1rem 1.5rem;
            background: var(--bg-color);
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }

        .session-status {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            gap: 0.5rem;
            width: 100%;
            justify-content: center;
        }

        .status-completed {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-in-progress {
            background: #fef9c3;
            color: #ca8a04;
        }

        .status-upcoming {
            background: #fee2e2;
            color: #dc2626;
        }

        .session-action {
            display: block;
            width: 100%;
            text-align: center;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            margin-top: 0.75rem;
        }

        .session-action:hover {
            background: var(--primary-dark);
            color: white;
        }

        .session-action.disabled {
            background: var(--border-color);
            cursor: not-allowed;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .sessions-header {
                padding: 1.5rem;
            }

            .class-title {
                font-size: 1.25rem;
            }

            .sessions-stats {
                grid-template-columns: 1fr;
            }

            .sessions-list {
                grid-template-columns: 1fr;
            }

            .session-header {
                padding: 1rem;
            }

            .session-body {
                padding: 1rem;
            }

            .session-footer {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-section">
        <!-- Header -->
        <div class="sessions-header">
            <h4 class="class-title">Tiếng Anh cơ bản A1</h4>
            <div class="class-info">
                <span><i class="fas fa-users me-2"></i>20 học viên</span>
                <span><i class="fas fa-calendar me-2"></i>Thứ 2, 4, 6</span>
                <span><i class="fas fa-clock me-2"></i>18:00 - 20:00</span>
            </div>
        </div>

        <!-- Stats -->
        <div class="sessions-stats">
            <div class="stat-card total">
                <div class="stat-value">30</div>
                <div class="stat-label">
                    <i class="fas fa-book"></i>
                    <span>Tổng số buổi</span>
                </div>
            </div>
            <div class="stat-card completed">
                <div class="stat-value">16</div>
                <div class="stat-label">
                    <i class="fas fa-check"></i>
                    <span>Đã học</span>
                </div>
            </div>
            <div class="stat-card remaining">
                <div class="stat-value">14</div>
                <div class="stat-label">
                    <i class="fas fa-hourglass-half"></i>
                    <span>Còn lại</span>
                </div>
            </div>
        </div>

        <!-- Sessions List -->
        <div class="sessions-list">
            <!-- Session Card 1 -->
            <div class="session-card completed">
                <div class="session-header">
                    <div class="session-title">
                        <i class="fas fa-book-open"></i>
                        <span>Buổi 16 - Unit 8: Daily Activities</span>
                    </div>
                    <div class="session-date">
                        <i class="fas fa-calendar"></i>
                        <span>15/03/2024</span>
                        <i class="fas fa-clock ms-2"></i>
                        <span>18:00 - 20:00</span>
                    </div>
                </div>
                <div class="session-body">
                    <div class="session-info">
                        <div class="info-item">
                            <i class="fas fa-users"></i>
                            <span>Sĩ số: 20/20 học viên</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-user-check"></i>
                            <span>Có mặt: 15 học viên</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-user-times"></i>
                            <span>Vắng mặt: 5 học viên</span>
                        </div>
                    </div>
                </div>
                <div class="session-footer">
                    <span class="session-status status-completed">
                        <i class="fas fa-check"></i>
                        <span>Đã học</span>
                    </span>
                    <a href="{{ route('online.attendance.detail', ['id' => 1]) }}" class="session-action">
                        <i class="fas fa-eye"></i>
                        <span>Xem chi tiết</span>
                    </a>
                </div>
            </div>

            <!-- Session Card 2 -->
            <div class="session-card in-progress">
                <div class="session-header">
                    <div class="session-title">
                        <i class="fas fa-book-open"></i>
                        <span>Buổi 17 - Unit 9: Hobbies</span>
                    </div>
                    <div class="session-date">
                        <i class="fas fa-calendar"></i>
                        <span>18/03/2024</span>
                        <i class="fas fa-clock ms-2"></i>
                        <span>18:00 - 20:00</span>
                    </div>
                </div>
                <div class="session-body">
                    <div class="session-info">
                        <div class="info-item">
                            <i class="fas fa-users"></i>
                            <span>Sĩ số: 20/20 học viên</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-user-check"></i>
                            <span>Chưa điểm danh</span>
                        </div>
                    </div>
                </div>
                <div class="session-footer">
                    <span class="session-status status-in-progress">
                        <i class="fas fa-clock"></i>
                        <span>Đang học</span>
                    </span>
                    <a href="#" class="session-action">
                        <i class="fas fa-eye"></i>
                        <span>Xem chi tiết</span>
                    </a>
                </div>
            </div>

            <!-- Session Card 3 -->
            <div class="session-card upcoming">
                <div class="session-header">
                    <div class="session-title">
                        <i class="fas fa-book-open"></i>
                        <span>Buổi 18 - Unit 10: Weather</span>
                    </div>
                    <div class="session-date">
                        <i class="fas fa-calendar"></i>
                        <span>20/03/2024</span>
                        <i class="fas fa-clock ms-2"></i>
                        <span>18:00 - 20:00</span>
                    </div>
                </div>
                <div class="session-body">
                    <div class="session-info">
                        <div class="info-item">
                            <i class="fas fa-users"></i>
                            <span>Sĩ số: 20/20 học viên</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-user-check"></i>
                            <span>Chưa điểm danh</span>
                        </div>
                    </div>
                </div>
                <div class="session-footer">
                    <span class="session-status status-upcoming">
                        <i class="fas fa-clock"></i>
                        <span>Chưa học</span>
                    </span>
                    <a href="#" class="session-action">
                        <i class="fas fa-eye"></i>
                        <span>Xem chi tiết</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
