@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">English Dictionary</h1>

        <!-- Form nhập text -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="mb-4">
                <label for="input-text" class="block text-sm font-medium text-gray-700 mb-2">
                    Enter English word
                </label>
                <input type="text" id="input-text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Type an English word...">
            </div>
            <button id="submit-text"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Look up
            </button>
        </div>

        <!-- Kết quả -->
        <div id="result-container" class="bg-white rounded-lg shadow-md p-6 hidden">
            <div id="result-content" class="space-y-6">
                <!-- Kết quả sẽ được thêm vào đây bằng JavaScript -->
            </div>
        </div>

        <!-- Loading indicator -->
        <div id="loading" class="hidden">
            <div class="flex justify-center items-center py-4">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputText = document.getElementById('input-text');
    const submitButton = document.getElementById('submit-text');
    const resultContainer = document.getElementById('result-container');
    const resultContent = document.getElementById('result-content');
    const loading = document.getElementById('loading');

    submitButton.addEventListener('click', async function() {
        const text = inputText.value.trim();
        if (!text) return;

        // Hiển thị loading
        loading.classList.remove('hidden');
        resultContainer.classList.add('hidden');

        try {
            const response = await fetch('/api/oxford/process-text', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ text: text })
            });

            const data = await response.json();
            console.log('API Response:', data);

            if (data.success) {
                // Xóa nội dung cũ
                resultContent.innerHTML = '';

                // Tạo phần tử cho từ
                const wordInfo = data.data[0]; // Chỉ lấy kết quả đầu tiên vì chỉ tra 1 từ
                if (wordInfo) {
                    const wordElement = document.createElement('div');
                    wordElement.className = 'p-4 bg-gray-50 rounded-lg space-y-4';

                    // Container cho từ và nút phát âm
                    const wordHeader = document.createElement('div');
                    wordHeader.className = 'flex items-center justify-between';

                    // Phần từ và phiên âm
                    const wordContent = document.createElement('div');
                    wordContent.className = 'flex-1';

                    const wordText = document.createElement('div');
                    wordText.className = 'text-3xl font-bold text-gray-900';
                    wordText.textContent = wordInfo.word;

                    const phonetic = document.createElement('div');
                    phonetic.className = 'text-xl text-blue-600 font-mono mt-2';

                    if (wordInfo.phonetic) {
                        phonetic.textContent = `/${wordInfo.phonetic}/`;
                    } else if (wordInfo.pronunciations && wordInfo.pronunciations.length > 0) {
                        const pronunciation = wordInfo.pronunciations[0];
                        if (pronunciation && pronunciation.phoneticSpelling) {
                            phonetic.textContent = `/${pronunciation.phoneticSpelling}/`;
                        }
                    }

                    wordContent.appendChild(wordText);
                    wordContent.appendChild(phonetic);
                    wordHeader.appendChild(wordContent);

                    // Nút phát âm
                    const audioUrl = wordInfo.audio_url ||
                        (wordInfo.pronunciations && wordInfo.pronunciations.length > 0
                            ? wordInfo.pronunciations[0].audioFile
                            : null);

                    if (audioUrl) {
                        const audioButton = document.createElement('button');
                        audioButton.className = 'p-3 text-blue-600 hover:text-blue-800 focus:outline-none transition-colors duration-200';
                        audioButton.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                            </svg>
                        `;

                        const audio = new Audio(audioUrl);
                        audioButton.addEventListener('click', () => {
                            audio.play().catch(error => {
                                console.error('Error playing audio:', error);
                                alert('Cannot play audio. Please try again later.');
                            });
                        });

                        wordHeader.appendChild(audioButton);
                    }

                    wordElement.appendChild(wordHeader);

                    // Hiển thị nghĩa của từ
                    if (wordInfo.definitions && wordInfo.definitions.length > 0) {
                        const definitionsContainer = document.createElement('div');
                        definitionsContainer.className = 'mt-6 space-y-3';

                        const definitionTitle = document.createElement('div');
                        definitionTitle.className = 'text-lg font-medium text-gray-700';
                        definitionTitle.textContent = 'Definitions:';
                        definitionsContainer.appendChild(definitionTitle);

                        wordInfo.definitions.forEach((definition, idx) => {
                            const definitionElement = document.createElement('div');
                            definitionElement.className = 'ml-4 text-gray-600 text-lg';
                            definitionElement.textContent = `${idx + 1}. ${definition}`;
                            definitionsContainer.appendChild(definitionElement);
                        });

                        wordElement.appendChild(definitionsContainer);
                    }

                    // Hiển thị ví dụ
                    if (wordInfo.examples && wordInfo.examples.length > 0) {
                        const examplesContainer = document.createElement('div');
                        examplesContainer.className = 'mt-6 space-y-3';

                        const exampleTitle = document.createElement('div');
                        exampleTitle.className = 'text-lg font-medium text-gray-700';
                        exampleTitle.textContent = 'Examples:';
                        examplesContainer.appendChild(exampleTitle);

                        wordInfo.examples.forEach((example, idx) => {
                            const exampleElement = document.createElement('div');
                            exampleElement.className = 'ml-4 text-gray-600 italic text-lg';
                            exampleElement.textContent = `• ${example}`;
                            examplesContainer.appendChild(exampleElement);
                        });

                        wordElement.appendChild(examplesContainer);
                    }

                    resultContent.appendChild(wordElement);
                }

                resultContainer.classList.remove('hidden');
            } else {
                alert('Error: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while looking up the word');
        } finally {
            loading.classList.add('hidden');
        }
    });

    // Cho phép nhấn Enter để submit
    inputText.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            submitButton.click();
        }
    });
});
</script>
@endpush
