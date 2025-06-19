@extends('online.layouts.master')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">{{ $title }}</h4>
                </div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-4" id="shadowingTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="instructions-tab" data-bs-toggle="tab"
                            data-bs-target="#instructions" type="button" role="tab">
                            <span class="badge bg-info me-2"><i class="fas fa-info-circle"></i></span>HƯỚNG DẪN
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="practice-tab" data-bs-toggle="tab" data-bs-target="#practice"
                            type="button" role="tab">
                            <span class="badge bg-primary me-2"><i class="fas fa-microphone"></i></span>LUYỆN TẬP
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="shadowingTabContent">
                    <!-- Instructions Tab -->
                    <div class="tab-pane fade show active" id="instructions" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="alert alert-info mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-video me-2"></i>Bước 1: Xem và Nghe
                                    </h5>
                                    <ul class="mb-0">
                                        <li>Xem video và nghe thật kỹ phát âm của người bản xứ</li>
                                        <li>Chú ý đến ngữ điệu và nhịp điệu của câu</li>
                                        <li>Có thể bật transcript để theo dõi nội dung</li>
                                        <li>Xem lại video nhiều lần nếu cần thiết</li>
                                    </ul>
                                </div>

                                <div class="alert alert-warning mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-sync-alt me-2"></i>Bước 2: Luyện Shadowing
                                    </h5>
                                    <ul class="mb-0">
                                        <li>Lặp lại theo người bản xứ càng nhanh càng tốt</li>
                                        <li>Bắt chước chính xác ngữ điệu và nhịp điệu</li>
                                        <li>Tập trung vào từng đoạn ngắn một</li>
                                        <li>Lặp lại nhiều lần cho đến khi tự tin</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="alert alert-success mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-microphone me-2"></i>Bước 3: Ghi Âm và Đánh Giá
                                    </h5>
                                    <ul class="mb-0">
                                        <li>Sử dụng nút "Ghi âm" để thu âm giọng nói của bạn</li>
                                        <li>So sánh bản ghi âm với giọng người bản xứ</li>
                                        <li>Chú ý đến những điểm cần cải thiện</li>
                                        <li>Thực hành lại những phần chưa tốt</li>
                                    </ul>
                                </div>

                                <div class="alert alert-secondary mb-4">
                                    <h5 class="alert-heading">
                                        <i class="fas fa-lightbulb me-2"></i>Mẹo Luyện Tập Hiệu Quả
                                    </h5>
                                    <ul class="mb-0">
                                        <li>Tập trung vào một đoạn ngắn trước khi chuyển sang đoạn khác</li>
                                        <li>Sử dụng tai nghe để nghe rõ hơn</li>
                                        <li>Thực hành thường xuyên, mỗi ngày 15-20 phút</li>
                                        <li>Không cần hoàn hảo ngay lập tức, cải thiện dần dần</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-primary btn-lg"
                                onclick="document.getElementById('practice-tab').click()">
                                <i class="fas fa-play me-2"></i>Bắt đầu luyện tập
                            </button>
                        </div>
                    </div>

                    <!-- Practice Tab -->
                    <div class="tab-pane fade" id="practice" role="tabpanel">
                        <div class="row">
                            <!-- Video Section -->
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body p-0">
                                        <div class="ratio ratio-16x9">
                                            <video src="{{ $video['url'] }}" title="{{ $video['title'] }}" controls
                                                class="rounded w-100" controlsList="nodownload">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>

                                <!-- Video Controls -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button class="btn btn-outline-primary" id="playPauseBtn">
                                                    <i class="fas fa-play me-2"></i>Play/Pause
                                                </button>
                                                <button class="btn btn-outline-primary" id="replayBtn">
                                                    <i class="fas fa-redo me-2"></i>Replay Section
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Transcript Section -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">
                                            <i class="fas fa-file-alt me-2"></i>Transcript & Translation
                                        </h5>
                                        @foreach ($video['transcript'] as $section)
                                            <div class="transcript-section mb-4">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary me-2">{{ $section['time'] }}</span>
                                                        <button class="btn btn-sm btn-outline-primary play-section me-2"
                                                            data-time="{{ $section['time'] }}">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success record-btn"
                                                            data-section="{{ $section['time'] }}">
                                                            <i class="fas fa-microphone me-1"></i>Ghi âm
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card bg-light">
                                                    <div class="card-body">
                                                        <p class="mb-2 english-text">{{ $section['text'] }}</p>
                                                        <p class="mb-0 text-muted vietnamese-text">
                                                            {{ $section['translation'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Tips & Instructions -->
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-lightbulb me-2"></i>Hướng dẫn Shadowing
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text mb-4">{{ $video['description'] }}</p>
                                        <h6 class="mb-3">Các bước thực hiện:</h6>
                                        <ol class="list-unstyled mb-0">
                                            @foreach ($video['tips'] as $tip)
                                                <li class="mb-3">
                                                    <div class="d-flex">
                                                        <span class="me-3">
                                                            <i class="fas fa-check-circle text-success"></i>
                                                        </span>
                                                        <span>{{ $tip }}</span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>

                                <!-- Recording History -->
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-history me-2"></i>Lịch sử ghi âm
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="recordingsList">
                                            <div class="recording-item">
                                                <div class="recording-icon">
                                                    <i class="fas fa-microphone"></i>
                                                </div>
                                                <div class="recording-content">
                                                    <div class="recording-title">
                                                        <span>Đoạn 00:15</span>
                                                        <span class="badge bg-success">Mới</span>
                                                    </div>
                                                    <div class="recording-meta">
                                                        <span><i class="far fa-clock"></i> 2 phút trước</span>
                                                        <span><i class="fas fa-wave-square"></i> 00:35</span>
                                                    </div>
                                                    <audio controls class="w-100 mt-2">
                                                        <source src="#" type="audio/wav">
                                                    </audio>
                                                </div>
                                                <div class="recording-actions">
                                                    <button class="recording-button delete" title="Xóa">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="recording-item">
                                                <div class="recording-icon">
                                                    <i class="fas fa-microphone"></i>
                                                </div>
                                                <div class="recording-content">
                                                    <div class="recording-title">
                                                        <span>Đoạn 00:30</span>
                                                    </div>
                                                    <div class="recording-meta">
                                                        <span><i class="far fa-clock"></i> 5 phút trước</span>
                                                        <span><i class="fas fa-wave-square"></i> 00:42</span>
                                                    </div>
                                                    <audio controls class="w-100 mt-2">
                                                        <source src="#" type="audio/wav">
                                                    </audio>
                                                </div>
                                                <div class="recording-actions">
                                                    <button class="recording-button delete" title="Xóa">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="recording-item">
                                                <div class="recording-icon">
                                                    <i class="fas fa-microphone"></i>
                                                </div>
                                                <div class="recording-content">
                                                    <div class="recording-title">
                                                        <span>Đoạn 00:45</span>
                                                    </div>
                                                    <div class="recording-meta">
                                                        <span><i class="far fa-clock"></i> 10 phút trước</span>
                                                        <span><i class="fas fa-wave-square"></i> 00:28</span>
                                                    </div>
                                                    <audio controls class="w-100 mt-2">
                                                        <source src="#" type="audio/wav">
                                                    </audio>
                                                </div>
                                                <div class="recording-actions">
                                                    <button class="recording-button delete" title="Xóa">
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

    @push('styles')
        <style>
            .transcript-section {
                border-bottom: 1px solid #dee2e6;
                padding-bottom: 1rem;
            }

            .transcript-section:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .english-text {
                font-size: 1.1rem;
                color: #212529;
            }

            .vietnamese-text {
                font-size: 0.95rem;
            }

            .recording-item {
                display: flex;
                align-items: center;
                padding: 0.75rem;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                margin-bottom: 0.75rem;
                background: white;
                transition: all 0.2s ease;
            }

            .recording-item:hover {
                background: #f9fafb;
                border-color: #d1d5db;
            }

            .recording-item:last-child {
                margin-bottom: 0;
            }

            .recording-icon {
                width: 32px;
                height: 32px;
                background: #e0f2fe;
                color: #0284c7;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 0.75rem;
            }

            .recording-content {
                flex: 1;
            }

            .recording-title {
                font-size: 0.9rem;
                color: #1f2937;
                margin-bottom: 0.25rem;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .recording-meta {
                display: flex;
                align-items: center;
                gap: 1rem;
                font-size: 0.8rem;
                color: #6b7280;
            }

            .recording-meta span {
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }

            .recording-actions {
                display: flex;
                gap: 0.5rem;
            }

            .recording-button {
                padding: 0.25rem;
                border-radius: 4px;
                border: none;
                background: transparent;
                color: #6b7280;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .recording-button:hover {
                background: #f3f4f6;
                color: #1f2937;
            }

            .recording-button.play {
                color: #059669;
            }

            .recording-button.play:hover {
                background: #ecfdf5;
                color: #047857;
            }

            .recording-button.delete {
                color: #dc2626;
            }

            .recording-button.delete:hover {
                background: #fee2e2;
                color: #b91c1c;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Lấy các elements
                const video = document.querySelector('video');
                const playPauseBtn = document.getElementById('playPauseBtn');
                const replayBtn = document.getElementById('replayBtn');

                // Biến lưu thời gian bắt đầu của section hiện tại
                let currentSectionStart = 0;
                let currentSectionEnd = 0;

                // Xử lý nút Play/Pause
                playPauseBtn.addEventListener('click', function() {
                    if (video.paused) {
                        video.play();
                        playPauseBtn.innerHTML = '<i class="fas fa-pause me-2"></i>Pause';
                    } else {
                        video.pause();
                        playPauseBtn.innerHTML = '<i class="fas fa-play me-2"></i>Play';
                    }
                });

                // Xử lý nút Replay Section
                replayBtn.addEventListener('click', function() {
                    // Nếu đang trong một section
                    if (currentSectionStart !== null) {
                        video.currentTime = currentSectionStart;
                        video.play();
                        playPauseBtn.innerHTML = '<i class="fas fa-pause me-2"></i>Pause';
                    }
                });

                // Cập nhật trạng thái nút khi video play/pause
                video.addEventListener('play', function() {
                    playPauseBtn.innerHTML = '<i class="fas fa-pause me-2"></i>Pause';
                });

                video.addEventListener('pause', function() {
                    playPauseBtn.innerHTML = '<i class="fas fa-play me-2"></i>Play';
                });

                // Xử lý khi click vào nút play section
                document.querySelectorAll('.play-section').forEach(button => {
                    button.addEventListener('click', function() {
                        const timeRange = this.dataset.time; // Format: "0:00 - 0:15"
                        const [start, end] = timeRange.split(' - ')
                            .map(time => {
                                const [min, sec] = time.split(':').map(Number);
                                return min * 60 + sec;
                            });

                        // Lưu thời gian của section hiện tại
                        currentSectionStart = start;
                        currentSectionEnd = end;

                        // Chuyển video đến thời điểm bắt đầu và play
                        video.currentTime = start;
                        video.play();
                        playPauseBtn.innerHTML = '<i class="fas fa-pause me-2"></i>Pause';
                    });
                });

                // Kiểm tra và dừng video khi kết thúc section
                video.addEventListener('timeupdate', function() {
                    if (currentSectionEnd && video.currentTime >= currentSectionEnd) {
                        video.pause();
                        playPauseBtn.innerHTML = '<i class="fas fa-play me-2"></i>Play';
                    }
                });

                // Thêm phím tắt
                document.addEventListener('keydown', function(e) {
                    // Space để play/pause
                    if (e.code === 'Space') {
                        e.preventDefault();
                        playPauseBtn.click();
                    }
                    // R để replay section
                    else if (e.code === 'KeyR') {
                        e.preventDefault();
                        replayBtn.click();
                    }
                });
            });
        </script>
    @endpush
@endsection
