@php
    $soundRules = [
        [
            'title' => 'Nhóm 1',
            'sounds' => ['/p/', '/t/', '/k/', '/f/', '/θ/'],
            'description' => 'Các âm cuối vô thanh',
            'corresponding_sound' => '/s/',
        ],
        [
            'title' => 'Nhóm 2',
            'sounds' => ['/s/', '/z/', '/ʃ/', '/ʒ/', '/tʃ/', '/dʒ/'],
            'description' => 'Các âm xát và âm tắc xát',
            'corresponding_sound' => '/ɪz/',
        ],
        [
            'title' => 'Nhóm 3',
            'sounds' => ['Other sounds'],
            'description' => 'Các âm khác',
            'corresponding_sound' => '/z/',
        ],
    ];

    $practiceWords = [
        [
            'word' => 'Class',
            'word_with_ending' => 'Classes',
            'base_phonetic' => 'klæ',
            'ending_phonetic' => 's',
            'full_phonetic' => '/klæs/',
            'full_phonetic_with_ending' => '/klæsɪz/',
        ],
        [
            'word' => 'Landmark',
            'word_with_ending' => 'Landmarks',
            'base_phonetic' => 'lænd.mɑːk',
            'ending_phonetic' => 's',
            'full_phonetic' => '/lænd.mɑːk/',
            'full_phonetic_with_ending' => '/lænd.mɑːks/',
        ],
        [
            'word' => 'Local',
            'word_with_ending' => 'Locals',
            'base_phonetic' => 'ləʊ.kəl',
            'ending_phonetic' => 'z',
            'full_phonetic' => '/ləʊ.kəl/',
            'full_phonetic_with_ending' => '/ləʊ.kəlz/',
        ],
        [
            'word' => 'Place',
            'word_with_ending' => 'Places',
            'base_phonetic' => 'pleɪ',
            'ending_phonetic' => 's',
            'full_phonetic' => '/pleɪs/',
            'full_phonetic_with_ending' => '/pleɪsɪz/',
        ],
        [
            'word' => 'Suit',
            'word_with_ending' => 'Suits',
            'base_phonetic' => 'suːt',
            'ending_phonetic' => 's',
            'full_phonetic' => '/suːt/',
            'full_phonetic_with_ending' => '/suːts/',
        ],
        [
            'word' => 'Farm',
            'word_with_ending' => 'Farms',
            'base_phonetic' => 'fɑːm',
            'ending_phonetic' => 'z',
            'full_phonetic' => '/fɑːm/',
            'full_phonetic_with_ending' => '/fɑːmz/',
        ],
    ];

    $availableEndings = ['/s/', '/ɪz/', '/z/'];
@endphp

