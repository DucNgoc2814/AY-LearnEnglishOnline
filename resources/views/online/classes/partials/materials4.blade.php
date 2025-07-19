{{-- Copy CSS from materials.blade.php --}}
<style>
    .materials-container .accordion-button {
        background-color: transparent !important;
        box-shadow: none !important;
    }
    .materials-container .accordion-button:focus {
        box-shadow: none !important;
        border-color: rgba(0,0,0,.125) !important;
    }
    /* Style cho Lesson */
    .materials-container .lesson-item > .accordion-header > .accordion-button {
        background-color: #fff !important;
        font-weight: 600;
        font-size: 1.1rem;
    }
    /* Style cho Before/During/After */
    .materials-container .level-1 {
        margin-left: 1.5rem;
        border-left: 2px solid #e9ecef;
    }
    .materials-container .level-1 > .accordion-header > .accordion-button {
        background-color: #e3f2fd !important;
        font-weight: 600;
    }
    /* Style cho các mục con trong Before/During/After */
    .materials-container .level-2 {
        margin-left: 3rem;
        border-left: 2px solid #e9ecef;
    }
    .materials-container .level-2 > .accordion-header > .accordion-button {
        background-color: #f8f9fa !important;
    }
    .materials-container .level-3 {
        margin-left: 4.5rem;
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
    /* Thêm đường kẻ dọc cho các mục */
    .materials-container .level-1,
    .materials-container .level-2 {
        position: relative;
    }
    .materials-container .level-1::before,
    .materials-container .level-2::before {
        content: '';
        position: absolute;
        left: -2px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e9ecef;
    }
</style>

<div class="materials-container">
    <div class="accordion" id="lessonsAccordion">
        @php
            $lessons = [
                ['id' => 1, 'name' => 'Expert Writing Analysis Techniques'],
                ['id' => 2, 'name' => 'Advanced Statistical Data Analysis'],
                ['id' => 3, 'name' => 'Complex Process and System Description'],
                ['id' => 4, 'name' => 'Expert Essay Writing Strategies'],
                ['id' => 5, 'name' => 'Advanced Argumentative Techniques'],
                ['id' => 6, 'name' => 'Academic Vocabulary Mastery'],
                ['id' => 7, 'name' => 'Expert Grammar and Style'],
                ['id' => 8, 'name' => 'Advanced Academic Reading'],
                ['id' => 9, 'name' => 'Research Paper Analysis'],
                ['id' => 10, 'name' => 'Speed Reading Mastery'],
                ['id' => 11, 'name' => 'Expert Listening Techniques'],
                ['id' => 12, 'name' => 'Complex Academic Lectures'],
                ['id' => 13, 'name' => 'Multi-accent Comprehension'],
                ['id' => 14, 'name' => 'Expert Speaking Strategies'],
                ['id' => 15, 'name' => 'Advanced Debate Techniques'],
                ['id' => 16, 'name' => 'Professional Presentation Skills'],
                ['id' => 17, 'name' => 'Native-like Pronunciation'],
                ['id' => 18, 'name' => 'Expert Mock Tests'],
                ['id' => 19, 'name' => 'Advanced Error Analysis'],
                ['id' => 20, 'name' => 'Band 9 Strategies'],
                ['id' => 21, 'name' => 'Final Expert Assessment']
            ];
        @endphp

        @foreach($lessons as $lesson)
            <div class="accordion-item mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#lesson{{ $lesson['id'] }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                        <i class="fas fa-book me-2"></i> {{ $lesson['name'] }}
                    </button>
                </h2>
                <div id="lesson{{ $lesson['id'] }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#lessonsAccordion">
                    <div class="accordion-body p-0">
                        <div class="accordion" id="lesson{{ $lesson['id'] }}Materials">
                            <!-- Before Class Materials -->
                            <div class="accordion-item mb-3 level-1">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#beforeClassMaterials{{ $lesson['id'] }}" aria-expanded="true">
                                        <i class="fas fa-hourglass-start me-2"></i> BEFORE CLASS
                                    </button>
                                </h2>
                                <div id="beforeClassMaterials{{ $lesson['id'] }}" class="accordion-collapse collapse show" data-bs-parent="#lesson{{ $lesson['id'] }}Materials">
                                    <div class="accordion-body p-0">
                                        <div class="accordion" id="beforeLessonsAccordion{{ $lesson['id'] }}">
                                            <!-- Học tiếng Anh qua phim -->
                                            <div class="accordion-item level-2">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#movieLearning{{ $lesson['id'] }}" aria-expanded="true">
                                                        <i class="fas fa-film me-2"></i> U.S. MOVIE
                                                    </button>
                                                </h2>
                                                <div id="movieLearning{{ $lesson['id'] }}" class="accordion-collapse collapse show" data-bs-parent="#beforeLessonsAccordion{{ $lesson['id'] }}">
                                                    <div class="list-group list-group-flush level-3">
                                                        <div class="list-group-item d-flex gap-3 py-3">
                                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                                                <i class="fas fa-film text-danger"></i>
                                                            </div>
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <div>
                                                                    <h6 class="mb-0">YOUNG SHELDON </h6>
                                                                    <p class="mb-0 small text-muted">Xem video và làm theo các bước nhé.</p>
                                                                </div>
                                                                <div class="d-flex flex-column align-items-end">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('online.video-exercise.show', ['id' => $lesson['id']]) }}" class="btn btn-sm btn-outline-primary">
                                                                            <i class="fas fa-play"></i> Start now!
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
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vocabListening{{ $lesson['id'] }}" aria-expanded="false">
                                                        <i class="fas fa-headphones me-2"></i> ACTIVE LISTENING
                                                    </button>
                                                </h2>
                                                <div id="vocabListening{{ $lesson['id'] }}" class="accordion-collapse collapse" data-bs-parent="#beforeLessonsAccordion{{ $lesson['id'] }}">
                                                    <div class="list-group list-group-flush level-3">
                                                        <div class="list-group-item d-flex gap-3 py-3">
                                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                                                <i class="fas fa-book-open text-info"></i>
                                                            </div>
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <div>
                                                                    <h6 class="mb-0">UNIT 1: HOMETOWN</h6>
                                                                    <p class="mb-0 small text-muted">Học từ vựng và luyện nghe qua các bài tập tương tác.</p>
                                                                </div>
                                                                <div class="d-flex flex-column align-items-end">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('online.vocabulary-listening.show', ['lesson_id' => $lesson['id']]) }}" class="btn btn-sm btn-outline-primary">
                                                                            <i class="fas fa-headphones"></i> Start now!
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
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#duringClassMaterials{{ $lesson['id'] }}" aria-expanded="false">
                                        <i class="fas fa-clock me-2"></i> DURING CLASS
                                    </button>
                                </h2>
                                <div id="duringClassMaterials{{ $lesson['id'] }}" class="accordion-collapse collapse" data-bs-parent="#lesson{{ $lesson['id'] }}Materials">
                                    <div class="accordion-body p-0">
                                        <div class="accordion" id="duringLessonsAccordion{{ $lesson['id'] }}">
                                            <!-- Xem video & handout -->
                                            <div class="accordion-item level-2">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#videoHandout{{ $lesson['id'] }}" aria-expanded="false">
                                                        <i class="fas fa-film me-2"></i> PRONUNCIATION
                                                    </button>
                                                </h2>
                                                <div id="videoHandout{{ $lesson['id'] }}" class="accordion-collapse collapse" data-bs-parent="#duringLessonsAccordion{{ $lesson['id'] }}">
                                                    <div class="list-group list-group-flush level-3">
                                                        <div class="list-group-item d-flex gap-3 py-3">
                                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                                                <i class="fas fa-film text-primary"></i>
                                                            </div>
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <div>
                                                                    <h6 class="mb-0">PRONUNCIATION - {{ $lesson['name'] }}</h6>
                                                                    <p class="mb-0 small text-muted">Xem video và Start now! tập handout đi kèm.</p>
                                                                </div>
                                                                <div class="d-flex flex-column align-items-end">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('online.video-handout.show') }}" class="btn btn-sm btn-outline-primary">
                                                                            <i class="fas fa-play"></i> Xem video và Start now!
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
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#videoShadowing{{ $lesson['id'] }}" aria-expanded="false">
                                                        <i class="fas fa-film me-2"></i> SHADOWING
                                                    </button>
                                                </h2>
                                                <div id="videoShadowing{{ $lesson['id'] }}" class="accordion-collapse collapse" data-bs-parent="#duringLessonsAccordion{{ $lesson['id'] }}">
                                                    <div class="list-group list-group-flush level-3">
                                                        <div class="list-group-item d-flex gap-3 py-3">
                                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                                                <i class="fas fa-microphone text-success"></i>
                                                            </div>
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <div>
                                                                    <h6 class="mb-0">SHADOWING - {{ $lesson['name'] }}</h6>
                                                                    <p class="mb-0 small text-muted">Luyện phát âm theo phương pháp Shadowing.</p>
                                                                </div>
                                                                <div class="d-flex flex-column align-items-end">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('online.video-shadowing.show', ['id' => $lesson['id']]) }}" class="btn btn-sm btn-outline-primary">
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
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#afterClassMaterials{{ $lesson['id'] }}" aria-expanded="false">
                                        <i class="fas fa-hourglass-end me-2"></i>AFTER CLASS
                                    </button>
                                </h2>
                                <div id="afterClassMaterials{{ $lesson['id'] }}" class="accordion-collapse collapse" data-bs-parent="#lesson{{ $lesson['id'] }}Materials">
                                    <div class="accordion-body p-0">
                                        <div class="accordion" id="afterLessonsAccordion{{ $lesson['id'] }}">
                                            <!-- Viết bài Reflection -->
                                            <div class="accordion-item level-2">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reflection{{ $lesson['id'] }}" aria-expanded="false">
                                                        <i class="fas fa-pen-fancy me-2"></i> REFLECTION
                                                    </button>
                                                </h2>
                                                <div id="reflection{{ $lesson['id'] }}" class="accordion-collapse collapse" data-bs-parent="#afterLessonsAccordion{{ $lesson['id'] }}">
                                                    <div class="list-group list-group-flush level-3">
                                                        <div class="list-group-item d-flex gap-3 py-3">
                                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px; background-color: #f8f9fa; border-radius: 8px;">
                                                                <i class="fas fa-edit text-primary"></i>
                                                            </div>
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <div>
                                                                    <h6 class="mb-0">REFLECTION - {{ $lesson['name'] }}</h6>
                                                                    <p class="mb-0 small text-muted">Viết bài phản ánh về những gì bạn đã học được.</p>
                                                                </div>
                                                                <div class="d-flex flex-column align-items-end">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('online.reflection-exercise.show', ['id' => $lesson['id']]) }}" class="btn btn-sm btn-outline-primary">
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
                </div>
            </div>
        @endforeach
    </div>
</div>
