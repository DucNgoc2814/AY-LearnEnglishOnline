@extends('client.layouts.master')

@section('title', 'Easy TV - Listen in English')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Easy TV Lessons</h1>
        <p class="lead text-muted">Simple and engaging English lessons for beginners</p>
    </div>

    @include('client.listen-in-english.partials.level-filter', ['levels' => ['Beginner', 'Intermediate', 'Advanced']])

    <div class="row g-4">
        @php
            $lessons = collect([]);
            for ($i = 1; $i <= 8; $i++) {
                $level = ['Beginner', 'Intermediate', 'Advanced'][rand(0, 2)];
                $lessons->push([
                    'title' => "Sample Lesson $i",
                    'duration' => rand(5, 15),
                    'students' => rand(100, 999),
                    'level' => $level
                ]);
            }

            // Filter by level if selected
            $selectedLevel = request()->get('level');
            if (!empty($selectedLevel)) {
                $lessons = $lessons->filter(function($lesson) use ($selectedLevel) {
                    return $lesson['level'] === $selectedLevel;
                });
            }
        @endphp

        @forelse ($lessons as $lesson)
        <div class="col-md-6 col-lg-4">
            <div class="card lesson-card h-100">
                <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="Lesson thumbnail">
                <div class="card-body">
                    <span class="badge bg-primary mb-2">{{ $lesson['level'] }}</span>
                    <h5 class="card-title">{{ $lesson['title'] }}</h5>
                    <p class="card-text text-muted">Duration: {{ $lesson['duration'] }} minutes</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('client.listen.lesson.detail', ['id' => $loop->iteration]) }}" class="btn btn-outline-primary">Start Lesson</a>
                        <span class="text-muted"><i class="fas fa-users"></i> {{ $lesson['students'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <h4 class="alert-heading">No Lessons Found</h4>
                <p>No lessons available for the selected level. Try selecting a different level.</p>
            </div>
        </div>
        @endforelse
    </div>

    @if($lessons->isNotEmpty())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .lesson-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .lesson-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
</style>
@endpush

