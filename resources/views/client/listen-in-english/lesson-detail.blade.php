@extends('client.layouts.master')

@section('title', 'Lesson Detail - Listen in English')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Video Section -->
            <div class="col-lg-7 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title mb-0">{{ $lesson['title'] ?? 'B.1 Rob Checks In' }}</h4>
                            <span class="badge bg-primary">Level {{ $lesson['level'] ?? 'Beginner' }}</span>
                        </div>
                        <div class="lesson-info mb-3">
                            <span class="text-muted me-3">
                                <i class="fas fa-clock"></i> {{ $lesson['duration'] ?? '1:37' }}
                            </span>
                            <span class="text-muted">
                                <i class="fas fa-globe"></i> {{ $lesson['accent'] ?? 'British' }}
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
                            <!-- Questions -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#questionsCollapse">
                                        <i class="fas fa-question-circle me-2"></i> Questions
                                    </button>
                                </h2>
                                <div id="questionsCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        @include('client.listen-in-english.lesson-detail.partials.questions')
                                    </div>
                                </div>
                            </div>

                            <!-- Script -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#scriptCollapse">
                                        <i class="fas fa-file-alt me-2"></i> Script
                                    </button>
                                </h2>
                                <div id="scriptCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        @include('client.listen-in-english.lesson-detail.partials.script')
                                    </div>
                                </div>
                            </div>

                            <!-- Dialogue Practice -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#dialogueCollapse">
                                        <i class="fas fa-comments me-2"></i> Dialogue Practice
                                    </button>
                                </h2>
                                <div id="dialogueCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        @include('client.listen-in-english.lesson-detail.partials.dialogue-practice')
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
                                        @include('client.listen-in-english.lesson-detail.partials.sentence-building')
                                    </div>
                                </div>
                            </div>

                            <!-- Listen & Repeat -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#listenRepeatCollapse">
                                        <i class="fas fa-microphone me-2"></i> Listen & Repeat
                                    </button>
                                </h2>
                                <div id="listenRepeatCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        @include('client.listen-in-english.lesson-detail.partials.listen-repeat')
                                    </div>
                                </div>
                            </div>

                            <!-- Grammar -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#grammarCollapse">
                                        <i class="fas fa-book me-2"></i> Grammar(Telling time)
                                    </button>
                                </h2>
                                <div id="grammarCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        @include('client.listen-in-english.lesson-detail.partials.grammar')
                                    </div>
                                </div>
                            </div>

                            <!-- Grammar Check -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#grammarCheckCollapse">
                                        <i class="fas fa-check-circle me-2"></i> Grammar Check
                                    </button>
                                </h2>
                                <div id="grammarCheckCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        @include('client.listen-in-english.lesson-detail.partials.grammar-check')
                                    </div>
                                </div>
                            </div>

                            <!-- Discussions -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#discussionsCollapse">
                                        <i class="fas fa-users me-2"></i> Discussions
                                    </button>
                                </h2>
                                <div id="discussionsCollapse" class="accordion-collapse collapse"
                                    data-bs-parent="#lessonAccordion">
                                    <div class="accordion-body">
                                        @include('client.listen-in-english.lesson-detail.partials.discussion')
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
