@php
    // Word Bank sẽ được truyền từ controller
    $wordBank = $step['short_u_exercise']['word_bank'] ?? [
        'love', 'much', 'lunch', 'happy', 'honey',
        'don\'t', 'cup', 'sun', 'fun', 'run'
    ];
    $message = $step['short_u_exercise']['message'] ?? null;
    $exerciseId = $step['short_u_exercise']['exercise_id'] ?? null;
@endphp

<div class="short-u-exercise" data-exercise-id="{{ $exerciseId }}">
    <div class="exercise-header mb-4">
        <h5 class="mb-2">
            <i class="fas fa-volume-up me-2"></i>Practice 4: Short /ʌ/ Sound
        </h5>
        <p class="text-muted mb-0">Hãy kéo những từ có âm /ʌ/ vào ô trống tương ứng với từ được cho.</p>
    </div>

    @if ($message)
        <div class="alert alert-{{ $message['type'] }} mb-4">
            <i class="fas fa-info-circle me-2"></i>{{ $message['message'] }}
        </div>
    @else
        <!-- Word Bank -->
        <div class="word-bank mb-4">
            <h6 class="mb-3">Từ vựng có sẵn:</h6>
            <div class="word-container" id="wordBank">
                @foreach ($wordBank as $word)
                    <div class="word-item" draggable="true">{{ $word }}</div>
                @endforeach
            </div>
        </div>

        <!-- Questions -->
        <div class="questions">
            @foreach ($step['short_u_exercise']['questions'] as $index => $question)
                <div class="question-item mb-4"
                    data-answer="{{ $question['correct_word'] }}"
                    data-target="{{ $question['target_word'] }}"
                    class="question-item mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <span class="question-number me-3">{{ $index + 1 }}</span>
                        <div class="question-text flex-grow-1">
                            {{-- <span class="target-word">{{ $question['target_word'] }}</span> --}}
                            <span class="phonetic ms-2">[{{ $question['phonetic'] }}]</span>
                        </div>
                    </div>
                    <div class="answer-zone" data-index="{{ $index }}">
                        <div class="dropzone">
                            <span class="placeholder">Kéo thả từ có âm /ʌ/ vào đây</span>
                        </div>
                    </div>
                    <div class="feedback mt-2" style="display: none;">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            <span class="feedback-text"></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Check Answer Button -->
        <div class="text-center mt-4">
            <button class="btn btn-primary me-2" onclick="checkShortUAnswers()">
                <i class="fas fa-check me-2"></i>Kiểm tra đáp án
            </button>
            <button class="btn btn-success" onclick="saveShortUProgress()">
                <i class="fas fa-save me-2"></i>Lưu tiến độ
            </button>
        </div>
    @endif
</div>

