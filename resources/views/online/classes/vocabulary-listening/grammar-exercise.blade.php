@php
    $wordBank = [
        'fairly large', 'extremely delicious', 'really stressful', 'pretty boring',
        'somewhat expensive', 'really high', 'a bit boring'
    ];
@endphp

<div class="grammar-exercise">
    <div class="exercise-header mb-4">
        <h5 class="mb-2">
            <i class="fas fa-language me-2"></i>{{ $step['title'] }}
        </h5>
        <p class="text-muted mb-0">{{ $step['description'] }}</p>
    </div>

    <!-- Word Bank -->
    <div class="word-bank mb-4">
        <h6 class="mb-3">Từ vựng có sẵn:</h6>
        <div class="word-container" id="wordBank">
            @foreach($wordBank as $word)
                <div class="word-item" draggable="true">{{ $word }}</div>
            @endforeach
        </div>
    </div>

    <!-- Questions -->
    <div class="questions">
        @foreach($step['grammar_exercise']['questions'] as $index => $question)
            <div class="question-item mb-4" data-answer="{{ $question['answer'] }}">
                <div class="d-flex align-items-center mb-2">
                    <span class="question-number me-3">{{ $index + 1 }}</span>
                    <div class="question-text flex-grow-1">
                        {{ $question['text'] }}
                    </div>
                </div>
                <div class="answer-zone" data-index="{{ $index }}">
                    <div class="dropzone">
                        <span class="placeholder">Kéo thả câu trả lời vào đây</span>
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
        <button class="btn btn-primary" onclick="checkGrammarAnswers()">
            <i class="fas fa-check me-2"></i>Kiểm tra đáp án
        </button>
    </div>
</div>

<style>
.grammar-exercise {
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

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    padding: 10px 20px;
    font-weight: 500;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
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

function checkGrammarAnswers() {
    const questionItems = document.querySelectorAll('.question-item');
    let correctCount = 0;

    questionItems.forEach(item => {
        const dropzone = item.querySelector('.dropzone');
        const wordItem = dropzone.querySelector('.word-item');
        const correctAnswer = item.dataset.answer;
        const feedback = item.querySelector('.feedback');
        const feedbackText = feedback.querySelector('.feedback-text');

        if (wordItem && wordItem.textContent === correctAnswer) {
            correctCount++;
            feedback.querySelector('.alert').className = 'alert alert-success';
            feedbackText.textContent = 'Chính xác!';
            dropzone.style.borderColor = '#198754';
            wordItem.style.borderColor = '#198754';
            wordItem.style.backgroundColor = '#d1e7dd';
        } else {
            feedback.querySelector('.alert').className = 'alert alert-danger';
            feedbackText.textContent = `Đáp án đúng là: ${correctAnswer}`;
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
</script>
