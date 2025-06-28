@php
    $sentences = [
        [
            'words' => 'Rob / see / Jenny / street / and / offer / her / coffee',
            'number' => 1
        ],
        [
            'words' => 'Jenny / thank / Rob / coffee',
            'number' => 2
        ],
        [
            'words' => 'Jenny / have / other / meeting / Daniel / 9:30',
            'number' => 3
        ],
        [
            'words' => 'Rob / going / interview / theater / director / twenty / minute',
            'number' => 4
        ],
        [
            'words' => 'Jenny / accidental / spill / coffee / Rob / while / she / check / phone',
            'number' => 5
        ],
        [
            'words' => 'Jenny / apologise / spill / coffee / Rob',
            'number' => 6
        ]
    ];
@endphp

<div class="sentence-building-container">
    <div class="instructions mb-3">
        <p>Viết câu về video clip sử dụng các từ cho sẵn. Bạn có thể thay đổi dạng từ hoặc thêm từ, nhưng không được thay đổi thứ tự từ.</p>
        <p class="text-muted">
            <small>[ ] = bắt buộc, ( ) = không bắt buộc</small>
        </p>
    </div>

    @foreach($sentences as $sentence)
    <div class="sentence-item mb-4">
        <div class="sentence-header">
            <h6 class="mb-2">Sentence {{ $sentence['number'] }}</h6>
            <div class="word-bank mb-2">
                {{ $sentence['words'] }}
            </div>
        </div>
        <div class="sentence-input">
            <input type="text" class="form-control mb-2" placeholder="Nhập câu của bạn...">
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm show-answer">Show</button>
                <button class="btn btn-secondary btn-sm hide-answer" style="display: none;">Hide</button>
            </div>
            <div class="answer mt-2" style="display: none;">
                <!-- Đáp án sẽ được hiển thị ở đây qua JavaScript -->
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
.sentence-building-container {
    padding: 15px;
}

.word-bank {
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    font-family: monospace;
}

.sentence-item {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 15px;
}

.answer {
    color: #28a745;
    font-weight: 500;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const answers = {
        1: "Rob sees Jenny on the street and offers her coffee",
        2: "Jenny thanks Rob for the coffee",
        3: "Jenny has another meeting with Daniel at 9:30",
        4: "Rob is going to interview the theater director for twenty minutes",
        5: "Jenny accidentally spills coffee on Rob while she checks her phone",
        6: "Jenny apologises for spilling coffee on Rob"
    };

    document.querySelectorAll('.show-answer').forEach(button => {
        button.addEventListener('click', function() {
            const sentenceItem = this.closest('.sentence-item');
            const sentenceNumber = sentenceItem.querySelector('h6').textContent.match(/\d+/)[0];
            const answerDiv = sentenceItem.querySelector('.answer');
            const hideButton = sentenceItem.querySelector('.hide-answer');

            answerDiv.textContent = answers[sentenceNumber];
            answerDiv.style.display = 'block';
            this.style.display = 'none';
            hideButton.style.display = 'block';
        });
    });

    document.querySelectorAll('.hide-answer').forEach(button => {
        button.addEventListener('click', function() {
            const sentenceItem = this.closest('.sentence-item');
            const answerDiv = sentenceItem.querySelector('.answer');
            const showButton = sentenceItem.querySelector('.show-answer');

            answerDiv.style.display = 'none';
            this.style.display = 'none';
            showButton.style.display = 'block';
        });
    });
});
</script>
