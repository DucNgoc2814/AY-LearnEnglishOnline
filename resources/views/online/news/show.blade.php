@extends('online.layouts.master')

@section('title', $news['title'])

@push('styles')
    <style>
        .news-detail {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .news-header {
            position: relative;
            margin-bottom: 30px;
        }

        .news-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .news-meta {
            margin: 20px 0;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .news-category {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-right: 15px;
        }

        .category-notice {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .category-guide {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        .category-event {
            background-color: #fff3e0;
            color: #f57c00;
        }

        .category-study {
            background-color: #e8f5e9;
            color: #388e3c;
        }

        .news-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1.4;
            margin: 20px 0;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            color: #666;
            font-size: 14px;
            margin-right: 20px;
        }

        .meta-item i {
            margin-right: 8px;
            color: #999;
        }

        .important-badge {
            background-color: #ef5350;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }

        .important-badge i {
            margin-right: 6px;
        }

        .news-content {
            font-size: 16px;
            line-height: 1.8;
            color: #333;
            margin-bottom: 40px;
        }

        .news-content p {
            margin-bottom: 20px;
        }

        .news-content h2, 
        .news-content h3 {
            margin: 30px 0 15px;
            color: #2c3e50;
        }

        .news-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }

        .news-content ul,
        .news-content ol {
            margin: 20px 0;
            padding-left: 20px;
        }

        .news-content li {
            margin-bottom: 10px;
        }

        .news-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            color: #1976d2;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-button:hover {
            color: #1565c0;
        }

        .back-button i {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .news-image {
                height: 250px;
            }

            .news-title {
                font-size: 24px;
            }

            .meta-item {
                display: block;
                margin-bottom: 10px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-section">
        <div class="news-detail">
            <div class="news-header">
                <img src="{{ asset($news['image']) }}" alt="{{ $news['title'] }}" class="news-image">
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="news-meta">
                            <span class="news-category category-{{ strtolower(str_replace(' ', '-', $news['category'])) }}">
                                {{ $news['category'] }}
                            </span>
                            @if($news['is_important'])
                                <span class="important-badge">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Thông báo quan trọng
                                </span>
                            @endif
                        </div>

                        <h1 class="news-title">{{ $news['title'] }}</h1>

                        <div class="meta-item">
                            <i class="far fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($news['created_at'])->format('d/m/Y H:i') }}
                        </div>
                        <div class="meta-item">
                            <i class="far fa-user"></i>
                            {{ $news['author'] }}
                        </div>

                        <div class="news-content mt-4">
                            {!! $news['content'] !!}
                        </div>

                        <div class="news-footer">
                            <a href="{{ route('online.news.index') }}" class="back-button">
                                <i class="fas fa-arrow-left"></i>
                                Quay lại danh sách tin tức
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 