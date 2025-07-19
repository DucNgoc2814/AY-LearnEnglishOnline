<div class="zoom-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">
            <i class="fas fa-video me-2"></i> Link Zoom phòng học trực tuyến
        </h5>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="zoom-info mb-4">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Link tham gia:</div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" value="https://zoom.us/j/98765432109?pwd=abc123" readonly>
                            <button class="btn btn-outline-primary copy-btn" type="button" data-clipboard-text="https://zoom.us/j/98765432109?pwd=abc123">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Meeting ID:</div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" value="987 6543 2109" readonly>
                            <button class="btn btn-outline-primary copy-btn" type="button" data-clipboard-text="987 6543 2109">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Passcode:</div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control" value="abc123" readonly>
                            <button class="btn btn-outline-primary copy-btn" type="button" data-clipboard-text="abc123">
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
                        <h5 class="alert-heading">Hướng dẫn tham gia</h5>
                        <p class="mb-0">Bạn có thể tham gia buổi học bằng cách nhấp vào liên kết trên hoặc nhập Meeting ID và Passcode vào ứng dụng Zoom.</p>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                <a href="https://zoom.us/j/98765432109?pwd=abc123" target="_blank" class="btn btn-primary">
                    <i class="fas fa-video me-2"></i> Tham gia ngay
                </a>
                <a href="#" class="btn btn-outline-secondary">
                    <i class="fas fa-download me-2"></i> Tải ứng dụng Zoom
                </a>
            </div>
        </div>
    </div>

    <div class="accordion" id="scheduleAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#upcomingSchedule" aria-expanded="true">
                    <i class="fas fa-calendar-alt me-2"></i> Lịch học sắp tới
                </button>
            </h2>
            <div id="upcomingSchedule" class="accordion-collapse collapse show" data-bs-parent="#scheduleAccordion">
                <div class="accordion-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Ngày</th>
                                    <th>Thời gian</th>
                                    <th>Chủ đề</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>15/05/2023</td>
                                    <td>19:00 - 21:00</td>
                                    <td>Bài 1: Giới thiệu khóa học</td>
                                    <td><span class="badge bg-success">Đã diễn ra</span></td>
                                </tr>
                                <tr>
                                    <td>22/05/2023</td>
                                    <td>19:00 - 21:00</td>
                                    <td>Bài 2: Ngữ pháp cơ bản</td>
                                    <td><span class="badge bg-primary">Sắp diễn ra</span></td>
                                </tr>
                                <tr>
                                    <td>29/05/2023</td>
                                    <td>19:00 - 21:00</td>
                                    <td>Bài 3: Luyện nói chủ đề 1</td>
                                    <td><span class="badge bg-secondary">Chưa diễn ra</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
