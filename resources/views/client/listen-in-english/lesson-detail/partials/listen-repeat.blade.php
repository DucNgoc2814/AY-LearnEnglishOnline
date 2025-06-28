@php
    $clips = [
        [
            'number' => 1,
            'duration' => '0:03',
            'text' => 'Rob sees Jenny on the street and offers her coffee.',
            'audio_url' => '/audio/clip1.mp3'
        ],
        [
            'number' => 2,
            'duration' => '0:02',
            'text' => 'Jenny thanks Rob for the coffee.',
            'audio_url' => '/audio/clip2.mp3'
        ],
        [
            'number' => 3,
            'duration' => '0:02',
            'text' => 'Jenny has another meeting with Daniel at 9:30.',
            'audio_url' => '/audio/clip3.mp3'
        ],
        [
            'number' => 4,
            'duration' => '0:02',
            'text' => 'Rob is going to interview the theater director for twenty minutes.',
            'audio_url' => '/audio/clip4.mp3'
        ],
        [
            'number' => 5,
            'duration' => '0:02',
            'text' => 'Jenny accidentally spills coffee on Rob while she checks her phone.',
            'audio_url' => '/audio/clip5.mp3'
        ],
        [
            'number' => 6,
            'duration' => '0:02',
            'text' => 'Jenny apologises for spilling coffee on Rob.',
            'audio_url' => '/audio/clip6.mp3'
        ],
        [
            'number' => 7,
            'duration' => '0:02',
            'text' => 'Rob forgives Jenny for the accident.',
            'audio_url' => '/audio/clip7.mp3'
        ],
        [
            'number' => 8,
            'duration' => '0:03',
            'text' => 'They both continue with their busy schedules.',
            'audio_url' => '/audio/clip8.mp3'
        ]
    ];
@endphp

<div class="listen-repeat-container">
    <div class="instructions mb-4">
        <p>
            <i class="fas fa-info-circle me-2"></i>
            Nghe đoạn audio và cố gắng lặp lại những gì bạn nghe. Click "Show" để xem văn bản.
        </p>
    </div>

    @foreach($clips as $clip)
    <div class="clip-item mb-4">
        <h6 class="mb-2">Clip {{ $clip['number'] }}</h6>

        <div class="audio-player mb-2">
            <audio class="clip-audio" data-clip="{{ $clip['number'] }}">
                <source src="{{ $clip['audio_url'] }}" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>

            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-sm btn-primary play-button">
                    <i class="fas fa-play"></i>
                </button>

                <div class="progress flex-grow-1" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                </div>

                <span class="duration-text">
                    <span class="current-time">0:00</span>
                    /
                    <span class="total-time">{{ $clip['duration'] }}</span>
                </span>

                <button class="btn btn-sm btn-link p-0">
                    <i class="fas fa-volume-up"></i>
                </button>
            </div>
        </div>

        <div class="text-controls">
            <button class="btn btn-primary btn-sm show-text">Show</button>
            <button class="btn btn-secondary btn-sm hide-text" style="display: none;">Hide</button>
            <div class="clip-text mt-2" style="display: none;">
                {{ $clip['text'] }}
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
.listen-repeat-container {
    padding: 15px;
}

.clip-item {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 20px;
}

.audio-player {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
}

.clip-text {
    color: #28a745;
    font-weight: 500;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 5px;
}

.duration-text {
    font-size: 0.875rem;
    color: #6c757d;
    min-width: 85px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý hiển thị/ẩn text
    document.querySelectorAll('.show-text').forEach(button => {
        button.addEventListener('click', function() {
            const clipItem = this.closest('.clip-item');
            const hideButton = clipItem.querySelector('.hide-text');
            const clipText = clipItem.querySelector('.clip-text');

            this.style.display = 'none';
            hideButton.style.display = 'inline-block';
            clipText.style.display = 'block';
        });
    });

    document.querySelectorAll('.hide-text').forEach(button => {
        button.addEventListener('click', function() {
            const clipItem = this.closest('.clip-item');
            const showButton = clipItem.querySelector('.show-text');
            const clipText = clipItem.querySelector('.clip-text');

            this.style.display = 'none';
            showButton.style.display = 'inline-block';
            clipText.style.display = 'none';
        });
    });

    // Xử lý audio player
    document.querySelectorAll('.audio-player').forEach(player => {
        const audio = player.querySelector('audio');
        const playButton = player.querySelector('.play-button');
        const progressBar = player.querySelector('.progress-bar');
        const currentTimeSpan = player.querySelector('.current-time');

        // Play/Pause
        playButton.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (audio.paused) {
                audio.play();
                icon.classList.remove('fa-play');
                icon.classList.add('fa-pause');
            } else {
                audio.pause();
                icon.classList.remove('fa-pause');
                icon.classList.add('fa-play');
            }
        });

        // Update progress bar
        audio.addEventListener('timeupdate', function() {
            const progress = (audio.currentTime / audio.duration) * 100;
            progressBar.style.width = progress + '%';

            // Update current time
            const minutes = Math.floor(audio.currentTime / 60);
            const seconds = Math.floor(audio.currentTime % 60);
            currentTimeSpan.textContent = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        });

        // Reset when audio ends
        audio.addEventListener('ended', function() {
            const icon = playButton.querySelector('i');
            icon.classList.remove('fa-pause');
            icon.classList.add('fa-play');
            progressBar.style.width = '0%';
            currentTimeSpan.textContent = '0:00';
        });
    });
});
</script>
