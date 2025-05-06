@extends('online.layouts.master')

@section('title', $exercise['title'] ?? 'Bài tập ngữ pháp')

@section('styles')
<style>
    .grammar-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
        font-size: 1.4rem;
        color: #333;
        margin-bottom: 15px;
    }
    
    .instructions {
        background-color: #e5f6fd;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
        border-left: 4px solid #17a2b8;
    }
    
    .instructions p {
        margin: 0;
    }
    
    .question-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .question-item {
        padding: 15px;
        margin-bottom: 10px;
        border-left: 3px solid #ddd;
        background-color: #fff;
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    
    .question-item:hover {
        border-left-color: var(--primary-color);
        background-color: #f8f9fa;
    }
    
    .question-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: var(--primary-color);
        color: white;
        border-radius: 50%;
        margin-right: 10px;
        font-weight: bold;
    }
    
    .exercise-header {
        background-color: var(--primary-color);
        color: white;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }
    
    .exercise-header i {
        margin-right: 10px;
        font-size: 1.5rem;
    }
    
    .exercise-header h2 {
        margin: 0;
        font-size: 1.5rem;
    }
    
    .btn-submit {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-top: 20px;
        width: 100%;
    }
    
    .btn-submit:hover {
        background-color: var(--primary-dark);
    }
    
    .answer-input {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 5px 8px;
        width: 150px;
        display: inline-block;
    }
    
    .answer-input:focus {
        border-color: var(--primary-color);
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
    }
    
    .answer-correct {
        border-color: var(--success-color);
        background-color: rgba(5, 150, 105, 0.1);
    }
    
    .answer-incorrect {
        border-color: var(--danger-color);
        background-color: rgba(220, 38, 38, 0.1);
    }
    
    .correct-answer {
        color: var(--success-color);
        font-size: 0.9rem;
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
<div class="grammar-container">
    
    <div class="exercise-header">
        <i class="fas fa-pen"></i>
        <h2>Grammar Exercise</h2>
    </div>

    @if(session('result'))
    <div class="alert alert-info">
        <h4>Your Score: {{ round(session('result')['score']) }}%</h4>
        <p>{{ session('result')['message'] }}</p>
        <a href="{{ request()->url() }}" class="btn btn-outline-primary">Try Again</a>
    </div>
    @endif
    
    <form action="{{ route('exercises.grammar.submit', ['id' => request()->route('id')]) }}" method="POST">
        @csrf
        <ul class="question-list">
            @foreach($exercise['questions'] as $index => $question)
            <li class="question-item">
                <span class="question-number">{{ $index + 1 }}</span>
                @php
                    $parts = preg_split('/(_____)/i', $question['question']);
                    $verbPattern = '/\((.*?)\)/';
                    preg_match($verbPattern, $question['question'], $matches);
                    $verb = isset($matches[1]) ? $matches[1] : '';
                @endphp
                
                {{ $parts[0] }}
                <input type="text" name="answers[]" 
                    class="answer-input 
                        @if(session('result'))
                            {{ strtolower(trim(old('answers.' . $index, ''))) === strtolower(trim($question['answer'])) ? 'answer-correct' : 'answer-incorrect' }}
                        @endif"
                    placeholder="{{ $verb }}"
                    @if(session('result')) value="{{ old('answers.' . $index, '') }}" readonly @endif>
                {{ $parts[1] ?? '' }}
                
                @if(session('result') && strtolower(trim(old('answers.' . $index, ''))) !== strtolower(trim($question['answer'])))
                    <div class="correct-answer">
                        <i class="fas fa-check-circle"></i> Correct answer: {{ $question['answer'] }}
                    </div>
                @endif
            </li>
            @endforeach
        </ul>
        
        @if(!session('result'))
            <button type="submit" class="btn-submit">
                <i class="fas fa-check"></i> Submit Answers
            </button>
        @endif
    </form>
</div>
@endsection 