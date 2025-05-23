@php
    $soundRules = [
        [
            'title' => 'Nhóm 1',
            'sounds' => ['/p/', '/t/', '/k/', '/f/', '/θ/'],
            'description' => 'Các âm cuối vô thanh'
        ],
        [
            'title' => 'Nhóm 2',
            'sounds' => ['/s/', '/z/', '/ʃ/', '/ʒ/', '/tʃ/', '/dʒ/'],
            'description' => 'Các âm xát và âm tắc xát'
        ],
        [
            'title' => 'Nhóm 3',
            'sounds' => 'Other sounds',
            'description' => 'Các âm khác'
        ]
    ];

    $practiceWords = [
        ['word' => 'Class', 'base' => '/klæs/', 'ending' => '/klæsɪz/'],
        ['word' => 'Landmark', 'base' => '', 'ending' => ''],
        ['word' => 'Local', 'base' => '', 'ending' => ''],
        ['word' => 'Place', 'base' => '', 'ending' => ''],
        ['word' => 'Suit', 'base' => '', 'ending' => ''],
        ['word' => 'Farm', 'base' => '', 'ending' => '']
    ];
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
        <div class="row">
            @foreach($soundRules as $rule)
                <div class="col-md-4 mb-4">
                    <div class="rule-card">
                        <h6 class="rule-title">{{ $rule['title'] }}</h6>
                        <div class="rule-sounds">
                            @if(is_array($rule['sounds']))
                                @foreach($rule['sounds'] as $sound)
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
    </div>

    <!-- Practice Table -->
    <div class="practice-section">
        <h6 class="mb-3">Bảng thực hành:</h6>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 10%">#</th>
                        <th style="width: 30%">Từ</th>
                        <th style="width: 30%">Phiên âm gốc</th>
                        <th style="width: 30%">Phiên âm khi thêm "s/es"</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($practiceWords as $index => $word)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="word-text">{{ $word['word'] }}</span>
                                    <button class="btn btn-sm btn-link text-primary ms-2 listen-btn"
                                            onclick="playAudio('{{ $word['word'] }}')"
                                            title="Nghe phát âm">
                                        <i class="fas fa-volume-up"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text"
                                           class="form-control base-phonetic"
                                           placeholder="Nhập phiên âm..."
                                           value="{{ $word['base'] }}"
                                           data-correct="{{ $word['base'] }}">
                                    <button class="btn btn-outline-primary check-btn"
                                            onclick="checkPhonetic(this, 'base')"
                                            type="button">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text"
                                           class="form-control ending-phonetic"
                                           placeholder="Nhập phiên âm..."
                                           value="{{ $word['ending'] }}"
                                           data-correct="{{ $word['ending'] }}">
                                    <button class="btn btn-outline-primary check-btn"
                                            onclick="checkPhonetic(this, 'ending')"
                                            type="button">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.ending-sound-exercise {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.rule-card {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    height: 100%;
    border: 1px solid #dee2e6;
}

.rule-title {
    color: #2563eb;
    margin-bottom: 15px;
    font-weight: 600;
}

.rule-sounds {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 15px;
}

.sound-badge {
    background-color: #e9ecef;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 4px 8px;
    font-family: 'Arial', sans-serif;
    font-size: 0.9rem;
}

.rule-description {
    color: #6b7280;
    font-size: 0.9rem;
    margin-bottom: 0;
}

.practice-section {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    border: 1px solid #dee2e6;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
    vertical-align: middle;
}

.word-text {
    font-weight: 500;
    color: #2563eb;
}

.listen-btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
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
</script>
