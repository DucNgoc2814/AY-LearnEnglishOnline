@extends('online.layouts.master')

@section('title', 'Dictation Exercise')

@section('styles')
<style>
    .dictation-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .audio-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .input-container textarea {
        width: 100%;
        padding: 15px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        font-size: 1rem;
        min-height: 100px;
        resize: vertical;
        transition: all 0.2s ease;
    }

    .input-container textarea:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.15);
        outline: none;
    }

    .result-container {
        padding: 15px;
        border-radius: 8px;
        margin-top: 20px;
        display: none;
    }

    .result-container.correct {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .result-container.incorrect {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .script-container {
        display: none;
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
    }

    .word-item {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        background: #f8f9fa;
        border-radius: 4px;
        cursor: pointer;
        margin: 4px;
        transition: all 0.2s ease;
    }

    .word-item:hover {
        background: #e9ecef;
    }

    .phonetic-popup {
        display: none;
        position: absolute;
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        z-index: 1000;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <h2 class="mb-0">Dictation Exercise</h2>
                <span class="badge bg-primary ms-2">1/21</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- Audio Player -->
                    <div class="audio-container">
                        <audio id="dictationAudio" controls class="w-100">
                            <source src="{{ $exercise['audio_url'] }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>

                    <!-- Input Area -->
                    <div class="input-container">
                        <textarea id="userInput"
                                class="form-control"
                                placeholder="Type what you hear..."></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-3">
                        <button id="checkButton" class="btn btn-primary me-2">
                            <i class="fas fa-check me-1"></i> Check
                        </button>
                        <button id="scriptButton" class="btn btn-secondary">
                            <i class="fas fa-file-alt me-1"></i> Script
                        </button>
                    </div>

                    <!-- Results -->
                    <div id="resultContainer" class="result-container"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div id="scriptContainer" class="card d-none">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Script</h5>
                </div>
                <div class="card-body">
                    <div class="translation-container mb-4">
                        <h6>Translation</h6>
                        <p id="translationText" class="mb-0"></p>
                    </div>
                    <div class="pronunciation-container">
                        <h6>Pronunciation</h6>
                        <div id="pronunciationWords" class="mt-2">
                            <!-- Words will be inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Phonetic Popup -->
<div id="phoneticPopup" class="phonetic-popup"></div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const exerciseId = {{ $exercise['id'] }};
    const audio = document.getElementById('dictationAudio');
    const userInput = document.getElementById('userInput');
    const checkButton = document.getElementById('checkButton');
    const scriptButton = document.getElementById('scriptButton');
    const resultContainer = document.getElementById('resultContainer');
    const scriptContainer = document.getElementById('scriptContainer');
    const translationText = document.getElementById('translationText');
    const pronunciationWords = document.getElementById('pronunciationWords');
    const phoneticPopup = document.getElementById('phoneticPopup');

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
            console.error('Error checking answer:', error);
            showResult('incorrect', 'An error occurred while checking your answer');
        }
    });

    // Script button click handler
    scriptButton.addEventListener('click', async function() {
        try {
            const response = await fetch(`/exercises/dictation/${exerciseId}/script`);
            const data = await response.json();

            if (data.success) {
                scriptContainer.classList.remove('d-none');
                translationText.textContent = data.data.translation;

                // Clear previous words
                pronunciationWords.innerHTML = '';

                // Add words with pronunciation
                data.data.words.forEach(word => {
                    const wordElement = document.createElement('div');
                    wordElement.className = 'word-item';
                    wordElement.innerHTML = `
                        ${word}
                        <i class="fas fa-volume-up ms-2 text-primary"></i>
                    `;

                    wordElement.addEventListener('click', () => showPhonetics(word));
                    pronunciationWords.appendChild(wordElement);
                });
            }
        } catch (error) {
            console.error('Error fetching script:', error);
        }
    });

    // Show result message
    function showResult(type, message) {
        resultContainer.className = `result-container ${type}`;
        resultContainer.innerHTML = message;
        resultContainer.style.display = 'block';
    }

    // Show phonetics popup
    async function showPhonetics(word) {
        try {
            const response = await fetch('/api/oxford/process-text', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ text: word })
            });

            const data = await response.json();

            if (data.success && data.data[0]) {
                const wordInfo = data.data[0];
                phoneticPopup.innerHTML = `
                    <div class="fw-bold mb-1">${word}</div>
                    <div class="text-primary">/${wordInfo.phonetic}/</div>
                    ${wordInfo.audio_url ? `
                        <button onclick="new Audio('${wordInfo.audio_url}').play()"
                                class="btn btn-sm btn-link text-primary p-0 mt-2">
                            <i class="fas fa-volume-up"></i>
                        </button>
                    ` : ''}
                `;

                // Position popup near the clicked word
                const rect = event.target.getBoundingClientRect();
                phoneticPopup.style.top = `${rect.bottom + window.scrollY + 5}px`;
                phoneticPopup.style.left = `${rect.left + window.scrollX}px`;
                phoneticPopup.style.display = 'block';
            }
        } catch (error) {
            console.error('Error fetching phonetics:', error);
        }
    }

    // Close phonetics popup when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.word-item') && !event.target.closest('.phonetic-popup')) {
            phoneticPopup.style.display = 'none';
        }
    });
});
</script>
@endpush