<!-- Listening & Reading Test Section -->
<div class="test-section">
    <!-- Timer Section -->
    <div class="timer-section bg-white p-4 rounded-lg shadow-sm mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-clock text-primary me-2"></i>
                <h6 class="m-0">Thời gian còn lại: <span id="countdown" class="text-primary font-weight-bold">10:00</span></h6>
            </div>
            <div class="progress" style="width: 200px; height: 8px; background-color: #e9ecef; border-radius: 4px;">
                <div id="timer-progress" class="progress-bar bg-primary" role="progressbar" style="width: 100%; border-radius: 4px;"></div>
            </div>
        </div>
    </div>

    <!-- Questions List -->
    <div class="questions-container">
        <!-- Question 1: Single Choice with Image -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="1">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                             style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            1
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 1:</span>
                            <h6 class="m-0">Single Choice Question</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-tasks me-1"></i>Single Choice</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="media-content mb-4">
                    <img src="https://via.placeholder.com/600x400" alt="Question Image" class="img-fluid rounded shadow-sm">
                </div>

                <div class="question-text mb-4">
                    <h6 class="font-weight-bold text-dark">Look at the picture and choose the correct answer: What is the main activity shown in the image?</h6>
                </div>

                <div class="answer-section">
                    <div class="single-choice">
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q1_option1" name="question1" class="custom-control-input" value="1">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q1_option1">
                                <span class="option-letter">A.</span> A group of students studying in a library
                            </label>
                        </div>
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q1_option2" name="question1" class="custom-control-input" value="2">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q1_option2">
                                <span class="option-letter">B.</span> People having a business meeting
                            </label>
                        </div>
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q1_option3" name="question1" class="custom-control-input" value="3">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q1_option3">
                                <span class="option-letter">C.</span> Children playing in a park
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 2: Multiple Choice with Audio -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="2">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                             style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            2
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 2:</span>
                            <h6 class="m-0">Multiple Choice Question</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-tasks me-1"></i>Multiple Choice</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="media-content mb-4">
                    <div class="audio-player bg-light p-3 rounded">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-headphones text-primary me-3"></i>
                            <audio controls class="flex-grow-1">
                                <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                </div>

                <div class="question-text mb-4">
                    <h6 class="font-weight-bold text-dark">Listen to the audio and select ALL the topics mentioned in the conversation:</h6>
                </div>

                <div class="answer-section">
                    <div class="multiple-choice">
                        <div class="custom-control custom-checkbox hover-effect mb-3">
                            <input type="checkbox" id="q2_option1" name="question2[]" class="custom-control-input" value="1">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q2_option1">
                                <span class="option-letter">A.</span> Weather forecast
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox hover-effect mb-3">
                            <input type="checkbox" id="q2_option2" name="question2[]" class="custom-control-input" value="2">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q2_option2">
                                <span class="option-letter">B.</span> Weekend plans
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox hover-effect mb-3">
                            <input type="checkbox" id="q2_option3" name="question2[]" class="custom-control-input" value="3">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q2_option3">
                                <span class="option-letter">C.</span> Family dinner
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 3: Fill in the blank with Video -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="3">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                             style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            3
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 3:</span>
                            <h6 class="m-0">Fill in the Blank Question</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-tasks me-1"></i>Fill in the Blank</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="media-content mb-4">
                    <div class="video-player rounded overflow-hidden shadow-sm">
                        <video controls class="w-100">
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                            Your browser does not support the video element.
                        </video>
                    </div>
                </div>

                <div class="question-text mb-4">
                    <h6 class="font-weight-bold text-dark">Watch the video and complete the sentence:</h6>
                    <p class="mt-3 text-muted">The main character in the video is trying to _________.</p>
                </div>

                <div class="answer-section">
                    <div class="fill-blank">
                        <input type="text" class="form-control form-control-lg" name="question3" placeholder="Type your answer here">
                    </div>
                </div>
            </div>
        </div>

        <!-- Question 4: Reading Comprehension -->
        <div class="question-card bg-white p-0 rounded-lg shadow-sm mb-4 overflow-hidden" data-question-id="4">
            <div class="question-header bg-primary text-white p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="question-number-circle me-3 bg-white text-primary d-flex align-items-center justify-content-center"
                             style="width: 35px; height: 35px; border-radius: 50%; font-weight: bold;">
                            4
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-2">Câu 4:</span>
                            <h6 class="m-0">Reading Comprehension</h6>
                        </div>
                    </div>
                    <div class="question-type-badge bg-white text-primary px-3 py-1 rounded-pill">
                        <small><i class="fas fa-tasks me-1"></i>Reading Comprehension</small>
                    </div>
                </div>
            </div>

            <div class="question-content p-4">
                <div class="question-text mb-4">
                    <h6 class="font-weight-bold text-dark mb-3">Read the passage and answer the question:</h6>
                    <div class="reading-passage p-4 bg-light rounded mb-4" style="border-left: 4px solid #0d6efd;">
                        <p class="mb-0">The Industrial Revolution was a period of major industrialization and innovation during the late 18th and early 19th century. The Industrial Revolution began in Great Britain and quickly spread throughout Europe and the United States. This era changed the way people worked, lived, and thought about society.</p>
                    </div>
                    <p class="mt-3 text-dark">According to the passage, where did the Industrial Revolution begin?</p>
                </div>

                <div class="answer-section">
                    <div class="single-choice">
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q4_option1" name="question4" class="custom-control-input" value="1">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q4_option1">
                                <span class="option-letter">A.</span> United States
                            </label>
                        </div>
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q4_option2" name="question4" class="custom-control-input" value="2">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q4_option2">
                                <span class="option-letter">B.</span> Great Britain
                            </label>
                        </div>
                        <div class="custom-control custom-radio hover-effect mb-3">
                            <input type="radio" id="q4_option3" name="question4" class="custom-control-input" value="3">
                            <label class="custom-control-label py-2 px-3 rounded w-100" for="q4_option3">
                                <span class="option-letter">C.</span> Europe
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="test-navigation d-flex justify-content-between align-items-center mt-4 bg-white p-3 rounded-lg shadow-sm">
        <button class="btn btn-outline-primary px-4" id="prevQuestion">
            <i class="fas fa-chevron-left me-2"></i>Câu hỏi trước
        </button>
        <div class="question-indicators">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary active" style="min-width: 45px;">1</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">2</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">3</button>
                <button type="button" class="btn btn-outline-primary" style="min-width: 45px;">4</button>
            </div>
        </div>
        <button class="btn btn-outline-primary px-4" id="nextQuestion">
            Câu hỏi tiếp theo<i class="fas fa-chevron-right ms-2"></i>
        </button>
    </div>

    <!-- Submit Button -->
    <div class="text-center mt-4">
        <button class="btn btn-primary btn-lg px-5" id="submitTest">
            <i class="fas fa-paper-plane me-2"></i>Nộp bài
        </button>
    </div>