<div class="ending-sound-exercise">
    <div class="d-flex justify-content-end mb-4">
        <a href="#" class="btn btn-info">
            <i class="fas fa-book me-2"></i>Mở từ điển Oxford
        </a>
    </div>

    <div class="exercise-header mb-4">
        <h5 class="mb-2">
            <i class="fas fa-music me-2"></i>{{ $step['title'] }}
        </h5>
        <p class="text-muted mb-0">{{ $step['description'] }}</p>
    </div>

    <!-- Sound Rules Section -->
    <div class="sound-rules mb-5">
        <div class="row mb-4">
            <!-- Sound Groups -->
            @foreach ($soundRules as $rule)
                <div class="col-md-4 mb-4">
                    <div class="rule-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="rule-title mb-0">{{ $rule['title'] }}</h6>
                            <div class="corresponding-sound">
                                <span class="sound-badge sound-badge-large">{{ $rule['corresponding_sound'] }}</span>
                            </div>
                        </div>
                        <div class="rule-sounds mb-3">
                            @if (is_array($rule['sounds']))
                                @foreach ($rule['sounds'] as $sound)
                                    <span class="sound-badge">{{ $sound }}</span>
                                @endforeach
                            @else
                                <span class="sound-badge">{{ $rule['sounds'] }}</span>
                            @endif
                        </div>
                        <p class="rule-description">{{ $rule['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Corresponding Sounds Summary -->
        <div class="corresponding-sounds-header">
            <h6 class="d-flex align-items-center">
                <span class="me-3">Âm tương ứng khi thêm "s/es":</span>
                <div class="d-flex gap-2">
                    <span class="sound-badge sound-badge-large">/s/</span>
                    <span class="sound-badge sound-badge-large">/ɪz/</span>
                    <span class="sound-badge sound-badge-large">/z/</span>
                </div>
            </h6>
        </div>
    </div>

    <!-- Practice Table -->
    <div class="practice-section">
        <!-- Sound Endings Bank -->
        <div class="endings-bank mb-4">
            <h6 class="mb-3">Các âm đuôi có sẵn:</h6>
            <div class="endings-container" id="endingsBank">
                @foreach ($availableEndings as $ending)
                    <div class="ending-item" draggable="true" data-ending="{{ $ending }}">
                        {{ $ending }}
                    </div>
                @endforeach
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 5%">STT</th>
                        <th style="width: 15%">Từ</th>
                        <th style="width: 30%">Phiên âm gốc</th>
                        <th style="width: 15%">Từ + s/es</th>
                        <th style="width: 30%">Phiên âm khi thêm "s/es"</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($practiceWords as $index => $word)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="word-text">{{ $word['word'] }}</span>
                                    <button class="btn btn-sm btn-link text-primary ms-2 listen-btn"
                                        onclick="playAudio('{{ $word['word'] }}')" title="Nghe phát âm">
                                        <i class="fas fa-volume-up"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="phonetic-container">
                                    <span class="base-phonetic">{{ $word['base_phonetic'] }}</span>
                                    <div class="ending-dropzone" data-correct="{{ $word['ending_phonetic'] }}"
                                        data-word-id="{{ $index }}">
                                        <span class="placeholder">Kéo thả âm đuôi vào đây</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="word-text with-ending">{{ $word['word_with_ending'] }}</span>
                                    <button class="btn btn-sm btn-link text-primary ms-2 listen-btn"
                                        onclick="playAudio('{{ $word['word_with_ending'] }}')" title="Nghe phát âm">
                                        <i class="fas fa-volume-up"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="phonetic-container">
                                    <span class="base-phonetic">{{ $word['base_phonetic'] }}</span>
                                    <div class="ending-dropzone-with-s"
                                        data-correct="{{ $word['full_phonetic_with_ending'] }}"
                                        data-word-id="{{ $index }}">
                                        <span class="placeholder">Kéo thả âm đuôi vào đây</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Save Progress Button -->
        <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-success btn-lg save-progress-btn" onclick="saveProgress()">
                <i class="fas fa-save me-2"></i>
                Lưu tiến độ
            </button>
        </div>
    </div>
</div>

<style>
    .ending-sound-exercise {
        background-color: #fff;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .sound-rules .row {
        margin: 0 -10px;
    }

    .sound-rules .col-md-4 {
        padding: 0 10px;
    }

    .rule-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        height: 100%;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .rule-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .rule-title {
        color: #2563eb;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .corresponding-sound {
        background-color: #e3f2fd;
        padding: 3px 6px;
        border-radius: 4px;
        border: 1px solid #90caf9;
    }

    .rule-sounds {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .sound-badge {
        background-color: #e9ecef;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 2px 6px;
        font-family: 'Arial', sans-serif;
        font-size: 0.8rem;
        transition: all 0.2s ease;
    }

    .sound-badge:hover {
        background-color: #dee2e6;
        transform: translateY(-1px);
    }

    .sound-badge-large {
        font-size: 0.9rem;
        padding: 4px 12px;
        background-color: #e3f2fd;
        border-color: #90caf9;
        color: #1976d2;
    }

    .rule-description {
        color: #6b7280;
        font-size: 0.8rem;
        margin-bottom: 0;
        margin-top: 8px;
    }

    .practice-section {
        background-color: #fff;
        border-radius: 8px;
        padding: 15px;
        border: 1px solid #dee2e6;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        vertical-align: middle;
        text-align: center;
        font-size: 0.85rem;
        padding: 8px;
    }

    .table td {
        vertical-align: middle;
        font-size: 0.85rem;
        padding: 8px;
    }

    .word-text {
        font-weight: 500;
        color: #2563eb;
        font-size: 0.85rem;
    }

    .word-text.with-ending {
        color: #059669;
    }

    .listen-btn {
        padding: 2px 4px;
        font-size: 0.8rem;
    }

    .listen-btn:hover {
        color: #1e40af !important;
    }

    .input-group .form-control {
        font-family: 'Arial', sans-serif;
    }

    .input-group .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
    }

    .check-btn {
        border-color: #2563eb;
        color: #2563eb;
    }

    .check-btn:hover {
        background-color: #2563eb;
        color: #fff;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .rule-card {
            margin-bottom: 1rem;
        }

        .table td {
            padding: 0.75rem;
        }
    }

    .corresponding-sounds-header {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        margin-top: 20px;
    }

    .corresponding-sounds-header h6 {
        margin: 0;
        font-size: 0.9rem;
        color: #4b5563;
    }

    .endings-bank {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #dee2e6;
    }

    .endings-bank h6 {
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .endings-container {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .ending-item {
        background-color: #e3f2fd;
        border: 1px solid #90caf9;
        border-radius: 4px;
        padding: 4px 10px;
        font-size: 0.85rem;
        cursor: move;
        user-select: none;
        transition: all 0.2s ease;
    }

    .ending-item:hover {
        background-color: #bbdefb;
        transform: translateY(-2px);
    }

    .ending-item.dragging {
        opacity: 0.5;
    }

    .phonetic-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .base-phonetic {
        font-family: 'Arial', sans-serif;
        color: #2563eb;
    }

    .ending-dropzone,
    .ending-dropzone-with-s {
        min-width: 70px;
        min-height: 32px;
        border: 2px dashed #dee2e6;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3px 6px;
        background-color: #fff;
        transition: all 0.3s ease;
    }

    .ending-dropzone.dragover,
    .ending-dropzone-with-s.dragover {
        border-color: #2563eb;
        background-color: #e3f2fd;
    }

    .ending-dropzone .placeholder,
    .ending-dropzone-with-s .placeholder {
        color: #6c757d;
        font-size: 0.75rem;
        font-style: italic;
    }

    .ending-dropzone.correct,
    .ending-dropzone-with-s.correct {
        border-color: #198754;
        background-color: #d1e7dd;
    }

    .ending-dropzone.incorrect,
    .ending-dropzone-with-s.incorrect {
        border-color: #dc3545;
        background-color: #f8d7da;
    }

    .save-progress-btn {
        min-width: 160px;
        padding: 8px 16px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 0.85rem;
    }

    .save-progress-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .save-progress-btn:active {
        transform: translateY(0);
    }

    .save-progress-btn i {
        font-size: 1.1em;
    }

    .exercise-header h5 {
        font-size: 1rem;
    }

    .exercise-header p {
        font-size: 0.85rem;
    }
</style>

<script>
    // Function to play audio pronunciation
    function playAudio(word) {
        if ('speechSynthesis' in window) {
            const utterance = new SpeechSynthesisUtterance(word);
            utterance.lang = 'en-US';
            speechSynthesis.speak(utterance);
        }
    }

    // Function to check phonetic transcription
    function checkPhonetic(button, type) {
        const cell = button.closest('td');
        const input = cell.querySelector(type === 'base' ? '.base-phonetic' : '.ending-phonetic');
        const correctPhonetic = input.dataset.correct;
        const userPhonetic = input.value.trim();

        if (userPhonetic === correctPhonetic) {
            input.classList.add('is-valid');
            input.classList.remove('is-invalid');
            button.disabled = true;
        } else {
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');

            // Show correct answer using SweetAlert2
            Swal.fire({
                title: 'Không chính xác!',
                html: `Đáp án đúng: <strong>${correctPhonetic}</strong>`,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltips.forEach(tooltip => {
            new bootstrap.Tooltip(tooltip);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const endingItems = document.querySelectorAll('.ending-item');
        const dropzones = document.querySelectorAll('.ending-dropzone, .ending-dropzone-with-s');

        endingItems.forEach(item => {
            item.addEventListener('dragstart', handleDragStart);
            item.addEventListener('dragend', handleDragEnd);
        });

        dropzones.forEach(dropzone => {
            dropzone.addEventListener('dragover', handleDragOver);
            dropzone.addEventListener('dragleave', handleDragLeave);
            dropzone.addEventListener('drop', handleDrop);
        });
    });

    function handleDragStart(e) {
        this.classList.add('dragging');
        e.dataTransfer.setData('text/plain', this.dataset.ending);
    }

    function handleDragEnd() {
        this.classList.remove('dragging');
    }

    function handleDragOver(e) {
        e.preventDefault();
        this.classList.add('dragover');
    }

    function handleDragLeave() {
        this.classList.remove('dragover');
    }

    function handleDrop(e) {
        e.preventDefault();
        this.classList.remove('dragover');

        const droppedEnding = e.dataTransfer.getData('text/plain');
        const correctEnding = this.dataset.correct;

        // Normalize the endings for comparison (remove slashes and spaces)
        const normalizedDropped = droppedEnding.replace(/[\/\s]/g, '');
        const normalizedCorrect = correctEnding.replace(/[\/\s]/g, '');

        // Clear existing content
        this.innerHTML = '';

        // Create new ending item
        const endingItem = document.createElement('div');
        endingItem.className = 'ending-item';
        endingItem.textContent = droppedEnding;
        this.appendChild(endingItem);

        // Check if correct after normalization
        if (normalizedDropped === normalizedCorrect) {
            this.classList.add('correct');
            this.classList.remove('incorrect');

            // Optional: Add success feedback
            endingItem.style.backgroundColor = '#d1e7dd';
            endingItem.style.borderColor = '#198754';
        } else {
            this.classList.add('incorrect');
            this.classList.remove('correct');

            // Optional: Add error feedback
            endingItem.style.backgroundColor = '#f8d7da';
            endingItem.style.borderColor = '#dc3545';
        }

        // Log for debugging
        console.log('Dropped:', normalizedDropped);
        console.log('Correct:', normalizedCorrect);
    }
</script>
