@extends('online.layouts.master')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">{{ $title }}</h4>

            <ul class="nav nav-tabs" id="videoHandoutTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="instructions-tab" data-bs-toggle="tab" data-bs-target="#instructions" type="button" role="tab">
                        <span class="badge bg-info me-2"><i class="fas fa-info-circle"></i></span>HƯỚNG DẪN
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab">
                        <span class="badge bg-primary me-2">1</span>XEM VIDEO
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="handout-tab" data-bs-toggle="tab" data-bs-target="#handout" type="button" role="tab">
                        <span class="badge bg-primary me-2">2</span>LÀM BÀI TẬP HANDOUT
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="homework-tab" data-bs-toggle="tab" data-bs-target="#homework" type="button" role="tab">
                        <span class="badge bg-primary me-2">3</span>HOMEWORK
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
                                <button class="btn btn-primary btn-lg" onclick="document.getElementById('video-tab').click()">
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
                                        <iframe id="videoPlayer" src="" title="Video Learning" allowfullscreen class="rounded"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Video Folders and List -->
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="accordion" id="videoFoldersAccordion">
                                        @foreach($video_folders as $folder)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#folder{{ $folder['id'] }}">
                                                    <i class="fas fa-folder{{ $loop->first ? '-open' : '' }} me-2 text-warning"></i>
                                                    {{ $folder['name'] }}
                                                </button>
                                            </h2>
                                            <div id="folder{{ $folder['id'] }}"
                                                 class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                 data-bs-parent="#videoFoldersAccordion">
                                                <div class="accordion-body p-0">
                                                    <div class="list-group list-group-flush">
                                                        @foreach($folder['videos'] as $video)
                                                        <button type="button"
                                                                class="list-group-item list-group-item-action video-item"
                                                                data-video-url="{{ $video['url'] }}">
                                                            <div class="d-flex w-100 justify-content-between align-items-center">
                                                                <div>
                                                                    <h6 class="mb-1">
                                                                        <i class="fas fa-play-circle me-2 text-primary"></i>
                                                                        {{ $video['title'] }}
                                                                    </h6>
                                                                    <p class="mb-1 small text-muted">{{ $video['description'] }}</p>
                                                                </div>
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
                    <div class="row">
                        <div class="col-12">
                            <!-- Main Lesson Sections -->
                            <div class="row g-4 mb-4">
                                <!-- Pronunciation Section Card -->
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Pronunciation</h4>
                                            <div class="list-group list-group-flush">
                                                <div class="list-group-item border-0 px-0">
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary me-2">1</span>
                                                        <span>Vowel: long /a:/</span>
                                                    </div>
                                                </div>
                                                <div class="list-group-item border-0 px-0">
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary me-2">2</span>
                                                        <span>Vowel: short /ʌ/</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Listening & Speaking Section Card -->
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">Listening & Speaking</h4>
                                            <div class="list-group list-group-flush">
                                                <div class="list-group-item border-0 px-0">
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary me-2">1</span>
                                                        <span>Unit 1: Hometown</span>
                                                    </div>
                                                </div>
                                                <div class="list-group-item border-0 px-0">
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary me-2">2</span>
                                                        <span>Reduction</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Exercise Content Section -->
                            <div class="card">
                                <div class="card-body">
                                    <div id="exerciseContent">
                                        <!-- Pronunciation Exercise -->
                                        <div class="pronunciation-exercise">
                                            <h3 class="mb-4">1. Vowel: long /a:/</h3>

                                            <!-- Pronunciation Cards Grid -->
                                            <div class="row g-4 mb-5">
                                                <!-- Father Card -->
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="pronunciation-card">
                                                        <div class="card-flip">
                                                            <div class="card-front">
                                                                <img src="/images/lessons/father.png" alt="Father" class="img-fluid mb-2">
                                                                <div class="word-text">/fa:ðər/</div>
                                                            </div>
                                                            <div class="card-back">
                                                                <div class="d-flex flex-column justify-content-center h-100">
                                                                    <h5 class="text-center mb-3">father</h5>
                                                                    <button class="btn btn-primary btn-play-audio">
                                                                        <i class="fas fa-volume-up"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="practice-controls mt-3">
                                                            <button class="btn btn-sm btn-record" data-word="father">
                                                                <i class="fas fa-microphone"></i> Record
                                                            </button>
                                                            <button class="btn btn-sm btn-play-recording d-none">
                                                                <i class="fas fa-play"></i> Play
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Arm Card -->
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="pronunciation-card">
                                                        <div class="card-flip">
                                                            <div class="card-front">
                                                                <img src="/images/lessons/arm.png" alt="Arm" class="img-fluid mb-2">
                                                                <div class="word-text">/a:rm/</div>
                                                            </div>
                                                            <div class="card-back">
                                                                <div class="d-flex flex-column justify-content-center h-100">
                                                                    <h5 class="text-center mb-3">arm</h5>
                                                                    <button class="btn btn-primary btn-play-audio">
                                                                        <i class="fas fa-volume-up"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="practice-controls mt-3">
                                                            <button class="btn btn-sm btn-record" data-word="arm">
                                                                <i class="fas fa-microphone"></i> Record
                                                            </button>
                                                            <button class="btn btn-sm btn-play-recording d-none">
                                                                <i class="fas fa-play"></i> Play
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Add more pronunciation cards here -->
                                            </div>

                                            <!-- Common Spelling Pattern Section -->
                                            <div class="spelling-pattern-section bg-light p-4 rounded-3 mb-4">
                                                <h5 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Common Spelling Pattern for /a:/</h5>
                                                <div class="pattern-content">
                                                    <p class="mb-2"><strong>ar:</strong> far, car, park, star, start</p>
                                                </div>
                                            </div>

                                            <!-- Practice Sentences -->
                                            <div class="practice-sentences">
                                                <h5 class="mb-3"><i class="fas fa-comments text-primary me-2"></i>Practice Sentences</h5>
                                                <div class="sentences-list">
                                                    <div class="sentence-item mb-3">
                                                        <p class="mb-2">1. How far is the car park?</p>
                                                        <button class="btn btn-sm btn-outline-primary btn-play-sentence">
                                                            <i class="fas fa-volume-up"></i> Listen
                                                        </button>
                                                    </div>
                                                    <div class="sentence-item mb-3">
                                                        <p class="mb-2">2. We went to a large bar full of film stars.</p>
                                                        <button class="btn btn-sm btn-outline-primary btn-play-sentence">
                                                            <i class="fas fa-volume-up"></i> Listen
                                                        </button>
                                                    </div>
                                                    <div class="sentence-item">
                                                        <p class="mb-2">3. We're starting in half an hour.</p>
                                                        <button class="btn btn-sm btn-outline-primary btn-play-sentence">
                                                            <i class="fas fa-volume-up"></i> Listen
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Second Pronunciation Exercise -->
                                        <div class="pronunciation-exercise mt-5">
                                            <h3 class="mb-4">2. Vowel: Short /ʌ/</h3>

                                            <!-- Pronunciation Cards Grid -->
                                            <div class="row g-4 mb-5">
                                                <!-- Ask Card -->
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="pronunciation-card">
                                                        <div class="card-flip">
                                                            <div class="card-front">
                                                                <img src="/images/lessons/ask.png" alt="Ask" class="img-fluid mb-2">
                                                                <div class="word-text">/ʌsk/</div>
                                                            </div>
                                                            <div class="card-back">
                                                                <div class="d-flex flex-column justify-content-center h-100">
                                                                    <h5 class="text-center mb-3">ask</h5>
                                                                    <button class="btn btn-primary btn-play-audio">
                                                                        <i class="fas fa-volume-up"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="practice-controls mt-3">
                                                            <button class="btn btn-sm btn-record" data-word="ask">
                                                                <i class="fas fa-microphone"></i> Record
                                                            </button>
                                                            <button class="btn btn-sm btn-play-recording d-none">
                                                                <i class="fas fa-play"></i> Play
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Public Card -->
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="pronunciation-card">
                                                        <div class="card-flip">
                                                            <div class="card-front">
                                                                <img src="/images/lessons/public.png" alt="Public" class="img-fluid mb-2">
                                                                <div class="word-text">/pʌblɪk/</div>
                                                            </div>
                                                            <div class="card-back">
                                                                <div class="d-flex flex-column justify-content-center h-100">
                                                                    <h5 class="text-center mb-3">public</h5>
                                                                    <button class="btn btn-primary btn-play-audio">
                                                                        <i class="fas fa-volume-up"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="practice-controls mt-3">
                                                            <button class="btn btn-sm btn-record" data-word="public">
                                                                <i class="fas fa-microphone"></i> Record
                                                            </button>
                                                            <button class="btn btn-sm btn-play-recording d-none">
                                                                <i class="fas fa-play"></i> Play
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Country Card -->
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="pronunciation-card">
                                                        <div class="card-flip">
                                                            <div class="card-front">
                                                                <img src="/images/lessons/country.png" alt="Country" class="img-fluid mb-2">
                                                                <div class="word-text">/kʌntri/</div>
                                                            </div>
                                                            <div class="card-back">
                                                                <div class="d-flex flex-column justify-content-center h-100">
                                                                    <h5 class="text-center mb-3">country</h5>
                                                                    <button class="btn btn-primary btn-play-audio">
                                                                        <i class="fas fa-volume-up"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="practice-controls mt-3">
                                                            <button class="btn btn-sm btn-record" data-word="country">
                                                                <i class="fas fa-microphone"></i> Record
                                                            </button>
                                                            <button class="btn btn-sm btn-play-recording d-none">
                                                                <i class="fas fa-play"></i> Play
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Bus Card -->
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="pronunciation-card">
                                                        <div class="card-flip">
                                                            <div class="card-front">
                                                                <img src="/images/lessons/bus.png" alt="Bus" class="img-fluid mb-2">
                                                                <div class="word-text">/bʌs/</div>
                                                            </div>
                                                            <div class="card-back">
                                                                <div class="d-flex flex-column justify-content-center h-100">
                                                                    <h5 class="text-center mb-3">bus</h5>
                                                                    <button class="btn btn-primary btn-play-audio">
                                                                        <i class="fas fa-volume-up"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="practice-controls mt-3">
                                                            <button class="btn btn-sm btn-record" data-word="bus">
                                                                <i class="fas fa-microphone"></i> Record
                                                            </button>
                                                            <button class="btn btn-sm btn-play-recording d-none">
                                                                <i class="fas fa-play"></i> Play
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Add more cards for other words -->
                                            </div>

                                            <!-- Common Spelling Pattern Section -->
                                            <div class="spelling-pattern-section bg-light p-4 rounded-3 mb-4">
                                                <h5 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Common Spelling Patterns for /ʌ/</h5>
                                                <div class="pattern-content">
                                                    <p class="mb-2"><strong>u:</strong> sun, much, fun</p>
                                                    <p class="mb-2"><strong>o:</strong> love, money, another</p>
                                                    <p class="mb-2"><strong>ou:</strong> cousin, enough, country</p>
                                                    <p class="mb-2"><strong>a:</strong> was, what</p>
                                                </div>
                                            </div>

                                            <!-- Practice Sentences -->
                                            <div class="practice-sentences">
                                                <h5 class="mb-3"><i class="fas fa-comments text-primary me-2"></i>Practice Sentences</h5>
                                                <div class="sentences-list">
                                                    <div class="sentence-item mb-3">
                                                        <p class="mb-2">1. What country are you from?</p>
                                                        <button class="btn btn-sm btn-outline-primary btn-play-sentence">
                                                            <i class="fas fa-volume-up"></i> Listen
                                                        </button>
                                                    </div>
                                                    <div class="sentence-item mb-3">
                                                        <p class="mb-2">2. What's up? Nothing much.</p>
                                                        <button class="btn btn-sm btn-outline-primary btn-play-sentence">
                                                            <i class="fas fa-volume-up"></i> Listen
                                                        </button>
                                                    </div>
                                                    <div class="sentence-item mb-3">
                                                        <p class="mb-2">3. That was fun!</p>
                                                        <button class="btn btn-sm btn-outline-primary btn-play-sentence">
                                                            <i class="fas fa-volume-up"></i> Listen
                                                        </button>
                                                    </div>
                                                    <div class="sentence-item mb-3">
                                                        <p class="mb-2">4. Do you have enough money?</p>
                                                        <button class="btn btn-sm btn-outline-primary btn-play-sentence">
                                                            <i class="fas fa-volume-up"></i> Listen
                                                        </button>
                                                    </div>
                                                    <div class="sentence-item">
                                                        <p class="mb-2">5. Would you like another one?</p>
                                                        <button class="btn btn-sm btn-outline-primary btn-play-sentence">
                                                            <i class="fas fa-volume-up"></i> Listen
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Reduction Practice Section -->
                                        <div class="reduction-practice mt-5">
                                            <h3 class="mb-4">3. Reduction</h3>

                                            <!-- Introduction -->
                                            <div class="alert alert-info mb-4">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Learn how words are reduced in natural English conversation. Listen to the examples and practice the reduced forms.
                                            </div>

                                            <!-- Reduction Types Tabs -->
                                            <ul class="nav nav-pills mb-4" id="reductionTabs" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#wanna" type="button">
                                                        want to → wanna
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#gonna" type="button">
                                                        going to → gonna
                                                    </button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#gotta" type="button">
                                                        got to → gotta
                                                    </button>
                                                </li>
                                            </ul>

                                            <!-- Tab Content -->
                                            <div class="tab-content" id="reductionTabContent">
                                                <!-- Wanna Tab -->
                                                <div class="tab-pane fade show active" id="wanna">
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">3.1 Want to → Wanna</h5>

                                                            <!-- Dialogue Practice -->
                                                            <div class="dialogue-practice mb-4">
                                                                <div class="dialogue-box bg-light p-4 rounded">
                                                                    <div class="dialogue-line mb-3">
                                                                        <span class="speaker">A:</span> Hello
                                                                        <button class="btn btn-sm btn-outline-primary ms-2 btn-play-audio">
                                                                            <i class="fas fa-volume-up"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="dialogue-line mb-3">
                                                                        <span class="speaker">B:</span> Hi Jack, This is Kate
                                                                        <button class="btn btn-sm btn-outline-primary ms-2 btn-play-audio">
                                                                            <i class="fas fa-volume-up"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="dialogue-line mb-3">
                                                                        <span class="speaker">A:</span> Oh, hi Kate
                                                                        <button class="btn btn-sm btn-outline-primary ms-2 btn-play-audio">
                                                                            <i class="fas fa-volume-up"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="dialogue-line mb-3">
                                                                        <span class="speaker">B:</span> Hey, there's a good movie on TV tonight
                                                                        <button class="btn btn-sm btn-outline-primary ms-2 btn-play-audio">
                                                                            <i class="fas fa-volume-up"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="dialogue-line highlight">
                                                                        <span class="speaker">Q:</span> Do you <span class="text-primary">wanna</span> come over and watch it with me?
                                                                        <button class="btn btn-sm btn-outline-primary ms-2 btn-play-audio">
                                                                            <i class="fas fa-volume-up"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Practice Exercise -->
                                                            <div class="practice-exercise">
                                                                <h6 class="mb-3">Practice: Transform "want to" to "wanna"</h6>
                                                                <div class="exercise-item mb-3">
                                                                    <p class="mb-2">1. I want to go to the movies.</p>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Transform the sentence...">
                                                                        <button class="btn btn-primary btn-check">Check</button>
                                                                    </div>
                                                                    <div class="feedback mt-2 d-none">
                                                                        <div class="correct-feedback text-success">
                                                                            <i class="fas fa-check-circle"></i> Correct! "I wanna go to the movies."
                                                                        </div>
                                                                        <div class="incorrect-feedback text-danger">
                                                                            <i class="fas fa-times-circle"></i> Try again!
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Gonna Tab -->
                                                <div class="tab-pane fade" id="gonna">
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">3.2 Going to → Gonna</h5>

                                                            <!-- Example Sentences -->
                                                            <div class="example-sentences mb-4">
                                                                <div class="sentence-box bg-light p-3 rounded mb-3">
                                                                    <p class="mb-2">When are they <span class="text-primary">gonna</span> be in Chicago?</p>
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-volume-up"></i> Listen
                                                                    </button>
                                                                </div>
                                                                <div class="sentence-box bg-light p-3 rounded mb-3">
                                                                    <p class="mb-2">They're <span class="text-primary">gonna</span> go camping.</p>
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-volume-up"></i> Listen
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <!-- Practice Exercise -->
                                                            <div class="practice-exercise">
                                                                <h6 class="mb-3">Your Turn: Transform "going to" to "gonna"</h6>
                                                                <div class="exercise-item mb-3">
                                                                    <p class="mb-2">What are you going to do in English?</p>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Transform the sentence...">
                                                                        <button class="btn btn-primary btn-check">Check</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Gotta Tab -->
                                                <div class="tab-pane fade" id="gotta">
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-4">3.3 Got to → Gotta</h5>

                                                            <!-- Example Sentences -->
                                                            <div class="example-sentences mb-4">
                                                                <div class="sentence-box bg-light p-3 rounded mb-3">
                                                                    <p class="mb-2">I've <span class="text-primary">gotta</span> talk to you later.</p>
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-volume-up"></i> Listen
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <!-- Practice Exercise -->
                                                            <div class="practice-exercise">
                                                                <h6 class="mb-3">Practice: Transform "got to" to "gotta"</h6>
                                                                <div class="exercise-item mb-3">
                                                                    <p class="mb-2">I've got to finish this work today.</p>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Transform the sentence...">
                                                                        <button class="btn btn-primary btn-check">Check</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Speaking Practice Section -->
                                        <div class="speaking-practice mt-5">
                                            <div class="section-header d-flex align-items-center mb-4">
                                                <h3 class="mb-0">4. Speaking Practice: Unit 1 - Hometown</h3>
                                            </div>

                                            <!-- Grammar Focus Card -->
                                            <div class="card mb-4">
                                                <div class="card-header bg-light d-flex align-items-center">
                                                    <span class="badge bg-primary me-2">4.1</span>
                                                    <h5 class="mb-0">Grammar Focus: Adverb + Adjective</h5>
                                                </div>
                                                <div class="card-body">
                                                    <!-- Example Cards Grid -->
                                                    <div class="row g-3 mb-4">
                                                        <div class="col-md-4">
                                                            <div class="example-card bg-light p-3 rounded h-100">
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <i class="fas fa-city text-primary me-2"></i>
                                                                    <h6 class="mb-0">City Description</h6>
                                                                </div>
                                                                <p class="mb-0">
                                                                    <span class="text-primary">extremely beautiful</span> city
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="example-card bg-light p-3 rounded h-100">
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <i class="fas fa-users text-primary me-2"></i>
                                                                    <h6 class="mb-0">People Description</h6>
                                                                </div>
                                                                <p class="mb-0">
                                                                    <span class="text-primary">very friendly</span> people
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="example-card bg-light p-3 rounded h-100">
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <i class="fas fa-globe text-primary me-2"></i>
                                                                    <h6 class="mb-0">Culture Description</h6>
                                                                </div>
                                                                <p class="mb-0">
                                                                    <span class="text-primary">really interesting</span> culture
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Practice Link -->
                                                    <div class="text-end">
                                                        <a href="https://wordwall.net/resource/65218962"
                                                           target="_blank"
                                                           class="btn btn-outline-primary">
                                                            <i class="fas fa-external-link-alt me-2"></i>
                                                            Practice More
                                                        </a>
                                                    </div>
                                                </div>
                                    </div>

                                            <!-- Speaking Formula Card -->
                                            <div class="card mb-4">
                                                <div class="card-header bg-light d-flex align-items-center">
                                                    <span class="badge bg-primary me-2">4.2</span>
                                                    <h5 class="mb-0">Speaking Formula: What do you like most about X?</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="formula-steps">
                                                        <!-- Step 0 (Instructions) -->
                                                        <div class="step-card mb-4">
                                                            <div class="step-header bg-primary text-white p-3 rounded-top">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="step-number me-3">0</span>
                                                                    <h6 class="mb-0">Instructions</h6>
                                                                </div>
                                                            </div>
                                                            <div class="step-content p-3 border border-top-0 rounded-bottom">
                                                                <div class="mb-3">
                                                                    <p class="lead text-primary mb-3">
                                                                        "First off, the thing that I love the most about X is that..."
                                                                    </p>
                                                                    <div class="pattern-options">
                                                                        <div class="pattern bg-light p-3 rounded mb-2">
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <span class="badge bg-primary me-2">Pattern A</span>
                                                                                <strong>there are/is + ADJECTIVE + NOUN, so + (kết quả)</strong>
                                                                            </div>
                                                                        </div>
                                                                        <div class="pattern bg-light p-3 rounded">
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <span class="badge bg-primary me-2">Pattern B</span>
                                                                                <strong>the + NOUN + is + ADJECTIVE because + (lí do)</strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step 1 -->
                                                        <div class="step-card mb-4">
                                                            <div class="step-header bg-primary text-white p-3 rounded-top">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="step-number me-3">1</span>
                                                                    <h6 class="mb-0">First Response</h6>
                                                                </div>
                                                            </div>
                                                            <div class="step-content p-3 border border-top-0 rounded-bottom">
                                                                <div class="mb-3">
                                                                    <p class="lead text-primary mb-3">
                                                                        "First off, the thing that I love the most about X is that..."
                                                                    </p>
                                                                    <div class="pattern-options">
                                                                        <div class="pattern bg-light p-3 rounded mb-2">
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <span class="badge bg-primary me-2">Pattern A</span>
                                                                                <strong>there are/is + ADJECTIVE + NOUN, so + (kết quả)</strong>
                                                                            </div>
                                                                        </div>
                                                                        <div class="pattern bg-light p-3 rounded">
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <span class="badge bg-primary me-2">Pattern B</span>
                                                                                <strong>the + NOUN + is + ADJECTIVE because + (lí do)</strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Step 2 -->
                                                        <div class="step-card">
                                                            <div class="step-header bg-primary text-white p-3 rounded-top">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="step-number me-3">2</span>
                                                                    <h6 class="mb-0">Additional Point</h6>
                                    </div>
                                </div>
                                                            <div class="step-content p-3 border border-top-0 rounded-bottom">
                                                                <p class="lead text-primary mb-3">
                                                                    "Another good thing is that I find X..."
                                                                </p>
                                                                <p class="mb-0">For example, people can...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                                            <!-- Practice Exercise Card -->
                                            <div class="card mb-4">
                                                <div class="card-header bg-light d-flex align-items-center">
                                                    <span class="badge bg-primary me-2">4.3</span>
                                                    <h5 class="mb-0">Practice Exercise</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="practice-container">
                                                        <!-- Topic Card -->
                                                        <div class="topic-card bg-light p-4 rounded mb-4">
                                                            <h5 class="mb-3">Topic: What do you like most about your hometown?</h5>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                                                <p class="mb-0">Use the speaking formula above to structure your answer.</p>
                                                            </div>
                                                        </div>

                                                        <!-- Recording Section -->
                                                        <div class="recording-section text-center p-4 bg-light rounded">
                                                            <div class="mb-4">
                                                                <button class="btn btn-lg btn-danger record-btn" id="recordButton">
                                                                    <i class="fas fa-microphone me-2"></i>
                                                                    Start Recording
                                                                </button>
                                                            </div>

                                                            <div class="recording-status d-none">
                                                                <div class="timer mb-3">
                                                                    <span class="badge bg-primary px-3 py-2">00:00</span>
                                                                </div>
                                                                <div class="recording-wave">
                                                                    <!-- Add wave animation here -->
                                                                </div>
                                                            </div>

                                                            <div class="playback-section mt-4 d-none">
                                                                <h6 class="mb-3">Your Recording</h6>
                                                                <audio controls class="w-100"></audio>
                                                                <div class="mt-3">
                                                                    <button class="btn btn-outline-primary btn-retry">
                                                                        <i class="fas fa-redo me-2"></i>Try Again
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Discussion Board Link -->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h5 class="mb-1">Join the Discussion</h5>
                                                            <p class="mb-0 text-muted">Share your answers and discuss with others</p>
                                                        </div>
                                                        <a href="https://padlet.com/quynhndhamazingyou/reflection-unit1-1-hometown-hvatkdamm9i1ytpz"
                                                           target="_blank"
                                                           class="btn btn-primary">
                                                            <i class="fas fa-external-link-alt me-2"></i>
                                                            Open Discussion Board
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Practice Game Section -->
                                        <div class="practice-game mt-5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="mb-4">
                                                        <i class="fas fa-gamepad text-primary me-2"></i>Practice: Odd One Out
                                                    </h4>

                                                    <!-- Game Instructions -->
                                                    <div class="alert alert-info mb-4">
                                                        <i class="fas fa-info-circle me-2"></i>
                                                        Listen to the pronunciation and find the word that has a different sound pattern.
                                                    </div>

                                                    <!-- Word Groups -->
                                                    <div class="word-groups">
                                                        <!-- Group 1 -->
                                                        <div class="word-group mb-4">
                                                            <div class="row g-3">
                                                                <div class="col-md-3 col-sm-6">
                                                                    <div class="word-card" data-word="love" data-pronunciation="/lʌv/">
                                                                        <div class="card h-100">
                                                                            <div class="card-body text-center">
                                                                                <h5 class="mb-2">love</h5>
                                                                                <p class="text-muted mb-2">/lʌv/</p>
                                                                                <button class="btn btn-sm btn-outline-primary btn-play">
                                                                                    <i class="fas fa-volume-up"></i>
                                                                                </button>
                                                                                <div class="form-check mt-2">
                                                                                    <input class="form-check-input" type="radio" name="group1" id="word1">
                                                                                    <label class="form-check-label" for="word1">
                                                                                        Select
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6">
                                                                    <div class="word-card" data-word="doesn't" data-pronunciation="/dʌznt/">
                                                                        <div class="card h-100">
                                                                            <div class="card-body text-center">
                                                                                <h5 class="mb-2">doesn't</h5>
                                                                                <p class="text-muted mb-2">/dʌznt/</p>
                                                                                <button class="btn btn-sm btn-outline-primary btn-play">
                                                                                    <i class="fas fa-volume-up"></i>
                                                                                </button>
                                                                                <div class="form-check mt-2">
                                                                                    <input class="form-check-input" type="radio" name="group1" id="word2">
                                                                                    <label class="form-check-label" for="word2">
                                                                                        Select
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6">
                                                                    <div class="word-card" data-word="young" data-pronunciation="/jʌŋ/">
                                                                        <div class="card h-100">
                                                                            <div class="card-body text-center">
                                                                                <h5 class="mb-2">young</h5>
                                                                                <p class="text-muted mb-2">/jʌŋ/</p>
                                                                                <button class="btn btn-sm btn-outline-primary btn-play">
                                                                                    <i class="fas fa-volume-up"></i>
                                                                                </button>
                                                                                <div class="form-check mt-2">
                                                                                    <input class="form-check-input" type="radio" name="group1" id="word3">
                                                                                    <label class="form-check-label" for="word3">
                                                                                        Select
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6">
                                                                    <div class="word-card" data-word="company" data-pronunciation="/kʌmpəni/">
                                                                        <div class="card h-100">
                                                                            <div class="card-body text-center">
                                                                                <h5 class="mb-2">company</h5>
                                                                                <p class="text-muted mb-2">/kʌmpəni/</p>
                                                                                <button class="btn btn-sm btn-outline-primary btn-play">
                                                                                    <i class="fas fa-volume-up"></i>
                                                                                </button>
                                                                                <div class="form-check mt-2">
                                                                                    <input class="form-check-input" type="radio" name="group1" id="word4">
                                                                                    <label class="form-check-label" for="word4">
                                                                                        Select
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-end mt-3">
                                                                <button class="btn btn-danger btn-retry d-none me-2">
                                                                    <i class="fas fa-redo me-1"></i> Try Again
                                                                </button>
                                                                <button class="btn btn-primary btn-check-answer">
                                                                    <i class="fas fa-check me-1"></i> Check Answer
                                                                </button>
                                                                <button class="btn btn-success btn-next d-none">
                                                                    Next Group <i class="fas fa-arrow-right ms-1"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <!-- Group 2 (Initially Hidden) -->
                                                        <div class="word-group mb-4 d-none">
                                                            <div class="row g-3">
                                                                <!-- Similar structure for next group -->
                                                                <div class="col-md-3 col-sm-6">
                                                                    <div class="word-card" data-word="much" data-pronunciation="/mʌtʃ/">
                                                                        <div class="card h-100">
                                                                            <div class="card-body text-center">
                                                                                <h5 class="mb-2">much</h5>
                                                                                <p class="text-muted mb-2">/mʌtʃ/</p>
                                                                                <button class="btn btn-sm btn-outline-primary btn-play">
                                                                                    <i class="fas fa-volume-up"></i>
                                                                                </button>
                                                                                <div class="form-check mt-2">
                                                                                    <input class="form-check-input" type="radio" name="group2" id="word5">
                                                                                    <label class="form-check-label" for="word5">
                                                                                        Select
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Add other words for group 2 -->
                                                            </div>
                                                            <div class="text-end mt-3">
                                                                <button class="btn btn-danger btn-retry d-none me-2">
                                                                    <i class="fas fa-redo me-1"></i> Try Again
                                                                </button>
                                                                <button class="btn btn-primary btn-check-answer">
                                                                    <i class="fas fa-check me-1"></i> Check Answer
                                                                </button>
                                                                <button class="btn btn-success btn-next d-none">
                                                                    Next Group <i class="fas fa-arrow-right ms-1"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Progress Tracker -->
                                                    <div class="progress-tracker mt-4">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mb-0">Progress</h6>
                                                            <span class="badge bg-success">0/4 Completed</span>
                                                        </div>
                                                        <div class="progress mt-2" style="height: 10px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
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

                <!-- Homework Tab Content -->
                <div class="tab-pane fade" id="homework" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="homework-section">
                                <h3 class="mb-4">5. Homework</h3>

                                <!-- After Class Section -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">AFTER CLASS (LESSON 1)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="homework-item d-flex align-items-center p-3 border-bottom">
                                            <span class="number me-3">1.</span>
                                            <div class="content">
                                                <h6 class="mb-0">Reflection: Unit 1 (Hometown)</h6>
                                            </div>
                                            <a href="#" class="btn btn-outline-primary ms-auto">
                                                <i class="fas fa-external-link-alt me-2"></i>Start
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Self Study Section -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">SELF - STUDY (LESSON 1)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="homework-item d-flex align-items-center p-3 border-bottom">
                                            <span class="number me-3">2.</span>
                                            <div class="content">
                                                <h6 class="mb-0">Shadowing: Unit 1 (Hometown)</h6>
                                            </div>
                                            <a href="#" class="btn btn-outline-primary ms-auto">
                                                <i class="fas fa-external-link-alt me-2"></i>Start
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Before Class Section -->
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">BEFORE CLASS (LESSON 2)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="homework-item d-flex align-items-center p-3 border-bottom">
                                            <span class="number me-3">3.</span>
                                            <div class="content">
                                                <h6 class="mb-0">Young Sheldon: Episode 2</h6>
                                            </div>
                                            <a href="#" class="btn btn-outline-primary ms-auto">
                                                <i class="fas fa-external-link-alt me-2"></i>Start
                                            </a>
                                        </div>
                                        <div class="homework-item d-flex align-items-center p-3">
                                            <span class="number me-3">4.</span>
                                            <div class="content">
                                                <h6 class="mb-0">Active Listening: Unit 2 (Home)</h6>
                                            </div>
                                            <a href="#" class="btn btn-outline-primary ms-auto">
                                                <i class="fas fa-external-link-alt me-2"></i>Start
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

