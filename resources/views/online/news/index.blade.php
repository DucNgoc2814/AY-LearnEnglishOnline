@extends('online.layouts.master')

@section('title', 'Thông báo & Tin tức')

@push('styles')
    <style>
        /* Reset all spacing */
        .content-section,
        .content-wrapper,
        .container-fluid,
        .container,
        .row,
        .col,
        body {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: hidden !important;
        }

        /* Main container styles */
        .news-container {
            width: 100%;
            max-width: 100%;
        }

        .page-header {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            border-bottom: 1px solid #e0e0e0;
            background: #fff;
        }

        .page-title {
            font-size: 15px;
            font-weight: 600;
            color: #0066cc;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Filter styles */
        .filter-section {
            padding: 10px 12px;
            background-color: #f8f9fa;
        }

        .filter-label {
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
            color: #333;
        }

        .filter-buttons {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 4px 10px;
            border: none;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        /* News grid layout */
        .news-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            padding: 12px;
            background-color: #f8f9fa;
        }

        /* News card styles */
        .news-card {
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            width: 100%;
        }

        .news-image {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 6px 6px 0 0;
        }

        .news-content {
            padding: 10px;
        }

        .news-meta-top {
            display: flex;
            align-items: center;
            margin-bottom: 6px;
            flex-wrap: wrap;
            gap: 4px;
        }

        .news-category {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 500;
        }

        .important-badge {
            display: inline-flex;
            align-items: center;
            background-color: #ff4d4f;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            gap: 3px;
        }

        .news-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #222;
            line-height: 1.4;
        }

        .news-summary {
            color: #555;
            margin-bottom: 8px;
            line-height: 1.4;
            font-size: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 6px;
            border-top: 1px solid #f0f0f0;
            font-size: 11px;
        }

        .news-date {
            display: flex;
            align-items: center;
            color: #777;
            gap: 3px;
        }

        .news-link {
            color: #0066cc;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        /* Category colors */
        .category-thông-báo,
        .category-notice {
            background-color: #e3f2fd;
            color: #0066cc;
        }

        .category-hướng-dẫn,
        .category-guide {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .category-sự-kiện,
        .category-event {
            background-color: #fff8e1;
            color: #f57c00;
        }

        .category-học-tập,
        .category-study {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        /* Desktop styles */
        @media (min-width: 768px) {
            .news-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 16px;
                padding: 16px;
            }

            .page-header {
                padding: 12px 16px;
            }

            .page-title {
                font-size: 16px;
            }

            .filter-section {
                padding: 12px 16px;
            }

            .filter-btn {
                padding: 6px 12px;
                font-size: 13px;
            }

            .news-content {
                padding: 12px;
            }

            .news-title {
                font-size: 15px;
            }

            .news-summary {
                font-size: 13px;
                -webkit-line-clamp: 3;
            }

            .news-meta {
                font-size: 12px;
            }
        }

        /* Fix for iOS Safari */
        @supports (-webkit-touch-callout: none) {
            .news-container {
                width: 100vw;
            }

            .news-grid {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="news-container">
        <div class="page-header">
            <h5 class="page-title">
                <i class="fas fa-newspaper"></i>Thông báo & Tin tức
            </h5>
        </div>

        <div class="filter-section">
            <div class="filter-label">Lọc theo danh mục</div>
            <div class="filter-buttons">
                <button class="filter-btn active">Tất cả</button>
                <button class="filter-btn">Thông báo</button>
                <button class="filter-btn">Hướng dẫn</button>
                <button class="filter-btn">Sự kiện</button>
                <button class="filter-btn">Học tập</button>
            </div>
        </div>

        <div class="news-grid">
            @foreach ($news as $item)
                <div class="news-card">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="news-image">
                    <div class="news-content">
                        <div class="news-meta-top">
                            <span class="news-category category-{{ strtolower(str_replace(' ', '-', $item['category'])) }}">
                                {{ $item['category'] }}
                            </span>
                            @if ($item['is_important'])
                                <span class="important-badge">
                                    <i class="fas fa-exclamation-circle"></i>Quan trọng
                                </span>
                            @endif
                        </div>
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
                            <a href="{{ route('online.news.show', $item['id']) }}" class="news-link text-decoration-none">
                                Xem chi tiết
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Force remove all margins and padding from parent containers
            const removeSpacing = () => {
                const parents = [
                    '.content-wrapper',
                    '.content-section',
                    '.container-fluid',
                    '.container',
                    '.row',
                    '.col',
                    '.card',
                    '.card-body'
                ];

                parents.forEach(selector => {
                    document.querySelectorAll(selector).forEach(element => {
                        element.style.margin = '0';
                        element.style.padding = '0';
                        element.style.borderRadius = '0';
                        element.style.border = 'none';
                        element.style.boxShadow = 'none';
                    });
                });
            };

            // Run immediately and after a short delay to ensure it applies
            removeSpacing();
            setTimeout(removeSpacing, 100);

            // Filter functionality
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
