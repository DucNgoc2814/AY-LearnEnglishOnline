<div class="tests-container">
        <div class="mt-4">
            <div class="card bg-light border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-chart-line text-primary me-3 fa-2x"></i>
                        <h5 class="card-title mb-0">Thống kê làm bài</h5>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h2 class="fw-bold text-primary">2/7</h2>
                                <p class="small text-muted mb-0">Đã hoàn thành</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h2 class="fw-bold text-success">9.0</h2>
                                <p class="small text-muted mb-0">Điểm trung bình</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h2 class="fw-bold text-warning">3</h2>
                                <p class="small text-muted mb-0">Cần làm</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h2 class="fw-bold text-secondary">2</h2>
                                <p class="small text-muted mb-0">Sắp mở</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="accordion" id="testsAccordion">
        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#lesson1Tests" aria-expanded="true">
                    <i class="fas fa-book me-2"></i> Trắc nghiệm bài 1: Giới thiệu khóa học
                </button>
            </h2>
            <div id="lesson1Tests" class="accordion-collapse collapse show" data-bs-parent="#testsAccordion">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Bài trắc nghiệm 1.1: Tổng quan khóa học</h6>
                                    <p class="mb-1 small text-muted">Kiểm tra hiểu biết về mục tiêu và cấu trúc khóa học</p>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <span class="badge bg-success">Đã hoàn thành</span>
                                        <small><i class="fas fa-clock me-1"></i> 15 phút</small>
                                        <small><i class="fas fa-question-circle me-1"></i> 10 câu</small>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Xem kết quả
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Bài trắc nghiệm 1.2: Kiến thức nền tảng</h6>
                                    <p class="mb-1 small text-muted">Đánh giá trình độ ban đầu của học viên</p>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <span class="badge bg-success">Đã hoàn thành</span>
                                        <small><i class="fas fa-clock me-1"></i> 20 phút</small>
                                        <small><i class="fas fa-question-circle me-1"></i> 15 câu</small>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Xem kết quả
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lesson2Tests" aria-expanded="false">
                    <i class="fas fa-book me-2"></i> Trắc nghiệm bài 2: Ngữ pháp cơ bản
                </button>
            </h2>
            <div id="lesson2Tests" class="accordion-collapse collapse" data-bs-parent="#testsAccordion">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Bài trắc nghiệm 2.1: Thì hiện tại đơn</h6>
                                    <p class="mb-1 small text-muted">Kiểm tra hiểu biết về thì hiện tại đơn</p>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <span class="badge bg-warning">Chưa làm</span>
                                        <small><i class="fas fa-clock me-1"></i> 15 phút</small>
                                        <small><i class="fas fa-question-circle me-1"></i> 10 câu</small>
                                    </div>
                                </div>
                                <a href="{{ route('online.classes.quiz', ['quiz' => 'present-simple']) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Làm bài
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Bài trắc nghiệm 2.2: Thì hiện tại tiếp diễn</h6>
                                    <p class="mb-1 small text-muted">Kiểm tra hiểu biết về thì hiện tại tiếp diễn</p>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <span class="badge bg-warning">Chưa làm</span>
                                        <small><i class="fas fa-clock me-1"></i> 15 phút</small>
                                        <small><i class="fas fa-question-circle me-1"></i> 10 câu</small>
                                    </div>
                                </div>
                                <a href="{{ route('online.classes.quiz', ['quiz' => 'present-continuous']) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Làm bài
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Bài trắc nghiệm 2.3: Từ vựng về chủ đề giao tiếp</h6>
                                    <p class="mb-1 small text-muted">Kiểm tra từ vựng về chủ đề giao tiếp hàng ngày</p>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <span class="badge bg-warning">Chưa làm</span>
                                        <small><i class="fas fa-clock me-1"></i> 10 phút</small>
                                        <small><i class="fas fa-question-circle me-1"></i> 10 câu</small>
                                    </div>
                                </div>
                                <a href="{{ route('online.classes.quiz', ['quiz' => 'communication-vocab']) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Làm bài
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lesson3Tests" aria-expanded="false">
                    <i class="fas fa-book me-2"></i> Trắc nghiệm bài 3: Giao tiếp cơ bản
                </button>
            </h2>
            <div id="lesson3Tests" class="accordion-collapse collapse" data-bs-parent="#testsAccordion">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Bài trắc nghiệm 3.1: Từ vựng giao tiếp hàng ngày</h6>
                                    <p class="mb-1 small text-muted">Kiểm tra về từ vựng giao tiếp thông dụng</p>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <span class="badge bg-secondary">Chưa mở</span>
                                        <small><i class="fas fa-clock me-1"></i> 15 phút</small>
                                        <small><i class="fas fa-question-circle me-1"></i> 10 câu</small>
                                    </div>
                                </div>
                                <button disabled class="btn btn-sm btn-secondary">
                                    <i class="fas fa-lock"></i> Mở vào 20/05/2023
                                </button>
                            </div>
                        </div>
                        <div class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Bài trắc nghiệm 3.2: Tình huống giao tiếp</h6>
                                    <p class="mb-1 small text-muted">Kiểm tra xử lý tình huống giao tiếp</p>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <span class="badge bg-secondary">Chưa mở</span>
                                        <small><i class="fas fa-clock me-1"></i> 15 phút</small>
                                        <small><i class="fas fa-question-circle me-1"></i> 8 câu</small>
                                    </div>
                                </div>
                                <button disabled class="btn btn-sm btn-secondary">
                                    <i class="fas fa-lock"></i> Mở vào 20/05/2023
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
</div> 