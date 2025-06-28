@php
    $exercises = [
        [
            'number' => 1,
            'time' => '9:00 a.m.',
            'answers' => [
                'It is nine (o\'clock) (in the morning).',
                'It is nine a.m.'
            ]
        ],
        [
            'number' => 2,
            'time' => '3:00 p.m.',
            'answers' => [
                'It is three (o\'clock) in the afternoon.',
                'It is three p.m.'
            ]
        ],
        [
            'number' => 3,
            'time' => '12:00 a.m.',
            'answers' => [
                'It is twelve (o\'clock) midnight.',
                'It is twelve a.m.'
            ]
        ],
        [
            'number' => 4,
            'time' => '12:00 p.m.',
            'answers' => [
                'It is twelve (o\'clock) noon.',
                'It is twelve p.m.'
            ]
        ],
        [
            'number' => 5,
            'time' => '3:05 p.m.',
            'answers' => [
                'It is three oh five p.m.',
                'It is five past three in the afternoon.',
                'It is three oh five in the afternoon.'
            ]
        ],
        [
            'number' => 6,
            'time' => '7:15 p.m.',
            'answers' => [
                'It is seven fifteen in the evening.',
                'It is quarter past seven in the evening.',
                'It is seven fifteen p.m.',
                'It is quarter past seven p.m.'
            ]
        ],
        [
            'number' => 7,
            'time' => '10:30 p.m.',
            'answers' => [
                'It is ten thirty at night.',
                'It is half past ten at night.',
                'It is ten thirty p.m.',
                'It is half past ten p.m.'
            ]
        ],
        [
            'number' => 8,
            'time' => '6:20 a.m.',
            'answers' => [
                'It is six twenty in the morning.',
                'It is twenty past six in the morning.',
                'It is six twenty a.m.',
                'It is twenty past six a.m.'
            ]
        ]
    ];
@endphp

<div class="grammar-check-container">
    <div class="instructions mb-4">
        <h6 class="mb-2">Directions:</h6>
        <p>Say these times. Click "Show" to check your answer.</p>
    </div>

    <div class="exercises">
        @foreach($exercises as $exercise)
        <div class="exercise-item mb-4">
            <div class="d-flex align-items-center mb-2">
                <span class="exercise-number me-2">{{ $exercise['number'] }}.</span>
                <span class="time-text">{{ $exercise['time'] }}</span>
            </div>

            <div class="answer-controls">
                <button class="btn btn-primary btn-sm show-answer">Show</button>
                <button class="btn btn-secondary btn-sm hide-answer" style="display: none;">Hide</button>
            </div>

            <div class="answers mt-2" style="display: none;">
                @foreach($exercise['answers'] as $answer)
                <div class="answer-item text-success">{{ $answer }}</div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.grammar-check-container {
    padding: 15px;
}

.exercise-item {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
}

.exercise-number {
    font-weight: 500;
    color: #2c3e50;
}

.time-text {
    font-weight: 500;
    color: #2c3e50;
}

.answer-item {
    margin: 5px 0;
    padding: 5px 10px;
    background-color: #fff;
    border-radius: 4px;
}

.btn-sm {
    padding: 0.25rem 0.75rem;
}

.instructions {
    color: #2c3e50;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý hiển thị/ẩn đáp án
    document.querySelectorAll('.show-answer').forEach(button => {
        button.addEventListener('click', function() {
            const exerciseItem = this.closest('.exercise-item');
            const hideButton = exerciseItem.querySelector('.hide-answer');
            const answers = exerciseItem.querySelector('.answers');

            this.style.display = 'none';
            hideButton.style.display = 'inline-block';
            answers.style.display = 'block';
        });
    });

    document.querySelectorAll('.hide-answer').forEach(button => {
        button.addEventListener('click', function() {
            const exerciseItem = this.closest('.exercise-item');
            const showButton = exerciseItem.querySelector('.show-answer');
            const answers = exerciseItem.querySelector('.answers');

            this.style.display = 'none';
            showButton.style.display = 'inline-block';
            answers.style.display = 'none';
        });
    });
});
</script>
