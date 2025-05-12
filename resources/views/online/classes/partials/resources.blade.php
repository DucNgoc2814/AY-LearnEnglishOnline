<div class="resources-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">
            <i class="fas fa-graduation-cap me-2"></i> Học liệu
        </h5>
        <button class="filter-btn" type="button" data-bs-toggle="collapse" data-bs-target="#resourcesFilter">
            <i class="fas fa-filter"></i> Lọc
        </button>
    </div>

    <div class="collapse mb-3" id="resourcesFilter">
        <div class="card card-body bg-light">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Loại học liệu</label>
                    <select class="form-select form-select-sm">
                        <option value="">Tất cả</option>
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                        <option value="document">Tài liệu</option>
                        <option value="interactive">Bài tập tương tác</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kỹ năng</label>
                    <select class="form-select form-select-sm">
                        <option value="">Tất cả</option>
                        <option value="listening">Listening</option>
                        <option value="speaking">Speaking</option>
                        <option value="reading">Reading</option>
                        <option value="writing">Writing</option>
                        <option value="grammar">Grammar</option>
                        <option value="vocabulary">Vocabulary</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cấp độ</label>
                    <select class="form-select form-select-sm">
                        <option value="">Tất cả</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="btn btn-sm btn-primary">Áp dụng</button>
            </div>
        </div>
    </div>

    <div class="accordion" id="resourcesAccordion">
        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#listeningResources" aria-expanded="true">
                    <i class="fas fa-headphones me-2"></i> Luyện nghe (Listening)
                </button>
            </h2>
            <div id="listeningResources" class="accordion-collapse collapse show" data-bs-parent="#resourcesAccordion">
                <div class="accordion-body">
                    <div class="row row-cols-1 row-cols-md-3 g-3">
                        <div class="col">
                            <div class="card h-100 resource-card">
                                <div class="card-img-top position-relative">
                                    <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="Resource thumbnail">
                                    <span class="badge bg-info resource-badge">Audio</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Listening Practice - Daily Conversations</h6>
                                    <p class="card-text small">Luyện nghe các đoạn hội thoại thường ngày để cải thiện khả năng nghe.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-secondary">10 bài học</span>
                                        <small class="text-muted">20 phút</small>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="#" class="btn btn-primary btn-sm d-block">Học ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 resource-card">
                                <div class="card-img-top position-relative">
                                    <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="Resource thumbnail">
                                    <span class="badge bg-danger resource-badge">Video</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Listening for Specific Information</h6>
                                    <p class="card-text small">Kỹ thuật nghe để lấy thông tin cụ thể trong các bài nghe IELTS.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-secondary">5 bài học</span>
                                        <small class="text-muted">30 phút</small>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="#" class="btn btn-primary btn-sm d-block">Học ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 resource-card">
                                <div class="card-img-top position-relative">
                                    <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="Resource thumbnail">
                                    <span class="badge bg-success resource-badge">Interactive</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Dictation Practice - Listen and Write</h6>
                                    <p class="card-text small">Luyện nghe và viết theo các đoạn hội thoại, cải thiện kỹ năng nghe và chính tả.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-secondary">15 bài tập</span>
                                        <small class="text-muted">30 phút</small>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="{{ route('exercises.dictation', ['id' => 1]) }}" class="btn btn-primary btn-sm d-block">Học ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#speakingResources" aria-expanded="false">
                    <i class="fas fa-comment-dots me-2"></i> Luyện nói (Speaking)
                </button>
            </h2>
            <div id="speakingResources" class="accordion-collapse collapse" data-bs-parent="#resourcesAccordion">
                <div class="accordion-body">
                    <div class="row row-cols-1 row-cols-md-3 g-3">
                        <div class="col">
                            <div class="card h-100 resource-card">
                                <div class="card-img-top position-relative">
                                    <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="Resource thumbnail">
                                    <span class="badge bg-danger resource-badge">Video</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Common English Phrases for Daily Conversation</h6>
                                    <p class="card-text small">Học các cụm từ thông dụng để giao tiếp hàng ngày.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-secondary">12 bài học</span>
                                        <small class="text-muted">25 phút</small>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="#" class="btn btn-primary btn-sm d-block">Học ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 resource-card">
                                <div class="card-img-top position-relative">
                                    <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="Resource thumbnail">
                                    <span class="badge bg-warning resource-badge">Exercise</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Pronunciation Practice - Difficult Sounds</h6>
                                    <p class="card-text small">Luyện phát âm các âm khó trong tiếng Anh.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-secondary">7 bài học</span>
                                        <small class="text-muted">15 phút</small>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="#" class="btn btn-primary btn-sm d-block">Học ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#readingResources" aria-expanded="false">
                    <i class="fas fa-book-open me-2"></i> Luyện đọc (Reading)
                </button>
            </h2>
            <div id="readingResources" class="accordion-collapse collapse" data-bs-parent="#resourcesAccordion">
                <div class="accordion-body">
                    <div class="row row-cols-1 row-cols-md-3 g-3">
                        <div class="col">
                            <div class="card h-100 resource-card">
                                <div class="card-img-top position-relative">
                                    <img src="https://via.placeholder.com/300x150" class="img-fluid" alt="Resource thumbnail">
                                    <span class="badge bg-primary resource-badge">Document</span>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Reading Comprehension Strategies</h6>
                                    <p class="card-text small">Các chiến lược đọc hiểu văn bản tiếng Anh hiệu quả.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-secondary">5 bài học</span>
                                        <small class="text-muted">40 phút</small>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="#" class="btn btn-primary btn-sm d-block">Học ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#additionalResources" aria-expanded="false">
                    <i class="fas fa-bookmark me-2"></i> Tài nguyên bổ sung
                </button>
            </h2>
            <div id="additionalResources" class="accordion-collapse collapse" data-bs-parent="#resourcesAccordion">
                <div class="accordion-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
                            <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                <i class="fas fa-globe text-primary"></i>
                            </div>
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Trang web luyện nghe BBC Learning English</h6>
                                    <p class="mb-0 opacity-75 small">Nguồn tài nguyên nghe miễn phí với các cấp độ khác nhau</p>
                                </div>
                                <small class="opacity-50 text-nowrap">
                                    <i class="fas fa-external-link-alt"></i>
                                </small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
                            <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                <i class="fas fa-mobile-alt text-primary"></i>
                            </div>
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Ứng dụng luyện từ vựng Quizlet</h6>
                                    <p class="mb-0 opacity-75 small">Ứng dụng học từ vựng hiệu quả với thẻ ghi nhớ</p>
                                </div>
                                <small class="opacity-50 text-nowrap">
                                    <i class="fas fa-external-link-alt"></i>
                                </small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Resource filtering functionality would go here
    });
</script>
@endpush