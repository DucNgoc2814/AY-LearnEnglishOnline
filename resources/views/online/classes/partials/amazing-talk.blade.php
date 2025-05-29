<div class="amazing-talk-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">
            <i class="fas fa-comments me-2"></i> Amazing Talk - Luyện nói tiếng Anh
        </h5>
        <span class="badge {{ $class->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
            {{ $class->status === 'active' ? 'Đang hoạt động' : 'Chưa kích hoạt' }}
        </span>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="amazing-talk-info mb-4">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Giảng viên phụ trách:</div>
                    <div class="col-md-9">
                        {{ $class->teacher->name ?? 'Chưa phân công' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Thời gian:</div>
                    <div class="col-md-9">
                        {{ $class->formatted_schedule ?? 'Đang cập nhật' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Link phòng học:</div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $class->amazing_talk_link ?? 'https://meet.google.com/abc-defg-hij' }}" readonly>
                            <button class="btn btn-outline-primary copy-btn" type="button" data-clipboard-text="{{ $class->amazing_talk_link ?? 'https://meet.google.com/abc-defg-hij' }}">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-info-circle fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading">Thông tin Amazing Talk</h5>
                        <p class="mb-0">Amazing Talk là chương trình luyện nói tiếng Anh với giảng viên bản ngữ, giúp bạn nâng cao kỹ năng giao tiếp và phát âm chuẩn.</p>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                <a href="{{ $class->amazing_talk_link ?? '#' }}" target="_blank" class="btn btn-primary">
                    <i class="fas fa-video me-2"></i> Tham gia buổi học
                </a>
                <a href="#" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#guideModal">
                    <i class="fas fa-book me-2"></i> Hướng dẫn chuẩn bị
                </a>
            </div>
        </div>
    </div>

    <div class="accordion" id="amazingTalkAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#upcomingSessions" aria-expanded="true">
                    <i class="fas fa-calendar-alt me-2"></i> Lịch Amazing Talk
                </button>
            </h2>
            <div id="upcomingSessions" class="accordion-collapse collapse show" data-bs-parent="#amazingTalkAccordion">
                <div class="accordion-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ngày</th>
                                    <th>Thời gian</th>
                                    <th>Chủ đề</th>
                                    <th>Giảng viên</th>
                                    <th>Trạng thái</th>
                                    <th>Tài liệu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($class->amazingTalkSessions ?? [] as $session)
                                <tr>
                                    <td>{{ $session->scheduled_at->format('d/m/Y') }}</td>
                                    <td>{{ $session->scheduled_at->format('H:i') }} - {{ $session->scheduled_at->addHours(2)->format('H:i') }}</td>
                                    <td>{{ $session->topic }}</td>
                                    <td>{{ $session->teacher->name }}</td>
                                    <td>
                                        @if($session->status === 'upcoming')
                                            <span class="badge bg-primary">Sắp diễn ra</span>
                                        @elseif($session->status === 'completed')
                                            <span class="badge bg-success">Đã hoàn thành</span>
                                        @else
                                            <span class="badge bg-secondary">Chưa diễn ra</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($session->materials)
                                            <a href="{{ $session->materials_url }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Chưa có buổi Amazing Talk nào được lên lịch
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hướng dẫn -->
<div class="modal fade" id="guideModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-book me-2"></i>
                    Hướng dẫn chuẩn bị Amazing Talk
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="guide-steps">
                    <div class="step mb-3">
                        <h6><i class="fas fa-check-circle me-2 text-success"></i>Trước buổi học</h6>
                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-angle-right me-2"></i>Tải và xem trước tài liệu</li>
                            <li><i class="fas fa-angle-right me-2"></i>Chuẩn bị tai nghe và micro</li>
                            <li><i class="fas fa-angle-right me-2"></i>Chọn nơi yên tĩnh để học</li>
                        </ul>
                    </div>
                    <div class="step mb-3">
                        <h6><i class="fas fa-video me-2 text-primary"></i>Trong buổi học</h6>
                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-angle-right me-2"></i>Tham gia đúng giờ</li>
                            <li><i class="fas fa-angle-right me-2"></i>Bật camera để tương tác tốt hơn</li>
                            <li><i class="fas fa-angle-right me-2"></i>Tích cực tham gia thảo luận</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize clipboard.js for copy buttons
        if (typeof ClipboardJS !== 'undefined') {
            new ClipboardJS('.copy-btn');

            // Show tooltip on copy
            document.querySelectorAll('.copy-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 1500);
                });
            });
        }
    });
</script>
@endpush
