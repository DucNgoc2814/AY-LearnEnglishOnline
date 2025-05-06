<style>
    .materials-container .accordion-button {
        background-color: transparent !important;
        box-shadow: none !important;
    }
    .materials-container .accordion-button:focus {
        box-shadow: none !important;
        border-color: rgba(0,0,0,.125) !important;
    }
    .materials-container .level-1 > .accordion-header > .accordion-button {
        background-color: #e3f2fd !important;
        font-weight: 600;
    }
    .materials-container .level-2 {
        margin-left: 2rem;
        border-left: 2px solid #e9ecef;
    }
    .materials-container .level-2 > .accordion-header > .accordion-button {
        background-color: #f8f9fa !important;
    }
    .materials-container .level-3 {
        margin-left: 3rem;
    }
    .materials-container .accordion-item {
        border: none;
    }
    .materials-container .list-group-item {
        border-left: none;
        border-right: none;
    }
    .materials-container .btn-outline-primary:focus {
        box-shadow: none !important;
    }
    .materials-container .btn-outline-primary:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
        border-color: #0d6efd;
    }
</style>

<div class="materials-container">
    <div class="accordion" id="materialsAccordion">
        <!-- Before Class Materials -->
        <div class="accordion-item mb-3 level-1">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#beforeClassMaterials" aria-expanded="true">
                    <i class="fas fa-hourglass-start me-2"></i> Before Class Materials
                </button>
            </h2>
            <div id="beforeClassMaterials" class="accordion-collapse collapse show" data-bs-parent="#materialsAccordion">
                <div class="accordion-body p-0">
                    <div class="accordion" id="beforeLessonsAccordion">
                        <!-- Lesson 1 -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#beforeLesson1" aria-expanded="true">
                                    <i class="fas fa-book me-2"></i> Buổi 1: Giới thiệu khóa học
                                </button>
                            </h2>
                            <div id="beforeLesson1" class="accordion-collapse collapse show" data-bs-parent="#beforeLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-film text-danger"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Video Exercise - Basic Introductions</h6>
                                                <p class="mb-0 small text-muted">Xem video và điền từ còn thiếu vào đoạn hội thoại.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('exercises.video', ['id' => 1]) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-play"></i> Làm bài
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lesson 2 -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#beforeLesson2" aria-expanded="false">
                                    <i class="fas fa-book me-2"></i> Buổi 2: Ngữ pháp cơ bản
                                </button>
                            </h2>
                            <div id="beforeLesson2" class="accordion-collapse collapse" data-bs-parent="#beforeLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-book-open text-info"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Grammar Preview - Present Simple</h6>
                                                <p class="mb-0 small text-muted">Ôn tập thì hiện tại đơn trước buổi học.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('exercises.grammar', ['id' => 1]) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-pen"></i> Làm bài
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lesson 3 -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#beforeLesson3" aria-expanded="false">
                                    <i class="fas fa-book me-2"></i> Buổi 3: Từ vựng chủ đề du lịch
                                </button>
                            </h2>
                            <div id="beforeLesson3" class="accordion-collapse collapse" data-bs-parent="#beforeLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-tasks text-warning"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Vocabulary Flashcards - Travel</h6>
                                                <p class="mb-0 small text-muted">Học từ vựng về chủ đề du lịch qua flashcards.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-play"></i> Học từ
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- During Class Materials -->
        <div class="accordion-item mb-3 level-1">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#duringClassMaterials" aria-expanded="false">
                    <i class="fas fa-clock me-2"></i> During Class Materials
                </button>
            </h2>
            <div id="duringClassMaterials" class="accordion-collapse collapse" data-bs-parent="#materialsAccordion">
                <div class="accordion-body p-0">
                    <div class="accordion" id="duringLessonsAccordion">
                        <!-- Lesson 1 -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#duringLesson1" aria-expanded="false">
                                    <i class="fas fa-book me-2"></i> Buổi 1: Giới thiệu khóa học
                                </button>
                            </h2>
                            <div id="duringLesson1" class="accordion-collapse collapse" data-bs-parent="#duringLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-headphones text-primary"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Listening Exercise - Basic Greetings</h6>
                                                <p class="mb-0 small text-muted">Nghe đoạn hội thoại và điền từ còn thiếu.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('exercises.audio', ['id' => 1]) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-headphones"></i> Làm bài
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lesson 2 -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#duringLesson2" aria-expanded="false">
                                    <i class="fas fa-book me-2"></i> Buổi 2: Ngữ pháp cơ bản
                                </button>
                            </h2>
                            <div id="duringLesson2" class="accordion-collapse collapse" data-bs-parent="#duringLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-pencil-alt text-success"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Grammar Practice - Present Simple</h6>
                                                <p class="mb-0 small text-muted">Luyện tập sử dụng thì hiện tại đơn.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('exercises.grammar', ['id' => 2]) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-pen"></i> Làm bài
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- After Class Materials -->
        <div class="accordion-item mb-3 level-1">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#afterClassMaterials" aria-expanded="false">
                    <i class="fas fa-hourglass-end me-2"></i> After Class Materials
                </button>
            </h2>
            <div id="afterClassMaterials" class="accordion-collapse collapse" data-bs-parent="#materialsAccordion">
                <div class="accordion-body p-0">
                    <div class="accordion" id="afterLessonsAccordion">
                        <!-- Lesson 1 -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#afterLesson1" aria-expanded="false">
                                    <i class="fas fa-book me-2"></i> Buổi 1: Giới thiệu khóa học
                                </button>
                            </h2>
                            <div id="afterLesson1" class="accordion-collapse collapse" data-bs-parent="#afterLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-tasks text-success"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Bài tập về nhà - Basic Introductions</h6>
                                                <p class="mb-0 small text-muted">Làm bài tập củng cố kiến thức.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-pen"></i> Làm bài
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lesson 2 -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#afterLesson2" aria-expanded="false">
                                    <i class="fas fa-book me-2"></i> Buổi 2: Ngữ pháp cơ bản
                                </button>
                            </h2>
                            <div id="afterLesson2" class="accordion-collapse collapse" data-bs-parent="#afterLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-book text-warning"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Grammar Review - Present Simple</h6>
                                                <p class="mb-0 small text-muted">Ôn tập và làm bài tập về thì hiện tại đơn.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-pen"></i> Làm bài
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 