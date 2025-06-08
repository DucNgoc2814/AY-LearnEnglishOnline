@extends('online.layouts.master')

@section('title', 'Video Dubbing Practice')

@section('styles')
<style>
    .practice-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .video-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .video-player {
        width: 100%;
        aspect-ratio: 16/9;
        background: #000;
    }

    .script-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .script-line {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        align-items: center;
    }

    .script-line:last-child {
        border-bottom: none;
    }

    .timestamp {
        flex-shrink: 0;
        color: #4f46e5;
        font-family: monospace;
        cursor: pointer;
        padding: 4px 12px;
        border-radius: 6px;
        transition: all 0.2s ease;
        background-color: #eef2ff;
        border: 1px solid #e0e7ff;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    .timestamp:hover {
        background-color: #4f46e5;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(79, 70, 229, 0.1);
    }

    .timestamp i {
        font-size: 12px;
    }

    .speaker {
        flex-shrink: 0;
        font-weight: 500;
        color: #4f46e5;
        width: 100px;
    }

    .text {
        flex-grow: 1;
    }

    .record-button {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ef4444;
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .record-button:hover {
        background: #dc2626;
    }

    .record-button.recording {
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .controls {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 8px;
    }

    .control-button {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #4b5563;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .control-button:hover {
        background: #f3f4f6;
        color: #1f2937;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .control-button.reset {
        background: #fee2e2;
        color: #dc2626;
        border-color: #fecaca;
    }

    .control-button.reset:hover {
        background: #fecaca;
        border-color: #fca5a5;
        color: #b91c1c;
    }

    .control-button.play {
        background: #ecfdf5;
        color: #059669;
        border-color: #d1fae5;
    }

    .control-button.play:hover {
        background: #d1fae5;
        border-color: #a7f3d0;
        color: #047857;
    }

    .control-button.primary {
        background: #4f46e5;
        color: white;
        border-color: #4338ca;
    }

    .control-button.primary:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(79, 70, 229, 0.2);
    }

    .control-button i {
        font-size: 1rem;
    }

    .history-section {
        background: white;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        margin-top: 1rem;
        overflow: hidden;
    }

    .history-header {
        background: #0f766e;
        color: white;
        padding: 0.75rem 1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .history-header i {
        font-size: 1.1rem;
    }

    .history-content {
        padding: 1rem;
    }

    .no-history-message {
        color: #6b7280;
        text-align: center;
        padding: 1rem;
        font-size: 0.95rem;
    }

    .history-item {
        padding: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.2s ease;
    }

    .history-item:last-child {
        border-bottom: none;
    }

    .history-item:hover {
        background: #f9fafb;
    }

    .history-item-icon {
        width: 32px;
        height: 32px;
        background: #e0f2fe;
        color: #0284c7;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .history-item-content {
        flex: 1;
    }

    .history-item-title {
        font-size: 0.9rem;
        color: #1f2937;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    .history-item-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.8rem;
        color: #6b7280;
    }

    .history-item-meta span {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .history-item-actions {
        display: flex;
        gap: 0.5rem;
    }

    .history-item-button {
        padding: 0.25rem;
        border-radius: 4px;
        border: none;
        background: transparent;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .history-item-button:hover {
        background: #f3f4f6;
        color: #1f2937;
    }

    .history-item-button.play {
        color: #059669;
    }

    .history-item-button.play:hover {
        background: #ecfdf5;
        color: #047857;
    }

    .history-item-button.delete {
        color: #dc2626;
    }

    .history-item-button.delete:hover {
        background: #fee2e2;
        color: #b91c1c;
    }
</style>
@endsection

@section('content')
<div class="practice-container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Video Player -->
            <div class="video-section">
                <video class="video-player" id="videoPlayer" controls>
                    <source src="{{ $video['video_url'] }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Script Section -->
            <div class="script-section">
                <h4 class="mb-4">Script</h4>
                @foreach($video['script'] as $line)
                <div class="script-line">
                    <span class="timestamp" data-time="{{ $line['timestamp'] }}" title="Click to seek video">
                        <i class="fas fa-clock"></i>
                        {{ $line['timestamp'] }}
                    </span>
                    <span class="speaker">{{ $line['speaker'] }}</span>
                    <span class="text">{{ $line['text'] }}</span>
                    <button class="record-button" title="Record your voice">
                        <i class="fas fa-microphone"></i>
                    </button>
                </div>
                @endforeach

                <div class="controls">
                    <button class="control-button reset">
                        <i class="fas fa-undo"></i>
                        Reset
                    </button>
                    <button class="control-button play">
                        <i class="fas fa-play"></i>
                        Play All
                    </button>
                    <button class="control-button primary">
                        <i class="fas fa-save"></i>
                        Save Recording
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Instructions -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Instructions</h5>
                    <ol class="ps-3">
                        <li class="mb-2">Watch the video first to understand the conversation</li>
                        <li class="mb-2">Click the microphone button next to each line to record your voice</li>
                        <li class="mb-2">Listen to your recording and re-record if needed</li>
                        <li>Click "Save Recording" when you're satisfied with your dubbing</li>
                    </ol>
                </div>
            </div>

            <!-- Tips -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tips for Better Dubbing</h5>
                    <ul class="ps-3">
                        <li class="mb-2">Pay attention to the speaker's tone and emotion</li>
                        <li class="mb-2">Practice the line a few times before recording</li>
                        <li class="mb-2">Try to match the timing of the original speech</li>
                        <li>Focus on clear pronunciation</li>
                    </ul>
                </div>
            </div>

            <div class="history-section">
                <div class="history-header">
                    <i class="fas fa-history"></i>
                    Lịch sử ghi âm
                </div>
                <div class="history-content">
                    <div class="history-item">
                        <div class="history-item-icon">
                            <i class="fas fa-microphone"></i>
                        </div>
                        <div class="history-item-content">
                            <div class="history-item-title">Bản ghi #1</div>
                            <div class="history-item-meta">
                                <span><i class="far fa-clock"></i> 2 phút trước</span>
                                <span><i class="fas fa-wave-square"></i> 00:35</span>
                            </div>
                        </div>
                        <div class="history-item-actions">
                            <button class="history-item-button play" title="Phát">
                                <i class="fas fa-play"></i>
                            </button>
                            <button class="history-item-button delete" title="Xóa">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="history-item">
                        <div class="history-item-icon">
                            <i class="fas fa-microphone"></i>
                        </div>
                        <div class="history-item-content">
                            <div class="history-item-title">Bản ghi #2</div>
                            <div class="history-item-meta">
                                <span><i class="far fa-clock"></i> 5 phút trước</span>
                                <span><i class="fas fa-wave-square"></i> 00:42</span>
                            </div>
                        </div>
                        <div class="history-item-actions">
                            <button class="history-item-button play" title="Phát">
                                <i class="fas fa-play"></i>
                            </button>
                            <button class="history-item-button delete" title="Xóa">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="history-item">
                        <div class="history-item-icon">
                            <i class="fas fa-microphone"></i>
                        </div>
                        <div class="history-item-content">
                            <div class="history-item-title">Bản ghi #3</div>
                            <div class="history-item-meta">
                                <span><i class="far fa-clock"></i> 10 phút trước</span>
                                <span><i class="fas fa-wave-square"></i> 00:28</span>
                            </div>
                        </div>
                        <div class="history-item-actions">
                            <button class="history-item-button play" title="Phát">
                                <i class="fas fa-play"></i>
                            </button>
                            <button class="history-item-button delete" title="Xóa">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoPlayer = document.getElementById('videoPlayer');
    const recordButtons = document.querySelectorAll('.record-button');
    const timestamps = document.querySelectorAll('.timestamp');

    // Handle timestamp clicks
    timestamps.forEach(timestamp => {
        timestamp.addEventListener('click', function() {
            const timeString = this.dataset.time;
            const [minutes, seconds] = timeString.split(':').map(Number);
            const timeInSeconds = minutes * 60 + seconds;

            // Seek video to the specified time
            videoPlayer.currentTime = timeInSeconds;

            // Start playing from that point
            videoPlayer.play();

            // Highlight the clicked timestamp briefly
            this.style.backgroundColor = '#e0e7ff';
            setTimeout(() => {
                this.style.backgroundColor = '';
            }, 500);
        });
    });

    // Recording functionality
    recordButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Toggle recording state
            this.classList.toggle('recording');
            const icon = this.querySelector('i');

            if (this.classList.contains('recording')) {
                icon.classList.remove('fa-microphone');
                icon.classList.add('fa-stop');
            } else {
                icon.classList.remove('fa-stop');
                icon.classList.add('fa-microphone');
            }

            // Here you would implement actual recording logic
        });
    });
});
</script>
@endpush
