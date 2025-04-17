@php
    $upcomingSessions = $class->sessions()
        ->where('start_time', '>', now())
        ->orderBy('start_time')
        ->take(5)
        ->get();
@endphp

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Buổi học sắp tới</h5>
                <a href="{{ route('online.teacher.classes.sessions.index', $class->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-calendar"></i>
                    Xem tất cả
                </a>
            </div>
            <div class="card-body">
                @if($upcomingSessions->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Thời gian</th>
                                    <th>Phòng học</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($upcomingSessions as $session)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $session->start_time->format('d/m/Y') }}</div>
                                        <div class="text-muted">{{ $session->start_time->format('H:i') }} - {{ $session->end_time->format('H:i') }}</div>
                                    </td>
                                    <td>{{ $session->room }}</td>
                                    <td>{{ $session->content }}</td>
                                    <td>
                                        <span class="badge bg-{{ $session->status_color }}">
                                            {{ $session->status_text }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('online.teacher.classes.attendance', ['class' => $class->id, 'session' => $session->id]) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-clipboard-check"></i>
                                            Điểm danh
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-calendar-times fa-3x mb-3"></i>
                        <p>Không có buổi học nào sắp tới</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Thông tin lớp học</h5>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Khóa học:</dt>
                    <dd class="col-sm-8">{{ $class->course->name }}</dd>

                    <dt class="col-sm-4">Trình độ:</dt>
                    <dd class="col-sm-8">{{ $class->level }}</dd>

                    <dt class="col-sm-4">Ngày bắt đầu:</dt>
                    <dd class="col-sm-8">{{ $class->start_date->format('d/m/Y') }}</dd>

                    <dt class="col-sm-4">Ngày kết thúc:</dt>
                    <dd class="col-sm-8">{{ $class->end_date->format('d/m/Y') }}</dd>

                    <dt class="col-sm-4">Lịch học:</dt>
                    <dd class="col-sm-8">{{ $class->schedule }}</dd>

                    <dt class="col-sm-4">Phòng học:</dt>
                    <dd class="col-sm-8">{{ $class->room }}</dd>

                    <dt class="col-sm-4">Sĩ số:</dt>
                    <dd class="col-sm-8">{{ $class->students->count() }}/{{ $class->max_students }}</dd>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thông báo lớp học</h5>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="card-body">
                @if($class->announcements->count() > 0)
                    @foreach($class->announcements as $announcement)
                    <div class="announcement-item mb-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6 class="mb-1">{{ $announcement->title }}</h6>
                            <small class="text-muted">{{ $announcement->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-0">{{ $announcement->content }}</p>
                    </div>
                    @endforeach
                @else
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-bullhorn fa-3x mb-3"></i>
                        <p>Chưa có thông báo nào</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Create Announcement Modal -->
<div class="modal fade" id="createAnnouncementModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tạo thông báo mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('online.teacher.classes.announcements.store', $class->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Tạo thông báo</button>
                </div>
            </form>
        </div>
    </div>
</div> 