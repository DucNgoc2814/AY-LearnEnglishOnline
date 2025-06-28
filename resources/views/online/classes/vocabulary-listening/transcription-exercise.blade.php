@php
    // Lấy danh sách từ từ dữ liệu được truyền vào từ controller
    $words = $step['words'] ?? [];
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
        @if(count($words) > 0)
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
                                            placeholder="Nhập phiên âm..." value=""
                                            data-correct="{{ $item['phonetic'] }}">
                                        <button class="btn btn-outline-primary check-btn"
                                            type="button"
                                            data-correct-phonetic="{{ $item['phonetic'] }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                Chưa có dữ liệu transcription cho bài học này.
            </div>
        @endif
    </div>

    <!-- Save Progress Button -->
    @if(count($words) > 0)
        <div class="text-center mt-4">
            <button class="btn btn-success save-progress" onclick="saveProgress()">
                <i class="fas fa-save me-2"></i>Lưu tiến độ
            </button>
        </div>
    @endif
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

    .phonetic-input.is-valid {
        border-color: #198754;
        background-color: #d1e7dd;
    }

    .phonetic-input.is-invalid {
        border-color: #dc3545;
        background-color: #f8d7da;
    }

    .phonetic-input.is-valid:focus,
    .phonetic-input.is-invalid:focus {
        box-shadow: none;
    }

    .save-progress {
        background-color: #198754 !important;
        border-color: #198754 !important;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .save-progress:hover {
        background-color: #157347 !important;
        border-color: #157347 !important;
    }

    .save-progress:focus {
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }

    .save-progress i {
        font-size: 14px;
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

    // Add event listeners when document is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Add click event listeners to all check buttons
        document.querySelectorAll('.check-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Lấy phiên âm đúng từ button
                const correctPhonetic = this.getAttribute('data-correct-phonetic');

                // Lấy input và giá trị người dùng nhập
                const inputElement = this.closest('.input-group').querySelector('.phonetic-input');
                const userPhonetic = inputElement.value.trim();

                // So sánh và hiển thị kết quả
                if (userPhonetic === correctPhonetic) {
                    inputElement.classList.add('is-valid');
                    inputElement.classList.remove('is-invalid');
                } else {
                    inputElement.classList.add('is-invalid');
                    inputElement.classList.remove('is-valid');
                }
            });
        });

        // Add event listeners for tooltips
        const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltips.forEach(tooltip => {
            new bootstrap.Tooltip(tooltip);
        });
    });

    // Function to save progress
    function saveProgress() {
        const lessonId = {{ $current_lesson_id ?? 'null' }};

        if (!lessonId) {
            Swal.fire({
                title: 'Lỗi!',
                text: 'Không tìm thấy thông tin bài học.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Kiểm tra xem có từ nào được nhập phiên âm chưa
        let hasPhonetic = false;
        const progress = [];

        document.querySelectorAll('.word-row').forEach(row => {
            const word = row.dataset.word;
            const phoneticInput = row.querySelector('.phonetic-input');
            const phonetic = phoneticInput ? phoneticInput.value.trim() : '';

            if (phonetic) {
                hasPhonetic = true;
                progress.push({
                    word,
                    phonetic
                });
            }
        });

        // Nếu chưa có từ nào được nhập phiên âm
        if (!hasPhonetic) {
            Swal.fire({
                title: 'Thông báo!',
                text: 'Vui lòng nhập phiên âm cho ít nhất một từ trước khi lưu tiến độ.',
                icon: 'warning',
                confirmButtonText: 'Đã hiểu'
            });
            return;
        }

        // Gọi API để lưu tiến độ
        fetch('/online/classes/vocabulary-listening/transcription/save-progress', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                lesson_id: lessonId,
                progress: progress
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
                text: error.message || 'Có lỗi xảy ra khi lưu tiến độ.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    }
</script>
