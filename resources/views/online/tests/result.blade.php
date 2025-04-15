@extends('layouts.app')

@section('title', 'Test Results')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto">
        <!-- Result Summary Card -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Test Results</h1>
                <h2 class="text-xl text-gray-600">{{ $test->title }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-50 p-4 rounded-lg text-center">
                    <div class="text-sm text-blue-600 font-medium">Score</div>
                    <div class="text-2xl font-bold text-blue-800">
                        {{ $testResult->score }}/{{ $test->total_points }}
                    </div>
                </div>
                <div class="bg-green-50 p-4 rounded-lg text-center">
                    <div class="text-sm text-green-600 font-medium">Correct Answers</div>
                    <div class="text-2xl font-bold text-green-800">
                        {{ $testResult->correct_answers }}
                    </div>
                </div>
                <div class="bg-red-50 p-4 rounded-lg text-center">
                    <div class="text-sm text-red-600 font-medium">Incorrect Answers</div>
                    <div class="text-2xl font-bold text-red-800">
                        {{ $testResult->incorrect_answers }}
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="w-64 h-64">
                    <canvas id="resultChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Detailed Review -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Detailed Review</h3>
            
            <div class="space-y-6">
                @foreach($test->questions as $index => $question)
                    <div class="p-4 rounded-lg {{ in_array($question->id, $testResult->correct_question_ids) ? 'bg-green-50' : 'bg-red-50' }}">
                        <div class="flex items-start">
                            <span class="question-number mr-2">{{ $index + 1 }}</span>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 mb-2">{{ $question->content }}</p>
                                
                                <div class="space-y-2 ml-4">
                                    @foreach($question->options as $option)
                                        <div class="flex items-center">
                                            @php
                                                $isSelected = $testResult->answers[$question->id] == $option->id;
                                                $isCorrect = $option->is_correct;
                                            @endphp
                                            
                                            <div class="w-4 h-4 mr-2 flex items-center justify-center">
                                                @if($isSelected)
                                                    <i class="fas {{ $isCorrect ? 'fa-check text-green-600' : 'fa-times text-red-600' }}"></i>
                                                @endif
                                            </div>
                                            
                                            <span class="text-gray-700 {{ $isSelected ? 'font-medium' : '' }} {{ $isCorrect ? 'text-green-700' : '' }}">
                                                {{ $option->content }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>

                                @if(!in_array($question->id, $testResult->correct_question_ids))
                                    <div class="mt-3 text-red-700 bg-red-100 p-3 rounded">
                                        <strong>Explanation:</strong> {{ $question->explanation }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-center space-x-4">
            <a href="{{ route('online.tests.index') }}" 
               class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Back to Tests
            </a>
            <a href="{{ route('online.dashboard') }}" 
               class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Go to Dashboard
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
    .question-number {
        @apply bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-sm font-medium;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('resultChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Correct', 'Incorrect'],
                datasets: [{
                    data: [
                        {{ $testResult->correct_answers }},
                        {{ $testResult->incorrect_answers }}
                    ],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.2)',
                        'rgba(239, 68, 68, 0.2)'
                    ],
                    borderColor: [
                        'rgb(34, 197, 94)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endpush 