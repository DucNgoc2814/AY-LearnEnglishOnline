@php
    $dialogue = [
        [
            'speaker' => 'ROB',
            'line' => 'Hey Jenny',
            'has_blank' => false
        ],
        [
            'speaker' => 'JENNY',
            'line' => 'Oh, hi Rob. [blank] for me?',
            'answer' => 'Is that coffee',
            'vietnamese_hint' => 'Đó có phải là cà phê',
            'has_blank' => true
        ],
        [
            'speaker' => 'ROB',
            'line' => 'Yes. A double espresso.',
            'has_blank' => false
        ],
        [
            'speaker' => 'JENNY',
            'line' => 'Oh wow. Thanks. That\'s so [blank] you.',
            'answer' => 'nice of',
            'vietnamese_hint' => 'tốt bụng của',
            'has_blank' => true
        ],
        [
            'speaker' => 'ROB',
            'line' => 'No problem. [blank] meeting with Daniel?',
            'answer' => 'How\'s your',
            'vietnamese_hint' => 'Cuộc họp của bạn thế nào',
            'has_blank' => true
        ],
        [
            'speaker' => 'JENNY',
            'line' => 'Yes. Another meeting. At [blank]?',
            'answer' => '9:30',
            'vietnamese_hint' => '9:30',
            'has_blank' => true
        ],
        [
            'speaker' => 'ROB',
            'line' => 'I\'m going to the office too. I have [blank] minutes.',
            'answer' => 'twenty',
            'vietnamese_hint' => 'hai mươi',
            'has_blank' => true
        ],
        [
            'speaker' => 'JENNY',
            'line' => 'Oh really? An [blank]?',
            'answer' => 'interview',
            'vietnamese_hint' => 'cuộc phỏng vấn',
            'has_blank' => true
        ],
        [
            'speaker' => 'ROB',
            'line' => 'A theater director.',
            'has_blank' => false
        ],
        [
            'speaker' => 'JENNY',
            'line' => 'That sounds [blank] interesting.',
            'answer' => 'very',
            'vietnamese_hint' => 'rất',
            'has_blank' => true
        ]
    ];
@endphp

<div class="dialogue-practice-container">
    <div class="instructions mb-4">
        <h6 class="mb-2">Directions:</h6>
        <p>Luyện tập đọc đoạn hội thoại. Sau đó che một phần hội thoại và cố gắng nhớ lại nội dung từ trí nhớ.</p>

        <div class="controls mb-3">
            <button class="btn btn-primary btn-sm show-all">Show All</button>
            <button class="btn btn-secondary btn-sm hide-all">Hide All</button>
        </div>
    </div>

    <div class="dialogue">
        @foreach($dialogue as $line)
        <div class="dialogue-line mb-3">
            <div class="speaker {{ strtolower($line['speaker']) }}">{{ $line['speaker'] }}:</div>
            <div class="line-content">
                @if($line['has_blank'])
                    <div class="practice-line">
                        {!! str_replace('[blank]', '<span class="blank">' . ($line['vietnamese_hint'] ?? '_________') . '</span>', $line['line']) !!}
                        <div class="line-controls">
                            <button class="btn btn-primary btn-sm show-answer">s</button>
                            <button class="btn btn-secondary btn-sm hide-answer" style="display: none;">h</button>
                        </div>
                    </div>
                    <div class="answer" style="display: none;">
                        <span class="text-success">{{ $line['answer'] }}</span>
                    </div>
                @else
                    {{ $line['line'] }}
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.dialogue-practice-container {
    padding: 15px;
}

.dialogue {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
}

.dialogue-line {
    display: flex;
    gap: 15px;
}

.speaker {
    font-weight: 500;
    min-width: 80px;
}

.speaker.rob {
    color: #2c3e50;
}

.speaker.jenny {
    color: #e74c3c;
}

.line-content {
    flex-grow: 1;
}

.practice-line {
    display: flex;
    align-items: center;
    gap: 10px;
}

.blank {
    color: #6c757d;
    border-bottom: 1px solid #6c757d;
    padding: 0 5px;
}

.line-controls {
    display: inline-flex;
    gap: 5px;
}

.line-controls .btn-sm {
    padding: 0.1rem 0.5rem;
    font-size: 0.75rem;
}

.answer {
    margin-top: 5px;
    font-style: italic;
}

.controls {
    display: flex;
    gap: 10px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý hiển thị/ẩn từng đáp án
    document.querySelectorAll('.show-answer').forEach(button => {
        button.addEventListener('click', function() {
            const dialogueLine = this.closest('.dialogue-line');
            const hideButton = dialogueLine.querySelector('.hide-answer');
            const answer = dialogueLine.querySelector('.answer');

            this.style.display = 'none';
            hideButton.style.display = 'inline-block';
            answer.style.display = 'block';
        });
    });

    document.querySelectorAll('.hide-answer').forEach(button => {
        button.addEventListener('click', function() {
            const dialogueLine = this.closest('.dialogue-line');
            const showButton = dialogueLine.querySelector('.show-answer');
            const answer = dialogueLine.querySelector('.answer');

            this.style.display = 'none';
            showButton.style.display = 'inline-block';
            answer.style.display = 'none';
        });
    });

    // Xử lý hiển thị/ẩn tất cả đáp án
    document.querySelector('.show-all').addEventListener('click', function() {
        document.querySelectorAll('.answer').forEach(answer => {
            answer.style.display = 'block';
        });
        document.querySelectorAll('.show-answer').forEach(button => {
            button.style.display = 'none';
        });
        document.querySelectorAll('.hide-answer').forEach(button => {
            button.style.display = 'inline-block';
        });
    });

    document.querySelector('.hide-all').addEventListener('click', function() {
        document.querySelectorAll('.answer').forEach(answer => {
            answer.style.display = 'none';
        });
        document.querySelectorAll('.show-answer').forEach(button => {
            button.style.display = 'inline-block';
        });
        document.querySelectorAll('.hide-answer').forEach(button => {
            button.style.display = 'none';
        });
    });
});
</script>
