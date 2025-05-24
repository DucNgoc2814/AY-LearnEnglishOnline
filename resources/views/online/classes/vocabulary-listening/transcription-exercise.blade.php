@php
    $words = [
        ['word' => 'Unpleasant', 'phonetic' => '/ʌnˈpleznt/'],
        ['word' => 'Extremely', 'phonetic' => ''],
        ['word' => 'Suburbs', 'phonetic' => ''],
        ['word' => 'Huge', 'phonetic' => ''],
        ['word' => 'Community', 'phonetic' => ''],
        ['word' => 'Fairly', 'phonetic' => ''],
        ['word' => 'Variety', 'phonetic' => ''],
        ['word' => 'Generous', 'phonetic' => ''],
        ['word' => 'Specialty', 'phonetic' => ''],
    ];
@endphp

<div class="transcription-exercise">
    <div class="exercise-header mb-4">
        <h5 class="mb-2">
            <i class="fas fa-volume-up me-2"></i>{{ $step['title'] }}
        </h5>
        <p class="text-muted mb-0">{{ $step['description'] }}</p>
    </div>

    <!-- Oxford Dictionary Link -->
    <div class="dictionary-link mb-4">
        <a href="{{ $step['dictionary_url'] }}" target="_blank" class="btn btn-info">
            <i class="fas fa-book me-2"></i>Mở từ điển Oxford
        </a>
    </div>

    <!-- Transcription Table -->
    <div class="transcription-table">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 50%">Từ</th>
                        <th style="width: 50%">
                            Phiên âm
                            <br>
                            <small class="text-muted">North American English</small>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($words as $index => $item)
                        <tr class="word-row" data-word="{{ $item['word'] }}">
                            <td class="word-cell">
                                <div class="d-flex align-items-center">
                                    <span class="word-number me-2">{{ $index + 1 }}.</span>
                                    <span class="word-text">{{ $item['word'] }}</span>
                                    <button class="btn btn-sm btn-link text-primary ms-2 listen-btn"
                                        onclick="playAudio('{{ $item['word'] }}')" title="Nghe phát âm">
                                        <i class="fas fa-volume-up"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="phonetic-cell">
                                <div class="input-group">
                                    <input type="text" class="form-control phonetic-input"
                                        placeholder="Nhập phiên âm..." value="{{ $item['phonetic'] }}"
                                        data-correct="{{ $item['phonetic'] }}">
                                    <button class="btn btn-outline-primary check-btn" onclick="checkPhonetic(this)"
                                        type="button">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                                <div class="feedback mt-2" style="display: none;">
                                    <div class="alert alert-success py-1 px-2 mb-0">
                                        <small><i class="fas fa-check-circle me-1"></i><span
                                                class="feedback-text"></span></small>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Save Progress Button -->
    <div class="text-center mt-4">
        <button class="btn btn-success save-progress" onclick="saveProgress()">
            <i class="fas fa-save me-2"></i>Lưu tiến độ
        </button>
    </div>
</div>

<style>
    .transcription-exercise {
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

    .dictionary-link {
        text-align: right;
    }

    .transcription-table {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        padding: 1rem;
        vertical-align: middle;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
    }

    .word-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        background-color: #e9ecef;
        border-radius: 50%;
        font-size: 0.875rem;
        font-weight: 500;
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

    .phonetic-input {
        font-family: 'Arial', sans-serif;
        font-size: 1rem;
    }

    .phonetic-input:focus {
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

    .feedback .alert {
        font-size: 0.875rem;
    }

    .feedback .alert-success {
        background-color: #d1fae5;
        border-color: #34d399;
        color: #065f46;
    }

    .save-progress {
        background-color: #2563eb;
        border-color: #2563eb;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }

    .save-progress:hover {
        background-color: #1e40af;
        border-color: #1e40af;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .dictionary-link {
            text-align: left;
            margin-bottom: 1rem;
        }

        .table td {
            padding: 0.75rem;
        }

        .word-number {
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
        }
    }
</style>

<script>
    // Function to play audio pronunciation
    async function playAudio(word) {
        try {
            // Gọi Free Dictionary API để lấy thông tin phát âm
            const response = await fetch(`https://api.dictionaryapi.dev/api/v2/entries/en/${word}`);
            const data = await response.json();

            // Lấy URL audio từ kết quả API
            const audioUrl = data[0]?.phonetics?.find(p => p.audio)?.audio;

            if (audioUrl) {
                // Phát âm thanh nếu tìm thấy
                const audio = new Audio(audioUrl);
                await audio.play();
            } else {
                // Fallback về speech synthesis nếu không có audio
                if ('speechSynthesis' in window) {
                    const utterance = new SpeechSynthesisUtterance(word);
                    utterance.lang = 'en-US';
                    speechSynthesis.speak(utterance);
                }
            }
        } catch (error) {
            console.error('Error playing pronunciation:', error);
            // Fallback về speech synthesis nếu có lỗi
            if ('speechSynthesis' in window) {
                const utterance = new SpeechSynthesisUtterance(word);
                utterance.lang = 'en-US';
                speechSynthesis.speak(utterance);
            }
        }
    }

    // Function to check phonetic transcription
    function checkPhonetic(button) {
        const row = button.closest('tr');
        const input = row.querySelector('.phonetic-input');
        const feedback = row.querySelector('.feedback');
        const feedbackText = feedback.querySelector('.feedback-text');
        const correctPhonetic = input.dataset.correct;
        const userPhonetic = input.value.trim();

        feedback.style.display = 'block';

        if (userPhonetic === correctPhonetic) {
            feedback.querySelector('.alert').className = 'alert alert-success py-1 px-2 mb-0';
            feedbackText.textContent = 'Chính xác!';
            input.classList.add('is-valid');
            input.classList.remove('is-invalid');
        } else {
            feedback.querySelector('.alert').className = 'alert alert-danger py-1 px-2 mb-0';
            feedbackText.textContent = `Đáp án đúng: ${correctPhonetic}`;
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        }
    }

    // Function to save progress
    function saveProgress() {
        const progress = [];
        document.querySelectorAll('.word-row').forEach(row => {
            const word = row.dataset.word;
            const phonetic = row.querySelector('.phonetic-input').value;
            progress.push({
                word,
                phonetic
            });
        });

        // Here you would typically make an API call to save the progress
        console.log('Saving progress:', progress);

        // Show success message
        Swal.fire({
            title: 'Đã lưu!',
            text: 'Tiến độ của bạn đã được lưu thành công.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltips.forEach(tooltip => {
            new bootstrap.Tooltip(tooltip);
        });
    });
</script>
