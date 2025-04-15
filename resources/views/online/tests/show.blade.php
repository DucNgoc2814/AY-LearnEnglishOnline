@extends('layouts.app')

@section('title', 'Test - ' . $test->title)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Test Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ $test->title }}</h1>
            <div class="flex items-center mt-2 text-gray-600">
                <span class="mr-4">
                    <i class="fas fa-clock mr-2"></i>
                    Duration: {{ $test->duration }} minutes
                </span>
                <span>
                    <i class="fas fa-star mr-2"></i>
                    Total Points: {{ $test->total_points }}
                </span>
            </div>
        </div>

        <!-- Test Instructions -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <h2 class="text-lg font-semibold text-blue-800 mb-2">Instructions</h2>
            <div class="text-blue-700">
                {!! $test->instructions !!}
            </div>
        </div>

        <!-- Test Questions -->
        <form action="{{ route('online.tests.submit', ['test_id' => $test->id]) }}" method="POST" id="testForm">
            @csrf
            <div class="space-y-6">
                @foreach($test->questions as $index => $question)
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="font-medium text-gray-800 mb-3">
                            {{ $index + 1 }}. {{ $question->content }}
                        </div>
                        <div class="ml-4 space-y-2">
                            @foreach($question->options as $option)
                                <div class="flex items-center">
                                    <input type="radio" 
                                           name="answers[{{ $question->id }}]" 
                                           value="{{ $option->id }}"
                                           id="q{{ $question->id }}_{{ $option->id }}"
                                           class="h-4 w-4 text-blue-600">
                                    <label for="q{{ $question->id }}_{{ $option->id }}"
                                           class="ml-2 text-gray-700">
                                        {{ $option->content }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="mt-8 flex items-center justify-between">
                <div class="text-gray-600" id="timer"></div>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Submit Test
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    /* Custom styles for test interface */
    .question-number {
        @apply bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium;
    }
    
    input[type="radio"]:checked + label {
        @apply text-blue-600 font-medium;
    }
</style>
@endpush

@push('scripts')
<script>
    // Timer functionality
    function startTimer(duration) {
        let timer = duration * 60;
        const timerDisplay = document.getElementById('timer');
        
        const countdown = setInterval(() => {
            const minutes = parseInt(timer / 60, 10);
            const seconds = parseInt(timer % 60, 10);

            timerDisplay.textContent = `Time Remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (--timer < 0) {
                clearInterval(countdown);
                document.getElementById('testForm').submit();
            }
        }, 1000);
    }

    // Start timer when page loads
    document.addEventListener('DOMContentLoaded', () => {
        startTimer({{ $test->duration }});
    });

    // Confirm before leaving page
    window.onbeforeunload = function() {
        return "Are you sure you want to leave? Your test progress will be lost.";
    };
</script>
@endpush 