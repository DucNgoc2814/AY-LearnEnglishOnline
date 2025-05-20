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
        color: #6b7280;
        font-family: monospace;
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
        padding: 0.5rem 1rem;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #4b5563;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .control-button:hover {
        background: #f3f4f6;
        color: #1f2937;
    }

    .control-button.primary {
        background: #4f46e5;
        color: white;
        border-color: #4f46e5;
    }

    .control-button.primary:hover {
        background: #4338ca;
    }
</style>
@endsection

@section('content')
<div class="practice-container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Video Player -->
            <div class="video-section">
                <video class="video-player" controls>
                    <source src="{{ $video['video_url'] }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Script Section -->
            <div class="script-section">
                <h4 class="mb-4">Script</h4>
                @foreach($video['script'] as $line)
                <div class="script-line">
                    <span class="timestamp">{{ $line['timestamp'] }}</span>
                    <span class="speaker">{{ $line['speaker'] }}</span>
                    <span class="text">{{ $line['text'] }}</span>
                    <button class="record-button" title="Record your voice">
                        <i class="fas fa-microphone"></i>
                    </button>
                </div>
                @endforeach

                <div class="controls">
                    <button class="control-button">
                        <i class="fas fa-undo"></i>
                        Reset
                    </button>
                    <button class="control-button">
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
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const recordButtons = document.querySelectorAll('.record-button');

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
