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
                        <!-- Học tiếng Anh qua phim -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#movieLearning" aria-expanded="true">
                                    <i class="fas fa-film me-2"></i> Học tiếng Anh qua phim
                                </button>
                            </h2>
                            <div id="movieLearning" class="accordion-collapse collapse show" data-bs-parent="#beforeLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-film text-danger"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Video Exercise - Basic Introductions</h6>
                                                <p class="mb-0 small text-muted">Xem video và làm theo các bước nhé.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('video-exercise.show', ['id' => 1]) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-play"></i> Làm bài
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Học từ vựng & luyện nghe -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vocabListening" aria-expanded="false">
                                    <i class="fas fa-headphones me-2"></i> Học từ vựng & luyện nghe
                                </button>
                            </h2>
                            <div id="vocabListening" class="accordion-collapse collapse" data-bs-parent="#beforeLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-book-open text-info"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Vocabulary & Listening Practice</h6>
                                                <p class="mb-0 small text-muted">Học từ vựng và luyện nghe qua các bài tập tương tác.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('vocabulary-listening.show') }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-headphones"></i> Làm bài
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
                        <!-- Xem video & handout -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#videoHandout" aria-expanded="false">
                                    <i class="fas fa-film me-2"></i> Xem video & handout
                                </button>
                            </h2>
                            <div id="videoHandout" class="accordion-collapse collapse" data-bs-parent="#duringLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-film text-primary"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Video Learning with Handouts</h6>
                                                <p class="mb-0 small text-muted">Xem video và làm bài tập handout đi kèm.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('video-handout.show') }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-play"></i> Xem video và làm bài
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Xem video Shadowing -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#videoShadowing" aria-expanded="false">
                                    <i class="fas fa-film me-2"></i> Xem video Shadowing
                                </button>
                            </h2>
                            <div id="videoShadowing" class="accordion-collapse collapse" data-bs-parent="#duringLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-microphone text-success"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Video Shadowing Practice</h6>
                                                <p class="mb-0 small text-muted">Luyện phát âm theo phương pháp Shadowing.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('video-shadowing.show') }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-play"></i> Xem video
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
                        <!-- Viết bài Reflection -->
                        <div class="accordion-item level-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reflection" aria-expanded="false">
                                    <i class="fas fa-pen-fancy me-2"></i> Viết bài Reflection
                                </button>
                            </h2>
                            <div id="reflection" class="accordion-collapse collapse" data-bs-parent="#afterLessonsAccordion">
                                <div class="list-group list-group-flush level-3">
                                    <div class="list-group-item d-flex gap-3 py-3">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                            <i class="fas fa-edit text-primary"></i>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0">Viết bài Reflection</h6>
                                                <p class="mb-0 small text-muted">Viết bài phản ánh về những gì bạn đã học được.</p>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('reflection-exercise.show', ['id' => 1]) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-pen"></i> Viết bài
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
