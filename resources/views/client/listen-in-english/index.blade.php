@extends('client.layouts.master')

@section('title', 'Listen in English')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Choose from two types of lessons.</h1>
        <p class="lead text-muted">Ideal for self-study and online classes.</p>
    </div>

    <div class="row justify-content-center g-4">
        <!-- Easy TV Section -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('client.listen.easy-tv') }}" class="text-decoration-none">
                <div class="card h-100 lesson-card">
                    <div class="card-body text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-tv fa-3x text-primary"></i>
                        </div>
                        <h3 class="card-title">Easy TV</h3>
                        <p class="card-text text-muted">Simple and fun English lessons</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- TV & Movies Section -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('client.listen.tv-movies') }}" class="text-decoration-none">
                <div class="card h-100 lesson-card">
                    <div class="card-body text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-film fa-3x text-primary"></i>
                        </div>
                        <h3 class="card-title">TV & Movies</h3>
                        <p class="card-text text-muted">Learn English through entertainment</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .lesson-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .lesson-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 50%;
    }
</style>
@endpush
