@extends('online.layouts.master')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0">{{ $title }}</h4>
                <button class="btn btn-outline-primary" id="toggleTranscript">
                    <i class="fas fa-file-alt me-2"></i>Hiện/Ẩn Transcript
                </button>
            </div>

            <div class="row">
                <!-- Video Section -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ $video['url'] }}"
                                        title="{{ $video['title'] }}"
                                        allowfullscreen
                                        class="rounded"></iframe>
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
                                <div class="btn-group">
                                    <button class="btn btn-outline-success" id="recordBtn">
                                        <i class="fas fa-microphone me-2"></i>Ghi âm
                                    </button>
                                    <button class="btn btn-outline-info" id="compareBtn">
                                        <i class="fas fa-exchange-alt me-2"></i>So sánh
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transcript Section (Collapsible) -->
                    <div class="card mb-4" id="transcriptSection" style="display: none;">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Transcript & Translation</h5>
                            @foreach($video['transcript'] as $section)
                            <div class="transcript-section mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary">{{ $section['time'] }}</span>
                                    <button class="btn btn-sm btn-outline-primary play-section" data-time="{{ $section['time'] }}">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </div>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <p class="mb-2 english-text">{{ $section['text'] }}</p>
                                        <p class="mb-0 text-muted vietnamese-text">{{ $section['translation'] }}</p>
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
                                @foreach($video['tips'] as $tip)
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
                                <!-- Recordings will be added here dynamically -->
                                <p class="text-muted text-center mb-0">Chưa có bản ghi âm nào</p>
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
        padding: 0.5rem;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        margin-bottom: 0.5rem;
    }
    .recording-item:last-child {
        margin-bottom: 0;
    }
    .btn-group .btn {
        margin-right: 0.25rem;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle Transcript
    const toggleTranscriptBtn = document.getElementById('toggleTranscript');
    const transcriptSection = document.getElementById('transcriptSection');

    toggleTranscriptBtn.addEventListener('click', function() {
        if (transcriptSection.style.display === 'none') {
            transcriptSection.style.display = 'block';
            transcriptSection.scrollIntoView({ behavior: 'smooth' });
        } else {
            transcriptSection.style.display = 'none';
        }
    });

    // Recording functionality
    let mediaRecorder;
    let audioChunks = [];
    const recordBtn = document.getElementById('recordBtn');
    const recordingsList = document.getElementById('recordingsList');

    // Request microphone access
    async function setupRecording() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.addEventListener('dataavailable', event => {
                audioChunks.push(event.data);
            });

            mediaRecorder.addEventListener('stop', () => {
                const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                const audioUrl = URL.createObjectURL(audioBlob);
                addRecordingToList(audioUrl);
                audioChunks = [];
            });
        } catch (error) {
            console.error('Error accessing microphone:', error);
            alert('Không thể truy cập microphone. Vui lòng kiểm tra quyền truy cập.');
        }
    }

    // Add recording to list
    function addRecordingToList(audioUrl) {
        const timestamp = new Date().toLocaleTimeString();
        const recordingItem = document.createElement('div');
        recordingItem.className = 'recording-item';
        recordingItem.innerHTML = `
            <div class="flex-grow-1">
                <div class="d-flex align-items-center">
                    <span class="me-2"><i class="fas fa-microphone text-success"></i></span>
                    <span>Bản ghi ${timestamp}</span>
                </div>
                <audio controls class="mt-2 w-100">
                    <source src="${audioUrl}" type="audio/wav">
                </audio>
            </div>
        `;

        if (recordingsList.querySelector('.text-muted')) {
            recordingsList.innerHTML = '';
        }
        recordingsList.insertBefore(recordingItem, recordingsList.firstChild);
    }

    // Handle record button click
    recordBtn.addEventListener('click', function() {
        if (!mediaRecorder) {
            setupRecording().then(() => {
                startRecording();
            });
        } else {
            startRecording();
        }
    });

    function startRecording() {
        if (mediaRecorder.state === 'inactive') {
            mediaRecorder.start();
            recordBtn.innerHTML = '<i class="fas fa-stop me-2"></i>Dừng ghi âm';
            recordBtn.classList.replace('btn-outline-success', 'btn-danger');
        } else {
            mediaRecorder.stop();
            recordBtn.innerHTML = '<i class="fas fa-microphone me-2"></i>Ghi âm';
            recordBtn.classList.replace('btn-danger', 'btn-outline-success');
        }
    }
});
</script>
@endpush
@endsection
