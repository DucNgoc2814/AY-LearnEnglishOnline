@extends('online.layouts.master')

@section('title', 'Danh sách bài tập Dictation')

@section('styles')
<style>
    .dictation-list-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-header {
        background: linear-gradient(135deg, #0061f2 0%, #6e00ff 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dictation-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dictation-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dictation-card .card-body {
        padding: 1.5rem;
    }

    .dictation-number {
        font-size: 1.5rem;
        font-weight: 600;
        color: #4f46e5;
        margin-bottom: 0.5rem;
    }

    .dictation-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-new {
        background-color: #ecfdf5;
        color: #065f46;
    }

    .status-completed {
        background-color: #eff6ff;
        color: #1e40af;
    }
</style>
@endsection

@section('content')
<div class="dictation-list-container">
    <div class="page-header">
        <h2 class="text-2xl font-bold mb-2">Bài tập Dictation</h2>
        <p class="text-white-600">Luyện nghe và viết theo các đoạn hội thoại, cải thiện kỹ năng nghe và chính tả.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($dictations as $dictation)
        <div class="col">
            <div class="dictation-card h-100">
                <div class="card-body">
                    <div class="dictation-number">Bài {{ $dictation->id }}</div>
                    <div class="mb-3">
                        <span class="dictation-status status-new">Mới</span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Luyện nghe và viết theo đoạn hội thoại.
                    </p>
                    <a href="{{ route('exercises.dictation', ['id' => $dictation->id]) }}"
                       class="btn btn-primary d-block">
                        Bắt đầu
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
