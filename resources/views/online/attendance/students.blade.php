@extends('online.layouts.master')

@section('title', 'Điểm danh học sinh')

@push('styles')
    <style>
        .attendance-header {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .attendance-header::before {
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

        .attendance-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
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

        .stat-card.present {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        }

        .stat-card.absent {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.75rem;
        }

        .stat-card.present .stat-value {
            color: var(--success-color);
        }

        .stat-card.absent .stat-value {
            color: var(--danger-color);
        }

        .stat-label {
            color: var(--text-color);
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-card.present .stat-label i {
            color: var(--success-color);
        }

        .stat-card.absent .stat-label i {
            color: var(--danger-color);
        }

        .student-list {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .student-avatar {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        tr:hover .student-avatar {
            border-color: var(--primary-color);
            transform: scale(1.1);
        }

        .student-name {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.25rem;
            transition: var(--transition);
        }

        tr:hover .student-name {
            color: var(--primary-color);
        }

        .student-id {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .attendance-status {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            gap: 0.5rem;
        }

        .status-present {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: var(--success-color);
        }

        .status-absent {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: var(--danger-color);
        }

        .attendance-btn {
            width: 3rem;
            height: 3rem;
            padding: 0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            border: 2px solid transparent;
            background: var(--bg-color);
        }

        .attendance-btn i {
            font-size: 1.25rem;
            transition: var(--transition);
        }

        .attendance-btn.present {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: var(--success-color);
            border-color: var(--success-color);
        }

        .attendance-btn.absent {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .attendance-btn:hover {
            transform: scale(1.1);
        }

        .attendance-btn:hover.present {
            background: var(--success-color);
            color: white;
        }

        .attendance-btn:hover.absent {
            background: var(--danger-color);
            color: white;
        }

        .mark-all-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .mark-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .table {
            margin: 0;
        }

        .table th {
            background: var(--bg-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border-color);
        }

        .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: var(--primary-light);
        }

        @media (max-width: 768px) {
            .attendance-stats {
                grid-template-columns: 1fr;
            }

            .attendance-header {
                padding: 1.5rem;
            }

            .class-title {
                font-size: 1.25rem;
            }

            .student-avatar {
                width: 2.5rem;
                height: 2.5rem;
            }

            .attendance-btn {
                width: 2.5rem;
                height: 2.5rem;
            }

            .table th,
            .table td {
                padding: 0.75rem 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    <div class="content-section">
        <div class="attendance-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h4 class="class-title">Tiếng Anh cơ bản A1</h4>
                    <div class="class-info">
                        <span><i class="fas fa-book-open me-2"></i>Buổi 16 - Unit 8: Daily Activities</span>
                        <span><i class="fas fa-calendar me-2"></i>15/03/2024</span>
                        <span><i class="fas fa-clock me-2"></i>18:00 - 20:00</span>
                    </div>
                </div>
                <button class="mark-all-btn" id="markAllPresent">
                    <i class="fas fa-user-check"></i>
                    <span>Điểm danh tất cả có mặt</span>
                </button>
            </div>
        </div>

        <!-- Stats -->
        <div class="attendance-stats">
            <div class="stat-card present">
                <div class="stat-value">15</div>
                <div class="stat-label">
                    <i class="fas fa-user-check"></i>
                    <span>Có mặt</span>
                </div>
            </div>
            <div class="stat-card absent">
                <div class="stat-value">5</div>
                <div class="stat-label">
                    <i class="fas fa-user-times"></i>
                    <span>Vắng mặt</span>
                </div>
            </div>
        </div>

        <!-- Student List -->
        <div class="student-list">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>Học viên</th>
                            <th style="width: 200px">Trạng thái</th>
                            <th style="width: 100px" class="text-center">Điểm danh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Học viên 1 -->
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="student-info">
                                    <img src="https://via.placeholder.com/150" alt="Avatar" class="student-avatar">
                                    <div>
                                        <div class="student-name">Nguyễn Văn A</div>
                                        <div class="student-id">ID: ST001</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="attendance-status status-present">
                                    <i class="fas fa-check"></i>
                                    <span>Có mặt</span>
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="attendance-btn present" data-student-id="1">
                                    <i class="fas fa-user"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Học viên 2 -->
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="student-info">
                                    <img src="https://via.placeholder.com/150" alt="Avatar" class="student-avatar">
                                    <div>
                                        <div class="student-name">Trần Thị B</div>
                                        <div class="student-id">ID: ST002</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="attendance-status status-absent">
                                    <i class="fas fa-times"></i>
                                    <span>Vắng mặt</span>
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="attendance-btn absent" data-student-id="2">
                                    <i class="fas fa-user"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Học viên 3 -->
                        <tr>
                            <td>3</td>
                            <td>
                                <div class="student-info">
                                    <img src="https://via.placeholder.com/150" alt="Avatar" class="student-avatar">
                                    <div>
                                        <div class="student-name">Lê Văn C</div>
                                        <div class="student-id">ID: ST003</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="attendance-status status-absent">
                                    <i class="fas fa-times"></i>
                                    <span>Vắng mặt</span>
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="attendance-btn absent" data-student-id="3">
                                    <i class="fas fa-user"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện điểm danh tất cả có mặt
            $('#markAllPresent').click(function() {
                if (confirm('Bạn có chắc chắn muốn điểm danh tất cả học viên có mặt?')) {
                    $('.attendance-btn').each(function() {
                        $(this).removeClass('absent').addClass('present');
                        const statusSpan = $(this).closest('tr').find('.attendance-status');
                        statusSpan.removeClass('status-absent').addClass('status-present')
                            .html('<i class="fas fa-check"></i><span>Có mặt</span>');
                    });
                    // TODO: Gọi API điểm danh tất cả
                    alert('Đã điểm danh tất cả học viên có mặt!');
                }
            });

            // Xử lý sự kiện điểm danh từng học viên
            $('.attendance-btn').click(function() {
                const button = $(this);
                const studentId = button.data('student-id');
                const statusSpan = button.closest('tr').find('.attendance-status');

                if (button.hasClass('present')) {
                    // Chuyển sang trạng thái vắng mặt
                    button.removeClass('present').addClass('absent');
                    statusSpan.removeClass('status-present').addClass('status-absent')
                        .html('<i class="fas fa-times"></i><span>Vắng mặt</span>');
                } else {
                    // Chuyển sang trạng thái có mặt
                    button.removeClass('absent').addClass('present');
                    statusSpan.removeClass('status-absent').addClass('status-present')
                        .html('<i class="fas fa-check"></i><span>Có mặt</span>');
                }

                // TODO: Gọi API cập nhật trạng thái điểm danh
            });
        });
    </script>
@endpush