<style>
    .short-u-exercise {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .exercise-header {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
    }

    .word-bank {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
    }

    .word-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .word-item {
        background-color: #e9ecef;
        border: 2px solid #dee2e6;
        border-radius: 4px;
        padding: 8px 16px;
        cursor: move;
        user-select: none;
        transition: all 0.2s ease;
    }

    .word-item:hover {
        background-color: #dee2e6;
        transform: translateY(-2px);
    }

    .word-item.dragging {
        opacity: 0.5;
        background-color: #b8daff;
    }

    .question-item {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
    }

    .question-number {
        background-color: #0d6efd;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .dropzone {
        border: 2px dashed #dee2e6;
        border-radius: 4px;
        padding: 10px;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        transition: all 0.2s ease;
    }

    .dropzone.dragover {
        border-color: #0d6efd;
        background-color: #e9ecef;
    }

    .dropzone .placeholder {
        color: #6c757d;
        font-style: italic;
    }

    .dropzone .word-item {
        margin: 0;
        background-color: #fff;
        border-color: #0d6efd;
    }

    .feedback {
        margin-top: 10px;
    }

    .feedback .alert {
        margin-bottom: 0;
        padding: 10px 15px;
    }

    .target-word {
        color: #dc3545;
        font-weight: bold;
        background-color: #ffe5e8;
        padding: 2px 6px;
        border-radius: 4px;
        display: inline-block;
        margin: 0 2px;
    }

    .phonetic {
        color: #6c757d;
        font-style: italic;
    }

    .question-text {
        font-size: 1.1rem;
        line-height: 1.5;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wordItems = document.querySelectorAll('.word-item');
        const dropzones = document.querySelectorAll('.dropzone');

        wordItems.forEach(word => {
            word.addEventListener('dragstart', function(e) {
                e.dataTransfer.setData('text/plain', e.target.textContent);
                this.classList.add('dragging');
            });

            word.addEventListener('dragend', function() {
                this.classList.remove('dragging');
            });
        });

        dropzones.forEach(dropzone => {
            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            dropzone.addEventListener('dragleave', function() {
                this.classList.remove('dragover');
            });

            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');

                const word = e.dataTransfer.getData('text/plain');
                const wordItem = document.createElement('div');
                wordItem.className = 'word-item';
                wordItem.textContent = word;
                wordItem.draggable = true;

                // Clear placeholder if exists
                const placeholder = this.querySelector('.placeholder');
                if (placeholder) {
                    placeholder.remove();
                }

                // Remove existing word if any
                const existingWord = this.querySelector('.word-item');
                if (existingWord) {
                    existingWord.remove();
                }

                this.appendChild(wordItem);

                // Add drag functionality to the new word item
                wordItem.addEventListener('dragstart', function(e) {
                    e.dataTransfer.setData('text/plain', e.target.textContent);
                    this.classList.add('dragging');
                });

                wordItem.addEventListener('dragend', function() {
                    this.classList.remove('dragging');
                });
            });
        });
    });

    function checkShortUAnswers() {
        const questionItems = document.querySelectorAll('.question-item');
        let correctCount = 0;

        questionItems.forEach(item => {
            const dropzone = item.querySelector('.dropzone');
            const wordItem = dropzone.querySelector('.word-item');
            const correctAnswer = item.dataset.answer;
            const targetWord = item.dataset.target;
            const feedback = item.querySelector('.feedback');
            const feedbackText = feedback.querySelector('.feedback-text');

            if (wordItem && wordItem.textContent === correctAnswer) {
                correctCount++;
                feedback.querySelector('.alert').className = 'alert alert-success';
                feedbackText.textContent = `Chính xác! "${targetWord}" có âm /ʌ/ giống như "${correctAnswer}"`;
                dropzone.style.borderColor = '#198754';
                wordItem.style.borderColor = '#198754';
                wordItem.style.backgroundColor = '#d1e7dd';
            } else {
                feedback.querySelector('.alert').className = 'alert alert-danger';
                feedbackText.textContent = `Chưa đúng. Từ có âm /ʌ/ tương ứng với "${targetWord}" là "${correctAnswer}"`;
                dropzone.style.borderColor = '#dc3545';
                if (wordItem) {
                    wordItem.style.borderColor = '#dc3545';
                    wordItem.style.backgroundColor = '#f8d7da';
                }
            }

            feedback.style.display = 'block';
        });

        // Show overall result
        Swal.fire({
            title: `Kết quả: ${correctCount}/${questionItems.length}`,
            text: `Bạn đã trả lời đúng ${correctCount} câu trên tổng số ${questionItems.length} câu.`,
            icon: correctCount === questionItems.length ? 'success' : 'info',
            confirmButtonText: 'OK'
        });
    }

    function saveShortUProgress() {
        const questionItems = document.querySelectorAll('.question-item');
        const completedItems = [];
        let correctCount = 0;

        questionItems.forEach((item, index) => {
            const dropzone = item.querySelector('.dropzone');
            const wordItem = dropzone.querySelector('.word-item');
            const correctAnswer = item.dataset.answer;

            if (wordItem && wordItem.textContent === correctAnswer) {
                correctCount++;
                completedItems.push({
                    index: index,
                    answer: wordItem.textContent,
                    is_correct: true
                });
            } else if (wordItem) {
                completedItems.push({
                    index: index,
                    answer: wordItem.textContent,
                    is_correct: false
                });
            }
        });

        const progress = (completedItems.length / questionItems.length) * 100;
        const score = (correctCount / questionItems.length) * 100;

        // Lấy exercise_id từ data attribute của container
        const exerciseId = document.querySelector('.short-u-exercise').dataset.exerciseId;

        // Gọi API lưu tiến độ
        fetch('/online/classes/vocabulary-listening/short-u/save-progress', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                exercise_id: exerciseId,
                progress: progress,
                score: score,
                completed_items: completedItems,
                current_position: completedItems.length
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Thành công!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                throw new Error(data.message);
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Lỗi!',
                text: error.message || 'Có lỗi xảy ra khi lưu tiến độ',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    }
</script>
