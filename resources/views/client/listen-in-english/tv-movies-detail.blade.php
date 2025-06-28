@extends('client.layouts.master')

@section('title', 'TV Show Lesson Detail - Listen in English')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Video Section -->
            <div class="col-lg-7 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title mb-0">{{ $show['title'] ?? 'Friends' }} - {{ $show['episode'] ?? 'The One Where It All Began' }}</h4>
                            <span class="badge bg-primary">Level {{ $show['level'] ?? 'Intermediate' }}</span>
                        </div>
                        <div class="lesson-info mb-3">
                            <span class="text-muted me-3">
                                <i class="fas fa-clock"></i> {{ $show['duration'] ?? '25' }} min
                            </span>
                            <span class="text-muted">
                                <i class="fas fa-globe"></i> {{ $show['accent'] ?? 'American' }}
                            </span>
                        </div>
                        <div class="video-container mb-3"
                            style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                            <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="video-controls">
                            <div class="alert alert-info">
                                <small>
                                    <i class="fas fa-info-circle"></i>
                                    If the video does not load, click <a href="#" class="alert-link">REFRESH</a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Section -->
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="accordion" id="lessonAccordion">
                            <!-- Grammar -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#grammarCollapse">
                                        <i class="fas fa-book me-2"></i> Grammar
                                    </button>
                                </h2>
                                <div id="grammarCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        @include('client.listen-in-english.tv-movies-detail.partials.grammar')
                                    </div>
                                </div>
                            </div>

                            <!-- Sentence Building -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#sentenceCollapse">
                                        <i class="fas fa-pencil-alt me-2"></i> Sentence Building
                                    </button>
                                </h2>
                                <div id="sentenceCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        @include('client.listen-in-english.tv-movies-detail.partials.sentence-building')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .video-container {
            background: #000;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .accordion-button {
            padding: 1rem;
            font-weight: 500;
        }

        .accordion-button:not(.collapsed) {
            background-color: #e7f1ff;
            color: #0d6efd;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, .125);
        }

        .lesson-info {
            font-size: 0.9rem;
        }

        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
    </style>
@endpush
