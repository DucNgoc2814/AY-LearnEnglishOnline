@extends('online.layouts.master')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Video Exercise - Basic Introductions</h4>

            <ul class="nav nav-tabs" id="exerciseTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1" type="button" role="tab" aria-controls="step1" aria-selected="true">
                        <i class="fas fa-1"></i> Bước 1
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step2-tab" data-bs-toggle="tab" data-bs-target="#step2" type="button" role="tab" aria-controls="step2" aria-selected="false">
                        <i class="fas fa-2"></i> Bước 2
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step3-tab" data-bs-toggle="tab" data-bs-target="#step3" type="button" role="tab" aria-controls="step3" aria-selected="false">
                        <i class="fas fa-3"></i> Bước 3
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-4" id="exerciseTabContent">
                <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe
                                    src="{{ $lesson->video_url }}"
                                    title="Video Exercise"
                                    allowfullscreen
                                    class="rounded shadow-sm"
                                ></iframe>
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
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-tasks me-2"></i>Hướng dẫn Bước 1</h5>
                                    <div class="card-text">
                                        <p class="mb-2">Trong quá trình xem video, hãy:</p>
                                        <ol class="ps-3">
                                            <li class="mb-2">Xem video lần đầu để nắm nội dung tổng quát</li>
                                            <li class="mb-2">Xem lại và ghi chú từ vựng, cụm từ mới</li>
                                            <li class="mb-2">Chú ý cách phát âm và ngữ điệu của người nói</li>
                                            <li>Ghi lại những cấu trúc câu hữu ích</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe
                                    src="{{ $lesson->video_url }}"
                                    title="Video Exercise"
                                    allowfullscreen
                                    class="rounded shadow-sm"
                                ></iframe>
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
                                    <span class="badge bg-primary p-2 draggable" draggable="true">wrong</span>
                                    <span class="badge bg-primary p-2 draggable" draggable="true">ready</span>
                                    <span class="badge bg-primary p-2 draggable" draggable="true">business</span>
                                    <span class="badge bg-primary p-2 draggable" draggable="true">deal</span>
                                    <span class="badge bg-primary p-2 draggable" draggable="true">thrilled</span>
                                    <span class="badge bg-primary p-2 draggable" draggable="true">in trouble</span>
                                    <span class="badge bg-primary p-2 draggable" draggable="true">Lights out</span>
                                    <span class="badge bg-primary p-2 draggable" draggable="true">cut back</span>
                                    <span class="badge bg-primary p-2 draggable" draggable="true">thoughts</span>
                                    <span class="badge bg-primary p-2 draggable" draggable="true">how you doing</span>
                                </div>
                            </div>

                            <!-- Exercise List -->
                            <div class="exercise-list">
                                <div class="exercise-item mb-3 p-3 border rounded">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-secondary me-2">1</span>
                                        <button class="btn btn-sm btn-outline-primary video-time-btn" data-time="48">
                                            <i class="fas fa-play me-1"></i>00:00:48
                                        </button>
                                        <span class="ms-3">Shelly, bữa tối xong rồi!</span>
                                    </div>
                                    <div class="answer-line">
                                        <span class="text-primary">> Shelly, dinner's</span>
                                        <div class="dropzone d-inline-block mx-2" data-answer="ready"></div>
                                        <span>.</span>
                                    </div>
                                </div>

                                <div class="exercise-item mb-3 p-3 border rounded">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-secondary me-2">2</span>
                                        <button class="btn btn-sm btn-outline-primary video-time-btn" data-time="112">
                                            <i class="fas fa-play me-1"></i>00:01:52
                                        </button>
                                        <span class="ms-3">Không phải việc của em.</span>
                                    </div>
                                    <div class="answer-line">
                                        <span class="text-primary">> None of your</span>
                                        <div class="dropzone d-inline-block mx-2" data-answer="business"></div>
                                        <span>.</span>
                                    </div>
                                </div>

                                <!-- Add more exercise items following the same pattern -->
                            </div>

                            <!-- Check Answer Button -->
                            <div class="text-end mt-4">
                                <button class="btn btn-success" id="checkAnswers">
                                    <i class="fas fa-check me-2"></i>Kiểm tra đáp án
                                </button>
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
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <div class="ratio ratio-16x9">
                                                <iframe
                                                    src="{{ $lesson->video_url }}"
                                                    title="Video Exercise"
                                                    allowfullscreen
                                                    class="rounded"
                                                    id="mainVideo"
                                                ></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Audio Clips Column -->
                                <div class="col-md-6">
                                    <div class="clip-list">
                                        <!-- Clip 1 -->
                                        <div class="clip-item mb-3 p-3 border rounded bg-white">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-primary">Clip 1</span>
                                                <button class="btn btn-sm btn-outline-secondary play-clip" data-time="48">
                                                    <i class="fas fa-play"></i>
                                                    <span class="ms-1">0:02 / 0:02</span>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary volume-btn">
                                                    <i class="fas fa-volume-up"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary show-btn ms-2">Show</button>
                                                <button class="btn btn-sm btn-outline-primary hide-btn">Hide</button>
                                            </div>
                                            <p class="clip-text text-primary mt-2 mb-0 d-none">Hi. How can I help you?</p>
                                        </div>

                                        <!-- Clip 2 -->
                                        <div class="clip-item mb-3 p-3 border rounded bg-white">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-primary">Clip 2</span>
                                                <button class="btn btn-sm btn-outline-secondary play-clip" data-time="112">
                                                    <i class="fas fa-play"></i>
                                                    <span class="ms-1">0:03 / 0:03</span>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary volume-btn">
                                                    <i class="fas fa-volume-up"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary show-btn ms-2">Show</button>
                                                <button class="btn btn-sm btn-outline-primary hide-btn">Hide</button>
                                            </div>
                                            <p class="clip-text text-primary mt-2 mb-0 d-none">Hi. How much is this tuna salad?</p>
                                        </div>

                                        <!-- Clip 3 -->
                                        <div class="clip-item mb-3 p-3 border rounded bg-white">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-primary">Clip 3</span>
                                                <button class="btn btn-sm btn-outline-secondary play-clip" data-time="150">
                                                    <i class="fas fa-play"></i>
                                                    <span class="ms-1">0:02 / 0:02</span>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary volume-btn">
                                                    <i class="fas fa-volume-up"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary show-btn ms-2">Show</button>
                                                <button class="btn btn-sm btn-outline-primary hide-btn">Hide</button>
                                            </div>
                                            <p class="clip-text text-primary mt-2 mb-0 d-none">[Clip text here]</p>
                                        </div>

                                        <!-- Clip 4 -->
                                        <div class="clip-item mb-3 p-3 border rounded bg-white">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-primary">Clip 4</span>
                                                <button class="btn btn-sm btn-outline-secondary play-clip" data-time="183">
                                                    <i class="fas fa-play"></i>
                                                    <span class="ms-1">0:03 / 0:03</span>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary volume-btn">
                                                    <i class="fas fa-volume-up"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary show-btn ms-2">Show</button>
                                                <button class="btn btn-sm btn-outline-primary hide-btn">Hide</button>
                                            </div>
                                            <p class="clip-text text-primary mt-2 mb-0 d-none">[Clip text here]</p>
                                        </div>
                                    </div>

                                    <!-- Instructions -->
                                    <div class="alert alert-info mt-3">
                                        <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Hướng dẫn:</h6>
                                        <ol class="mb-0">
                                            <li>Click vào clip để xem đoạn video tương ứng</li>
                                            <li>Sử dụng nút play để nghe lại audio clip</li>
                                            <li>Ấn Show/Hide để hiện/ẩn phụ đề</li>
                                            <li>Lặp lại nhiều lần để cải thiện phát âm</li>
                                        </ol>
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
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }
    .clip-item {
        background: white;
        transition: all 0.2s;
    }
    .clip-item:hover {
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
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
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const draggables = document.querySelectorAll('.draggable');
    const dropzones = document.querySelectorAll('.dropzone');
    const videoTimeButtons = document.querySelectorAll('.video-time-btn');
    const checkAnswersBtn = document.getElementById('checkAnswers');
    const clipItems = document.querySelectorAll('.clip-item');
    const mainVideo = document.getElementById('mainVideo');

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

    // Check Answers Logic
    checkAnswersBtn.addEventListener('click', function() {
        dropzones.forEach(dropzone => {
            const correctAnswer = dropzone.dataset.answer;
            const userAnswer = dropzone.textContent;

            dropzone.classList.remove('correct', 'incorrect');
            if (userAnswer === correctAnswer) {
                dropzone.classList.add('correct');
            } else {
                dropzone.classList.add('incorrect');
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
});
</script>
@endpush
@endsection
