@extends('online.layouts.master')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">U.S. MOVIE - {{ $lesson->title }}</h4>

                <ul class="nav nav-tabs" id="exerciseTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="step0-tab" data-bs-toggle="tab" data-bs-target="#step0"
                            type="button" role="tab" aria-controls="step0" aria-selected="true">
                            <i class="fas fa-info-circle"></i> Bước 0
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1" type="button"
                            role="tab" aria-controls="step1" aria-selected="false">
                            <i class="fas fa-1"></i> Bước 1
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="step2-tab" data-bs-toggle="tab" data-bs-target="#step2" type="button"
                            role="tab" aria-controls="step2" aria-selected="false">
                            <i class="fas fa-2"></i> Bước 2
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="step3-tab" data-bs-toggle="tab" data-bs-target="#step3" type="button"
                            role="tab" aria-controls="step3" aria-selected="false">
                            <i class="fas fa-3"></i> Bước 3
                        </button>
                    </li>
                </ul>

                <div class="tab-content pt-4" id="exerciseTabContent">
                    <div class="tab-pane fade show active" id="step0" role="tabpanel" aria-labelledby="step0-tab">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-info-circle me-2"></i>Hướng dẫn làm bài
                                </h5>

                                <div class="alert alert-info">
                                    <h6 class="alert-heading"><i class="fas fa-video me-2"></i>Bước 1: Xem video</h6>
                                    <ul class="mb-0">
                                        <li>Xem video với phụ đề tiếng Anh để hiểu nội dung và ngữ cảnh</li>
                                        <li>Có thể tạm dừng video để ghi chú từ vựng và cấu trúc câu mới</li>
                                        <li>Chú ý cách phát âm của người bản xứ</li>
                                    </ul>
                                </div>

                                <div class="alert alert-warning">
                                    <h6 class="alert-heading"><i class="fas fa-tasks me-2"></i>Bước 2: Làm bài tập</h6>
                                    <ul class="mb-0">
                                        <li>Hoàn thành bài tập điền từ bằng cách kéo và thả từ vựng vào ô trống</li>
                                        <li>Kiểm tra đáp án sau khi hoàn thành</li>
                                        <li>Xem lại video nếu cần thiết để hiểu rõ hơn ngữ cảnh</li>
                                    </ul>
                                </div>

                                <div class="alert alert-success">
                                    <h6 class="alert-heading"><i class="fas fa-microphone me-2"></i>Bước 3: Luyện nói</h6>
                                    <ul class="mb-0">
                                        <li>Luyện nói theo từng đoạn clip ngắn</li>
                                        <li>Sử dụng nút play để nghe lại audio và lặp lại nhiều lần</li>
                                        <li>Có thể hiện/ẩn phụ đề để hỗ trợ việc luyện tập</li>
                                    </ul>
                                </div>

                                <!-- Video Tutorial -->
                                <div class="video-container mb-4">
                                    <h5 class="mb-3"><i class="fas fa-video me-2"></i>Tutorial Video</h5>
                                    <div class="ratio ratio-16x9 mb-4">
                                        @php
                                            // Convert YouTube URL to embed URL
                                            $tutorialUrl = $tutorial_video_url ?? '';
                                            $videoId = '';
                                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $tutorialUrl, $match)) {
                                                $videoId = $match[1];
                                            }
                                            $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                        @endphp
                                        <iframe src="{{ $embedUrl }}" title="Tutorial video" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen class="rounded shadow-sm">
                                        </iframe>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-muted">Watch the tutorial video to understand the learning process</p>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button class="btn btn-primary" onclick="document.getElementById('step1-tab').click()">
                                        <i class="fas fa-play me-2"></i>Bắt đầu làm bài
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ratio ratio-16x9 mb-3">
                                    @php
                                        $embedUrl = App\Helpers\VideoHelper::getEmbedUrl($lesson->video_url);
                                    @endphp

                                    <iframe src="{{ $embedUrl }}" title="{{ $lesson->title ?? 'Video Exercise' }}"
                                        allowfullscreen class="rounded shadow-sm"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        sandbox="allow-same-origin allow-scripts allow-popups allow-forms"
                                        referrerpolicy="origin" loading="lazy"
                                        style="border: none; width: 100%; height: 100%;"
                                        onload="this.style.visibility='visible'" onerror="handleIframeError(this)"></iframe>
                                </div>
                                <div class="alert alert-info mb-3">
                                    <h6 class="alert-heading"><i class="fas fa-lightbulb me-2"></i>Mẹo học hiệu quả:</h6>
                                    <ul class="mb-0">
                                        <li>Xem video với phụ đề tiếng Anh (nếu có)</li>
                                        <li>Tạm dừng video để ghi chú từ vựng mới</li>
                                        <li>Cố gắng bắt chước cách phát âm của người bản xứ</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ratio ratio-16x9 mb-3">
                                    <iframe src="{{ App\Helpers\VideoHelper::getEmbedUrl($lesson->video_url) }}"
                                        title="{{ $lesson->title ?? 'Video Exercise' }}" allowfullscreen
                                        class="rounded shadow-sm"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mt-4">
                            <div class="card-body">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-tasks me-2"></i>Bài tập điền từ
                                    <small class="text-muted ms-2">Kéo và thả từ vựng vào ô trống tương ứng</small>
                                </h5>

                                <!-- Word Bank -->
                                <div class="mb-4">
                                    <h6 class="mb-3">Ngân hàng từ vựng:</h6>
                                    <div class="d-flex flex-wrap gap-2 word-bank" id="wordBank">
                                        @foreach($wordBank as $word)
                                            <span class="badge bg-primary p-2 draggable" draggable="true">{{ $word }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Exercise List -->
                                <div class="exercise-list">
                                    @foreach($lesson->videoExerciseQuestions as $index => $question)
                                        <div class="exercise-item mb-3 p-3 border rounded">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-secondary me-2">{{ $index + 1 }}</span>
                                                <span class="ms-3">{{ $question->question_text }}</span>
                                            </div>
                                            <div class="answer-line d-flex align-items-center">
                                                <span class="text-primary">> {{ $question->context_text }}</span>
                                                <div class="dropzone d-inline-block mx-2" data-answer="{{ $question->correct_answer }}"></div>
                                                <span>.</span>
                                                <button class="btn btn-sm btn-outline-success ms-3 check-answer">
                                                    <i class="fas fa-check me-1"></i>Kiểm tra
                                                </button>
                                                <div class="feedback ms-2"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Save Progress Button -->
                                <div class="d-flex justify-content-center align-items-center mt-4">
                                    <button class="btn btn-success" id="saveProgress" style="min-width: 150px;">
                                        <i class="fas fa-save me-2"></i>Lưu tiến độ
                                    </button>
                                    <div class="save-feedback ms-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-microphone me-2"></i>Luyện nói theo clip
                                    <small class="text-muted ms-2">Click vào từng clip để luyện nói theo từng đoạn</small>
                                </h5>

                                <div class="row">
                                    <!-- Video Column -->
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="ratio ratio-16x9">
                                                    @php
                                                        // Convert YouTube URL to embed URL
                                                        $videoUrl = $lesson->video_url;
                                                        $videoId = '';
                                                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $match)) {
                                                            $videoId = $match[1];
                                                        }
                                                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                                    @endphp
                                                    <iframe src="{{ $embedUrl }}"
                                                        title="{{ $lesson->title ?? 'Video Exercise' }}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen
                                                        class="rounded shadow-sm"
                                                        id="mainVideo">
                                                    </iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Exercise Column -->
                                    <div class="col-md-6">
                                        <!-- Exercise Items -->
                                        <div class="exercise-items mb-4">
                                            <div class="clip-item mb-3 p-3 border rounded bg-white">
                                                <div class="d-flex align-items-center gap-2 mb-3">
                                                    <button class="btn btn-sm btn-outline-secondary play-clip"
                                                        data-time="48">
                                                        <i class="fas fa-play"></i>
                                                        <span class="ms-1">0:02 / 0:10</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-primary record-audio"
                                                        data-clip="1">
                                                        <i class="fas fa-microphone"></i>
                                                        <span class="ms-1">Ghi âm</span>
                                                    </button>
                                                </div>
                                                <div class="exercise-content">
                                                    <div class="input-group mb-2">
                                                        <span class="input-group-text bg-light">Hi.</span>
                                                        <input type="text" class="form-control"
                                                            style="max-width: 120px;" placeholder="Điền từ"
                                                            data-answer="how">
                                                        <span class="input-group-text bg-light">can I help you?</span>
                                                        <button class="btn btn-outline-success check-answer"
                                                            type="button">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </div>
                                                    <div class="feedback mt-2 d-none"></div>
                                                </div>
                                            </div>

                                            <div class="clip-item mb-3 p-3 border rounded bg-white">
                                                <div class="d-flex align-items-center gap-2 mb-3">
                                                    <button class="btn btn-sm btn-outline-secondary play-clip"
                                                        data-time="112">
                                                        <i class="fas fa-play"></i>
                                                        <span class="ms-1">0:11 / 0:15</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-primary record-audio"
                                                        data-clip="2">
                                                        <i class="fas fa-microphone"></i>
                                                        <span class="ms-1">Ghi âm</span>
                                                    </button>
                                                </div>
                                                <div class="exercise-content">
                                                    <div class="input-group mb-2">
                                                        <span class="input-group-text bg-light">Hi. How</span>
                                                        <input type="text" class="form-control"
                                                            style="max-width: 120px;" placeholder="Điền từ"
                                                            data-answer="much">
                                                        <span class="input-group-text bg-light">is this tuna salad?</span>
                                                        <button class="btn btn-outline-success check-answer"
                                                            type="button">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </div>
                                                    <div class="feedback mt-2 d-none"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Recording History -->
                                        <div class="card">
                                            <div
                                                class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fas fa-history me-2"></i>Lịch sử ghi âm
                                                </div>
                                                <span class="badge bg-light text-success">Mới</span>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="recording-history">
                                                    <div class="recording-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="badge bg-primary me-2">Đoạn 00:15</span>
                                                                    <span class="badge bg-success">Mới</span>
                                                                </div>
                                                                <div class="timestamp mt-1">
                                                                    <i class="far fa-clock me-1"></i>2 phút trước
                                                                    <span class="ms-2 text-muted">
                                                                        <i class="fas fa-stopwatch me-1"></i>00:35
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="recording-controls">
                                                                <div class="btn-group">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-play"></i>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="recording-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="badge bg-primary me-2">Đoạn 00:30</span>
                                                                </div>
                                                                <div class="timestamp mt-1">
                                                                    <i class="far fa-clock me-1"></i>5 phút trước
                                                                    <span class="ms-2 text-muted">
                                                                        <i class="fas fa-stopwatch me-1"></i>00:42
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="recording-controls">
                                                                <div class="btn-group">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-play"></i>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="recording-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="badge bg-primary me-2">Đoạn 00:45</span>
                                                                </div>
                                                                <div class="timestamp mt-1">
                                                                    <i class="far fa-clock me-1"></i>10 phút trước
                                                                    <span class="ms-2 text-muted">
                                                                        <i class="fas fa-stopwatch me-1"></i>00:28
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="recording-controls">
                                                                <div class="btn-group">
                                                                    <button class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-play"></i>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-outline-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
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
    </div>

    @push('styles')
        <style>
            .nav-tabs .nav-link {
                color: #6c757d;
                border: none;
                border-bottom: 2px solid transparent;
                padding: 1rem 1.5rem;
            }

            .nav-tabs .nav-link.active {
                color: #0d6efd;
                border: none;
                border-bottom: 2px solid #0d6efd;
            }

            .nav-tabs .nav-link:hover {
                border: none;
                border-bottom: 2px solid #0d6efd;
            }

            .word-bank .draggable {
                cursor: move;
                user-select: none;
                transition: all 0.2s;
            }

            .word-bank .draggable:hover {
                transform: translateY(-2px);
            }

            .dropzone {
                width: 100px;
                height: 30px;
                border: 2px dashed #dee2e6;
                border-radius: 4px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #f8f9fa;
                transition: all 0.2s;
            }

            .dropzone.dragover {
                background: #e9ecef;
                border-color: #0d6efd;
            }

            .dropzone.correct {
                background: #d4edda;
                border-color: #198754;
            }

            .dropzone.incorrect {
                background: #f8d7da;
                border-color: #dc3545;
            }

            .video-time-btn:hover {
                background-color: #0d6efd;
                color: white;
            }

            .exercise-item {
                background: white;
                transition: all 0.2s;
            }

            .exercise-item:hover {
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            }

            .clip-item {
                transition: all 0.3s ease;
                border: 1px solid #dee2e6 !important;
            }

            .clip-item:hover {
                box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
            }

            .clip-controls button {
                min-width: 40px;
            }

            .clip-controls .play-clip {
                min-width: 120px;
            }

            .clip-text {
                font-size: 1.1rem;
                margin-left: 3.5rem;
            }

            .action-buttons {
                margin-left: 3.5rem;
            }

            .input-group-text {
                border: 1px solid #ced4da;
                font-size: 0.95rem;
            }

            .input-group .form-control {
                border: 1px solid #ced4da;
                font-size: 0.95rem;
            }

            .input-group .btn {
                border: 1px solid #ced4da;
            }

            .btn-outline-success:hover {
                background-color: #28a745;
                color: white;
            }

            .exercise-content {
                padding: 0.5rem;
                background-color: #f8f9fa;
                border-radius: 0.375rem;
            }

            .play-clip,
            .record-audio {
                transition: all 0.2s ease;
            }

            .play-clip:hover {
                background-color: #6c757d;
                color: white;
            }

            .record-audio:hover {
                background-color: #0d6efd;
                color: white;
            }

            .feedback {
                font-size: 0.9rem;
                padding: 0.5rem 0.75rem;
                border-radius: 0.25rem;
            }

            .recording-history {
                max-height: 400px;
                overflow-y: auto;
            }

            .recording-item {
                padding: 1rem;
                border-bottom: 1px solid #dee2e6;
                transition: all 0.2s ease;
            }

            .recording-item:hover {
                background-color: #f8f9fa;
            }

            .recording-item:last-child {
                border-bottom: none;
            }

            .recording-item .timestamp {
                font-size: 0.85rem;
                color: #6c757d;
            }

            .recording-controls {
                display: flex;
                gap: 0.5rem;
            }

            .btn-group .btn {
                padding: 0.25rem 0.5rem;
            }

            .btn-group .btn i {
                width: 16px;
            }

            .badge {
                padding: 0.5em 0.8em;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const draggables = document.querySelectorAll('.draggable');
                const dropzones = document.querySelectorAll('.dropzone');
                const videoTimeButtons = document.querySelectorAll('.video-time-btn');
                const saveProgressBtn = document.getElementById('saveProgress');
                const clipItems = document.querySelectorAll('.clip-item');
                const mainVideo = document.getElementById('mainVideo');
                let mediaRecorder;
                let audioChunks = [];
                let isRecording = false;

                // Drag and Drop Logic
                draggables.forEach(draggable => {
                    draggable.addEventListener('dragstart', function(e) {
                        e.dataTransfer.setData('text/plain', e.target.textContent);
                        setTimeout(() => e.target.classList.add('d-none'), 0);
                    });

                    draggable.addEventListener('dragend', function(e) {
                        e.target.classList.remove('d-none');
                    });
                });

                dropzones.forEach(dropzone => {
                    dropzone.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        this.classList.add('dragover');
                    });

                    dropzone.addEventListener('dragleave', function(e) {
                        this.classList.remove('dragover');
                    });

                    dropzone.addEventListener('drop', function(e) {
                        e.preventDefault();
                        const word = e.dataTransfer.getData('text/plain');
                        this.textContent = word;
                        this.classList.remove('dragover');
                    });
                });

                // Video Time Button Logic
                videoTimeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const time = this.dataset.time;
                        // Add your video control logic here
                        console.log('Seek to time:', time);
                    });
                });

                // Check individual answer logic
                document.querySelectorAll('.check-answer').forEach(button => {
                    button.addEventListener('click', function() {
                        const answerLine = this.closest('.answer-line');
                        const dropzone = answerLine.querySelector('.dropzone');
                        const feedback = answerLine.querySelector('.feedback');
                        const correctAnswer = dropzone.dataset.answer;
                        const userAnswer = dropzone.textContent.trim();

                        dropzone.classList.remove('correct', 'incorrect');

                        if (userAnswer === correctAnswer) {
                            dropzone.classList.add('correct');
                            feedback.innerHTML = '<span class="text-success"><i class="fas fa-check-circle me-1"></i>Chính xác!</span>';
                        } else {
                            dropzone.classList.add('incorrect');
                            feedback.innerHTML = '<span class="text-danger"><i class="fas fa-times-circle me-1"></i>Chưa đúng</span>';
                        }
                    });
                });

                clipItems.forEach(item => {
                    const showBtn = item.querySelector('.show-btn');
                    const hideBtn = item.querySelector('.hide-btn');
                    const clipText = item.querySelector('.clip-text');
                    const playBtn = item.querySelector('.play-clip');

                    // Show/Hide text functionality
                    showBtn.addEventListener('click', () => {
                        clipText.classList.remove('d-none');
                    });

                    hideBtn.addEventListener('click', () => {
                        clipText.classList.add('d-none');
                    });

                    // Play button functionality
                    playBtn.addEventListener('click', function() {
                        const time = this.dataset.time;
                        const icon = this.querySelector('i');

                        // Toggle play/pause icon
                        icon.classList.toggle('fa-play');
                        icon.classList.toggle('fa-pause');

                        // Seek video to specific time
                        if (mainVideo && mainVideo.contentWindow) {
                            mainVideo.contentWindow.postMessage({
                                event: 'command',
                                func: 'seekTo',
                                args: [time]
                            }, '*');
                        }
                    });
                });

                function handleIframeError(iframe) {
                    // Thử load lại với URL gốc
                    iframe.src = '{{ $lesson->video_url }}';

                    // Nếu vẫn lỗi, hiển thị thông báo
                    iframe.onerror = function() {
                        iframe.style.display = 'none';
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'alert alert-danger';
                        errorDiv.innerHTML = `
                <h4 class="alert-heading">Không thể tải video</h4>
                <p>Xin lỗi, không thể tải video lúc này. Vui lòng:</p>
                <ul>
                    <li>Kiểm tra kết nối internet của bạn</li>
                    <li>Thử tải lại trang</li>
                    <li>Hoặc <a href="{{ $lesson->video_url }}" target="_blank">mở video trong tab mới</a></li>
                </ul>
            `;
                        iframe.parentNode.appendChild(errorDiv);
                    };
                }

                // Save progress logic
                saveProgressBtn.addEventListener('click', async function() {
                    const saveFeedback = document.querySelector('.save-feedback');
                    const progress = [];

                    // Collect answers from all dropzones
                    dropzones.forEach((dropzone, index) => {
                        progress.push({
                            questionId: index + 1,
                            answer: dropzone.textContent.trim(),
                            isCorrect: dropzone.classList.contains('correct')
                        });
                    });

                    try {
                        // Send progress to server
                        const response = await fetch('/api/video-exercise/save-progress', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                lessonId: '{{ $lesson->id }}',
                                progress: progress
                            })
                        });

                        if (response.ok) {
                            saveFeedback.innerHTML = '<span class="text-success"><i class="fas fa-check-circle me-1"></i>Đã lưu tiến độ</span>';
                            setTimeout(() => {
                                saveFeedback.innerHTML = '';
                            }, 3000);
                        } else {
                            throw new Error('Failed to save progress');
                        }
                    } catch (error) {
                        console.error('Error saving progress:', error);
                        saveFeedback.innerHTML = '<span class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>Lỗi khi lưu tiến độ</span>';
                    }
                });

                // Xử lý khi nhấn Enter trong input
                document.querySelectorAll('.input-group input').forEach(input => {
                    input.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            this.nextElementSibling.click();
                        }
                    });
                });

                // Xử lý nút ghi âm
                document.querySelectorAll('.record-audio').forEach(button => {
                    button.addEventListener('click', async function() {
                        const clipId = this.dataset.clip;
                        const icon = this.querySelector('i');
                        const text = this.querySelector('span');

                        if (!isRecording) {
                            try {
                                const stream = await navigator.mediaDevices.getUserMedia({
                                    audio: true
                                });
                                mediaRecorder = new MediaRecorder(stream);
                                audioChunks = [];

                                mediaRecorder.ondataavailable = (event) => {
                                    audioChunks.push(event.data);
                                };

                                mediaRecorder.onstop = () => {
                                    const audioBlob = new Blob(audioChunks, {
                                        type: 'audio/wav'
                                    });
                                    const audioUrl = URL.createObjectURL(audioBlob);
                                    addRecordingToHistory(audioUrl, clipId);
                                };

                                mediaRecorder.start();
                                isRecording = true;
                                icon.className = 'fas fa-stop';
                                text.textContent = 'Dừng';
                                this.classList.remove('btn-outline-primary');
                                this.classList.add('btn-danger');
                            } catch (err) {
                                console.error('Error accessing microphone:', err);
                                alert(
                                    'Không thể truy cập microphone. Vui lòng kiểm tra quyền truy cập.');
                            }
                        } else {
                            mediaRecorder.stop();
                            isRecording = false;
                            icon.className = 'fas fa-microphone';
                            text.textContent = 'Ghi âm';
                            this.classList.remove('btn-danger');
                            this.classList.add('btn-outline-primary');
                        }
                    });
                });

                function addRecordingToHistory(audioUrl, clipId) {
                    const now = new Date();
                    const timestamp = now.toLocaleTimeString();
                    const historyContainer = document.querySelector('.recording-history');

                    const recordingItem = document.createElement('div');
                    recordingItem.className = 'recording-item';
                    recordingItem.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary me-2">Đoạn ${clipId}</span>
                                    <span class="badge bg-success">Mới</span>
                                </div>
                                <div class="timestamp mt-1">
                                    <i class="far fa-clock me-1"></i>${timestamp}
                                </div>
                            </div>
                            <div class="recording-controls">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;

                    // Thêm vào đầu danh sách
                    historyContainer.insertBefore(recordingItem, historyContainer.firstChild);

                    // Xử lý nút xóa
                    recordingItem.querySelector('.delete-recording').addEventListener('click', function() {
                        recordingItem.remove();
                    });
                }
            });
        </script>
    @endpush
@endsection
