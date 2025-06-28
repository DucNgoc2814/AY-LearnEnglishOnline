@php
    $questions = [
        [
            'number' => 1,
            'words' => 'what / time / you / usually / get / up / ?',
            'question' => 'What time do you usually get up?',
            'example_answer' => 'I usually get up at ...',
            'hint' => 'Use the time expressions you learned to answer this question.'
        ],
        [
            'number' => 2,
            'words' => 'what / time / you / get / up / today / ?',
            'question' => 'What time did you get up today?',
            'example_answer' => 'I got up at ... today.',
            'hint' => 'Use past tense and specific time.'
        ],
        [
            'number' => 3,
            'words' => 'when / you / usually / go / bed / ?',
            'question' => 'When do you usually go to bed?',
            'example_answer' => 'I usually go to bed at ...',
            'hint' => 'Use time expressions for evening/night.'
        ],
        [
            'number' => 4,
            'words' => 'what / time / you / go / bed / tonight / ?',
            'question' => 'What time will you go to bed tonight?',
            'example_answer' => 'I will go to bed at ... tonight.',
            'hint' => 'Use future time expression.'
        ],
        [
            'number' => 5,
            'words' => 'when / you / usually / eat / dinner / ?',
            'question' => 'When do you usually eat dinner?',
            'example_answer' => 'I usually eat dinner at ...',
            'hint' => 'Use time expressions for evening.'
        ],
        [
            'number' => 6,
            'words' => 'when / you / usually / do / homework?',
            'question' => 'When do you usually do homework?',
            'example_answer' => 'I usually do homework at ...',
            'hint' => 'Use specific time or general time of day.'
        ],
        [
            'number' => 7,
            'words' => 'what / time / this / class / start / ?',
            'question' => 'What time does this class start?',
            'example_answer' => 'This class starts at ...',
            'hint' => 'Use present simple and specific time.'
        ],
        [
            'number' => 8,
            'words' => 'what / best / time / start / work / ?',
            'question' => 'What is the best time to start work?',
            'example_answer' => 'The best time to start work is ...',
            'hint' => 'Give your opinion about ideal work time.'
        ]
    ];
@endphp

<div class="discussion-container">
    <div class="instructions mb-4">
        <h6 class="mb-2">Directions:</h6>
        <p>Hãy thảo luận với bạn của bạn những câu hỏi sau. Bạn có thể thay đổi dạng từ hoặc thêm từ, nhưng không được thay đổi thứ tự từ.</p>
    </div>

    <div class="questions">
        @foreach($questions as $question)
        <div class="question-item mb-4">
            <div class="question-header mb-2">
                <strong class="question-number">Q{{ $question['number'] }}</strong>
                <span class="word-bank">| {{ $question['words'] }}</span>
            </div>

            <div class="question-content">
                <div class="controls mb-2">
                    <button class="btn btn-primary btn-sm show-question">Question</button>
                    <button class="btn btn-secondary btn-sm hide-question" style="display: none;">Hide</button>
                    <button class="btn btn-success btn-sm show-answer ms-2">Answer</button>
                    <button class="btn btn-secondary btn-sm hide-answer" style="display: none;">Hide</button>
                </div>

                <div class="question-text mt-2" style="display: none;">
                    {{ $question['question'] }}
                </div>

                <div class="answer-example mt-2" style="display: none;">
                    <div class="example-text text-success">
                        {{ $question['example_answer'] }}
                    </div>
                    <div class="hint text-muted mt-1">
                        <small><i class="fas fa-lightbulb me-1"></i>{{ $question['hint'] }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.discussion-container {
    padding: 15px;
}

.question-item {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
}

.question-number {
    color: #2c3e50;
}

.word-bank {
    color: #6c757d;
    font-family: monospace;
}

.question-text {
    color: #2c3e50;
    font-weight: 500;
    padding: 10px;
    background-color: #fff;
    border-radius: 4px;
}

.example-text {
    padding: 10px;
    background-color: #fff;
    border-radius: 4px;
}

.btn-sm {
    padding: 0.25rem 0.75rem;
}

.hint {
    font-size: 0.9em;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý hiển thị/ẩn câu hỏi
    document.querySelectorAll('.show-question').forEach(button => {
        button.addEventListener('click', function() {
            const questionItem = this.closest('.question-item');
            const hideButton = questionItem.querySelector('.hide-question');
            const questionText = questionItem.querySelector('.question-text');

            this.style.display = 'none';
            hideButton.style.display = 'inline-block';
            questionText.style.display = 'block';
        });
    });

    document.querySelectorAll('.hide-question').forEach(button => {
        button.addEventListener('click', function() {
            const questionItem = this.closest('.question-item');
            const showButton = questionItem.querySelector('.show-question');
            const questionText = questionItem.querySelector('.question-text');

            this.style.display = 'none';
            showButton.style.display = 'inline-block';
            questionText.style.display = 'none';
        });
    });

    // Xử lý hiển thị/ẩn đáp án mẫu
    document.querySelectorAll('.show-answer').forEach(button => {
        button.addEventListener('click', function() {
            const questionItem = this.closest('.question-item');
            const hideButton = questionItem.querySelector('.hide-answer');
            const answerExample = questionItem.querySelector('.answer-example');

            this.style.display = 'none';
            hideButton.style.display = 'inline-block';
            answerExample.style.display = 'block';
        });
    });

    document.querySelectorAll('.hide-answer').forEach(button => {
        button.addEventListener('click', function() {
            const questionItem = this.closest('.question-item');
            const showButton = questionItem.querySelector('.show-answer');
            const answerExample = questionItem.querySelector('.answer-example');

            this.style.display = 'none';
            showButton.style.display = 'inline-block';
            answerExample.style.display = 'none';
        });
    });
});
</script>
