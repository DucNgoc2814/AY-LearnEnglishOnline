@php
    $sentences = [
        [
            'words' => ['Rob', 'see', 'Jenny', 'street', 'and', 'offer', 'her', 'coffee'],
            'number' => 1
        ],
        [
            'words' => ['Jenny', 'thank', 'Rob', 'coffee'],
            'number' => 2
        ],
        [
            'words' => ['Jenny', 'have', 'other', 'meeting', 'Daniel', '9:30'],
            'number' => 3
        ],
        [
            'words' => ['Rob', 'going', 'interview', 'theater', 'director', 'twenty', 'minute'],
            'number' => 4
        ],
        [
            'words' => ['Jenny', 'accidental', 'spill', 'coffee', 'Rob', 'while', 'she', 'check', 'phone'],
            'number' => 5
        ],
        [
            'words' => ['Jenny', 'apologise', 'spill', 'coffee', 'Rob'],
            'number' => 6
        ]
    ];
@endphp

<div class="sentence-building-container">
    <div class="instructions mb-3">
        <p>Kéo và thả các từ để tạo thành câu hoàn chỉnh. Bạn có thể thay đổi dạng từ hoặc thêm từ khi cần thiết.</p>
        <p class="text-muted">
            <small>[ ] = bắt buộc, ( ) = không bắt buộc</small>
        </p>
    </div>

    @foreach($sentences as $sentence)
    <div class="sentence-item mb-4">
        <div class="sentence-header">
            <h6 class="mb-2">Sentence {{ $sentence['number'] }}</h6>

            <!-- Word Bank -->
            <div class="word-bank mb-2" id="word-bank-{{ $sentence['number'] }}">
                @foreach($sentence['words'] as $word)
                <div class="word-item" draggable="true" data-word="{{ $word }}">{{ $word }}</div>
                @endforeach
            </div>
        </div>

        <!-- Drop Zone -->
        <div class="sentence-builder mb-2">
            <div class="drop-zone" id="drop-zone-{{ $sentence['number'] }}">
                <div class="drop-zone-placeholder">Kéo từ vào đây để tạo câu</div>
            </div>
        </div>

        <div class="sentence-controls">
            <button class="btn btn-danger btn-sm clear-sentence">Clear</button>
            <button class="btn btn-primary btn-sm show-answer">Show Answer</button>
            <button class="btn btn-secondary btn-sm hide-answer" style="display: none;">Hide Answer</button>
        </div>
        <div class="answer mt-2" style="display: none;">
            <!-- Đáp án sẽ được hiển thị ở đây qua JavaScript -->
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
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    min-height: 50px;
}

.word-item {
    background-color: #fff;
    border: 1px solid #dee2e6;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: move;
    user-select: none;
    display: inline-block;
    margin: 2px;
    font-size: 14px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    transition: all 0.2s;
}

.word-item:hover {
    background-color: #e9ecef;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
}

.word-item.dragging {
    opacity: 0.5;
    background-color: #e9ecef;
}

.sentence-builder {
    margin-top: 10px;
}

.drop-zone {
    min-height: 60px;
    border: 2px dashed #dee2e6;
    border-radius: 5px;
    padding: 10px;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    align-items: center;
    background-color: #fff;
    transition: all 0.3s;
}

.drop-zone.drag-over {
    background-color: #e9ecef;
    border-color: #6c757d;
}

.drop-zone-placeholder {
    color: #6c757d;
    text-align: center;
    width: 100%;
    font-style: italic;
}

.sentence-item {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 15px;
}

.sentence-controls {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.answer {
    color: #28a745;
    font-weight: 500;
    margin-top: 10px;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 4px;
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

    // Drag and Drop functionality
    document.querySelectorAll('.word-item').forEach(word => {
        word.addEventListener('dragstart', function(e) {
            this.classList.add('dragging');
            e.dataTransfer.setData('text/plain', this.dataset.word);
        });

        word.addEventListener('dragend', function() {
            this.classList.remove('dragging');
        });
    });

    document.querySelectorAll('.drop-zone').forEach(zone => {
        zone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        });

        zone.addEventListener('dragleave', function() {
            this.classList.remove('drag-over');
        });

        zone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');

            const word = e.dataTransfer.getData('text/plain');
            const placeholder = this.querySelector('.drop-zone-placeholder');
            if (placeholder) {
                placeholder.remove();
            }

            const wordElement = document.createElement('div');
            wordElement.className = 'word-item';
            wordElement.textContent = word;
            wordElement.draggable = true;

            // Add drag functionality to the new word in drop zone
            wordElement.addEventListener('dragstart', function(e) {
                e.dataTransfer.setData('text/plain', this.textContent);
                this.classList.add('dragging');
            });

            wordElement.addEventListener('dragend', function() {
                this.classList.remove('dragging');
            });

            // Double click to remove word
            wordElement.addEventListener('dblclick', function() {
                this.remove();
                if (zone.children.length === 0) {
                    const placeholder = document.createElement('div');
                    placeholder.className = 'drop-zone-placeholder';
                    placeholder.textContent = 'Kéo từ vào đây để tạo câu';
                    zone.appendChild(placeholder);
                }
            });

            this.appendChild(wordElement);
        });
    });

    // Show/Hide Answer functionality
    document.querySelectorAll('.show-answer').forEach(button => {
        button.addEventListener('click', function() {
            const sentenceItem = this.closest('.sentence-item');
            const sentenceNumber = sentenceItem.querySelector('h6').textContent.match(/\d+/)[0];
            const answerDiv = sentenceItem.querySelector('.answer');
            const hideButton = sentenceItem.querySelector('.hide-answer');

            answerDiv.textContent = answers[sentenceNumber];
            answerDiv.style.display = 'block';
            this.style.display = 'none';
            hideButton.style.display = 'inline-block';
        });
    });

    document.querySelectorAll('.hide-answer').forEach(button => {
        button.addEventListener('click', function() {
            const sentenceItem = this.closest('.sentence-item');
            const answerDiv = sentenceItem.querySelector('.answer');
            const showButton = sentenceItem.querySelector('.show-answer');

            answerDiv.style.display = 'none';
            this.style.display = 'none';
            showButton.style.display = 'inline-block';
        });
    });

    // Clear sentence functionality
    document.querySelectorAll('.clear-sentence').forEach(button => {
        button.addEventListener('click', function() {
            const sentenceItem = this.closest('.sentence-item');
            const dropZone = sentenceItem.querySelector('.drop-zone');

            dropZone.innerHTML = '<div class="drop-zone-placeholder">Kéo từ vào đây để tạo câu</div>';
        });
    });
});
</script>