@push('styles')
<style>
    /* Update tab styles */
    .nav-tabs .nav-link {
        border: none;
        border-bottom: 2px solid transparent;
        padding: 1rem 1.5rem;
        margin-bottom: -2px;
        font-weight: 500;
        color: #6c757d;
        position: relative;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }

    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
        background-color: transparent;
    }

    .nav-tabs .badge {
        font-size: 0.875rem;
        padding: 0.4em 0.6em;
        background-color: #0d6efd;
    }

    .nav-tabs .nav-link.active .badge {
        background-color: #0143a3;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #0d6efd;
    }
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,.125);
    }
    .list-group-item-action:hover {
        background-color: #f8f9fa;
    }
    .list-group-item-action.active {
        background-color: #e7f1ff;
        border-color: #dee2e6;
        color: #0d6efd;
    }
    .nav-pills .nav-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        margin-right: 0.5rem;
    }

    .nav-pills .nav-link.active {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .table td {
        vertical-align: middle;
    }

    /* Additional Exercise Styles */
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .card-title {
        color: #2c3e50;
        font-weight: 600;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }
    .badge {
        font-size: 0.875rem;
        padding: 0.5em 0.8em;
    }

    /* Pronunciation Exercise Styles */
    .pronunciation-card {
        perspective: 1000px;
        margin-bottom: 1rem;
    }

    .card-flip {
        position: relative;
        width: 100%;
        height: 200px;
        text-align: center;
        transition: transform 0.8s;
        transform-style: preserve-3d;
        cursor: pointer;
    }

    .pronunciation-card:hover .card-flip {
        transform: rotateY(180deg);
    }

    .card-front, .card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 1rem;
        padding: 1rem;
        background: white;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }

    .card-front {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .card-back {
        transform: rotateY(180deg);
        background: #f8f9fa;
    }

    .word-text {
        font-size: 1.2rem;
        font-weight: 500;
        color: #2c3e50;
        margin-top: 0.5rem;
    }

    .btn-record {
        background-color: #dc3545;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-record:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }

    .btn-play-audio {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        transition: all 0.3s ease;
    }

    .btn-play-audio:hover {
        transform: scale(1.1);
    }

    .practice-sentences .sentence-item {
        padding: 1rem;
        border-radius: 0.5rem;
        background: white;
        transition: all 0.3s ease;
    }

    .practice-sentences .sentence-item:hover {
        transform: translateX(10px);
        box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.05);
    }

    .spelling-pattern-section {
        border-left: 4px solid #0d6efd;
    }

    /* Practice Game Styles */
    .word-card {
        transition: all 0.3s ease;
    }

    .word-card:hover {
        transform: translateY(-5px);
    }

    .word-card.correct {
        border: 2px solid #28a745;
    }

    .word-card.incorrect {
        border: 2px solid #dc3545;
    }

    .btn-play {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .btn-play:hover {
        transform: scale(1.1);
    }

    .progress {
        border-radius: 1rem;
        background-color: #e9ecef;
    }

    .progress-bar {
        border-radius: 1rem;
        transition: width 0.5s ease;
    }

    .btn-retry, .btn-next {
        transition: all 0.3s ease;
    }

    .btn-retry:hover, .btn-next:hover {
        transform: scale(1.05);
    }

    .word-group {
        transition: all 0.5s ease;
    }

    .word-group.fade-out {
        opacity: 0;
        transform: translateX(-20px);
    }

    .word-group.fade-in {
        opacity: 1;
        transform: translateX(0);
    }

    /* Reduction Practice Styles */
    .dialogue-line {
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .speaker {
        font-weight: 600;
        color: #0d6efd;
        margin-right: 0.5rem;
    }

    .highlight {
        background-color: #e8f4ff;
        padding: 0.5rem;
        border-radius: 0.25rem;
    }

    .sentence-box {
        transition: all 0.3s ease;
    }

    .sentence-box:hover {
        transform: translateX(10px);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .nav-pills .nav-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        margin-right: 0.5rem;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover {
        transform: translateY(-2px);
    }

    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        color: white;
    }

    .feedback {
        font-size: 0.9rem;
    }

    /* Speaking Practice Styles */
    .section-header .section-icon {
        transform: rotate(-5deg);
    }

    .step-number {
        width: 30px;
        height: 30px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .example-card {
        transition: all 0.3s ease;
        border-left: 4px solid #0d6efd;
    }

    .example-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }

    .pattern {
        transition: all 0.3s ease;
    }

    .pattern:hover {
        transform: translateX(10px);
    }

    .record-btn {
        transition: all 0.3s ease;
    }

    .record-btn:hover {
        transform: scale(1.05);
    }

    .record-btn.recording {
        animation: pulse 1.5s infinite;
    }

    .recording-wave {
        height: 40px;
        background: linear-gradient(90deg, #0d6efd, #dc3545);
        border-radius: 20px;
        animation: wave 1.5s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    @keyframes wave {
        0% { opacity: 0.5; }
        50% { opacity: 1; }
        100% { opacity: 0.5; }
    }

    /* Homework Tab Styles */
    .homework-section .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: all 0.3s ease;
    }

    .homework-section .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .homework-section .card-header {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        padding: 1rem;
    }

    .homework-section .card-header h5 {
        color: #2c3e50;
        font-weight: 600;
    }

    .homework-item {
        transition: all 0.3s ease;
        background-color: white;
    }

    .homework-item:hover {
        background-color: #f8f9fa;
    }

    .homework-item .number {
        font-weight: 600;
        color: #0d6efd;
        font-size: 1.1rem;
        min-width: 30px;
    }

    .homework-item .content {
        flex: 1;
    }

    .homework-item .btn {
        transition: all 0.3s ease;
    }

    .homework-item .btn:hover {
        transform: translateX(5px);
    }

    .homework-item:not(:last-child) {
        border-bottom: 1px solid #e9ecef;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize audio context
    let audioContext;
    let mediaRecorder;
    let audioChunks = [];

    // Handle recording functionality
    document.querySelectorAll('.btn-record').forEach(button => {
        button.addEventListener('click', async function() {
            const word = this.dataset.word;

            if (!audioContext) {
                audioContext = new (window.AudioContext || window.webkitAudioContext)();
            }

            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });

                // Visual feedback for recording
                this.innerHTML = '<i class="fas fa-stop"></i> Stop';
                this.classList.add('recording');

                mediaRecorder = new MediaRecorder(stream);
                audioChunks = [];

                mediaRecorder.ondataavailable = (event) => {
                    audioChunks.push(event.data);
                };

                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                    const audioUrl = URL.createObjectURL(audioBlob);

                    // Show play button and store audio URL
                    const playButton = this.nextElementSibling;
                    playButton.classList.remove('d-none');
                    playButton.dataset.audioUrl = audioUrl;
                };

                mediaRecorder.start();
            } catch (err) {
                console.error('Error accessing microphone:', err);
                alert('Please allow microphone access to record.');
            }
        });
    });

    // Handle playing recorded audio
    document.querySelectorAll('.btn-play-recording').forEach(button => {
        button.addEventListener('click', function() {
            const audio = new Audio(this.dataset.audioUrl);
            audio.play();
            });
        });

    // Add flip animation on hover
    document.querySelectorAll('.pronunciation-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.querySelector('.card-flip').style.transform = 'rotateY(180deg)';
        });

        card.addEventListener('mouseleave', function() {
            this.querySelector('.card-flip').style.transform = 'rotateY(0deg)';
        });
    });

    // Xử lý chọn video
    const videoItems = document.querySelectorAll('.video-item');
    const videoPlayer = document.getElementById('videoPlayer');

    // Set video đầu tiên làm mặc định
    if (videoItems.length > 0 && videoPlayer) {
        const firstVideoUrl = videoItems[0].dataset.videoUrl;
        videoPlayer.src = firstVideoUrl;
        videoItems[0].classList.add('active');
    }

    videoItems.forEach(item => {
        item.addEventListener('click', function() {
            const videoUrl = this.dataset.videoUrl;
            videoPlayer.src = videoUrl;

            // Remove active class from all items
            videoItems.forEach(vi => vi.classList.remove('active'));
            // Add active class to clicked item
            this.classList.add('active');
        });
    });

    // Xử lý phát âm
    document.querySelectorAll('.btn-outline-primary').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const word = input.value.trim();
            if (word) {
                // Thêm logic phát âm ở đây (có thể sử dụng Web Speech API hoặc custom audio)
                const utterance = new SpeechSynthesisUtterance(word);
                window.speechSynthesis.speak(utterance);
            }
        });
    });

    // Game Logic
    const wordGroups = document.querySelectorAll('.word-group');
    let currentGroupIndex = 0;
    let completedGroups = 0;

    function initializeGroup(group) {
        const checkButton = group.querySelector('.btn-check-answer');
        const retryButton = group.querySelector('.btn-retry');
        const nextButton = group.querySelector('.btn-next');
        const radioInputs = group.querySelectorAll('input[type="radio"]');
        const wordCards = group.querySelectorAll('.word-card');

        // Reset group state
        function resetGroup() {
            wordCards.forEach(card => {
                card.classList.remove('correct', 'incorrect');
            });
            radioInputs.forEach(input => {
                input.checked = false;
                input.disabled = false;
            });
            checkButton.disabled = false;
            retryButton.classList.add('d-none');
            nextButton.classList.add('d-none');
        }

        // Check answer
        checkButton.addEventListener('click', function() {
            const selectedInput = group.querySelector('input[type="radio"]:checked');

            if (!selectedInput) {
                alert('Please select an answer first!');
                return;
            }

            const selectedCard = selectedInput.closest('.word-card');
            const isCorrect = selectedCard.dataset.word === 'company'; // Example condition

            // Reset previous results
            wordCards.forEach(card => {
                card.classList.remove('correct', 'incorrect');
            });

            if (isCorrect) {
                selectedCard.classList.add('correct');
                checkButton.classList.add('d-none');
                nextButton.classList.remove('d-none');

                // Update progress only on first correct answer
                if (!group.dataset.completed) {
                    completedGroups++;
                    group.dataset.completed = 'true';
                    updateProgress();
                }

                // Disable all inputs
                radioInputs.forEach(input => input.disabled = true);
            } else {
                selectedCard.classList.add('incorrect');
                retryButton.classList.remove('d-none');
                // Don't disable inputs to allow retry
            }
        });

        // Retry button
        retryButton.addEventListener('click', function() {
            resetGroup();
        });

        // Next button
        nextButton.addEventListener('click', function() {
            if (currentGroupIndex < wordGroups.length - 1) {
                // Fade out current group
                group.classList.add('fade-out');

                setTimeout(() => {
                    group.classList.add('d-none');
                    currentGroupIndex++;

                    // Show and fade in next group
                    const nextGroup = wordGroups[currentGroupIndex];
                    nextGroup.classList.remove('d-none');
                    setTimeout(() => {
                        nextGroup.classList.add('fade-in');
                    }, 50);
                }, 500);
            }
        });
    }

    // Initialize all groups
    wordGroups.forEach(group => {
        initializeGroup(group);
    });

    // Update progress bar and badge
    function updateProgress() {
        const progressBar = document.querySelector('.progress-bar');
        const progressBadge = document.querySelector('.badge');
        const progress = (completedGroups / wordGroups.length) * 100;

        progressBar.style.width = `${progress}%`;
        progressBadge.textContent = `${completedGroups}/${wordGroups.length} Completed`;
    }

    // Reduction Practice Logic
    document.addEventListener('DOMContentLoaded', function() {
        // Handle exercise checking
        document.querySelectorAll('.btn-check').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const feedback = this.closest('.exercise-item').querySelector('.feedback');
                const correctFeedback = feedback.querySelector('.correct-feedback');
                const incorrectFeedback = feedback.querySelector('.incorrect-feedback');

                feedback.classList.remove('d-none');

                // Simple check - you would want to implement proper answer checking
                if (input.value.toLowerCase().includes('wanna') ||
                    input.value.toLowerCase().includes('gonna') ||
                    input.value.includes('gotta')) {
                    correctFeedback.classList.remove('d-none');
                    incorrectFeedback.classList.add('d-none');
                    input.classList.add('is-valid');
                    input.classList.remove('is-invalid');
                } else {
                    correctFeedback.classList.add('d-none');
                    incorrectFeedback.classList.remove('d-none');
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                }
            });
        });

        // Handle audio playback
        document.querySelectorAll('.btn-play-audio').forEach(button => {
            button.addEventListener('click', function() {
                // Add audio playback logic here
                console.log('Playing audio...');
            });
        });
    });

    // Speaking Practice Logic
    document.addEventListener('DOMContentLoaded', function() {
        const recordButton = document.getElementById('recordButton');
        const timer = document.querySelector('.timer');
        const audioPlayer = document.querySelector('.audio-player');
        let mediaRecorder;
        let audioChunks = [];
        let timerInterval;
        let seconds = 0;

        recordButton.addEventListener('click', async function() {
            if (!mediaRecorder || mediaRecorder.state === 'inactive') {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                    mediaRecorder = new MediaRecorder(stream);
                    audioChunks = [];

                    mediaRecorder.ondataavailable = (event) => {
                        audioChunks.push(event.data);
                    };

                    mediaRecorder.onstop = () => {
                        const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                        const audioUrl = URL.createObjectURL(audioBlob);
                        const audio = audioPlayer.querySelector('audio');
                        audio.src = audioUrl;
                        audioPlayer.classList.remove('d-none');
                    };

                    // Start recording
                    mediaRecorder.start();
                    recordButton.innerHTML = '<i class="fas fa-stop me-2"></i>Stop Recording';
                    recordButton.classList.add('btn-warning', 'recording');
                    recordButton.classList.remove('btn-danger');

                    // Show and start timer
                    timer.classList.remove('d-none');
                    startTimer();

                } catch (err) {
                    console.error('Error accessing microphone:', err);
                    alert('Please allow microphone access to record.');
                }
            } else {
                // Stop recording
                mediaRecorder.stop();
                recordButton.innerHTML = '<i class="fas fa-microphone me-2"></i>Record Again';
                recordButton.classList.remove('btn-warning', 'recording');
                recordButton.classList.add('btn-danger');

                // Stop timer
                clearInterval(timerInterval);
                seconds = 0;
            }
        });

        function startTimer() {
            seconds = 0;
            updateTimerDisplay();
            timerInterval = setInterval(() => {
                seconds++;
                updateTimerDisplay();
            }, 1000);
        }

        function updateTimerDisplay() {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            timer.querySelector('.badge').textContent =
                `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
        }
    });

    // Remove any existing progress tracking for video tab
    const videoTab = document.getElementById('video-tab');
    if (videoTab) {
        // Remove any completion classes or indicators
        videoTab.classList.remove('completed', 'half-completed');
        const existingBadges = videoTab.querySelectorAll('.completion-badge');
        existingBadges.forEach(badge => badge.remove());
    }
});
</script>
@endpush
@endsection