</div>

@push('styles')
<style>
.question-card {
    transition: all 0.3s ease;
}

.question-header {
    background: linear-gradient(90deg, #0d6efd, #0dcaf0);
}

.hover-effect {
    transition: all 0.2s ease;
}

.hover-effect:hover {
    transform: translateX(5px);
}

.custom-control-label {
    cursor: pointer;
    border: 1px solid #dee2e6;
    transition: all 0.2s ease;
}

.custom-control-input:checked ~ .custom-control-label {
    background-color: #e7f1ff;
    border-color: #0d6efd;
}

.custom-control-label:hover {
    background-color: #f8f9fa;
}

.option-letter {
    font-weight: bold;
    color: #0d6efd;
    margin-right: 10px;
}

.btn-outline-primary {
    border-width: 2px;
}

.btn-outline-primary:hover {
    transform: translateY(-1px);
}

.progress {
    overflow: hidden;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
}

.progress-bar {
    transition: width 1s linear;
}

.audio-player audio {
    height: 40px;
}

.audio-player audio::-webkit-media-controls-panel {
    background-color: white;
}

.reading-passage {
    line-height: 1.8;
    color: #495057;
}

.form-control-lg {
    border: 2px solid #dee2e6;
    transition: all 0.2s ease;
}

.form-control-lg:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.btn-group .btn {
    border-width: 2px;
    font-weight: 500;
}

.btn-group .btn.active {
    background-color: #0d6efd;
    color: white;
}

/* Animation for question transitions */
.question-card {
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.question-type-badge {
    font-weight: 500;
    font-size: 0.875rem;
}

.question-number-circle {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    font-size: 1.1rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Timer functionality
    let timeLeft = 600; // 10 minutes in seconds
    const countdownElement = document.getElementById('countdown');
    const timerProgress = document.getElementById('timer-progress');

    const timer = setInterval(() => {
        timeLeft--;
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        countdownElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        const progressPercentage = (timeLeft / 600) * 100;
        timerProgress.style.width = `${progressPercentage}%`;

        if (timeLeft <= 0) {
            clearInterval(timer);
            submitTest();
        }
    }, 1000);

    // Question navigation
    const questions = document.querySelectorAll('.question-card');
    const indicators = document.querySelectorAll('.question-indicators button');
    let currentQuestion = 0;

    function showQuestion(index) {
        questions.forEach((q, i) => {
            q.style.display = i === index ? 'block' : 'none';
        });
        indicators.forEach((ind, i) => {
            ind.classList.toggle('active', i === index);
        });

        // Update navigation buttons
        document.getElementById('prevQuestion').disabled = index === 0;
        document.getElementById('nextQuestion').disabled = index === questions.length - 1;
    }

    // Initialize first question
    showQuestion(0);

    // Navigation button handlers
    document.getElementById('prevQuestion').addEventListener('click', () => {
        if (currentQuestion > 0) {
            currentQuestion--;
            showQuestion(currentQuestion);
        }
    });

    document.getElementById('nextQuestion').addEventListener('click', () => {
        if (currentQuestion < questions.length - 1) {
            currentQuestion++;
            showQuestion(currentQuestion);
        }
    });

    // Indicator button handlers
    indicators.forEach((button, index) => {
        button.addEventListener('click', () => {
            currentQuestion = index;
            showQuestion(currentQuestion);
        });
    });

    // Submit test function
    const submitTest = () => {
        const answers = {};
        questions.forEach(question => {
            const questionId = question.dataset.questionId;
            const inputs = question.querySelectorAll('input');

            if (inputs[0].type === 'radio') {
                const checked = question.querySelector('input:checked');
                answers[questionId] = checked ? checked.value : null;
            } else if (inputs[0].type === 'checkbox') {
                answers[questionId] = Array.from(question.querySelectorAll('input:checked')).map(cb => cb.value);
            } else {
                answers[questionId] = inputs[0].value;
            }
        });
    };

    document.getElementById('submitTest').addEventListener('click', submitTest);
});
</script>
@endpush
