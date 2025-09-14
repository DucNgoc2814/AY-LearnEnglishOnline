@extends('online.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/components/word-drag-drop.css') }}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script src="{{ asset('js/components/word-drag-drop.js') }}"></script>
@endpush

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">PRONUNCIATION</h4>

                <ul class="nav nav-tabs" id="videoHandoutTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="instructions-tab" data-bs-toggle="tab"
                            data-bs-target="#instructions" type="button" role="tab">
                            <span class="badge bg-info me-2"><i class="fas fa-info-circle"></i></span>HƯỚNG DẪN
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button"
                            role="tab">
                            <span class="badge bg-primary me-2">1</span>XEM VIDEO
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="handout-tab" data-bs-toggle="tab" data-bs-target="#handout"
                            type="button" role="tab">
                            <span class="badge bg-primary me-2">2</span>LÀM BÀI TẬP HANDOUT
                        </button>
                    </li>
                </ul>

                <div class="tab-content pt-4" id="videoHandoutTabContent">
                    <!-- Instructions Tab -->
                    <div class="tab-pane fade show active" id="instructions" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">
                                    <i class="fas fa-info-circle text-info me-2"></i>Hướng dẫn làm bài
                                </h4>

                                <div class="alert alert-info mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-video me-2"></i>Bước 1: Xem Video
                                    </h5>
                                    <ul class="mb-0">
                                        <li>Xem video bài học theo thứ tự trong danh sách</li>
                                        <li>Ghi chú những điểm quan trọng và từ vựng mới</li>
                                        <li>Có thể tạm dừng video để ghi chép hoặc xem lại các phần chưa rõ</li>
                                        <li>Chú ý cách phát âm và ngữ điệu của người nói</li>
                                    </ul>
                                </div>

                                <div class="alert alert-warning mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-book me-2"></i>Bước 2: Làm Bài Tập Handout
                                    </h5>
                                    <ul class="mb-0">
                                        <li>Hoàn thành các bài tập phát âm (Pronunciation)</li>
                                        <li>Thực hành các bài tập nghe và nói (Listening & Speaking)</li>
                                        <li>Làm theo hướng dẫn chi tiết trong từng phần</li>
                                        <li>Kiểm tra kỹ đáp án trước khi nộp bài</li>
                                    </ul>
                                </div>

                                <div class="alert alert-success mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-tasks me-2"></i>Bước 3: Làm Bài Tập Về Nhà
                                    </h5>
                                    <ul class="mb-0">
                                        <li>Hoàn thành bài tập After Class để củng cố kiến thức</li>
                                        <li>Thực hiện bài tập Self-Study để nâng cao kỹ năng</li>
                                        <li>Chuẩn bị bài Before Class cho buổi học tiếp theo</li>
                                    </ul>
                                </div>

                                <div class="alert alert-secondary mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-lightbulb me-2"></i>Lưu ý quan trọng
                                    </h5>
                                    <ul class="mb-0">
                                        <li>Làm bài tập theo đúng thứ tự các bước</li>
                                        <li>Lưu lại tiến độ thường xuyên</li>
                                        <li>Có thể quay lại các bước trước để ôn tập</li>
                                        <li>Liên hệ giáo viên nếu cần hỗ trợ thêm</li>
                                    </ul>
                                </div>

                                <div class="text-center mt-4">
                                    <button class="btn btn-primary btn-lg"
                                        onclick="document.getElementById('video-tab').click()">
                                        <i class="fas fa-play me-2"></i>Bắt đầu học
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 1: Watch Video -->
                    <div class="tab-pane fade" id="video" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Video Player -->
                                <div class="card mb-4">
                                    <div class="card-body p-0">
                                        <div class="ratio ratio-16x9">
                                            <iframe id="videoPlayer" src="" title="Video Learning" allowfullscreen
                                                class="rounded"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <!-- Video Folders and List -->
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="accordion" id="videoFoldersAccordion">
                                            @foreach ($video_folders as $folder)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button
                                                            class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#folder{{ $folder['id'] }}">
                                                            <i
                                                                class="fas fa-folder{{ $loop->first ? '-open' : '' }} me-2 text-warning"></i>
                                                            {{ $folder['name'] }}
                                                        </button>
                                                    </h2>
                                                    <div id="folder{{ $folder['id'] }}"
                                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                        data-bs-parent="#videoFoldersAccordion">
                                                        <div class="accordion-body p-0">
                                                            <div class="list-group list-group-flush">
                                                                @foreach ($folder['videos'] as $video)
                                                                    <button type="button"
                                                                        class="list-group-item list-group-item-action video-item"
                                                                        data-video-url="{{ $video['url'] }}">
                                                                        <div
                                                                            class="d-flex w-100 justify-content-between align-items-center">
                                                                            <div>
                                                                                <h6 class="mb-1">
                                                                                    <i
                                                                                        class="fas fa-play-circle me-2 text-primary"></i>
                                                                                    {{ $video['title'] }}
                                                                                </h6>
                                                                                <p class="mb-1 small text-muted">
                                                                                    {{ $video['description'] }}</p>
                                                                            </div>
                                                                            <span
                                                                                class="badge bg-primary rounded-pill d-none video-status">
                                                                                <i class="fas fa-check"></i>
                                                                            </span>
                                                                        </div>
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Exercise -->
                    <div class="tab-pane fade" id="handout" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">
                                    <i class="fas fa-gamepad me-2"></i>Practice 1: Long /ɑː/ Sound
                                </h4>

                                <div class="alert alert-info mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-info-circle me-2"></i>Instructions
                                    </h5>
                                    <p class="mb-0">
                                        Find pairs of words that contain the long /ɑː/ sound. Click on the cards to flip
                                        them and match the pairs.
                                        Try to complete the game with as few moves as possible!
                                    </p>
                                </div>

                                <div class="memory-game-container">
                                    <div class="game-stats mb-4 d-flex justify-content-between align-items-center">
                                        <div class="moves">
                                            <i class="fas fa-sync-alt me-2"></i>Moves: <span id="moveCount">0</span>
                                        </div>
                                        <div class="timer me-3">
                                            <i class="fas fa-clock me-2"></i>Time: <span id="memoryGameTimer">0:00</span>
                                        </div>
                                        <div class="matches">
                                            <i class="fas fa-check-circle me-2"></i>Matches: <span
                                                id="matchCount">0</span>/8
                                        </div>
                                    </div>
                                    <div class="memory-grid" id="memoryGrid">
                                        <!-- Cards will be dynamically added here -->
                                    </div>

                                    <!-- Recording Section -->
                                    <div class="recording-section mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">
                                                    <i class="fas fa-microphone me-2"></i>Practice Pronunciation
                                                </h5>

                                                <!-- Record Controls -->
                                                <div class="record-controls mb-4">
                                                    <button id="recordButton" class="btn btn-primary me-2">
                                                        <i class="fas fa-microphone"></i>
                                                        <span>Start Recording</span>
                                                    </button>
                                                    <div id="recordingTimer" class="d-none">
                                                        Recording: <span id="timerDisplay">00:00</span>
                                                    </div>
                                                </div>

                                                <!-- Recording History -->
                                                <div class="recording-history">
                                                    <h6 class="mb-3">
                                                        <i class="fas fa-history me-2"></i>Your Recording History
                                                    </h6>
                                                    <div id="recordingsList" class="list-group">
                                                        <!-- Recordings will be added here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Practice 2: Common Spelling Pattern -->
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            <i class="fas fa-spell-check me-2"></i>Practice 2: Common Spelling Pattern for
                                            /ɑː/
                                        </h4>

                                        <div class="alert alert-info mb-4">
                                            <h5 class="alert-heading">
                                                <i class="fas fa-info-circle me-2"></i>Instructions
                                            </h5>
                                            <p class="mb-0">
                                                Listen to the audio and select the correct word that matches the
                                                pronunciation.
                                                Pay attention to the common spelling patterns for the /ɑː/ sound.
                                            </p>
                                        </div>

                                        <!-- Audio Player Section -->
                                        <div class="audio-player-section mb-4">
                                            <div class="current-audio-container text-center p-4 bg-light rounded">
                                                <div class="audio-player">
                                                    <audio id="currentAudio" class="w-100" controls>
                                                        <source src="" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Word Options Section -->
                                        <div class="word-options-section">
                                            <div
                                                class="word-options-container d-flex flex-wrap justify-content-center gap-2">
                                                <!-- Words will be dynamically added here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Practice 3: Long /ɑː/ Sound -->
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            <i class="fas fa-microphone me-2"></i>Practice 3: Long /ɑː/
                                        </h4>

                                        <div class="alert alert-info mb-4">
                                            <h5 class="alert-heading">
                                                <i class="fas fa-info-circle me-2"></i>Instructions
                                            </h5>
                                            <p class="mb-0">
                                                First, arrange the words in the correct order by dragging and dropping them.
                                                Once the sentence is correctly arranged, you can record yourself pronouncing it.
                                                Pay special attention to the /ɑː/ sound (highlighted in red).
                                            </p>
                                        </div>

                                        <!-- Sentences Practice Section -->
                                        <div class="sentences-practice">
                                            <div class="sentence-list">
                                                <!-- Sentence 1 -->
                                                <div class="sentence-item card mb-3">
                                                    <div class="card-body">
                                                        <div class="sentence-container mb-3">
                                                            <div class="sentence-text mb-2">Original sentence:</div>
                                                            <div class="words-container" data-correct-order="How,far,is,the,car park">
                                                                <div class="word-box" draggable="true">the</div>
                                                                <div class="word-box" draggable="true">car park</div>
                                                                <div class="word-box" draggable="true">How</div>
                                                                <div class="word-box" draggable="true">far</div>
                                                                <div class="word-box" draggable="true">is</div>
                                                            </div>
                                                            <div class="feedback-message mt-2"></div>
                                                        </div>
                                                        <div class="d-flex gap-2 mb-3">
                                                            <div class="audio-player-wrapper">
                                                                <audio class="original-audio" controls>
                                                                    <source src="/audio/sentences/sentence1.mp3" type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                            <button class="btn btn-outline-primary record-btn" data-sentence-id="1" disabled>
                                                                <i class="fas fa-microphone me-2"></i>Record
                                                            </button>
                                                            <button class="btn btn-outline-secondary history-btn" type="button" data-bs-toggle="collapse" data-bs-target="#history-1">
                                                                <i class="fas fa-history me-2"></i>History
                                                                <span class="badge bg-secondary recording-count">0</span>
                                                            </button>
                                                        </div>
                                                        <div class="collapse" id="history-1">
                                                            <div class="card">
                                                                <div class="card-body bg-light p-3">
                                                                    <h6 class="mb-3">Recording History</h6>
                                                                    <div class="recordings-list" id="recordings-1"></div>
                                                                    <div class="text-center text-muted empty-message">
                                                                        <i class="fas fa-microphone-slash me-2"></i>No recordings yet
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Sentence 2 -->
                                                <div class="sentence-item card mb-3">
                                                    <div class="card-body">
                                                        <div class="sentence-container mb-3">
                                                            <div class="sentence-text mb-2">Original sentence:</div>
                                                            <div class="words-container" data-correct-order="We,went,to,a,large bar,full,of,film,stars">
                                                                <div class="word-box" draggable="true">stars</div>
                                                                <div class="word-box" draggable="true">We</div>
                                                                <div class="word-box" draggable="true">went</div>
                                                                <div class="word-box" draggable="true">to</div>
                                                                <div class="word-box" draggable="true">a</div>
                                                                <div class="word-box" draggable="true">large bar</div>
                                                                <div class="word-box" draggable="true">full</div>
                                                                <div class="word-box" draggable="true">of</div>
                                                                <div class="word-box" draggable="true">film</div>
                                                            </div>
                                                            <div class="feedback-message mt-2"></div>
                                                        </div>
                                                        <div class="d-flex gap-2 mb-3">
                                                            <div class="audio-player-wrapper">
                                                                <audio class="original-audio" controls>
                                                                    <source src="/audio/sentences/sentence2.mp3" type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                            <button class="btn btn-outline-primary record-btn" data-sentence-id="2" disabled>
                                                                <i class="fas fa-microphone me-2"></i>Record
                                                            </button>
                                                            <button class="btn btn-outline-secondary history-btn" type="button" data-bs-toggle="collapse" data-bs-target="#history-2">
                                                                <i class="fas fa-history me-2"></i>History
                                                                <span class="badge bg-secondary recording-count">0</span>
                                                            </button>
                                                        </div>
                                                        <div class="collapse" id="history-2">
                                                            <div class="card">
                                                                <div class="card-body bg-light p-3">
                                                                    <h6 class="mb-3">Recording History</h6>
                                                                    <div class="recordings-list" id="recordings-2"></div>
                                                                    <div class="text-center text-muted empty-message">
                                                                        <i class="fas fa-microphone-slash me-2"></i>No recordings yet
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Sentence 3 -->
                                                <div class="sentence-item card mb-3">
                                                    <div class="card-body">
                                                        <div class="sentence-container mb-3">
                                                            <div class="sentence-text mb-2">Original sentence:</div>
                                                            <div class="words-container" data-correct-order="We're,starting,in,half,an,hour">
                                                                <div class="word-box" draggable="true">hour</div>
                                                                <div class="word-box" draggable="true">We're</div>
                                                                <div class="word-box" draggable="true">starting</div>
                                                                <div class="word-box" draggable="true">in</div>
                                                                <div class="word-box" draggable="true">half</div>
                                                                <div class="word-box" draggable="true">an</div>
                                                            </div>
                                                            <div class="feedback-message mt-2"></div>
                                                        </div>
                                                        <div class="d-flex gap-2 mb-3">
                                                            <div class="audio-player-wrapper">
                                                                <audio class="original-audio" controls>
                                                                    <source src="/audio/sentences/sentence3.mp3" type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                            <button class="btn btn-outline-primary record-btn" data-sentence-id="3" disabled>
                                                                <i class="fas fa-microphone me-2"></i>Record
                                                            </button>
                                                            <button class="btn btn-outline-secondary history-btn" type="button" data-bs-toggle="collapse" data-bs-target="#history-3">
                                                                <i class="fas fa-history me-2"></i>History
                                                                <span class="badge bg-secondary recording-count">0</span>
                                                            </button>
                                                        </div>
                                                        <div class="collapse" id="history-3">
                                                            <div class="card">
                                                                <div class="card-body bg-light p-3">
                                                                    <h6 class="mb-3">Recording History</h6>
                                                                    <div class="recordings-list" id="recordings-3"></div>
                                                                    <div class="text-center text-muted empty-message">
                                                                        <i class="fas fa-microphone-slash me-2"></i>No recordings yet
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

                                <style>
                                    .spelling-patterns {
                                        background: #f8f9fa;
                                        padding: 1.5rem;
                                        border-radius: 8px;
                                    }

                                    .pattern-list {
                                        display: flex;
                                        flex-direction: column;
                                        gap: 1rem;
                                    }

                                    .pattern-item {
                                        display: flex;
                                        align-items: center;
                                        gap: 1rem;
                                    }

                                    .pattern-letter {
                                        font-weight: bold;
                                        color: #0d6efd;
                                        font-size: 1.2rem;
                                        width: 30px;
                                    }

                                    .pattern-examples {
                                        color: #6c757d;
                                    }

                                    .word-columns {
                                        margin-top: 2rem;
                                    }

                                    .word-column {
                                        display: flex;
                                        flex-direction: column;
                                        gap: 1rem;
                                    }

                                    .word-item {
                                        background: white;
                                        border: 2px solid #dee2e6;
                                        border-radius: 8px;
                                        padding: 1rem;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                    }

                                    .word-item:hover {
                                        border-color: #0d6efd;
                                        transform: translateY(-2px);
                                    }

                                    .word-item .word {
                                        font-size: 1.1rem;
                                        font-weight: 500;
                                        margin-bottom: 0.25rem;
                                    }

                                    .word-item .phonetic {
                                        color: #6c757d;
                                        font-size: 0.9rem;
                                    }

                                    .word-item.correct {
                                        background: #d4edda;
                                        border-color: #198754;
                                        color: #0f5132;
                                    }

                                    .word-item.incorrect {
                                        background: #f8d7da;
                                        border-color: #dc3545;
                                        color: #842029;
                                        animation: shake 0.5s;
                                    }

                                    @keyframes shake {

                                        0%,
                                        100% {
                                            transform: translateX(0);
                                        }

                                        10%,
                                        30%,
                                        50%,
                                        70%,
                                        90% {
                                            transform: translateX(-5px);
                                        }

                                        20%,
                                        40%,
                                        60%,
                                        80% {
                                            transform: translateX(5px);
                                        }
                                    }
                                </style>

                                <script>
                                    // Initialize word differentiation exercise
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const wordItems = document.querySelectorAll('.word-item');

                                        wordItems.forEach(item => {
                                            item.addEventListener('click', function() {
                                                const isCorrect = this.dataset.correct === 'true';

                                                if (isCorrect) {
                                                    this.classList.remove('incorrect');
                                                    this.classList.add('correct');
                                                } else {
                                                    this.classList.remove('correct');
                                                    this.classList.add('incorrect');
                                                    setTimeout(() => {
                                                        this.classList.remove('incorrect');
                                                    }, 1000);
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <!-- Practice 4: Short /ʌ/ Sound -->
                                <div class="card mt-4">
                                    <div class="card-body">
                                        @include('online.classes.summary-of-all-exercises.course-two.before.video-handout.short-u-sound-exercise', ['step' => $step])
                                    </div>
                                </div>

                                <!-- Practice 5: Common Spelling Pattern -->
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            <i class="fas fa-spell-check me-2"></i>Practice 5: Common Spelling Pattern for
                                            /ʌ/
                                        </h4>

                                        <div class="alert alert-info mb-4">
                                            <h5 class="alert-heading">
                                                <i class="fas fa-info-circle me-2"></i>Instructions
                                            </h5>
                                            <p class="mb-0">
                                                Find the word in each column that has a different sound from /ʌ/. Pay
                                                attention to the spelling patterns.
                                            </p>
                                        </div>

                                        <!-- Spelling Patterns Section -->
                                        <div class="spelling-patterns mb-4">
                                            <div class="pattern-list">
                                                <div class="pattern-item">
                                                    <span class="pattern-letter">u</span>
                                                    <span class="pattern-examples">sun, much, fun</span>
                                                </div>
                                                <div class="pattern-item">
                                                    <span class="pattern-letter">o</span>
                                                    <span class="pattern-examples">love, money, another</span>
                                                </div>
                                                <div class="pattern-item">
                                                    <span class="pattern-letter">ou</span>
                                                    <span class="pattern-examples">cousin, enough, country</span>
                                                </div>
                                                <div class="pattern-item">
                                                    <span class="pattern-letter">a</span>
                                                    <span class="pattern-examples">was, what</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Word Columns Section -->
                                        <div class="word-columns">
                                            <div class="row g-4">
                                                <div class="col-md-3">
                                                    <div class="word-column">
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">love</span>
                                                            <span class="phonetic">/lʌv/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">much</span>
                                                            <span class="phonetic">/mʌtʃ/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">lunch</span>
                                                            <span class="phonetic">/lʌntʃ/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="true">
                                                            <span class="word">happy</span>
                                                            <span class="phonetic">/ˈhæpi/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">honey</span>
                                                            <span class="phonetic">/ˈhʌni/</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="word-column">
                                                        <div class="word-item" data-correct="true">
                                                            <span class="word">don't</span>
                                                            <span class="phonetic">/dəʊnt/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">nothing</span>
                                                            <span class="phonetic">/ˈnʌθɪŋ/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">month</span>
                                                            <span class="phonetic">/mʌnθ/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">wonderful</span>
                                                            <span class="phonetic">/ˈwʌndəfʊl/</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="word-column">
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">young</span>
                                                            <span class="phonetic">/jʌŋ/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">enough</span>
                                                            <span class="phonetic">/ɪˈnʌf/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="true">
                                                            <span class="word">talking</span>
                                                            <span class="phonetic">/ˈtɔːkɪŋ/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">brother</span>
                                                            <span class="phonetic">/ˈbrʌðər/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">other</span>
                                                            <span class="phonetic">/ˈʌðər/</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="word-column">
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">company</span>
                                                            <span class="phonetic">/ˈkʌmpəni/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">cousin</span>
                                                            <span class="phonetic">/ˈkʌzn/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">once</span>
                                                            <span class="phonetic">/wʌns/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="true">
                                                            <span class="word">your</span>
                                                            <span class="phonetic">/jɔːr/</span>
                                                        </div>
                                                        <div class="word-item" data-correct="false">
                                                            <span class="word">understand</span>
                                                            <span class="phonetic">/ˌʌndərˈstænd/</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Practice 6: Short /ʌ/ Sound -->
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            <i class="fas fa-microphone me-2"></i>Practice 6: Short /ʌ/
                                        </h4>

                                        <div class="alert alert-info mb-4">
                                            <h5 class="alert-heading">
                                                <i class="fas fa-info-circle me-2"></i>Instructions
                                            </h5>
                                            <p class="mb-0">
                                                Listen to each sentence and practice pronouncing the words with the /ʌ/
                                                sound (highlighted in red).
                                                Record yourself and compare with the original audio.
                                            </p>
                                        </div>

                                        <!-- Sentences Practice Section -->
                                        <div class="sentences-practice">
                                            <div class="sentence-list">
                                                <!-- Sentence 1 -->
                                                <div class="sentence-item card mb-3">
                                                    <div class="card-body">
                                                        <div class="sentence-text mb-3">
                                                            My <span class="highlight-word">brother</span> <span
                                                                class="highlight-word">runs</span> to catch the <span
                                                                class="highlight-word">bus</span>.
                                                        </div>
                                                        <div class="d-flex gap-2 mb-3">
                                                            <div class="audio-player-wrapper">
                                                                <audio class="original-audio" controls>
                                                                    <source src="/audio/sentences/sentence4.mp3"
                                                                        type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                            <button class="btn btn-outline-primary record-btn"
                                                                data-sentence-id="4">
                                                                <i class="fas fa-microphone me-2"></i>Record
                                                            </button>
                                                            <button class="btn btn-outline-secondary history-btn"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#history-4">
                                                                <i class="fas fa-history me-2"></i>History
                                                                <span class="badge bg-secondary recording-count">0</span>
                                                            </button>
                                                        </div>
                                                        <div class="collapse" id="history-4">
                                                            <div class="card">
                                                                <div class="card-body bg-light p-3">
                                                                    <h6 class="mb-3">Recording History</h6>
                                                                    <div class="recordings-list" id="recordings-4"></div>
                                                                    <div class="text-center text-muted empty-message">
                                                                        <i class="fas fa-microphone-slash me-2"></i>No
                                                                        recordings yet
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Sentence 2 -->
                                                <div class="sentence-item card mb-3">
                                                    <div class="card-body">
                                                        <div class="sentence-text mb-3">
                                                            I <span class="highlight-word">love</span> to have <span
                                                                class="highlight-word">lunch</span> with my <span
                                                                class="highlight-word">cousin</span>.
                                                        </div>
                                                        <div class="d-flex gap-2 mb-3">
                                                            <div class="audio-player-wrapper">
                                                                <audio class="original-audio" controls>
                                                                    <source src="/audio/sentences/sentence5.mp3"
                                                                        type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                            <button class="btn btn-outline-primary record-btn"
                                                                data-sentence-id="5">
                                                                <i class="fas fa-microphone me-2"></i>Record
                                                            </button>
                                                            <button class="btn btn-outline-secondary history-btn"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#history-5">
                                                                <i class="fas fa-history me-2"></i>History
                                                                <span class="badge bg-secondary recording-count">0</span>
                                                            </button>
                                                        </div>
                                                        <div class="collapse" id="history-5">
                                                            <div class="card">
                                                                <div class="card-body bg-light p-3">
                                                                    <h6 class="mb-3">Recording History</h6>
                                                                    <div class="recordings-list" id="recordings-5"></div>
                                                                    <div class="text-center text-muted empty-message">
                                                                        <i class="fas fa-microphone-slash me-2"></i>No
                                                                        recordings yet
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Sentence 3 -->
                                                <div class="sentence-item card mb-3">
                                                    <div class="card-body">
                                                        <div class="sentence-text mb-3">
                                                            The <span class="highlight-word">young</span> <span
                                                                class="highlight-word">duck</span> <span
                                                                class="highlight-word">jumps</span> into the water.
                                                        </div>
                                                        <div class="d-flex gap-2 mb-3">
                                                            <div class="audio-player-wrapper">
                                                                <audio class="original-audio" controls>
                                                                    <source src="/audio/sentences/sentence6.mp3"
                                                                        type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                            <button class="btn btn-outline-primary record-btn"
                                                                data-sentence-id="6">
                                                                <i class="fas fa-microphone me-2"></i>Record
                                                            </button>
                                                            <button class="btn btn-outline-secondary history-btn"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#history-6">
                                                                <i class="fas fa-history me-2"></i>History
                                                                <span class="badge bg-secondary recording-count">0</span>
                                                            </button>
                                                        </div>
                                                        <div class="collapse" id="history-6">
                                                            <div class="card">
                                                                <div class="card-body bg-light p-3">
                                                                    <h6 class="mb-3">Recording History</h6>
                                                                    <div class="recordings-list" id="recordings-6"></div>
                                                                    <div class="text-center text-muted empty-message">
                                                                        <i class="fas fa-microphone-slash me-2"></i>No
                                                                        recordings yet
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

                                <!-- Practice 7: Word pair /ɑː/ & /ʌ/ -->
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            <i class="fas fa-exchange-alt me-2"></i>Practice 7: Phân Biệt Âm /ɑː/ & /ʌ/
                                        </h4>

                                        <div class="alert alert-info mb-4">
                                            <h5 class="alert-heading">
                                                <i class="fas fa-info-circle me-2"></i>Hướng Dẫn
                                            </h5>
                                            <p class="mb-0">
                                                Kéo các từ đang chạy phía trên và thả vào ô phù hợp bên dưới. Mỗi từ sẽ
                                                thuộc về một trong hai âm: /ɑː/ hoặc /ʌ/.
                                                Hãy lắng nghe kỹ phát âm của từng từ và quyết định xem nó thuộc nhóm âm nào.
                                            </p>
                                        </div>

                                        <!-- Word Stream Section -->
                                        <div class="word-stream-container mb-4">
                                            <div class="word-stream" id="wordStream">
                                                <!-- Words will be added here dynamically -->
                                            </div>
                                        </div>

                                        <!-- Drop Zones -->
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="drop-zone" id="longAhZone" data-sound="ɑː">
                                                    <div class="drop-zone-header">
                                                        <h5 class="mb-0">
                                                            <span class="phonetic-label">/ɑː/</span>
                                                            <span class="example-words">car, park, dark</span>
                                                        </h5>
                                                    </div>
                                                    <div class="drop-zone-content">
                                                        <!-- Dropped words will appear here -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="drop-zone" id="shortUZone" data-sound="ʌ">
                                                    <div class="drop-zone-header">
                                                        <h5 class="mb-0">
                                                            <span class="phonetic-label">/ʌ/</span>
                                                            <span class="example-words">cup, sun, run</span>
                                                        </h5>
                                                    </div>
                                                    <div class="drop-zone-content">
                                                        <!-- Dropped words will appear here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Progress Section -->
                                        <div class="progress-section mt-4">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="progress-label">Tiến độ:</span>
                                                <span class="progress-count">0/20 từ</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 0%"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <style>
                                    .spelling-patterns {
                                        background: #f8f9fa;
                                        padding: 1.5rem;
                                        border-radius: 8px;
                                    }

                                    .pattern-list {
                                        display: flex;
                                        flex-direction: column;
                                        gap: 1rem;
                                    }

                                    .pattern-item {
                                        display: flex;
                                        align-items: center;
                                        gap: 1rem;
                                    }

                                    .pattern-letter {
                                        font-weight: bold;
                                        color: #0d6efd;
                                        font-size: 1.2rem;
                                        width: 30px;
                                    }

                                    .pattern-examples {
                                        color: #6c757d;
                                    }

                                    .word-columns {
                                        margin-top: 2rem;
                                    }

                                    .word-column {
                                        display: flex;
                                        flex-direction: column;
                                        gap: 1rem;
                                    }

                                    .word-item {
                                        background: white;
                                        border: 2px solid #dee2e6;
                                        border-radius: 8px;
                                        padding: 1rem;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                    }

                                    .word-item:hover {
                                        border-color: #0d6efd;
                                        transform: translateY(-2px);
                                    }

                                    .word-item .word {
                                        font-size: 1.1rem;
                                        font-weight: 500;
                                        margin-bottom: 0.25rem;
                                    }

                                    .word-item .phonetic {
                                        color: #6c757d;
                                        font-size: 0.9rem;
                                    }

                                    .word-item.correct {
                                        background: #d4edda;
                                        border-color: #198754;
                                        color: #0f5132;
                                    }

                                    .word-item.incorrect {
                                        background: #f8d7da;
                                        border-color: #dc3545;
                                        color: #842029;
                                        animation: shake 0.5s;
                                    }

                                    @keyframes shake {

                                        0%,
                                        100% {
                                            transform: translateX(0);
                                        }

                                        10%,
                                        30%,
                                        50%,
                                        70%,
                                        90% {
                                            transform: translateX(-5px);
                                        }

                                        20%,
                                        40%,
                                        60%,
                                        80% {
                                            transform: translateX(5px);
                                        }
                                    }
                                </style>

                                <script>
                                    // Initialize word differentiation exercise
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const wordItems = document.querySelectorAll('.word-item');

                                        wordItems.forEach(item => {
                                            item.addEventListener('click', function() {
                                                const isCorrect = this.dataset.correct === 'true';

                                                if (isCorrect) {
                                                    this.classList.remove('incorrect');
                                                    this.classList.add('correct');
                                                } else {
                                                    this.classList.remove('correct');
                                                    this.classList.add('incorrect');
                                                    setTimeout(() => {
                                                        this.classList.remove('incorrect');
                                                    }, 1000);
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <!-- Practice 8: Kĩ thuật rút gọn âm (Reduction) -->
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            <i class="fas fa-volume-down me-2"></i>Practice 8: Kĩ thuật rút gọn âm
                                            (Reduction)
                                        </h4>

                                        <div class="alert alert-info mb-4">
                                            <h5 class="alert-heading">
                                                <i class="fas fa-info-circle me-2"></i>Hướng Dẫn
                                            </h5>
                                            <p class="mb-0">
                                                Nghe và chọn dạng rút gọn âm đúng cho mỗi câu. Chú ý cách phát âm tự nhiên
                                                trong giao tiếp hàng ngày.
                                            </p>
                                        </div>

                                        <!-- Reduction Type 1: Want to => wanna -->
                                        <div class="reduction-section mb-4">
                                            <h5 class="reduction-title">
                                                <span class="badge bg-primary me-2">1</span>
                                                Want to <i class="fas fa-arrow-right mx-2"></i>
                                                <span class="text-danger">wanna</span>
                                                <span class="phonetic text-muted">/wɒnə/</span>
                                            </h5>

                                            <div class="sentences-list">
                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/wanna1.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">Do you <span
                                                                class="highlight-word">want to</span> come over and watch
                                                            it with me?</div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">wanna</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">want to</button>
                                                    </div>
                                                </div>

                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/wanna2.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">Do you <span
                                                                class="highlight-word">want to</span> grab lunch later?
                                                        </div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">wanna</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">want to</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Reduction Type 2: Going to => gonna -->
                                        <div class="reduction-section mb-4">
                                            <h5 class="reduction-title">
                                                <span class="badge bg-primary me-2">2</span>
                                                Going to <i class="fas fa-arrow-right mx-2"></i>
                                                <span class="text-danger">gonna</span>
                                                <span class="phonetic text-muted">/ɡənə/</span>
                                            </h5>

                                            <div class="sentences-list">
                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/gonna1.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">When are they <span
                                                                class="highlight-word">going to</span> be in Chicago?</div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">gonna</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">going to</button>
                                                    </div>
                                                </div>

                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/gonna2.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">They're <span
                                                                class="highlight-word">going to</span> go camping.</div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">gonna</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">going to</button>
                                                    </div>
                                                </div>

                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/gonna3.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">What are you <span
                                                                class="highlight-word">going to</span> do in England?</div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">gonna</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">going to</button>
                                                    </div>
                                                </div>

                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/gonna4.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">I'm <span class="highlight-word">going
                                                                to</span> go to art galleries</div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">gonna</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">going to</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Reduction Type 3: Got to => gotta -->
                                        <div class="reduction-section mb-4">
                                            <h5 class="reduction-title">
                                                <span class="badge bg-primary me-2">3</span>
                                                Got to <i class="fas fa-arrow-right mx-2"></i>
                                                <span class="text-danger">gotta</span>
                                                <span class="phonetic text-muted">/ɡɒtə/</span>
                                            </h5>

                                            <div class="sentences-list">
                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/gotta1.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">I've <span class="highlight-word">got
                                                                to</span> run. Talk to you later.</div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">gotta</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">got to</button>
                                                    </div>
                                                </div>

                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/gotta2.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">We've <span class="highlight-word">got
                                                                to</span> hurry or we'll be late.</div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">gotta</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">got to</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Reduction Type 4: Kind of => kinda -->
                                        <div class="reduction-section mb-4">
                                            <h5 class="reduction-title">
                                                <span class="badge bg-primary me-2">4</span>
                                                Kind of <i class="fas fa-arrow-right mx-2"></i>
                                                <span class="text-danger">kinda</span>
                                                <span class="phonetic text-muted">/kaɪndə/</span>
                                            </h5>

                                            <div class="sentences-list">
                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/kinda1.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">He's <span class="highlight-word">kind
                                                                of</span> shy and not very talkative.</div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">kinda</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">kind of</button>
                                                    </div>
                                                </div>

                                                <div class="sentence-item p-3 border rounded mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-primary me-2 play-btn"
                                                            data-audio="/audio/reduction/kinda2.mp3">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <div class="sentence-text">It's <span class="highlight-word">kind
                                                                of</span> cold in here - can we close the window?</div>
                                                    </div>
                                                    <div class="options mt-2">
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="true">kinda</button>
                                                        <button class="btn btn-outline-secondary me-2 option-btn"
                                                            data-correct="false">kind of</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Progress Section -->
                                        <div class="progress-section mt-4">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="progress-label">Tiến độ:</span>
                                                <span class="progress-count">0/10 câu</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 0%"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <style>
                                    .reduction-section {
                                        background: #f8f9fa;
                                        padding: 20px;
                                        border-radius: 8px;
                                    }

                                    .reduction-title {
                                        color: #0d6efd;
                                        margin-bottom: 20px;
                                    }

                                    .highlight-word {
                                        color: #dc3545;
                                        font-weight: 500;
                                    }

                                    .phonetic {
                                        font-size: 0.9em;
                                    }

                                    .sentence-item {
                                        background: white;
                                        transition: all 0.3s ease;
                                    }

                                    .sentence-item:hover {
                                        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                                    }

                                    .option-btn {
                                        transition: all 0.3s ease;
                                        font-weight: 500;
                                        min-width: 100px;
                                    }

                                    .option-btn.correct {
                                        background-color: #198754;
                                        border-color: #198754;
                                        color: white;
                                        box-shadow: 0 0 10px rgba(25, 135, 84, 0.5);
                                    }

                                    .option-btn.incorrect {
                                        background-color: #dc3545;
                                        border-color: #dc3545;
                                        color: white;
                                        box-shadow: 0 0 10px rgba(220, 53, 69, 0.5);
                                    }

                                    /* Thêm icon cho trạng thái đúng/sai */
                                    .option-btn.correct::after {
                                        content: ' ✓';
                                        font-weight: bold;
                                    }

                                    .option-btn.incorrect::after {
                                        content: ' ✗';
                                        font-weight: bold;
                                    }

                                    /* Hiệu ứng hover cho nút chưa chọn */
                                    .option-btn:not(.correct):not(.incorrect):hover {
                                        background-color: #e9ecef;
                                        transform: translateY(-2px);
                                    }

                                    .play-btn:hover {
                                        transform: scale(1.1);
                                    }

                                    @keyframes shake {

                                        0%,
                                        100% {
                                            transform: translateX(0);
                                        }

                                        10%,
                                        30%,
                                        50%,
                                        70%,
                                        90% {
                                            transform: translateX(-5px);
                                        }

                                        20%,
                                        40%,
                                        60%,
                                        80% {
                                            transform: translateX(5px);
                                        }
                                    }

                                    .option-btn.incorrect {
                                        animation: shake 0.5s;
                                    }

                                    /* Hiệu ứng cho nút đúng */
                                    @keyframes pulse {
                                        0% {
                                            transform: scale(1);
                                        }

                                        50% {
                                            transform: scale(1.05);
                                        }

                                        100% {
                                            transform: scale(1);
                                        }
                                    }

                                    .option-btn.correct {
                                        animation: pulse 0.5s;
                                    }
                                </style>

                                <script>
                                    class ReductionPractice {
                                        constructor() {
                                            this.totalQuestions = 10;
                                            this.correctAnswers = 0;
                                            this.attemptedQuestions = new Set();

                                            this.initializeElements();
                                            this.setupEventListeners();
                                        }

                                        initializeElements() {
                                            this.progressBar = document.querySelector('.progress-bar');
                                            this.progressCount = document.querySelector('.progress-count');
                                            this.playButtons = document.querySelectorAll('.play-btn');
                                            this.optionButtons = document.querySelectorAll('.option-btn');
                                        }

                                        setupEventListeners() {
                                            // Setup audio play buttons
                                            this.playButtons.forEach(button => {
                                                button.addEventListener('click', () => {
                                                    const audioSrc = button.dataset.audio;
                                                    const audio = new Audio(audioSrc);
                                                    audio.play();
                                                });
                                            });

                                            // Setup option buttons
                                            this.optionButtons.forEach(button => {
                                                button.addEventListener('click', () => {
                                                    const sentenceItem = button.closest('.sentence-item');
                                                    if (!this.attemptedQuestions.has(sentenceItem)) {
                                                        this.handleAnswer(button);
                                                    }
                                                });
                                            });
                                        }

                                        handleAnswer(button) {
                                            const isCorrect = button.dataset.correct === 'true';
                                            const sentenceItem = button.closest('.sentence-item');
                                            const options = sentenceItem.querySelectorAll('.option-btn');

                                            // Mark this question as attempted
                                            this.attemptedQuestions.add(sentenceItem);

                                            if (isCorrect) {
                                                button.classList.add('correct');
                                                this.correctAnswers++;
                                                this.updateProgress();

                                                // Play success sound
                                                const audio = new Audio('/audio/success.mp3');
                                                audio.play();
                                            } else {
                                                button.classList.add('incorrect');

                                                // Show correct answer
                                                options.forEach(opt => {
                                                    if (opt.dataset.correct === 'true') {
                                                        opt.classList.add('correct');
                                                    }
                                                });
                                            }

                                            // Disable all options for this sentence
                                            options.forEach(opt => {
                                                opt.disabled = true;
                                            });

                                            // Check if practice is complete
                                            if (this.attemptedQuestions.size === this.totalQuestions) {
                                                this.showCompletionMessage();
                                            }
                                        }

                                        updateProgress() {
                                            const progress = (this.attemptedQuestions.size / this.totalQuestions) * 100;
                                            this.progressBar.style.width = `${progress}%`;
                                            this.progressCount.textContent = `${this.attemptedQuestions.size}/${this.totalQuestions} câu`;
                                        }

                                        showCompletionMessage() {
                                            const messageHTML = `
                                <div class="alert alert-success mt-4">
                                    <h4 class="alert-heading">Chúc mừng! 🎉</h4>
                                    <p>Bạn đã hoàn thành bài tập về kỹ thuật rút gọn âm!</p>
                                    <hr>
                                    <p class="mb-0">Số câu đúng: ${this.correctAnswers}/${this.totalQuestions}</p>
                                    <div class="mt-3">
                                        <button class="btn btn-primary" onclick="window.location.reload()">
                                            <i class="fas fa-redo me-2"></i>Làm Lại
                                        </button>
                                    </div>
                                </div>
                            `;

                                            const messageElement = document.createElement('div');
                                            messageElement.innerHTML = messageHTML;
                                            document.querySelector('.progress-section').after(messageElement);
                                        }
                                    }

                                    // Initialize Reduction Practice when the handout tab is shown
                                    document.getElementById('handout-tab').addEventListener('click', function() {
                                        if (!window.reductionPractice) {
                                            window.reductionPractice = new ReductionPractice();
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <style>
                        /* Word Stream Styles */
                        .word-stream-container {
                            background: #f8f9fa;
                            padding: 20px;
                            border-radius: 8px;
                            position: relative;
                            overflow: hidden;
                            height: 100px;
                        }

                        .word-stream {
                            position: relative;
                            height: 60px;
                            display: flex;
                            align-items: center;
                        }

                        .floating-word {
                            position: absolute;
                            background: white;
                            padding: 8px 16px;
                            border: 2px solid #0d6efd;
                            border-radius: 20px;
                            cursor: grab;
                            transition: transform 0.2s;
                            user-select: none;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            min-width: 100px;
                            animation: floatLeft 15s linear;
                        }

                        .floating-word:hover {
                            transform: scale(1.05);
                        }

                        .floating-word .word-text {
                            font-weight: 500;
                            color: #0d6efd;
                        }

                        .floating-word .phonetic {
                            font-size: 0.8em;
                            color: #6c757d;
                        }

                        @keyframes floatLeft {
                            from {
                                left: 100%;
                            }

                            to {
                                left: -120px;
                            }
                        }

                        /* Drop Zone Styles */
                        .drop-zone {
                            border: 3px dashed #dee2e6;
                            border-radius: 8px;
                            padding: 20px;
                            min-height: 200px;
                            transition: all 0.3s ease;
                        }

                        .drop-zone.drag-over {
                            border-color: #0d6efd;
                            background: #e7f1ff;
                        }

                        .drop-zone-header {
                            text-align: center;
                            margin-bottom: 15px;
                            padding-bottom: 15px;
                            border-bottom: 1px solid #dee2e6;
                        }

                        .phonetic-label {
                            font-size: 1.2em;
                            font-weight: bold;
                            color: #0d6efd;
                            margin-right: 10px;
                        }

                        .example-words {
                            color: #6c757d;
                            font-size: 0.9em;
                        }

                        .drop-zone-content {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 10px;
                            min-height: 100px;
                        }

                        .dropped-word {
                            background: white;
                            padding: 8px 16px;
                            border-radius: 20px;
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            animation: dropIn 0.3s ease;
                        }

                        .dropped-word.correct {
                            border: 2px solid #198754;
                            color: #198754;
                        }

                        .dropped-word.incorrect {
                            border: 2px solid #dc3545;
                            color: #dc3545;
                            animation: shake 0.5s;
                        }

                        @keyframes dropIn {
                            from {
                                transform: translateY(-20px);
                                opacity: 0;
                            }

                            to {
                                transform: translateY(0);
                                opacity: 1;
                            }
                        }

                        @keyframes shake {

                            0%,
                            100% {
                                transform: translateX(0);
                            }

                            10%,
                            30%,
                            50%,
                            70%,
                            90% {
                                transform: translateX(-5px);
                            }

                            20%,
                            40%,
                            60%,
                            80% {
                                transform: translateX(5px);
                            }
                        }

                        /* Progress Styles */
                        .progress-section {
                            background: #f8f9fa;
                            padding: 15px;
                            border-radius: 8px;
                            margin-top: 20px;
                        }

                        .progress-label {
                            font-weight: 500;
                        }

                        .progress {
                            height: 10px;
                        }
                    </style>

                    <script>
                        class WordPairPractice {
                            constructor() {
                                this.words = [{
                                        word: 'car',
                                        phonetic: '/kɑː/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/car.mp3'
                                    },
                                    {
                                        word: 'cup',
                                        phonetic: '/kʌp/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/cup.mp3'
                                    },
                                    {
                                        word: 'heart',
                                        phonetic: '/hɑːt/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/heart.mp3'
                                    },
                                    {
                                        word: 'sun',
                                        phonetic: '/sʌn/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/sun.mp3'
                                    },
                                    {
                                        word: 'park',
                                        phonetic: '/pɑːk/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/park.mp3'
                                    },
                                    {
                                        word: 'run',
                                        phonetic: '/rʌn/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/run.mp3'
                                    },
                                    {
                                        word: 'dark',
                                        phonetic: '/dɑːk/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/dark.mp3'
                                    },
                                    {
                                        word: 'bus',
                                        phonetic: '/bʌs/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/bus.mp3'
                                    },
                                    {
                                        word: 'farm',
                                        phonetic: '/fɑːm/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/farm.mp3'
                                    },
                                    {
                                        word: 'duck',
                                        phonetic: '/dʌk/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/duck.mp3'
                                    },
                                    {
                                        word: 'star',
                                        phonetic: '/stɑː/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/star.mp3'
                                    },
                                    {
                                        word: 'jump',
                                        phonetic: '/dʒʌmp/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/jump.mp3'
                                    },
                                    {
                                        word: 'palm',
                                        phonetic: '/pɑːm/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/palm.mp3'
                                    },
                                    {
                                        word: 'lunch',
                                        phonetic: '/lʌntʃ/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/lunch.mp3'
                                    },
                                    {
                                        word: 'calm',
                                        phonetic: '/kɑːm/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/calm.mp3'
                                    },
                                    {
                                        word: 'hug',
                                        phonetic: '/hʌɡ/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/hug.mp3'
                                    },
                                    {
                                        word: 'path',
                                        phonetic: '/pɑːθ/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/path.mp3'
                                    },
                                    {
                                        word: 'love',
                                        phonetic: '/lʌv/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/love.mp3'
                                    },
                                    {
                                        word: 'grass',
                                        phonetic: '/grɑːs/',
                                        sound: 'ɑː',
                                        audio: '/audio/vocabulary/grass.mp3'
                                    },
                                    {
                                        word: 'much',
                                        phonetic: '/mʌtʃ/',
                                        sound: 'ʌ',
                                        audio: '/audio/vocabulary/much.mp3'
                                    }
                                ];

                                this.correctCount = 0;
                                this.totalWords = this.words.length;
                                this.activeWords = new Set();
                                this.maxActiveWords = 5;
                                this.correctWords = new Set(); // Thêm set để theo dõi các từ đã đúng

                                this.initializeElements();
                                this.setupDropZones();
                                this.startWordStream();
                            }

                            initializeElements() {
                                this.wordStream = document.getElementById('wordStream');
                                this.progressBar = document.querySelector('.progress-bar');
                                this.progressCount = document.querySelector('.progress-count');
                                this.dropZones = document.querySelectorAll('.drop-zone');
                            }

                            setupDropZones() {
                                this.dropZones.forEach(zone => {
                                    zone.addEventListener('dragover', (e) => {
                                        e.preventDefault();
                                        zone.classList.add('drag-over');
                                    });

                                    zone.addEventListener('dragleave', () => {
                                        zone.classList.remove('drag-over');
                                    });

                                    zone.addEventListener('drop', (e) => {
                                        e.preventDefault();
                                        zone.classList.remove('drag-over');
                                        const wordData = JSON.parse(e.dataTransfer.getData('text/plain'));
                                        const draggedElement = document.querySelector(
                                            `.floating-word[data-word="${wordData.word}"]`);
                                        this.handleDrop(wordData, zone, draggedElement);
                                    });
                                });
                            }

                            createFloatingWord(wordData) {
                                if (this.correctWords.has(wordData.word)) {
                                    return null; // Không tạo từ đã đúng
                                }

                                const wordElement = document.createElement('div');
                                wordElement.className = 'floating-word';
                                wordElement.draggable = true;
                                wordElement.dataset.word = wordData.word;
                                wordElement.innerHTML = `
                                <span class="word-text">${wordData.word}</span>
                                <span class="phonetic">${wordData.phonetic}</span>
                            `;

                                wordElement.addEventListener('dragstart', (e) => {
                                    e.dataTransfer.setData('text/plain', JSON.stringify(wordData));
                                });

                                return wordElement;
                            }

                            startWordStream() {
                                this.shuffleWords();
                                this.addWords();
                                // Thêm từ mới mỗi 3 giây
                                setInterval(() => this.addWords(), 3000);
                            }

                            shuffleWords() {
                                for (let i = this.words.length - 1; i > 0; i--) {
                                    const j = Math.floor(Math.random() * (i + 1));
                                    [this.words[i], this.words[j]] = [this.words[j], this.words[i]];
                                }
                            }

                            addWords() {
                                // Chỉ thêm từ mới nếu chưa hoàn thành
                                if (this.correctCount < this.totalWords) {
                                    while (this.activeWords.size < this.maxActiveWords) {
                                        // Lặp qua tất cả các từ cho đến khi tìm thấy từ chưa đúng
                                        for (let word of this.words) {
                                            if (!this.activeWords.has(word.word) && !this.correctWords.has(word.word)) {
                                                const wordElement = this.createFloatingWord(word);
                                                if (wordElement) {
                                                    this.wordStream.appendChild(wordElement);
                                                    this.activeWords.add(word.word);

                                                    // Tính toán vị trí bắt đầu ngẫu nhiên
                                                    const startPosition = 100 + Math.random() * 20;
                                                    wordElement.style.left = `${startPosition}%`;

                                                    // Animation kết thúc
                                                    wordElement.addEventListener('animationend', () => {
                                                        if (this.activeWords.has(word.word) && !this.correctWords.has(word
                                                                .word)) {
                                                            this.activeWords.delete(word.word);
                                                            wordElement.remove();
                                                        }
                                                    });

                                                    break;
                                                }
                                            }
                                        }
                                        // Nếu không tìm thấy từ mới để thêm, thoát khỏi vòng lặp
                                        if (this.activeWords.size === this.correctWords.size) break;
                                    }
                                }
                            }

                            handleDrop(wordData, zone, wordElement) {
                                const isCorrect = wordData.sound === zone.dataset.sound;
                                const droppedElement = document.createElement('div');
                                droppedElement.className = `dropped-word ${isCorrect ? 'correct' : 'incorrect'}`;
                                droppedElement.innerHTML = `
                                <span>${wordData.word}</span>
                                <i class="fas ${isCorrect ? 'fa-check text-success' : 'fa-times text-danger'}"></i>
                            `;

                                if (isCorrect) {
                                    this.correctCount++;
                                    this.updateProgress();
                                    zone.querySelector('.drop-zone-content').appendChild(droppedElement);

                                    // Đánh dấu từ đã đúng và xóa khỏi stream
                                    this.correctWords.add(wordData.word);
                                    this.activeWords.delete(wordData.word);
                                    if (wordElement) {
                                        wordElement.remove();
                                    }

                                    // Play success sound
                                    const audio = new Audio(wordData.audio);
                                    audio.play();

                                    // Thêm từ mới
                                    this.addWords();

                                    if (this.correctCount === this.totalWords) {
                                        this.showCompletionMessage();
                                    }
                                } else {
                                    droppedElement.addEventListener('animationend', () => {
                                        droppedElement.remove();
                                    });
                                    zone.querySelector('.drop-zone-content').appendChild(droppedElement);
                                }
                            }

                            updateProgress() {
                                const progress = (this.correctCount / this.totalWords) * 100;
                                this.progressBar.style.width = `${progress}%`;
                                this.progressCount.textContent = `${this.correctCount}/${this.totalWords} từ`;
                            }

                            showCompletionMessage() {
                                const messageHTML = `
                                <div class="alert alert-success mt-4">
                                    <h4 class="alert-heading">Chúc mừng! 🎉</h4>
                                    <p>Bạn đã hoàn thành xuất sắc bài tập phân biệt âm /ɑː/ và /ʌ/!</p>
                                    <hr>
                                    <p class="mb-0">Số từ đúng: ${this.correctCount}/${this.totalWords}</p>
                                    <div class="mt-3">
                                        <button class="btn btn-primary" onclick="window.location.reload()">
                                            <i class="fas fa-redo me-2"></i>Làm Lại
                                        </button>
                                    </div>
                                </div>
                            `;

                                const messageElement = document.createElement('div');
                                messageElement.innerHTML = messageHTML;
                                document.querySelector('.progress-section').after(messageElement);
                            }
                        }

                        // Initialize Word Pair Practice when the handout tab is shown
                        document.getElementById('handout-tab').addEventListener('click', function() {
                            if (!window.wordPairPractice) {
                                window.wordPairPractice = new WordPairPractice();
                            }
                        });
                    </script>


                </div>
            </div>
        </div>

        <style>
            .video-item {
                transition: all 0.3s ease;
                border-left: 4px solid transparent;
            }

            .video-item:hover {
                background-color: #f8f9fa;
                border-left-color: #0d6efd;
            }

            .video-item.active {
                background-color: #0d6efd !important;
                /* Màu xanh đậm */
                border-left-color: #0d6efd;
                color: white !important;
                /* Đổi màu chữ thành trắng để dễ đọc */
            }

            .video-item.active .text-muted {
                color: rgba(255, 255, 255, 0.8) !important;
                /* Màu chữ mô tả cũng chuyển sang trắng nhạt */
            }

            .video-item.active .fa-play-circle {
                display: none;
            }

            .video-item .video-status {
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .video-item.watched .video-status {
                opacity: 1;
            }

            .accordion-button:not(.collapsed) {
                background-color: #f8f9fa;
                color: #0d6efd;
            }

            .accordion-button:focus {
                box-shadow: none;
            }

            /* Memory Game Styles */
            .memory-game-container {
                padding: 20px;
            }

            .memory-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 15px;
                margin-bottom: 20px;
            }

            .memory-card {
                aspect-ratio: 1;
                perspective: 1000px;
                cursor: pointer;
            }

            .memory-card-inner {
                position: relative;
                width: 100%;
                height: 100%;
                text-align: center;
                transition: transform 0.6s;
                transform-style: preserve-3d;
                cursor: pointer;
            }

            .memory-card.flipped .memory-card-inner {
                transform: rotateY(180deg);
            }

            .memory-card-front,
            .memory-card-back {
                position: absolute;
                width: 100%;
                height: 100%;
                backface-visibility: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2em;
                font-weight: bold;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .memory-card-front {
                background: linear-gradient(135deg, #0d6efd, #0dcaf0);
                color: white;
            }

            .memory-card-back {
                background: white;
                transform: rotateY(180deg);
                border: 2px solid #0d6efd;
                padding: 10px;
                text-align: center;
            }

            .memory-card-back .word {
                font-size: 1.2rem;
                color: #0d6efd;
            }

            .memory-card-back .phonetic {
                font-size: 0.9rem;
                color: #6c757d;
                margin-top: 5px;
            }

            .memory-card.matched .memory-card-inner {
                transform: rotateY(180deg);
                box-shadow: 0 0 15px rgba(25, 135, 84, 0.5);
            }

            .memory-card.matched .memory-card-back {
                border-color: #198754;
            }

            .memory-card.wrong {
                animation: shake 0.5s;
            }

            .game-stats {
                font-size: 1.1rem;
                color: #6c757d;
            }

            @keyframes shake {

                0%,
                100% {
                    transform: translateX(0);
                }

                10%,
                30%,
                50%,
                70%,
                90% {
                    transform: translateX(-5px);
                }

                20%,
                40%,
                60%,
                80% {
                    transform: translateX(5px);
                }
            }

            .memory-card-back.image-card {
                padding: 5px;
            }

            .memory-card-back .card-image {
                width: 100%;
                height: 100%;
                object-fit: contain;
                border-radius: 6px;
            }

            .memory-card-back.word-card {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 10px;
            }

            .memory-card-back .word {
                font-size: 1.4rem;
                color: #0d6efd;
                margin-bottom: 5px;
            }

            .memory-card-back .phonetic {
                font-size: 1rem;
                color: #6c757d;
            }

            .memory-card-back {
                position: relative;
            }

            .audio-btn {
                position: absolute;
                bottom: 5px;
                right: 5px;
                background: #0d6efd;
                color: white;
                border: none;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .audio-btn:hover {
                background: #0b5ed7;
                transform: scale(1.1);
            }

            .memory-card-back.word-card .audio-btn {
                bottom: 10px;
                right: 10px;
            }

            .memory-card-back.image-card .audio-btn {
                bottom: 10px;
                right: 10px;
                background: rgba(13, 110, 253, 0.8);
            }

            /* Recording Section Styles */
            .recording-section {
                background: #fff;
                border-radius: 8px;
            }

            .record-controls {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            #recordButton {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.5rem 1rem;
            }

            #recordButton.recording {
                background-color: #dc3545;
                border-color: #dc3545;
                animation: pulse 1.5s infinite;
            }

            #recordingTimer {
                font-size: 1.1rem;
                color: #dc3545;
                font-weight: 500;
            }

            .recording-item {
                display: flex;
                align-items: center;
                padding: 0.75rem;
                border: 1px solid #dee2e6;
                margin-bottom: 0.5rem;
                border-radius: 0.375rem;
                background: #f8f9fa;
            }

            .recording-item .recording-info {
                flex-grow: 1;
                margin-right: 1rem;
            }

            .recording-item .recording-actions {
                display: flex;
                gap: 0.5rem;
            }

            .recording-item .btn-action {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }

            /* Spelling Pattern Practice Styles */
            .word-options-container {
                margin: 20px 0;
            }

            .word-option {
                background: white;
                border: 2px solid #0d6efd;
                border-radius: 25px;
                padding: 8px 20px;
                font-size: 1.1rem;
                color: #0d6efd;
                cursor: pointer;
                transition: all 0.3s ease;
                margin: 5px;
            }

            .word-option:hover {
                background: #e7f1ff;
                transform: translateY(-2px);
            }

            .word-option.correct {
                background: #198754;
                border-color: #198754;
                color: white;
                transition: all 0.3s ease;
            }

            .word-option.incorrect {
                background: #dc3545;
                border-color: #dc3545;
                color: white;
                animation: shake 0.5s;
            }

            @keyframes shake {

                0%,
                100% {
                    transform: translateX(0);
                }

                10%,
                30%,
                50%,
                70%,
                90% {
                    transform: translateX(-5px);
                }

                20%,
                40%,
                60%,
                80% {
                    transform: translateX(5px);
                }
            }

            .audio-player {
                max-width: 500px;
                margin: 0 auto;
            }

            .highlight-word {
                color: #dc3545;
                font-weight: 500;
            }

            .sentence-text {
                font-size: 1.2rem;
                line-height: 1.5;
            }

            .sentence-item {
                border: 1px solid rgba(0, 0, 0, .125);
                transition: all 0.3s ease;
            }

            .sentence-item:hover {
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
            }

            .record-btn.recording {
                background-color: #dc3545;
                border-color: #dc3545;
                color: white;
                animation: pulse 1.5s infinite;
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }

            .recordings-list {
                margin-top: 1rem;
            }

            .recording-item {
                display: flex;
                align-items: center;
                padding: 0.5rem;
                background: white;
                border-radius: 0.25rem;
                margin-bottom: 0.5rem;
                border: 1px solid rgba(0, 0, 0, .125);
            }

            .recording-item .controls {
                display: flex;
                gap: 0.5rem;
            }

            .recording-item .timestamp {
                margin-right: auto;
                color: #6c757d;
            }

            .empty-message {
                padding: 1rem;
                font-size: 0.9rem;
                display: none;
            }

            .recordings-list:empty+.empty-message {
                display: block;
            }

            .history-btn .recording-count {
                margin-left: 5px;
            }

            .audio-player-wrapper {
                flex: 1;
                max-width: 300px;
            }

            .audio-player-wrapper audio {
                width: 100%;
                height: 38px;
            }

            /* Custom audio player styling */
            audio.original-audio {
                border-radius: 20px;
                background: #f8f9fa;
            }

            audio.original-audio::-webkit-media-controls-panel {
                background: #f8f9fa;
            }

            audio.original-audio::-webkit-media-controls-play-button {
                background-color: #0d6efd;
                border-radius: 50%;
            }

            audio.original-audio::-webkit-media-controls-play-button:hover {
                background-color: #0b5ed7;
            }

            audio.original-audio::-webkit-media-controls-current-time-display,
            audio.original-audio::-webkit-media-controls-time-remaining-display {
                color: #212529;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const videoItems = document.querySelectorAll('.video-item');
                const videoPlayer = document.getElementById('videoPlayer');

                videoItems.forEach(item => {
                    item.addEventListener('click', function() {
                        // Remove active class and restore play icon from all items
                        videoItems.forEach(i => {
                            i.classList.remove('active');
                            const playIcon = i.querySelector('.fa-play-circle');
                            if (playIcon) {
                                playIcon.style.display = 'inline-block';
                            }
                        });

                        // Add active class to clicked item
                        this.classList.add('active');

                        // Hide play icon of clicked item
                        const playIcon = this.querySelector('.fa-play-circle');
                        if (playIcon) {
                            playIcon.style.display = 'none';
                        }

                        // Update video source
                        const videoUrl = this.dataset.videoUrl;
                        videoPlayer.src = videoUrl;

                        // Mark as watched
                        this.classList.add('watched');
                    });
                });
            });

            // Memory Game for Long /ɑː/ Sound Practice
            class PronunciationMemoryGame {
                constructor() {
                    this.cards = [{
                            id: 1,
                            type: 'word',
                            word: 'car',
                            phonetic: '/kɑː/',
                            pair: 'car.jpg',
                            audio: '/audio/vocabulary/car.mp3'
                        },
                        {
                            id: 2,
                            type: 'image',
                            image: '/images/vocabulary/car.jpg',
                            pair: 'car',
                            audio: '/audio/vocabulary/car.mp3'
                        },
                        {
                            id: 3,
                            type: 'word',
                            word: 'star',
                            phonetic: '/stɑː/',
                            pair: 'star.jpg',
                            audio: '/audio/vocabulary/star.mp3'
                        },
                        {
                            id: 4,
                            type: 'image',
                            image: '/images/vocabulary/star.jpg',
                            pair: 'star',
                            audio: '/audio/vocabulary/star.mp3'
                        },
                        {
                            id: 5,
                            type: 'word',
                            word: 'heart',
                            phonetic: '/hɑːt/',
                            pair: 'heart.jpg',
                            audio: '/audio/vocabulary/heart.mp3'
                        },
                        {
                            id: 6,
                            type: 'image',
                            image: '/images/vocabulary/heart.jpg',
                            pair: 'heart',
                            audio: '/audio/vocabulary/heart.mp3'
                        },
                        {
                            id: 7,
                            type: 'word',
                            word: 'dark',
                            phonetic: '/dɑːk/',
                            pair: 'dark.jpg',
                            audio: '/audio/vocabulary/dark.mp3'
                        },
                        {
                            id: 8,
                            type: 'image',
                            image: '/images/vocabulary/dark.jpg',
                            pair: 'dark',
                            audio: '/audio/vocabulary/dark.mp3'
                        },
                        {
                            id: 9,
                            type: 'word',
                            word: 'park',
                            phonetic: '/pɑːk/',
                            pair: 'park.jpg',
                            audio: '/audio/vocabulary/park.mp3'
                        },
                        {
                            id: 10,
                            type: 'image',
                            image: '/images/vocabulary/park.jpg',
                            pair: 'park',
                            audio: '/audio/vocabulary/park.mp3'
                        },
                        {
                            id: 11,
                            type: 'word',
                            word: 'farm',
                            phonetic: '/fɑːm/',
                            pair: 'farm.jpg',
                            audio: '/audio/vocabulary/farm.mp3'
                        },
                        {
                            id: 12,
                            type: 'image',
                            image: '/images/vocabulary/farm.jpg',
                            pair: 'farm',
                            audio: '/audio/vocabulary/farm.mp3'
                        },
                        {
                            id: 13,
                            type: 'word',
                            word: 'grass',
                            phonetic: '/grɑːs/',
                            pair: 'grass.jpg',
                            audio: '/audio/vocabulary/grass.mp3'
                        },
                        {
                            id: 14,
                            type: 'image',
                            image: '/images/vocabulary/grass.jpg',
                            pair: 'grass',
                            audio: '/audio/vocabulary/grass.mp3'
                        },
                        {
                            id: 15,
                            type: 'word',
                            word: 'path',
                            phonetic: '/pɑːθ/',
                            pair: 'path.jpg',
                            audio: '/audio/vocabulary/path.mp3'
                        },
                        {
                            id: 16,
                            type: 'image',
                            image: '/images/vocabulary/path.jpg',
                            pair: 'path',
                            audio: '/audio/vocabulary/path.mp3'
                        }
                    ];

                    this.flippedCards = [];
                    this.matchedPairs = 0;
                    this.moves = 0;
                    this.isLocked = false;
                    this.startTime = null;
                    this.timerInterval = null;

                    this.grid = document.getElementById('memoryGrid');
                    this.moveCount = document.getElementById('moveCount');
                    this.matchCount = document.getElementById('matchCount');
                    this.timerDisplay = document.getElementById('memoryGameTimer');

                    this.initialize();
                }

                initialize() {
                    this.shuffleCards();
                    this.renderCards();
                    this.startTimer();
                }

                shuffleCards() {
                    for (let i = this.cards.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [this.cards[i], this.cards[j]] = [this.cards[j], this.cards[i]];
                    }
                }

                renderCards() {
                    this.grid.innerHTML = '';
                    this.cards.forEach((card, index) => {
                        const cardElement = document.createElement('div');
                        cardElement.className = 'memory-card';
                        cardElement.dataset.index = index;

                        if (card.type === 'word') {
                            cardElement.innerHTML = `
                            <div class="memory-card-inner">
                                <div class="memory-card-front">
                                    ${index + 1}
                                </div>
                                <div class="memory-card-back word-card">
                                    <div class="word">${card.word}</div>
                                    <div class="phonetic">${card.phonetic}</div>
                                    <button class="audio-btn" onclick="event.stopPropagation(); playAudio('${card.audio}')">
                                        <i class="fas fa-volume-up"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        } else {
                            cardElement.innerHTML = `
                            <div class="memory-card-inner">
                                <div class="memory-card-front">
                                    ${index + 1}
                                </div>
                                <div class="memory-card-back image-card">
                                    <img src="${card.image}" alt="${card.pair}" class="card-image">
                                    <button class="audio-btn" onclick="event.stopPropagation(); playAudio('${card.audio}')">
                                        <i class="fas fa-volume-up"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        }

                        cardElement.addEventListener('click', () => this.flipCard(cardElement, card));
                        this.grid.appendChild(cardElement);
                    });
                }

                flipCard(element, card) {
                    if (this.isLocked || element.classList.contains('flipped') || element.classList.contains('matched')) {
                        return;
                    }

                    element.classList.add('flipped');
                    this.flippedCards.push({
                        element,
                        card
                    });

                    if (this.flippedCards.length === 2) {
                        this.moves++;
                        this.moveCount.textContent = this.moves;
                        this.isLocked = true;
                        this.checkMatch();
                    }
                }

                checkMatch() {
                    const [first, second] = this.flippedCards;
                    const isMatch = (first.card.type === 'word' && second.card.type === 'image' && first.card.word ===
                            second.card.pair) ||
                        (first.card.type === 'image' && second.card.type === 'word' && first.card.pair === second.card
                            .word);

                    if (isMatch) {
                        this.handleMatch(first.element, second.element);
                    } else {
                        this.handleMismatch(first.element, second.element);
                    }
                }

                handleMatch(firstCard, secondCard) {
                    firstCard.classList.add('matched');
                    secondCard.classList.add('matched');
                    this.matchedPairs++;
                    this.matchCount.textContent = this.matchedPairs;

                    this.flippedCards = [];
                    this.isLocked = false;

                    if (this.matchedPairs === 8) {
                        this.handleGameComplete();
                    }
                }

                handleMismatch(firstCard, secondCard) {
                    firstCard.classList.add('wrong');
                    secondCard.classList.add('wrong');

                    setTimeout(() => {
                        firstCard.classList.remove('flipped', 'wrong');
                        secondCard.classList.remove('flipped', 'wrong');
                        this.flippedCards = [];
                        this.isLocked = false;
                    }, 1000);
                }

                startTimer() {
                    this.startTime = Date.now();
                    this.timerInterval = setInterval(() => {
                        const elapsed = Math.floor((Date.now() - this.startTime) / 1000);
                        const minutes = Math.floor(elapsed / 60);
                        const seconds = elapsed % 60;
                        this.timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                    }, 1000);
                }

                handleGameComplete() {
                    clearInterval(this.timerInterval);
                    const timeSpent = this.timerDisplay.textContent;

                    const messageHTML = `
                    <div class="alert alert-success mt-4">
                        <h4 class="alert-heading">Congratulations! 🎉</h4>
                        <p>You've completed the Long /ɑː/ Sound Practice!</p>
                        <hr>
                        <p class="mb-0">
                            ⏱️ Time: ${timeSpent}<br>
                            🔄 Moves: ${this.moves}<br>
                            ✅ Matches: ${this.matchedPairs}/8
                        </p>
                        <div class="mt-3">
                            <button class="btn btn-primary" onclick="window.location.reload()">
                                <i class="fas fa-redo me-2"></i>Play Again
                            </button>
                        </div>
                    </div>
                `;

                    const messageElement = document.createElement('div');
                    messageElement.innerHTML = messageHTML;
                    this.grid.parentNode.appendChild(messageElement);
                }
            }

            // Initialize the Pronunciation Memory Game when the handout tab is shown
            document.getElementById('handout-tab').addEventListener('click', function() {
                if (!window.pronunciationGame) {
                    window.pronunciationGame = new PronunciationMemoryGame();
                }
            });

            // Add audio playback function
            function playAudio(audioSrc) {
                const audio = new Audio(audioSrc);
                audio.play().catch(error => {
                    console.error('Error playing audio:', error);
                });
            }

            // Recording functionality
            class AudioRecorder {
                constructor() {
                    this.mediaRecorder = null;
                    this.audioChunks = [];
                    this.isRecording = false;
                    this.recordButton = document.getElementById('recordButton');
                    this.recordingTimer = document.getElementById('recordingTimer');
                    this.timerDisplay = document.getElementById('timerDisplay');
                    this.recordingsList = document.getElementById('recordingsList');
                    this.recordings = [];
                    this.timerInterval = null;
                    this.startTime = null;

                    this.setupEventListeners();
                }

                setupEventListeners() {
                    this.recordButton.addEventListener('click', () => {
                        if (!this.isRecording) {
                            this.startRecording();
                        } else {
                            this.stopRecording();
                        }
                    });
                }

                async startRecording() {
                    try {
                        const stream = await navigator.mediaDevices.getUserMedia({
                            audio: true
                        });
                        this.mediaRecorder = new MediaRecorder(stream);
                        this.audioChunks = [];

                        this.mediaRecorder.addEventListener('dataavailable', (event) => {
                            this.audioChunks.push(event.data);
                        });

                        this.mediaRecorder.addEventListener('stop', () => {
                            const audioBlob = new Blob(this.audioChunks, {
                                type: 'audio/wav'
                            });
                            const audioUrl = URL.createObjectURL(audioBlob);
                            this.addRecordingToList(audioUrl);
                        });

                        this.mediaRecorder.start();
                        this.isRecording = true;
                        this.startTime = Date.now();
                        this.startTimer();

                        this.recordButton.classList.add('recording');
                        this.recordButton.querySelector('span').textContent = 'Stop Recording';
                        this.recordButton.querySelector('i').className = 'fas fa-stop';
                        this.recordingTimer.classList.remove('d-none');

                    } catch (error) {
                        console.error('Error accessing microphone:', error);
                        alert('Error accessing microphone. Please ensure you have granted microphone permissions.');
                    }
                }

                stopRecording() {
                    if (this.mediaRecorder && this.isRecording) {
                        this.mediaRecorder.stop();
                        this.isRecording = false;
                        this.stopTimer();

                        this.recordButton.classList.remove('recording');
                        this.recordButton.querySelector('span').textContent = 'Start Recording';
                        this.recordButton.querySelector('i').className = 'fas fa-microphone';
                        this.recordingTimer.classList.add('d-none');

                        // Stop all tracks in the stream
                        this.mediaRecorder.stream.getTracks().forEach(track => track.stop());
                    }
                }

                startTimer() {
                    this.timerInterval = setInterval(() => {
                        const elapsed = Math.floor((Date.now() - this.startTime) / 1000);
                        const minutes = Math.floor(elapsed / 60).toString().padStart(2, '0');
                        const seconds = (elapsed % 60).toString().padStart(2, '0');
                        this.timerDisplay.textContent = `${minutes}:${seconds}`;
                    }, 1000);
                }

                stopTimer() {
                    clearInterval(this.timerInterval);
                    this.timerDisplay.textContent = '00:00';
                }

                addRecordingToList(audioUrl) {
                    const timestamp = new Date().toLocaleTimeString();
                    const recordingId = `recording-${Date.now()}`;

                    const recordingItem = document.createElement('div');
                    recordingItem.className = 'recording-item';
                    recordingItem.innerHTML = `
                    <div class="recording-info">
                        <div class="recording-title">Recording at ${timestamp}</div>
                    </div>
                    <div class="recording-actions">
                        <button class="btn btn-sm btn-primary btn-action play-btn" data-playing="false">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btn-action delete-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <audio id="${recordingId}" src="${audioUrl}"></audio>
                `;

                    // Add event listeners for play/pause
                    const playBtn = recordingItem.querySelector('.play-btn');
                    const audio = recordingItem.querySelector('audio');

                    playBtn.addEventListener('click', () => {
                        const isPlaying = playBtn.dataset.playing === 'true';
                        if (isPlaying) {
                            audio.pause();
                            playBtn.innerHTML = '<i class="fas fa-play"></i>';
                            playBtn.dataset.playing = 'false';
                        } else {
                            audio.play();
                            playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                            playBtn.dataset.playing = 'true';
                        }
                    });

                    // Add event listener for delete
                    const deleteBtn = recordingItem.querySelector('.delete-btn');
                    deleteBtn.addEventListener('click', () => {
                        if (confirm('Are you sure you want to delete this recording?')) {
                            recordingItem.remove();
                            URL.revokeObjectURL(audioUrl);
                        }
                    });

                    // Add event listener for audio end
                    audio.addEventListener('ended', () => {
                        playBtn.innerHTML = '<i class="fas fa-play"></i>';
                        playBtn.dataset.playing = 'false';
                    });

                    this.recordingsList.insertBefore(recordingItem, this.recordingsList.firstChild);
                }
            }

            // Initialize the recorder when the handout tab is shown
            document.getElementById('handout-tab').addEventListener('click', function() {
                if (!window.audioRecorder) {
                    window.audioRecorder = new AudioRecorder();
                }
            });

            // Spelling Pattern Practice
            class SpellingPatternPractice {
                constructor() {
                    this.words = [{
                            word: 'half',
                            audio: '/audio/vocabulary/half.mp3',
                            patterns: ['al']
                        },
                        {
                            word: 'bath',
                            audio: '/audio/vocabulary/bath.mp3',
                            patterns: ['a']
                        },
                        {
                            word: 'grass',
                            audio: '/audio/vocabulary/grass.mp3',
                            patterns: ['ass']
                        },
                        {
                            word: 'path',
                            audio: '/audio/vocabulary/path.mp3',
                            patterns: ['a']
                        },
                        {
                            word: 'start',
                            audio: '/audio/vocabulary/start.mp3',
                            patterns: ['ar']
                        },
                        {
                            word: 'father',
                            audio: '/audio/vocabulary/father.mp3',
                            patterns: ['a']
                        },
                        {
                            word: 'car',
                            audio: '/audio/vocabulary/car.mp3',
                            patterns: ['ar']
                        },
                        {
                            word: 'heart',
                            audio: '/audio/vocabulary/heart.mp3',
                            patterns: ['ear']
                        },
                        {
                            word: 'palm',
                            audio: '/audio/vocabulary/palm.mp3',
                            patterns: ['al']
                        },
                        {
                            word: 'calm',
                            audio: '/audio/vocabulary/calm.mp3',
                            patterns: ['al']
                        }
                    ];

                    this.currentAudio = document.getElementById('currentAudio');
                    this.container = document.querySelector('.word-options-container');
                    this.currentWordIndex = 0;

                    this.initialize();
                }

                initialize() {
                    this.shuffleWords();
                    this.renderWords();
                    this.loadCurrentAudio();
                    this.setupEventListeners();
                }

                loadCurrentAudio() {
                    if (this.currentWordIndex < this.words.length) {
                        this.currentAudio.src = this.words[this.currentWordIndex].audio;
                        this.currentAudio.play().catch(error => {
                            console.error('Error playing audio:', error);
                        });
                    } else {
                        // All words completed
                        this.showCompletionMessage();
                    }
                }

                shuffleWords() {
                    for (let i = this.words.length - 1; i > 0; i--) {
                        const j = Math.floor(Math.random() * (i + 1));
                        [this.words[i], this.words[j]] = [this.words[j], this.words[i]];
                    }
                }

                renderWords() {
                    this.container.innerHTML = '';
                    this.words.forEach(word => {
                        const wordButton = document.createElement('button');
                        wordButton.className = 'word-option';
                        wordButton.textContent = word.word;
                        this.container.appendChild(wordButton);
                    });
                }

                setupEventListeners() {
                    const wordButtons = this.container.querySelectorAll('.word-option');
                    wordButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            this.checkAnswer(button);
                        });
                    });

                    // Replay audio when it ends
                    this.currentAudio.addEventListener('ended', () => {
                        setTimeout(() => {
                            this.currentAudio.play().catch(error => {
                                console.error('Error replaying audio:', error);
                            });
                        }, 1000); // Wait 1 second before replaying
                    });
                }

                checkAnswer(button) {
                    const currentWord = this.words[this.currentWordIndex];
                    const isCorrect = button.textContent === currentWord.word;

                    if (isCorrect) {
                        // Add correct animation and remove the button
                        button.classList.add('correct');
                        setTimeout(() => {
                            button.style.transform = 'scale(0)';
                            button.style.opacity = '0';
                            setTimeout(() => {
                                button.remove();
                            }, 300); // Remove after animation
                        }, 500); // Start animation after showing correct state

                        // Move to next word
                        this.currentWordIndex++;
                        setTimeout(() => {
                            this.loadCurrentAudio();
                        }, 1000);
                    } else {
                        // Show incorrect feedback temporarily
                        button.classList.add('incorrect');
                        setTimeout(() => {
                            button.classList.remove('incorrect');
                        }, 1000);
                    }
                }

                showCompletionMessage() {
                    const messageHTML = `
                    <div class="alert alert-success mt-4">
                        <h4 class="alert-heading">Congratulations! 🎉</h4>
                        <p>You've completed all the words!</p>
                        <div class="mt-3">
                            <button class="btn btn-primary" onclick="window.location.reload()">
                                <i class="fas fa-redo me-2"></i>Practice Again
                            </button>
                        </div>
                    </div>
                `;

                    const messageElement = document.createElement('div');
                    messageElement.innerHTML = messageHTML;
                    this.container.parentNode.appendChild(messageElement);
                    this.container.style.display = 'none';
                }
            }

            // Initialize Spelling Pattern Practice when the handout tab is shown
            document.getElementById('handout-tab').addEventListener('click', function() {
                if (!window.spellingPractice) {
                    window.spellingPractice = new SpellingPatternPractice();
                }
            });

            class SentencePractice {
                constructor() {
                    this.initializeElements();
                    this.setupEventListeners();
                    this.mediaRecorder = null;
                    this.audioChunks = [];
                    this.isRecording = false;
                    this.currentRecordingBtn = null;
                }

                initializeElements() {
                    this.originalAudios = document.querySelectorAll('.original-audio');
                    this.recordButtons = document.querySelectorAll('.record-btn');
                }

                setupEventListeners() {
                    // Setup audio ended event
                    this.originalAudios.forEach(audio => {
                        audio.addEventListener('ended', () => {
                            // Optional: Add any behavior you want when the original audio ends
                        });
                    });

                    // Setup record buttons
                    this.recordButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            if (!this.isRecording) {
                                this.startRecording(button);
                            } else if (this.currentRecordingBtn === button) {
                                this.stopRecording();
                            }
                        });
                    });
                }

                async startRecording(button) {
                    try {
                        const stream = await navigator.mediaDevices.getUserMedia({
                            audio: true
                        });
                        this.mediaRecorder = new MediaRecorder(stream);
                        this.audioChunks = [];
                        this.currentRecordingBtn = button;

                        this.mediaRecorder.addEventListener('dataavailable', (event) => {
                            this.audioChunks.push(event.data);
                        });

                        this.mediaRecorder.addEventListener('stop', () => {
                            const audioBlob = new Blob(this.audioChunks, {
                                type: 'audio/wav'
                            });
                            const audioUrl = URL.createObjectURL(audioBlob);
                            this.addRecordingToList(audioUrl, button.dataset.sentenceId);
                        });

                        this.mediaRecorder.start();
                        this.isRecording = true;
                        button.classList.add('recording');
                        button.innerHTML = '<i class="fas fa-stop me-2"></i>Stop';

                    } catch (error) {
                        console.error('Error accessing microphone:', error);
                        alert('Error accessing microphone. Please ensure you have granted microphone permissions.');
                    }
                }

                stopRecording() {
                    if (this.mediaRecorder && this.isRecording) {
                        this.mediaRecorder.stop();
                        this.isRecording = false;
                        this.currentRecordingBtn.classList.remove('recording');
                        this.currentRecordingBtn.innerHTML = '<i class="fas fa-microphone me-2"></i>Record';

                        // Stop all tracks in the stream
                        this.mediaRecorder.stream.getTracks().forEach(track => track.stop());
                    }
                }

                addRecordingToList(audioUrl, sentenceId) {
                    const recordingsList = document.getElementById(`recordings-${sentenceId}`);
                    const timestamp = new Date().toLocaleTimeString();

                    const recordingItem = document.createElement('div');
                    recordingItem.className = 'recording-item';
                    recordingItem.innerHTML = `
                    <span class="timestamp">${timestamp}</span>
                    <div class="controls">
                        <button class="btn btn-sm btn-primary play-btn">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <audio src="${audioUrl}"></audio>
                `;

                    const playBtn = recordingItem.querySelector('.play-btn');
                    const deleteBtn = recordingItem.querySelector('.delete-btn');
                    const audio = recordingItem.querySelector('audio');

                    playBtn.addEventListener('click', () => {
                        if (audio.paused) {
                            audio.play();
                            playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                        } else {
                            audio.pause();
                            playBtn.innerHTML = '<i class="fas fa-play"></i>';
                        }
                    });

                    audio.addEventListener('ended', () => {
                        playBtn.innerHTML = '<i class="fas fa-play"></i>';
                    });

                    deleteBtn.addEventListener('click', () => {
                        if (confirm('Are you sure you want to delete this recording?')) {
                            recordingItem.remove();
                            URL.revokeObjectURL(audioUrl);
                        }
                    });

                    // Update recording count
                    const historyBtn = document.querySelector(`[data-bs-target="#history-${sentenceId}"]`);
                    const countBadge = historyBtn.querySelector('.recording-count');
                    const currentCount = parseInt(countBadge.textContent);
                    countBadge.textContent = currentCount + 1;

                    // Show history panel if it's the first recording
                    if (currentCount === 0) {
                        const historyPanel = document.getElementById(`history-${sentenceId}`);
                        bootstrap.Collapse.getOrCreateInstance(historyPanel).show();
                    }

                    recordingsList.insertBefore(recordingItem, recordingsList.firstChild);

                    // ... existing delete event listener ...
                    deleteBtn.addEventListener('click', () => {
                        if (confirm('Are you sure you want to delete this recording?')) {
                            recordingItem.remove();
                            URL.revokeObjectURL(audioUrl);

                            // Update recording count
                            const newCount = parseInt(countBadge.textContent) - 1;
                            countBadge.textContent = newCount;

                            // Hide history panel if no recordings left
                            if (newCount === 0) {
                                const historyPanel = document.getElementById(`history-${sentenceId}`);
                                bootstrap.Collapse.getOrCreateInstance(historyPanel).hide();
                            }
                        }
                    });
                }
            }

            // Initialize Sentence Practice when the handout tab is shown
            document.getElementById('handout-tab').addEventListener('click', function() {
                if (!window.sentencePractice) {
                    window.sentencePractice = new SentencePractice();
                }
            });

            // Memory Game for Short /ʌ/ Sound Practice
            class ShortVowelMemoryGame extends PronunciationMemoryGame {
                constructor() {
                    super();
                    this.cards = [{
                            id: 1,
                            type: 'word',
                            word: 'cup',
                            phonetic: '/kʌp/',
                            pair: 'cup.jpg',
                            audio: '/audio/vocabulary/cup.mp3'
                        },
                        {
                            id: 2,
                            type: 'image',
                            image: '/images/vocabulary/cup.jpg',
                            pair: 'cup',
                            audio: '/audio/vocabulary/cup.mp3'
                        },
                        {
                            id: 3,
                            type: 'word',
                            word: 'sun',
                            phonetic: '/sʌn/',
                            pair: 'sun.jpg',
                            audio: '/audio/vocabulary/sun.mp3'
                        },
                        {
                            id: 4,
                            type: 'image',
                            image: '/images/vocabulary/sun.jpg',
                            pair: 'sun',
                            audio: '/audio/vocabulary/sun.mp3'
                        },
                        {
                            id: 5,
                            type: 'word',
                            word: 'run',
                            phonetic: '/rʌn/',
                            pair: 'run.jpg',
                            audio: '/audio/vocabulary/run.mp3'
                        },
                        {
                            id: 6,
                            type: 'image',
                            image: '/images/vocabulary/run.jpg',
                            pair: 'run',
                            audio: '/audio/vocabulary/run.mp3'
                        },
                        {
                            id: 7,
                            type: 'word',
                            word: 'bus',
                            phonetic: '/bʌs/',
                            pair: 'bus.jpg',
                            audio: '/audio/vocabulary/bus.mp3'
                        },
                        {
                            id: 8,
                            type: 'image',
                            image: '/images/vocabulary/bus.jpg',
                            pair: 'bus',
                            audio: '/audio/vocabulary/bus.mp3'
                        },
                        {
                            id: 9,
                            type: 'word',
                            word: 'duck',
                            phonetic: '/dʌk/',
                            pair: 'duck.jpg',
                            audio: '/audio/vocabulary/duck.mp3'
                        },
                        {
                            id: 10,
                            type: 'image',
                            image: '/images/vocabulary/duck.jpg',
                            pair: 'duck',
                            audio: '/audio/vocabulary/duck.mp3'
                        },
                        {
                            id: 11,
                            type: 'word',
                            word: 'jump',
                            phonetic: '/dʒʌmp/',
                            pair: 'jump.jpg',
                            audio: '/audio/vocabulary/jump.mp3'
                        },
                        {
                            id: 12,
                            type: 'image',
                            image: '/images/vocabulary/jump.jpg',
                            pair: 'jump',
                            audio: '/audio/vocabulary/jump.mp3'
                        },
                        {
                            id: 13,
                            type: 'word',
                            word: 'lunch',
                            phonetic: '/lʌntʃ/',
                            pair: 'lunch.jpg',
                            audio: '/audio/vocabulary/lunch.mp3'
                        },
                        {
                            id: 14,
                            type: 'image',
                            image: '/images/vocabulary/lunch.jpg',
                            pair: 'lunch',
                            audio: '/audio/vocabulary/lunch.mp3'
                        },
                        {
                            id: 15,
                            type: 'word',
                            word: 'hug',
                            phonetic: '/hʌɡ/',
                            pair: 'hug.jpg',
                            audio: '/audio/vocabulary/hug.mp3'
                        },
                        {
                            id: 16,
                            type: 'image',
                            image: '/images/vocabulary/hug.jpg',
                            pair: 'hug',
                            audio: '/audio/vocabulary/hug.mp3'
                        }
                    ];

                    this.grid = document.getElementById('memoryGrid2');
                    this.moveCount = document.getElementById('moveCount2');
                    this.matchCount = document.getElementById('matchCount2');
                    this.timerDisplay = document.getElementById('memoryGameTimer2');

                    this.initialize();
                }
            }

            // Initialize both memory games when the handout tab is shown
            document.getElementById('handout-tab').addEventListener('click', function() {
                if (!window.pronunciationGame) {
                    window.pronunciationGame = new PronunciationMemoryGame();
                }
                if (!window.shortVowelGame) {
                    window.shortVowelGame = new ShortVowelMemoryGame();
                }
            });

            // Audio Recorder for Practice 4
            class AudioRecorder2 extends AudioRecorder {
                constructor() {
                    super();
                    this.recordButton = document.getElementById('recordButton2');
                    this.recordingTimer = document.getElementById('recordingTimer2');
                    this.timerDisplay = document.getElementById('timerDisplay2');
                    this.recordingsList = document.getElementById('recordingsList2');

                    this.setupEventListeners();
                }
            }

            // Initialize both recorders when the handout tab is shown
            document.getElementById('handout-tab').addEventListener('click', function() {
                if (!window.audioRecorder) {
                    window.audioRecorder = new AudioRecorder();
                }
                if (!window.audioRecorder2) {
                    window.audioRecorder2 = new AudioRecorder2();
                }
            });
        </script>

        <style>
            .sentence-text {
                display: flex;
                align-items: center;
                cursor: move;
                padding: 10px;
                background: #f8f9fa;
                border-radius: 4px;
            }

            .drag-handle {
                color: #6c757d;
                cursor: move;
            }

            .sentence-item.dragging {
                opacity: 0.5;
            }

            .sentence-item.correct {
                border-left: 4px solid #28a745;
            }

            .sentence-item.incorrect {
                border-left: 4px solid #dc3545;
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Định nghĩa dữ liệu câu
            const sentences = [
                {
                    id: 1,
                    content: 'How <span class="highlight-word">far</span> is the <span class="highlight-word">car park</span>?',
                    audioSrc: '/audio/sentences/sentence1.mp3'
                },
                {
                    id: 2,
                    content: 'We went to a <span class="highlight-word">large bar</span> full of film <span class="highlight-word">stars</span>.',
                    audioSrc: '/audio/sentences/sentence2.mp3'
                },
                {
                    id: 3,
                    content: 'We\'re <span class="highlight-word">starting</span> in half an hour.',
                    audioSrc: '/audio/sentences/sentence3.mp3'
                }
            ];

            // Trộn ngẫu nhiên các câu
            const shuffledSentences = [...sentences].sort(() => Math.random() - 0.5);

            // Lấy template và container
            const template = document.getElementById('sentence-template');
            const container = document.getElementById('sortable-sentences');

            // Tạo các phần tử câu
            shuffledSentences.forEach(sentence => {
                const clone = template.content.cloneNode(true);
                const item = clone.querySelector('.sentence-item');

                item.dataset.sentenceId = sentence.id;
                item.querySelector('.sentence-content').innerHTML = sentence.content;
                item.querySelector('audio source').src = sentence.audioSrc;

                const historyBtn = item.querySelector('.history-btn');
                const historyCollapse = item.querySelector('.collapse');
                const recordingsList = item.querySelector('.recordings-list');

                historyBtn.dataset.bsTarget = `#history-${sentence.id}`;
                historyCollapse.id = `history-${sentence.id}`;
                recordingsList.id = `recordings-${sentence.id}`;

                container.appendChild(clone);
            });

            // Khởi tạo Sortable
            new Sortable(container, {
                animation: 150,
                handle: '.drag-handle',
                ghostClass: 'dragging'
            });

            // Xử lý kiểm tra thứ tự
            document.getElementById('check-order-btn').addEventListener('click', function() {
                const currentOrder = Array.from(container.children).map(item => parseInt(item.dataset.sentenceId));
                const isCorrect = currentOrder.every((id, index) => id === sentences[index].id);

                const feedback = document.getElementById('order-feedback');
                feedback.classList.remove('d-none', 'alert-success', 'alert-danger');

                if (isCorrect) {
                    feedback.classList.add('alert-success');
                    feedback.innerHTML = '<i class="fas fa-check-circle me-2"></i>Congratulations! You have arranged the sentences correctly. You can now start recording.';

                    // Enable record buttons
                    document.querySelectorAll('.record-btn').forEach(btn => btn.disabled = false);
                } else {
                    feedback.classList.add('alert-danger');
                    feedback.innerHTML = '<i class="fas fa-times-circle me-2"></i>The order is not correct. Please try again!';

                    // Disable record buttons
                    document.querySelectorAll('.record-btn').forEach(btn => btn.disabled = true);
                }
            });
        });
        </script>
    @endsection
