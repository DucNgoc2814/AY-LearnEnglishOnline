@extends('online.layouts.master')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ $title }}</h4>

                <!-- Nav tabs -->
                <div class="tabs-wrapper">
                    <ul class="nav nav-tabs mb-4" id="stepTabs" role="tablist">
                        @foreach ($steps as $index => $step)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index === 0 ? 'active' : '' }}" id="{{ $step['id'] }}-tab"
                                    data-bs-toggle="tab" data-bs-target="#{{ $step['id'] }}" type="button"
                                    role="tab">
                                    <span class="step-number">{{ $index + 1 }}</span>
                                    <span class="step-title">{{ $step['title'] }}</span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tab content -->
                <div class="tab-content" id="stepTabsContent">
                    @foreach ($steps as $index => $step)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="{{ $step['id'] }}"
                            role="tabpanel">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">{{ $step['title'] }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text mb-4">{{ $step['description'] }}</p>

                                    @switch($index)
                                        @case(0)
                                            <!-- Video Tutorial -->
                                            <div class="video-container">
                                                <div class="ratio ratio-16x9 mb-4">
                                                    @php
                                                        // Convert YouTube URL to embed URL
                                                        $videoUrl = $step['video_url'];
                                                        $videoId = '';
                                                        if (
                                                            preg_match(
                                                                '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                                                                $videoUrl,
                                                                $match,
                                                            )
                                                        ) {
                                                            $videoId = $match[1];
                                                        }
                                                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                                    @endphp
                                                    <iframe src="{{ $embedUrl }}" title="YouTube video player" frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                                <div class="text-center">
                                                    <p class="text-muted">Xem video hướng dẫn về phương pháp Active Listening</p>
                                                </div>
                                            </div>
                                        @break

                                        @case(1)
                                            <!-- Quizlet -->
                                            <div class="d-flex flex-column gap-3">
                                                <a href="{{ $step['quizlet_url'] }}" target="_blank" class="btn btn-primary">
                                                    <i class="fas fa-external-link-alt me-2"></i>Mở Quizlet
                                                </a>
                                                <a href="{{ $step['guide_url'] }}" target="_blank" class="btn btn-info">
                                                    <i class="fas fa-question-circle me-2"></i>Xem hướng dẫn sử dụng
                                                </a>

                                                <!-- Quizlet Feature Checklist -->
                                                <div class="quizlet-checklist mt-4">
                                                    <h6 class="mb-3">Đánh dấu các tính năng bạn đã hoàn thành:</h6>
                                                    <div class="d-flex gap-4 flex-wrap">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="flashcards">
                                                            <label class="form-check-label" for="flashcards">
                                                                <i class="fas fa-clone me-2"></i>Học với Flashcards
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="learn">
                                                            <label class="form-check-label" for="learn">
                                                                <i class="fas fa-graduation-cap me-2"></i>Học (Learn)
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="write">
                                                            <label class="form-check-label" for="write">
                                                                <i class="fas fa-pencil-alt me-2"></i>Viết (Write)
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="test">
                                                            <label class="form-check-label" for="test">
                                                                <i class="fas fa-tasks me-2"></i>Kiểm tra (Test)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break

                                        @case(2)
                                            <!-- Dictation -->
                                            <div class="dictation-exercise">
                                                <div class="mb-4">
                                                    <audio controls class="w-100">
                                                        <source src="/path/to/audio.mp3" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                </div>
                                                @foreach ($step['dictation_exercises'] as $audio)
                                                    <div class="mb-4">
                                                        <h5 class="mb-3">{{ $audio['title'] }}</h5>
                                                        @foreach ($audio['exercises'] as $exercise)
                                                            <div class="exercise-item mb-4"
                                                                data-answer="{{ $exercise['answer'] }}">
                                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                                    <h6 class="mb-0">{{ $exercise['id'] }}</h6>
                                                                    <button class="btn btn-sm btn-outline-primary check-script"
                                                                        onclick="checkScript(this)">
                                                                        Check with the script
                                                                    </button>
                                                                </div>
                                                                <div class="exercise-content">
                                                                    <textarea class="form-control mb-2" rows="4" placeholder="Type your answer here...">{{ $exercise['text'] }}</textarea>
                                                                    <div class="answer-feedback" style="display: none;">
                                                                        <div class="alert alert-info">
                                                                            <strong>Correct Answer:</strong>
                                                                            <p class="mb-0 mt-2" style="white-space: pre-line;">
                                                                                {{ $exercise['answer'] }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach

                                                <!-- Save Progress Button -->
                                                <div class="text-center mt-4">
                                                    <button class="btn btn-success save-dictation-progress"
                                                        onclick="saveDictationProgress()">
                                                        <i class="fas fa-save me-2"></i>Lưu tiến độ
                                                    </button>
                                                </div>
                                            </div>
                                        @break

                                        @case(3)
                                            @include('online.classes.vocabulary-listening.key-phrases')
                                        @break

                                        @case(4)
                                            <!-- Sentence Building -->
                                            <div class="sentence-building">
                                                @foreach ($step['sentences'] as $index => $sentence)
                                                    <div class="sentence-container mb-4" data-answer="{{ $sentence['answer'] }}">
                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <h6 class="mb-0">Câu {{ $index + 1 }}:</h6>
                                                            <button class="btn btn-sm btn-outline-primary check-sentence"
                                                                onclick="checkSentence(this)">
                                                                Check with the answer
                                                            </button>
                                                        </div>

                                                        <!-- Word Bank -->
                                                        <div class="word-bank mb-3" id="wordBank{{ $index }}">
                                                            @foreach ($sentence['words'] as $word)
                                                                <div class="word-item" draggable="true">{{ $word }}</div>
                                                            @endforeach
                                                        </div>

                                                        <!-- Sentence Building Area -->
                                                        <div class="sentence-area" id="sentenceArea{{ $index }}">
                                                            <div class="sentence-line"></div>
                                                        </div>

                                                        <!-- Answer Feedback -->
                                                        <div class="answer-feedback mt-3" style="display: none;">
                                                            <div class="alert alert-info">
                                                                <strong>Correct Answer:</strong>
                                                                <p class="mb-0 mt-2">{{ $sentence['answer'] }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!-- Save Progress Button -->
                                                <div class="text-center mt-4">
                                                    <button class="btn btn-success save-sentence-progress" onclick="saveSentenceProgress()">
                                                        <i class="fas fa-save me-2"></i>Lưu tiến độ
                                                    </button>
                                                </div>
                                            </div>
                                        @break

                                        @case(5)
                                            <!-- Grammar -->
                                            @include('online.classes.vocabulary-listening.grammar-exercise')
                                        @break

                                        @case(6)
                                            <!-- Transcription -->
                                            @include('online.classes.vocabulary-listening.transcription-exercise')
                                        @break

                                        @case(7)
                                            <!-- Ending Sound -->
                                            @include('online.classes.vocabulary-listening.ending-sound-exercise')
                                        @break

                                        @case(8)
                                            <!-- Listening & Reading Test -->
                                            @include('online.classes.vocabulary-listening.listening-reading-test')
                                        @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .tabs-wrapper {
                position: relative;
                overflow: hidden;
                margin-bottom: 1.5rem;
            }

            .nav-tabs {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                overflow-y: hidden;
                scrollbar-width: none;
                /* Firefox */
                -ms-overflow-style: none;
                /* IE and Edge */
                -webkit-overflow-scrolling: touch;
                padding-bottom: 2px;
                margin-bottom: 0;
                border-bottom: 1px solid #dee2e6;
            }

            .nav-tabs::-webkit-scrollbar {
                display: none;
                /* Chrome, Safari, Opera */
            }

            .nav-tabs .nav-item {
                flex: 0 0 auto;
                margin-bottom: 0;
                position: relative;
            }

            .nav-tabs .nav-link {
                white-space: nowrap;
                padding: 1rem 1.5rem;
                border: none;
                border-bottom: 2px solid transparent;
                color: #6c757d;
                transition: all 0.2s ease-in-out;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .nav-tabs .nav-link .step-number {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 24px;
                height: 24px;
                background-color: #e9ecef;
                border-radius: 50%;
                font-size: 0.875rem;
                font-weight: 500;
                color: #6c757d;
                transition: all 0.2s ease-in-out;
            }

            .nav-tabs .nav-link .step-title {
                font-weight: 500;
            }

            .nav-tabs .nav-link:hover {
                color: #0d6efd;
                border-color: #e9ecef;
            }

            .nav-tabs .nav-link:hover .step-number {
                background-color: #0d6efd;
                color: white;
            }

            .nav-tabs .nav-link.active {
                color: #0d6efd;
                border-bottom: 2px solid #0d6efd;
                font-weight: 600;
            }

            .nav-tabs .nav-link.active .step-number {
                background-color: #0d6efd;
                color: white;
            }

            /* Add gradient indicators for scroll */
            .tabs-wrapper::before,
            .tabs-wrapper::after {
                content: '';
                position: absolute;
                top: 0;
                bottom: 0;
                width: 40px;
                pointer-events: none;
                z-index: 1;
                transition: opacity 0.3s ease;
            }

            .tabs-wrapper::before {
                left: 0;
                background: linear-gradient(to right, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0));
                opacity: 0;
            }

            .tabs-wrapper::after {
                right: 0;
                background: linear-gradient(to left, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0));
                opacity: 0;
            }

            .tabs-wrapper.has-left-scroll::before {
                opacity: 1;
            }

            .tabs-wrapper.has-right-scroll::after {
                opacity: 1;
            }

            .dictation-exercise,
            .key-phrases,
            .sentence-building,
            .grammar-exercise,
            .transcription,
            .ending-sound,
            .test-section {
                min-height: 300px;
            }

            .draggable-container,
            .word-bank {
                background-color: #f8f9fa;
                border: 1px dashed #dee2e6;
                border-radius: 0.25rem;
                padding: 1rem;
                min-height: 100px;
            }

            .exercise-item {
                background-color: #f8f9fa;
                border-radius: 8px;
                padding: 1.5rem;
            }

            .exercise-item textarea {
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .exercise-item .btn-outline-primary {
                border-color: #0d6efd;
                color: #0d6efd;
            }

            .exercise-item .btn-outline-primary:hover {
                background-color: #0d6efd;
                color: white;
            }

            .answer-feedback {
                margin-top: 1rem;
            }

            .highlight-correct {
                background-color: #d4edda;
            }

            .highlight-incorrect {
                background-color: #f8d7da;
                text-decoration: line-through;
            }

            .key-phrases .table {
                margin-bottom: 0;
            }

            .key-phrases .table th {
                background-color: #f8f9fa;
                font-weight: 600;
                padding: 1rem;
            }

            .key-phrases .table td {
                padding: 1rem;
                vertical-align: middle;
            }

            .key-phrases .phrase-input {
                font-size: 1rem;
                padding: 0.5rem;
            }

            .key-phrases .answer-feedback {
                font-size: 0.95rem;
                margin-top: 0.5rem;
            }

            .key-phrases .highlight-correct {
                color: #198754;
                font-weight: 500;
            }

            .key-phrases .highlight-incorrect {
                color: #dc3545;
                text-decoration: line-through;
            }

            .sentence-container {
                background-color: #f8f9fa;
                border-radius: 8px;
                padding: 1.5rem;
            }

            .word-bank {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                min-height: 60px;
                padding: 1rem;
                background-color: #fff;
                border: 2px dashed #dee2e6;
                border-radius: 6px;
            }

            .sentence-area {
                min-height: 60px;
                padding: 1rem;
                background-color: #fff;
                border: 2px solid #0d6efd;
                border-radius: 6px;
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                align-items: center;
            }

            .word-item {
                display: inline-block;
                padding: 0.5rem 1rem;
                background-color: #e9ecef;
                border: 1px solid #ced4da;
                border-radius: 4px;
                cursor: move;
                user-select: none;
                font-size: 0.95rem;
                transition: all 0.2s ease;
            }

            .word-item:hover {
                background-color: #dee2e6;
            }

            .word-item.dragging {
                opacity: 0.5;
                background-color: #b8daff;
            }

            .sentence-line {
                position: absolute;
                bottom: 10px;
                left: 0;
                right: 0;
                height: 2px;
                background-color: #dee2e6;
                pointer-events: none;
            }

            .correct-word {
                background-color: #d4edda;
                border-color: #c3e6cb;
            }

            .incorrect-word {
                background-color: #f8d7da;
                border-color: #f5c6cb;
            }

            .highlighted-word {
                font-weight: bold;
                background-color: #fff3cd;
                color: #dc3545;
                padding: 2px 4px;
                border-radius: 4px;
            }

            .key-phrases .table td {
                font-size: 1rem;
                line-height: 1.6;
            }

            .blank-input {
                border: 2px solid #dee2e6;
                transition: all 0.2s ease-in-out;
            }

            .blank-input:focus {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            }

            .blank-input.is-valid {
                border-color: #198754;
                background-color: #d1e7dd;
            }

            .blank-input.is-invalid {
                border-color: #dc3545;
                background-color: #f8d7da;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabsWrapper = document.querySelector('.tabs-wrapper');
                const tabsNav = document.querySelector('.nav-tabs');
                const tabs = document.querySelectorAll('.nav-link');

                // Restore active tab from localStorage
                const activeTabId = localStorage.getItem('activeTab');
                if (activeTabId) {
                    const tabToActivate = document.querySelector(activeTabId);
                    if (tabToActivate) {
                        document.querySelectorAll('.nav-link').forEach(tab => {
                            tab.classList.remove('active');
                        });
                        document.querySelectorAll('.tab-pane').forEach(pane => {
                            pane.classList.remove('show', 'active');
                        });

                        tabToActivate.classList.add('active');
                        const targetPane = document.querySelector(tabToActivate.getAttribute('data-bs-target'));
                        if (targetPane) {
                            targetPane.classList.add('show', 'active');
                        }
                    }
                }

                // Save active tab to localStorage when changed
                tabs.forEach(tab => {
                    tab.addEventListener('shown.bs.tab', function(e) {
                        localStorage.setItem('activeTab', '#' + e.target.id);
                    });
                });

                // Function to update scroll indicators
                function updateScrollIndicators() {
                    const hasLeftScroll = tabsNav.scrollLeft > 0;
                    const hasRightScroll = (tabsNav.scrollWidth - tabsNav.clientWidth) > tabsNav.scrollLeft;

                    tabsWrapper.classList.toggle('has-left-scroll', hasLeftScroll);
                    tabsWrapper.classList.toggle('has-right-scroll', hasRightScroll);
                }

                // Handle mouse wheel scrolling
                tabsNav.addEventListener('wheel', function(e) {
                    if (e.deltaY !== 0) {
                        e.preventDefault();
                        tabsNav.scrollLeft += e.deltaY;
                        updateScrollIndicators();
                    }
                });

                // Handle scroll event
                tabsNav.addEventListener('scroll', function() {
                    updateScrollIndicators();
                });

                // Initial check for scroll indicators
                updateScrollIndicators();

                // Update on window resize
                window.addEventListener('resize', function() {
                    updateScrollIndicators();
                });

                // Timer functionality for test
                function startTimer(duration, display) {
                    let timer = duration,
                        minutes, seconds;
                    let countdown = setInterval(function() {
                        minutes = parseInt(timer / 60, 10);
                        seconds = parseInt(timer % 60, 10);

                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;

                        display.textContent = minutes + ":" + seconds;

                        if (--timer < 0) {
                            clearInterval(countdown);
                            display.textContent = "Hết giờ!";
                        }
                    }, 1000);
                }

                // Initialize timer when test tab is shown
                document.querySelector('#step8-tab').addEventListener('shown.bs.tab', function(e) {
                    let display = document.querySelector('#countdown');
                    startTimer(600, display); // 10 minutes = 600 seconds
                });

                const containers = document.querySelectorAll('.sentence-container');

                containers.forEach((container, containerIndex) => {
                    const wordBank = container.querySelector('.word-bank');
                    const sentenceArea = container.querySelector('.sentence-area');
                    const words = container.querySelectorAll('.word-item');

                    words.forEach(word => {
                        word.addEventListener('dragstart', () => {
                            word.classList.add('dragging');
                        });

                        word.addEventListener('dragend', () => {
                            word.classList.remove('dragging');
                        });
                    });

                    [wordBank, sentenceArea].forEach(area => {
                        area.addEventListener('dragover', e => {
                            e.preventDefault();
                            const draggable = document.querySelector('.dragging');
                            if (draggable) {
                                const afterElement = getDragAfterElement(area, e.clientX);
                                if (afterElement) {
                                    area.insertBefore(draggable, afterElement);
                                } else {
                                    area.appendChild(draggable);
                                }
                            }
                        });
                    });
                });

            });

            function getDragAfterElement(container, x) {
                const draggableElements = [...container.querySelectorAll('.word-item:not(.dragging)')];

                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = x - box.left - box.width / 2;

                    if (offset < 0 && offset > closest.offset) {
                        return {
                            offset: offset,
                            element: child
                        };
                    } else {
                        return closest;
                    }
                }, {
                    offset: Number.NEGATIVE_INFINITY
                }).element;
            }

            function checkSentence(button) {
                const container = button.closest('.sentence-container');
                const sentenceArea = container.querySelector('.sentence-area');
                const words = sentenceArea.querySelectorAll('.word-item');
                const userAnswer = Array.from(words).map(word => word.textContent).join(' ');
                const correctAnswer = container.dataset.answer;

                // Show the answer feedback
                const feedback = container.querySelector('.answer-feedback');
                feedback.style.display = 'block';

                // Check each word and highlight
                words.forEach((word, index) => {
                    const correctWords = correctAnswer.split(' ');
                    if (word.textContent === correctWords[index]) {
                        word.classList.add('correct-word');
                    } else {
                        word.classList.add('incorrect-word');
                    }
                });

                // Disable dragging and checking
                words.forEach(word => word.setAttribute('draggable', 'false'));
                button.disabled = true;
            }

            function checkScript(button) {
                const exerciseItem = button.closest('.exercise-item');
                const textarea = exerciseItem.querySelector('textarea');
                const answerFeedback = exerciseItem.querySelector('.answer-feedback');
                const correctAnswer = exerciseItem.dataset.answer;

                // Show the answer feedback
                answerFeedback.style.display = 'block';

                // Compare user input with correct answer
                const userInput = textarea.value;
                const userWords = userInput.split(/\s+/);
                const correctWords = correctAnswer.split(/\s+/);

                let highlightedText = '';
                let i = 0;

                userWords.forEach((word, index) => {
                    if (word === correctWords[i]) {
                        highlightedText += `<span class="highlight-correct">${word}</span> `;
                        i++;
                    } else if (word.includes('_')) {
                        // Skip blanks in the original text
                        highlightedText += `${word} `;
                        i++;
                    } else {
                        highlightedText += `<span class="highlight-incorrect">${word}</span> `;
                        i++;
                    }
                });

                // Update the textarea with highlighted text
                textarea.style.display = 'none';
                const highlightDiv = document.createElement('div');
                highlightDiv.innerHTML = highlightedText;
                highlightDiv.className = 'form-control mb-2';
                highlightDiv.style.minHeight = '100px';
                highlightDiv.style.whiteSpace = 'pre-line';
                textarea.parentNode.insertBefore(highlightDiv, textarea);

                // Disable the check button
                button.disabled = true;
            }

            function checkPhrases() {
                const rows = document.querySelectorAll('.phrase-row');
                let allCorrect = true;

                rows.forEach(row => {
                    const inputs = row.querySelectorAll('.blank-input');
                    let rowCorrect = true;

                    inputs.forEach(input => {
                        const userAnswer = input.value.trim().toLowerCase();
                        const correctAnswer = input.dataset.answer.toLowerCase();

                        if (userAnswer === correctAnswer) {
                            input.classList.add('is-valid');
                            input.classList.remove('is-invalid');
                        } else {
                            input.classList.add('is-invalid');
                            input.classList.remove('is-valid');
                            rowCorrect = false;
                            allCorrect = false;
                        }
                    });

                    const feedback = row.querySelector('.answer-feedback');
                    if (rowCorrect) {
                        feedback.style.display = 'block';
                        inputs.forEach(input => {
                            input.disabled = true;
                        });
                    }
                });

                if (allCorrect) {
                    document.getElementById('checkPhrases').disabled = true;
                }
            }
        </script>
    @endpush
@endsection
