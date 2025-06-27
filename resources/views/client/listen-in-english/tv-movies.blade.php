@extends('client.layouts.master')

@section('title', 'TV & Movies - Listen in English')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">TV & Movies Lessons</h1>
        <p class="lead text-muted">Learn English through popular entertainment</p>
    </div>

    @include('client.listen-in-english.partials.level-filter', ['levels' => ['Beginner', 'Intermediate', 'Advanced']])

    <div class="row g-4">
        @php
            $shows = collect([
                ['title' => 'Friends', 'episode' => 'The One Where It All Began', 'level' => 'Intermediate', 'duration' => 25],
                ['title' => 'Modern Family', 'episode' => 'Pilot', 'level' => 'Intermediate', 'duration' => 30],
                ['title' => 'The Office', 'episode' => 'Diversity Day', 'level' => 'Advanced', 'duration' => 28],
                ['title' => 'Big Bang Theory', 'episode' => 'The Roommate Agreement', 'level' => 'Intermediate', 'duration' => 22],
                ['title' => 'How I Met Your Mother', 'episode' => 'Purple Giraffe', 'level' => 'Advanced', 'duration' => 25],
                ['title' => 'Brooklyn Nine-Nine', 'episode' => 'The Tagger', 'level' => 'Intermediate', 'duration' => 24],
                ['title' => 'The Crown', 'episode' => 'Wolferton Splash', 'level' => 'Advanced', 'duration' => 35],
                ['title' => 'Stranger Things', 'episode' => 'The Vanishing of Will Byers', 'level' => 'Beginner', 'duration' => 32],
            ]);

            // Filter by level if selected
            $selectedLevel = request()->get('level');
            if (!empty($selectedLevel)) {
                $shows = $shows->filter(function($show) use ($selectedLevel) {
                    return $show['level'] === $selectedLevel;
                });
            }
        @endphp

        @forelse ($shows as $show)
        <div class="col-md-6 col-lg-4">
            <div class="card lesson-card h-100">
                <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="{{ $show['title'] }} thumbnail">
                <div class="card-body">
                    <span class="badge bg-primary mb-2">{{ $show['level'] }}</span>
                    <h5 class="card-title">{{ $show['title'] }}</h5>
                    <p class="card-text">{{ $show['episode'] }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="#" class="btn btn-outline-primary">Watch Now</a>
                        <div class="text-muted">
                            <i class="fas fa-clock"></i> {{ $show['duration'] }} min
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <h4 class="alert-heading">No Shows Found</h4>
                <p>No shows available for the selected level. Try selecting a different level.</p>
            </div>
        </div>
        @endforelse
    </div>

    @if($shows->isNotEmpty())
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

