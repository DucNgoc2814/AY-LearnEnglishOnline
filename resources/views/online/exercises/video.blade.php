@extends('online.layouts.master')

@section('title', 'Basic Introductions - Video Exercise')

@section('styles')
<style>
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 8px;
        background-color: #000;
        cursor: pointer;
    }

    .video-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-container .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 68px;
        height: 48px;
        background-color: #ff0000;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .video-container .play-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-style: solid;
        border-width: 12px 0 12px 20px;
        border-color: transparent transparent transparent #fff;
    }

    .video-container .play-button:hover {
        background-color: #ff2222;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .transcript-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .transcript-line {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 4px;
        background-color: #fff;
        border-left: 3px solid #dee2e6;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .transcript-line:hover {
        border-left-color: #0d6efd;
        background-color: #f8f9fa;
    }

    .transcript-line .time {
        color: #0d6efd;
        font-weight: 500;
        font-size: 0.85rem;
        display: inline-block;
        min-width: 50px;
        cursor: pointer;
    }

    .transcript-line .time:hover {
        text-decoration: underline;
    }

    .input-underline {
        border: none;
        border-bottom: 1px solid #ced4da;
        border-radius: 0;
        padding: 0 5px;
        width: 100px;
        font-weight: 500;
        background-color: #f8f9ff;
    }

    .input-underline:focus {
        border-bottom: 2px solid var(--primary-color);
        box-shadow: none;
    }

    .input-correct {
        border-bottom: 2px solid var(--success-color);
        background-color: rgba(16, 185, 129, 0.1);
    }

    .input-incorrect {
        border-bottom: 2px solid var(--danger-color);
        background-color: rgba(239, 68, 68, 0.1);
    }

    .result-container {
        margin-top: 20px;
        padding: 20px;
        border-radius: 8px;
        background-color: #f0f7ff;
        border: 1px solid #cfe2ff;
    }
</style>
@endsection

@section('content')
@php
// Hardcoded data for testing
$exercise = [
    'title' => 'Basic Introductions',
    'description' => 'Watch the video and fill in the missing words in the conversation.',
    'youtube_id' => '19HaT0YaWA0',
    'transcript' => [
        [
            'time' => '00:03',
            'text' => 'Hello, my name is Sarah.'
        ],
        [
            'time' => '00:06',
            'text' => "I'm from _____.",
            'answer' => 'England'
        ],
        [
            'time' => '00:09',
            'text' => 'I _____ English at the university.',
            'answer' => 'teach'
        ],
        [
            'time' => '00:14',
            'text' => 'I enjoy _____ to music and reading books.',
            'answer' => 'listening'
        ],
        [
            'time' => '00:18',
            'text' => "What's your _____?",
            'answer' => 'name'
        ],
        [
            'time' => '00:21',
            'text' => 'Where are you _____?',
            'answer' => 'from'
        ]
    ]
];
@endphp

<div class="row">
    <div class="col-12">
        <h2 class="mb-2">{{ $exercise['title'] }}</h2>
        <p class="lead text-muted">{{ $exercise['description'] }}</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="video-container" id="videoContainer">
                    <img src="https://i.ytimg.com/vi/{{ $exercise['youtube_id'] }}/hqdefault.jpg" alt="Video thumbnail">
                    <div class="play-button"></div>
                </div>

                @if(session('result'))
                <div class="result-container">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            @if(session('result')['score'] >= 80)
                                <i class="fas fa-award fa-3x text-warning"></i>
                            @elseif(session('result')['score'] >= 60)
                                <i class="fas fa-star fa-3x text-primary"></i>
                            @else
                                <i class="fas fa-check-circle fa-3x text-success"></i>
                            @endif
                        </div>
                        <div>
                            <h4 class="mb-0">Your Score: {{ round(session('result')['score']) }}%</h4>
                            <p class="mb-0">{{ session('result')['message'] }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ request()->url() }}" class="btn btn-outline-primary">Try Again</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Transcript</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('exercises.video.submit', ['id' => request()->route('id')]) }}" method="POST">
                    @csrf
                    <div class="transcript-container">
                        @foreach($exercise['transcript'] as $index => $line)
                            <div class="transcript-line">
                                <span class="time" role="button">{{ $line['time'] }}</span>
                                @if(isset($line['answer']))
                                    @php
                                        $parts = explode('_____', $line['text']);
                                    @endphp
                                    <span>{{ $parts[0] }}</span>
                                    <input type="text" name="answers[]" class="input-underline" placeholder="..."
                                        @if(session('result'))
                                            value="{{ old('answers.'.$index, '') }}"
                                            class="input-underline {{ strtolower(trim(old('answers.'.$index, ''))) === strtolower(trim($line['answer'])) ? 'input-correct' : 'input-incorrect' }}"
                                            readonly
                                        @endif
                                    >
                                    <span>{{ $parts[1] ?? '' }}</span>
                                @else
                                    <span>{{ $line['text'] }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if(!session('result'))
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-2"></i> Check Answers
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let videoLoaded = false;

function loadVideo(startTime = 0) {
    if (videoLoaded) return;

    const container = document.getElementById('videoContainer');
    const videoId = '{{ $exercise['youtube_id'] }}';

    // Create iframe
    const iframe = document.createElement('iframe');
    iframe.id = 'youtubePlayer';
    iframe.src = `https://tienganh-abc.com/videos/tuoi-tho-ba-djao-cua-sheldon-2017=66735f66cd8dc73b802af882/tap-1`;
    iframe.setAttribute('allowfullscreen', '');
    iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';

    // Replace thumbnail with iframe
    container.innerHTML = '';
    container.appendChild(iframe);
    videoLoaded = true;
}

function handleTimeClick(timeStr) {
    try {
        const seconds = convertTimeToSeconds(timeStr);
        if (!videoLoaded) {
            loadVideo(seconds);
        } else {
            const iframe = document.getElementById('youtubePlayer');
            const videoId = '{{ $exercise['youtube_id'] }}';
            iframe.src = `https://www.youtube-nocookie.com/embed/${videoId}?autoplay=1&start=${seconds}`;
        }
    } catch (error) {
        console.error('Error seeking video:', error);
        showError('Error controlling video. Please refresh and try again.');
    }
}

function convertTimeToSeconds(timeStr) {
    const [minutes, seconds] = timeStr.split(':').map(Number);
    return (minutes * 60) + seconds;
}

function showError(message) {
    const container = document.querySelector('.video-container');
    const existingError = container.querySelector('.alert');
    if (existingError) {
        existingError.remove();
    }
    container.insertAdjacentHTML('beforeend',
        `<div class="alert alert-danger mt-3">${message}</div>`
    );
}

// Set up event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Click handler for video thumbnail
    const container = document.getElementById('videoContainer');
    container.addEventListener('click', function() {
        loadVideo();
    });

    // Click handlers for timestamps
    const timeElements = document.querySelectorAll('.time');
    timeElements.forEach(element => {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            const timeStr = this.textContent.trim();
            handleTimeClick(timeStr);
        });
    });
});
</script>
@endsection