@extends('online.layouts.master')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">{{ $title }}</h4>

            <ul class="nav nav-tabs" id="videoHandoutTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab">
                        <span class="badge bg-primary me-2">1</span>XEM VIDEO
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="handout-tab" data-bs-toggle="tab" data-bs-target="#handout" type="button" role="tab">
                        <span class="badge bg-primary me-2">2</span>LÀM BÀI TẬP HANDOUT
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-4" id="videoHandoutTabContent">
                <!-- Tab 1: Watch Video -->
                <div class="tab-pane fade show active" id="video" role="tabpanel">
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

                <!-- Tab 2: Handout Exercise -->
                <div class="tab-pane fade" id="handout" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-file-pdf me-2 text-danger"></i>{{ $handout['title'] }}
                                        </h5>
                                        <a href="{{ $handout['pdf_url'] }}" class="btn btn-primary" download>
                                            <i class="fas fa-download me-2"></i>Tải Handout
                                        </a>
                                    </div>

                                    <p class="text-muted mb-4">{{ $handout['description'] }}</p>

                                    <!-- PDF Viewer -->
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ $handout['pdf_url'] }}"
                                                class="rounded shadow-sm"
                                                style="border: 1px solid #dee2e6;"
                                                allowfullscreen></iframe>
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
    .nav-tabs {
        border-bottom: 2px solid #e9ecef;
    }
    .nav-tabs .nav-link {
        border: none;
        border-bottom: 2px solid transparent;
        padding: 1rem 1.5rem;
        margin-bottom: -2px;
        font-weight: 500;
        color: #6c757d;
    }
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #0d6efd;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
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
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý form handout
    const handoutForm = document.getElementById('handoutForm');
    const exerciseTextareas = document.querySelectorAll('textarea[data-exercise]');

    if (handoutForm && exerciseTextareas) {
        // Load saved answers
        exerciseTextareas.forEach(textarea => {
            const exerciseId = textarea.dataset.exercise;
            const savedAnswer = localStorage.getItem(`handout_ex${exerciseId}`);
            if (savedAnswer) {
                textarea.value = savedAnswer;
            }
        });

        // Save answers while typing
        exerciseTextareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                const exerciseId = this.dataset.exercise;
                localStorage.setItem(`handout_ex${exerciseId}`, this.value);
            });
        });

        // Handle form submission
        handoutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            exerciseTextareas.forEach(textarea => {
                const exerciseId = textarea.dataset.exercise;
                localStorage.setItem(`handout_ex${exerciseId}`, textarea.value);
            });
            alert('Bài làm đã được lưu thành công!');
        });
    }

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
});
</script>
@endpush
@endsection
