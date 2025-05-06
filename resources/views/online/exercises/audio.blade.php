@extends('online.layouts.master')

@section('title', $exercise['title'] ?? 'Bài tập nghe hiểu')

@section('styles')
<style>
    .audio-exercise-container {
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .exercise-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }
    
    .exercise-description {
        color: #666;
        margin-bottom: 20px;
    }
    
    .audio-player {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        text-align: center;
    }
    
    .audio-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        gap: 20px;
    }
    
    .player-progress {
        height: 4px;
        background-color: #e5e7eb;
        width: 100%;
        border-radius: 4px;
        margin: 15px 0 5px;
        position: relative;
    }
    
    .progress-bar {
        height: 100%;
        background-color: #666;
        border-radius: 4px;
        width: 0;
        transition: width 0.1s linear;
    }
    
    .audio-time {
        display: flex;
        justify-content: space-between;
        color: #666;
        font-size: 0.8rem;
    }
    
    .control-btn {
        background: none;
        border: none;
        color: #333;
        font-size: 1.8rem;
        cursor: pointer;
        transition: all 0.2s;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .control-btn.play-btn {
        font-size: 2.5rem;
    }
    
    .control-btn:hover {
        color: var(--primary-color);
    }
    
    .question-container {
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 1px solid #eee;
    }
    
    .question-number {
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
        font-size: 1.1rem;
    }
    
    .question-text {
        line-height: 1.8;
        margin-bottom: 25px;
        font-size: 1.05rem;
    }
    
    .input-answer {
        border: none;
        border-bottom: 1px solid #ccc;
        padding: 4px 8px;
        width: 150px;
        background-color: #f9f9f9;
        margin: 0 5px;
        transition: all 0.3s;
        text-align: center;
    }
    
    .input-answer:focus {
        outline: none;
        border-color: var(--primary-color);
        background-color: #f0f7ff;
    }
    
    .answer-correct {
        border-color: #10b981;
        background-color: rgba(16, 185, 129, 0.1);
    }
    
    .answer-incorrect {
        border-color: #ef4444;
        background-color: rgba(239, 68, 68, 0.1);
    }
    
    .correct-answer {
        color: #ef4444;
        font-weight: bold;
        font-size: 0.9rem;
        margin-left: 5px;
    }
    
    .ay-btn-check {
        background-color: #fbbf24;
        color: #000;
        border: none;
        padding: 8px 18px;
        border-radius: 4px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-block;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .ay-btn-check:hover {
        background-color: #f59e0b;
        transform: translateY(-2px);
    }
    
    .instruction {
        background-color: #fff9c2;
        padding: 10px 15px;
        border-radius: 5px;
        border-left: 3px solid #fbbf24;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }
    
    .highlight {
        color: #ef4444;
        font-weight: 600;
    }
    
    .logo-header {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .logo-header img {
        max-width: 200px;
        height: auto;
    }
    
    .script-display {
        margin-top: 15px;
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        border-left: 3px solid #ef4444;
        display: none;
    }
    
    .script-display span.highlight {
        background-color: #fff3cd;
        padding: 2px 5px;
        font-weight: bold;
    }
    
    .check-button-container {
        text-align: right;
        margin-top: 20px;
    }
    
    .back-button-container {
        margin-bottom: 20px;
    }
    
    .ay-btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #f3f4f6;
        color: #374151;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .ay-btn-back:hover {
        background-color: #e5e7eb;
        color: #111827;
        transform: translateX(-2px);
    }
    
    .ay-btn-back i {
        font-size: 0.9em;
    }
</style>
@endsection

@section('content')
<div class="audio-exercise-container">
    <div class="logo-header">
        <img src="{{ asset('themes/client/assets/images/logo.png') }}" alt="AmazingYou English Zone">
    </div>
    
    <div class="back-button-container">
        <a href="{{ url()->previous() }}" class="ay-btn-back">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <h1 class="exercise-title">{{ $exercise['title'] }}</h1>
    <p class="exercise-description">{{ $exercise['instructions'] ?? 'Listen to the audio and fill in the blanks with the correct words.' }}</p>
    
    <div class="instruction">
        <i class="fas fa-info-circle"></i> Sau khi điền vào chỗ trống thì nhấn nút <strong>"Check with the script"</strong>, nó sẽ check từ nào mình điền sai
    </div>
    
    @foreach($exercise['sections'] ?? [] as $index => $section)
    <div class="question-container" id="question-{{ $index + 1 }}">
        <div class="question-number">{{ $index + 1 }}.</div>
        
        <div class="audio-player">
            <div class="audio-controls">
                <button class="control-btn" title="Rewind">
                    <i class="fas fa-backward"></i>
                </button>
                <button class="control-btn play-btn" title="Play">
                    <i class="fas fa-play-circle"></i>
                </button>
                <button class="control-btn" title="Forward">
                    <i class="fas fa-forward"></i>
                </button>
            </div>
            <div class="player-progress">
                <div class="progress-bar" role="progressbar"></div>
            </div>
            <div class="audio-time">
                <span>0:00</span>
                <span>{{ $section['audio_length'] ?? '1:30' }}</span>
            </div>
        </div>
        
        <div class="question-text">
            @php
                $parts = preg_split('/(_____)/i', $section['text']);
                $blankCount = count($parts) - 1;
            @endphp
            
            <div id="text-display-{{ $index + 1 }}">
                @foreach($parts as $i => $part)
                    {{ $part }}
                    @if($i < $blankCount)
                        <input type="text" 
                               class="input-answer" 
                               id="answer-{{ $index + 1 }}-{{ $i + 1 }}" 
                               data-correct="{{ $section['answers'][$i] ?? '' }}" 
                               placeholder="...">
                        <span class="correct-answer" style="display: none;"></span>
                    @endif
                @endforeach
            </div>
        </div>
        
        <div class="check-button-container">
            <button type="button" class="ay-btn-check" onclick="checkAnswer({{ $index + 1 }})">
                Check with the script
            </button>
        </div>
            
        <div id="script-{{ $index + 1 }}" class="script-display">
            @php
                $scriptText = $section['text'];
                foreach ($section['answers'] ?? [] as $j => $answer) {
                    $scriptText = preg_replace('/_____/', '<span class="highlight">'.$answer.'</span>', $scriptText, 1);
                }
            @endphp
            {!! $scriptText !!}
        </div>
    </div>
    @endforeach
    
    <!-- Placeholder data mẫu nếu không có dữ liệu -->
    @if(empty($exercise['sections']))
    <div class="question-container" id="question-1">
        <div class="question-number">1.</div>
        
        <div class="audio-player">
            <div class="audio-controls">
                <button class="control-btn" title="Rewind">
                    <i class="fas fa-backward"></i>
                </button>
                <button class="control-btn play-btn" title="Play">
                    <i class="fas fa-play-circle"></i>
                </button>
                <button class="control-btn" title="Forward">
                    <i class="fas fa-forward"></i>
                </button>
            </div>
            <div class="player-progress">
                <div class="progress-bar" role="progressbar"></div>
            </div>
            <div class="audio-time">
                <span>0:00</span>
                <span>1:45</span>
            </div>
        </div>
        
        <div class="question-text">
            I live in Paris, it's the capital city. It's <input type="text" class="input-answer" id="answer-1-1" data-correct="famous" placeholder="..."><span class="correct-answer" style="display: none;"></span> for its <input type="text" class="input-answer" id="answer-1-2" data-correct="landmarks" placeholder="..."><span class="correct-answer" style="display: none;"></span> such as the Eiffel Tower, Notre Dame Cathedral or the Louvre. It's also <input type="text" class="input-answer" id="answer-1-3" data-correct="well-known" placeholder="..."><span class="correct-answer" style="display: none;"></span> for its food, of course!
        </div>
        
        <div class="check-button-container">
            <button type="button" class="ay-btn-check" onclick="checkAnswer(1)">
                Check with the script
            </button>
        </div>
        
        <div id="script-1" class="script-display">
            I live in Paris, it's the capital city. It's <span class="highlight">famous</span> for its <span class="highlight">landmarks</span> such as the Eiffel Tower, Notre Dame Cathedral or the Louvre. It's also <span class="highlight">well-known</span> for its food, of course!
        </div>
    </div>
    
    <div class="question-container" id="question-2">
        <div class="question-number">2.</div>
        
        <div class="audio-player">
            <div class="audio-controls">
                <button class="control-btn" title="Rewind">
                    <i class="fas fa-backward"></i>
                </button>
                <button class="control-btn play-btn" title="Play">
                    <i class="fas fa-play-circle"></i>
                </button>
                <button class="control-btn" title="Forward">
                    <i class="fas fa-forward"></i>
                </button>
            </div>
            <div class="player-progress">
                <div class="progress-bar" role="progressbar"></div>
            </div>
            <div class="audio-time">
                <span>0:00</span>
                <span>1:30</span>
            </div>
        </div>
        
        <div class="question-text">
            <div id="text-display-2">
                I live in Shanghai. It's a 
                <input type="text" class="input-answer" id="answer-2-1" data-correct="huge" placeholder="...">, 
                <input type="text" class="input-answer" id="answer-2-2" data-correct="bustling" placeholder="...">, 
                <input type="text" class="input-answer" id="answer-2-3" data-correct="international" placeholder="..."> 
                city. People from all over the world live and work there.
            </div>
        </div>
        
        <div class="check-button-container">
            <button type="button" class="ay-btn-check" onclick="checkAnswer(2)">
                Check with the script
            </button>
        </div>
        
        <div id="script-2" class="script-display">
            I live in Shanghai. It's a <span class="highlight">huge</span>, <span class="highlight">bustling</span>, <span class="highlight">international</span> city. People from all over the world live and work there.
        </div>
    </div>
    
    <div class="question-container" id="question-3">
        <div class="question-number">3.</div>
        
        <div class="audio-player">
            <div class="audio-controls">
                <button class="control-btn" title="Rewind">
                    <i class="fas fa-backward"></i>
                </button>
                <button class="control-btn play-btn" title="Play">
                    <i class="fas fa-play-circle"></i>
                </button>
                <button class="control-btn" title="Forward">
                    <i class="fas fa-forward"></i>
                </button>
            </div>
            <div class="player-progress">
                <div class="progress-bar" role="progressbar"></div>
            </div>
            <div class="audio-time">
                <span>0:00</span>
                <span>2:15</span>
            </div>
        </div>
        
        <div class="question-text">
            <div id="text-display-3">
                I live in a small town called Banbury. I've 
                <input type="text" class="input-answer" id="answer-3-1" data-correct="been living" placeholder="..."> 
                there for about five years, since I finished university. It's a 
                <input type="text" class="input-answer" id="answer-3-2" data-correct="pretty sleepy place" placeholder="...">, 
                to be honest.
            </div>
        </div>
        
        <div class="check-button-container">
            <button type="button" class="ay-btn-check" onclick="checkAnswer(3)">
                Check with the script
            </button>
        </div>
        
        <div id="script-3" class="script-display">
            I live in a small town called Banbury. I've <span class="highlight">been living</span> there for about five years, since I finished university. It's a <span class="highlight">pretty sleepy place</span>, to be honest.
        </div>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    function checkAnswer(questionNumber) {
        const container = document.getElementById(`question-${questionNumber}`);
        const inputs = container.querySelectorAll('.input-answer');
        const scriptDisplay = document.getElementById(`script-${questionNumber}`);
        let allCorrect = true;
        
        inputs.forEach(input => {
            const userAnswer = input.value.trim().toLowerCase();
            const correctAnswer = input.dataset.correct.toLowerCase();
            const resultSpan = input.nextElementSibling;
            
            if (userAnswer === correctAnswer) {
                input.classList.add('answer-correct');
                input.classList.remove('answer-incorrect');
                resultSpan.style.display = 'none';
            } else {
                input.classList.add('answer-incorrect');
                input.classList.remove('answer-correct');
                resultSpan.textContent = correctAnswer;
                resultSpan.style.display = 'inline';
                allCorrect = false;
            }
            
            // Disable input after checking
            input.readOnly = true;
        });
        
        // Show script with correct answers
        scriptDisplay.style.display = 'block';
    }
    
    // Xử lý audio player
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.play-btn').forEach(button => {
            button.addEventListener('click', function() {
                const audioPlayer = this.closest('.audio-player');
                const progressBar = audioPlayer.querySelector('.progress-bar');
                const playIcon = this.querySelector('i');
                
                // Toggle play/pause
                if (playIcon.classList.contains('fa-play-circle')) {
                    playIcon.classList.remove('fa-play-circle');
                    playIcon.classList.add('fa-pause-circle');
                    
                    // Giả lập progress bar
                    let width = 0;
                    const interval = setInterval(() => {
                        if (width >= 100) {
                            clearInterval(interval);
                            playIcon.classList.remove('fa-pause-circle');
                            playIcon.classList.add('fa-play-circle');
                        } else {
                            width += 0.5;
                            progressBar.style.width = width + '%';
                        }
                    }, 100);
                } else {
                    playIcon.classList.remove('fa-pause-circle');
                    playIcon.classList.add('fa-play-circle');
                }
            });
        });
    });
</script>
@endpush 