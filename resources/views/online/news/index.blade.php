@extends('online.layouts.master')

@section('title', 'Thông báo & Tin tức')

@push('styles')
    <style>
        .news-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            background: #fff;
            overflow: hidden;
        }

        .news-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .news-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-content {
            padding: 20px;
        }

        .news-category {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
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
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #2c3e50;
            line-height: 1.4;
        }

        .news-summary {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .news-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #999;
            font-size: 14px;
        }

        .important-badge {
            background-color: #ef5350;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .news-date {
            display: flex;
            align-items: center;
        }

        .news-date i {
            margin-right: 5px;
        }

        .filter-section {
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .filter-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-btn.active {
            background-color: #1976d2;
            color: white;
        }

        .filter-btn:not(.active) {
            background-color: #e9ecef;
            color: #495057;
        }

        .filter-btn:hover:not(.active) {
            background-color: #dee2e6;
        }

        @media (max-width: 768px) {
            .news-image {
                height: 160px;
            }

            .news-content {
                padding: 15px;
            }

            .news-title {
                font-size: 16px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content-section">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 text-primary">
                    <i class="fas fa-newspaper me-2"></i>Thông báo & Tin tức
                </h5>
            </div>
            <div class="card-body">
                <div class="filter-section">
                    <h6 class="filter-title">Lọc theo danh mục</h6>
                    <div class="filter-buttons">
                        <button class="filter-btn active">Tất cả</button>
                        <button class="filter-btn">Thông báo</button>
                        <button class="filter-btn">Hướng dẫn</button>
                        <button class="filter-btn">Sự kiện</button>
                        <button class="filter-btn">Học tập</button>
                    </div>
                </div>

                <div class="row">
                    @foreach($news as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="news-card">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="news-image">
                                <div class="news-content">
                                    <span class="news-category category-{{ strtolower(str_replace(' ', '-', $item['category'])) }}">
                                        {{ $item['category'] }}
                                    </span>
                                    @if($item['is_important'])
                                        <span class="important-badge ms-2">
                                            <i class="fas fa-exclamation-circle me-1"></i>Quan trọng
                                        </span>
                                    @endif
                                    <h3 class="news-title">
                                        <a href="{{ route('online.news.show', $item['id']) }}" class="text-decoration-none text-dark">
                                            {{ $item['title'] }}
                                        </a>
                                    </h3>
                                    <p class="news-summary">{{ $item['summary'] }}</p>
                                    <div class="news-meta">
                                        <div class="news-date">
                                            <i class="far fa-calendar-alt"></i>
                                            {{ \Carbon\Carbon::parse($item['created_at'])->format('d/m/Y') }}
                                        </div>
                                        <a href="{{ route('online.news.show', $item['id']) }}" class="text-primary text-decoration-none">
                                            Xem chi tiết
                                            <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
@endpush 