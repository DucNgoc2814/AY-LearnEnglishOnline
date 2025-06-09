@extends('online.layouts.master')

@section('title', 'Dictation Exercise')

@section('styles')
    <style>
        .dictation-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .exercise-header {
            background: linear-gradient(135deg, #0061f2 0%, #6e00ff 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .exercise-header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .exercise-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .audio-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }

        .audio-container audio {
            width: 100%;
            height: 48px;
        }

        .input-container {
            margin-bottom: 1.5rem;
        }

        .input-container textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            min-height: 120px;
            resize: vertical;
            transition: all 0.3s ease;
            background: white;
            color: #1f2937;
        }

        .input-container textarea:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #6366f1;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #4f46e5;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #4b5563;
            border: 1px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-1px);
        }

        .result-container {
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            display: none;
            font-weight: 500;
        }

        .result-container.correct {
            background-color: #ecfdf5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }

        .result-container.incorrect {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .script-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            height: 100%;
        }

        .script-header {
            background: #6366f1;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px 12px 0 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .script-body {
            padding: 1.5rem;
        }

        .translation-section {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 0.75rem;
        }

        .word-pronunciation {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            margin: 0.25rem;
            background: #f3f4f6;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #4b5563;
            text-decoration: none;
            border: 1px solid #e5e7eb;
        }

        .word-pronunciation:hover {
            background: #e5e7eb;
            color: #1f2937;
        }

        .phonetic-popup {
            position: absolute;
            background: white;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
            z-index: 1000;
            min-width: 240px;
            border: 1px solid #e5e7eb;
        }

        .pronunciation-button {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #4b5563;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pronunciation-button:hover {
            background: #e5e7eb;
            color: #1f2937;
        }

        .word-definition {
            margin-top: 0.75rem;
            font-size: 0.9rem;
            color: #6b7280;
            line-height: 1.5;
        }

        .ipa-text {
            font-family: monospace;
            color: #6b7280;
            margin: 0.5rem 0;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .dictation-container {
                padding: 1rem;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dictation-container">
        <!-- Exercise Header -->
        <div class="exercise-header">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Dictation Exercise</h2>
                <span class="exercise-badge">{{ $exercise->id }}/{{ $total }}</span>
            </div>
        </div>

        <div class="row g-4">
            <!-- Main Exercise Area -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <!-- Audio Player -->
                        <div class="audio-container">
                            <audio id="dictationAudio" controls controlsList="nodownload" class="w-100">
                                <source src="{{ $exercise->audio_url }}" type="audio/mpeg">
                                <p class="text-danger">Trình duyệt của bạn không hỗ trợ phát audio.</p>
                            </audio>
                            <div id="audioError" class="alert alert-danger mt-3 d-none">
                                Không thể tải file audio. Vui lòng thử lại sau.
                            </div>
                        </div>

                        <!-- Input Area -->
                        <div class="input-container">
                            <textarea id="userInput" class="form-control"
                                placeholder="Nhập những gì bạn nghe được..."
                                rows="4"></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="button-group">
                            <button id="checkButton" class="btn btn-primary">
                                <i class="fas fa-check"></i>
                                Kiểm tra
                            </button>
                            <button id="scriptButton" class="btn btn-secondary">
                                <i class="fas fa-file-alt"></i>
                                Xem kết quả
                            </button>
                        </div>

                        <!-- Results -->
                        <div id="resultContainer" class="result-container"></div>
                    </div>
                </div>
            </div>

            <!-- Script Area -->
            <div class="col-lg-4">
                <div id="scriptContainer" class="script-card d-none">
                    <div class="script-header">
                        Script
                    </div>
                    <div class="script-body">
                        <div class="translation-section">
                            <h6 class="section-title">Translation</h6>
                            <p id="translationText" class="mb-0"></p>
                        </div>
                        <div class="pronunciation-section">
                            <h6 class="section-title">Pronunciation</h6>
                            <div id="pronunciationText" class="pronunciation-text"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Phonetic Popup -->
    <div id="phoneticPopup" class="phonetic-popup" style="display: none;"></div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const exerciseId = {{ $exercise->id }};
            const audio = document.getElementById('dictationAudio');
            const audioError = document.getElementById('audioError');
            const userInput = document.getElementById('userInput');
            const checkButton = document.getElementById('checkButton');
            const scriptButton = document.getElementById('scriptButton');
            const resultContainer = document.getElementById('resultContainer');
            const scriptContainer = document.getElementById('scriptContainer');
            const translationText = document.getElementById('translationText');
            const pronunciationText = document.getElementById('pronunciationText');
            const phoneticPopup = document.getElementById('phoneticPopup');

            // Handle audio errors
            audio.addEventListener('error', function(e) {
                console.error('Audio error:', e);
                audioError.classList.remove('d-none');
            });

            // Handle audio load success
            audio.addEventListener('loadeddata', function() {
                audioError.classList.add('d-none');
            });

            function showResult(type, message) {
                resultContainer.className = `result-container ${type}`;
                resultContainer.textContent = message;
                resultContainer.style.display = 'block';
            }

            // Check button click handler
            checkButton.addEventListener('click', async function() {
                const userText = userInput.value.trim();

                if (!userText) {
                    showResult('incorrect', 'Bạn cần nhập điều bạn nghe được');
                    return;
                }

                try {
                    const response = await fetch('/exercises/dictation/check', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            exercise_id: exerciseId,
                            user_text: userText
                        })
                    });

                    const data = await response.json();
                    if (data.success) {
                        showResult(data.is_correct ? 'correct' : 'incorrect', data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showResult('incorrect', 'Có lỗi xảy ra. Vui lòng thử lại.');
                }
            });

            // Script button click handler
            scriptButton.addEventListener('click', async function() {
                try {
                    const response = await fetch(`/exercises/dictation/${exerciseId}/script`, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();
                    if (data.success) {
                        // Display translation
                        translationText.textContent = data.data.translation;

                        // Fill the input textarea with the correct text
                        const correctText = data.data.pronunciations.map(item => item.word).join(' ');
                        userInput.value = correctText;
                        userInput.style.borderColor = '#6ee7b7'; // Add a success border color
                        userInput.style.backgroundColor = '#ecfdf5'; // Light green background

                        // Display pronunciation
                        let pronunciationHtml = '';
                        data.data.pronunciations.forEach((item, index) => {
                            pronunciationHtml += `<span class="word-pronunciation"
                                data-word="${item.word}"
                                data-phonetic="${item.phonetic || ''}"
                                data-audio="${item.audio_url || ''}"
                                data-definitions='${JSON.stringify(item.definitions || []).replace(/'/g, "&apos;")}'
                            >${item.word}</span>`;
                            if (index < data.data.pronunciations.length - 1) {
                                pronunciationHtml += ' ';
                            }
                        });
                        pronunciationText.innerHTML = pronunciationHtml;

                        // Add click handlers for pronunciation
                        document.querySelectorAll('.word-pronunciation').forEach(word => {
                            word.addEventListener('click', function() {
                                const wordData = {
                                    word: this.dataset.word,
                                    phonetic: this.dataset.phonetic,
                                    audio: this.dataset.audio,
                                    definitions: JSON.parse(this.dataset.definitions.replace(/&apos;/g, "'"))
                                };
                                showPhonetics(wordData, this);
                            });
                        });

                        scriptContainer.classList.remove('d-none');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showResult('incorrect', 'Có lỗi xảy ra khi tải script.');
                }
            });

            // Add input event listener to reset styles when user starts typing
            userInput.addEventListener('input', function() {
                this.style.borderColor = '#e5e7eb'; // Reset border color
                this.style.backgroundColor = 'white'; // Reset background color
            });

            function showPhonetics(wordData, element) {
                const rect = element.getBoundingClientRect();
                let definitions;
                try {
                    definitions = JSON.parse(wordData.definitions.replace(/&apos;/g, "'"));
                } catch (e) {
                    definitions = [];
                    console.error('Error parsing definitions:', e);
                }

                let content = `
                    <div class="mb-2">
                        <strong>${wordData.word}</strong>
                        <div class="ipa-text">${wordData.phonetic || ''}</div>
                    </div>
                `;

                if (wordData.audio) {
                    content += `
                        <div class="pronunciation-buttons">
                            <button class="pronunciation-button" onclick="new Audio('${wordData.audio}').play()">
                                <i class="fas fa-volume-up"></i> Play
                            </button>
                        </div>
                    `;
                }

                if (definitions && definitions.length > 0) {
                    content += `
                        <div class="word-definition">
                            ${definitions.map((def, index) =>
                                `${index + 1}. ${def}`
                            ).join('<br>')}
                        </div>
                    `;
                }

                phoneticPopup.innerHTML = content;
                phoneticPopup.style.left = `${rect.left}px`;
                phoneticPopup.style.top = `${rect.bottom + 5}px`;
                phoneticPopup.style.display = 'block';

                // Close popup when clicking outside
                document.addEventListener('click', function closePopup(e) {
                    if (!phoneticPopup.contains(e.target) && !element.contains(e.target)) {
                        phoneticPopup.style.display = 'none';
                        document.removeEventListener('click', closePopup);
                    }
                });
            }
        });
    </script>
@endpush
