@extends('client.layouts.master')

@section('title', 'Read to Lead - News Articles')

@section('content')
    <!-- Include Navigation Partial - Full Width -->
    @include('client.read-to-lead.partials.navigation')

    <!-- Main Content with Side Padding -->
    <div class="main-content">
        <div class="container-fluid px-5">
            <!-- Hero Section -->
            <div class="row mb-5">
                <div class="col-lg-8">
                    <!-- Main Featured Article -->
                    <div class="position-relative hero-article mb-4">
                        <img src="{{ asset('images/placeholder.jpg') }}" class="img-fluid w-100" alt="Main article">
                        <div class="hero-overlay">
                            <span class="badge bg-primary mb-2">DISCOVERY</span>
                            <h2 class="text-white mb-2">The Future of Space Exploration: New Frontiers</h2>
                            <p class="text-white-50 mb-2">Discover the latest breakthroughs in space technology and upcoming
                                missions to Mars...</p>
                            <div class="d-flex align-items-center text-white-50">
                                <span class="me-3"><i class="fas fa-clock"></i> 15 min read</span>
                                <span><i class="fas fa-signal"></i> Advanced</span>
                            </div>
                        </div>
                        <a href="{{ route('client.read-to-lead.article.detail', 1) }}" class="stretched-link"></a>
                    </div>

                    <!-- Secondary Featured Articles -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="position-relative secondary-article">
                                <img src="{{ asset('images/placeholder.jpg') }}" class="img-fluid w-100"
                                    alt="Secondary article">
                                <div class="article-overlay">
                                    <span class="badge bg-success mb-2">HEALTH & LIFESTYLE</span>
                                    <h4 class="text-white">Mindful Living: A Guide to Better Health</h4>
                                    <div class="d-flex align-items-center text-white-50">
                                        <span class="me-3"><i class="fas fa-clock"></i> 8 min read</span>
                                        <span><i class="fas fa-signal"></i> Beginner</span>
                                    </div>
                                </div>
                                <a href="{{ route('client.read-to-lead.article.detail', 2) }}" class="stretched-link"></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative secondary-article">
                                <img src="{{ asset('images/placeholder.jpg') }}" class="img-fluid w-100"
                                    alt="Secondary article">
                                <div class="article-overlay">
                                    <span class="badge bg-danger mb-2">CULTURE</span>
                                    <h4 class="text-white">Traditional Festivals Around the World</h4>
                                    <div class="d-flex align-items-center text-white-50">
                                        <span class="me-3"><i class="fas fa-clock"></i> 10 min read</span>
                                        <span><i class="fas fa-signal"></i> Intermediate</span>
                                    </div>
                                </div>
                                <a href="{{ route('client.read-to-lead.article.detail', 3) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="card sidebar-card">
                        <div class="card-body">
                            <h5 class="section-title">Popular Articles</h5>
                            <div class="popular-articles">
                                @php
                                    $popularArticles = [
                                        [
                                            'id' => 4,
                                            'title' => 'The Art of Japanese Cuisine',
                                            'category' => 'CUISINE',
                                            'reading_time' => 7,
                                            'level' => 'Intermediate',
                                        ],
                                        [
                                            'id' => 5,
                                            'title' => 'Sustainable Tourism Trends',
                                            'category' => 'TRAVEL',
                                            'reading_time' => 5,
                                            'level' => 'Beginner',
                                        ],
                                        [
                                            'id' => 6,
                                            'title' => 'Modern Art Movements',
                                            'category' => 'CULTURE',
                                            'reading_time' => 12,
                                            'level' => 'Advanced',
                                        ],
                                        [
                                            'id' => 7,
                                            'title' => 'Wellness and Mental Health',
                                            'category' => 'HEALTH & LIFESTYLE',
                                            'reading_time' => 8,
                                            'level' => 'Beginner',
                                        ],
                                    ];
                                @endphp

                                @foreach ($popularArticles as $index => $article)
                                    <div class="popular-article-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <span class="popular-number">{{ $index + 1 }}</span>
                                            </div>
                                            <div class="col-10">
                                                <a href="{{ route('client.read-to-lead.article.detail', $article['id']) }}" class="text-decoration-none">
                                                    <div class="popular-article-content">
                                                        <span class="badge bg-secondary mb-1">{{ $article['category'] }}</span>
                                                        <h6 class="mb-1">{{ $article['title'] }}</h6>
                                                        <div class="d-flex align-items-center small text-muted">
                                                            <span class="me-2"><i class="fas fa-clock"></i>
                                                                {{ $article['reading_time'] }} min</span>
                                                            <span><i class="fas fa-signal"></i> {{ $article['level'] }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Articles Grid -->
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="section-title mb-4">Latest Articles</h2>
                    <div class="row g-4">
                        @php
                            $latestArticles = collect([
                                [
                                    'id' => 8,
                                    'title' => 'The Rise of Plant-Based Cuisine',
                                    'category' => 'CUISINE',
                                    'level' => 'Intermediate',
                                    'reading_time' => 8,
                                    'image' => 'images/placeholder.jpg',
                                    'excerpt' =>
                                        'Exploring the growing trend of plant-based eating and its impact on global cuisine...',
                                ],
                                [
                                    'id' => 9,
                                    'title' => 'Ancient Wonders Rediscovered',
                                    'category' => 'DISCOVERY',
                                    'level' => 'Advanced',
                                    'reading_time' => 15,
                                    'image' => 'images/placeholder.jpg',
                                    'excerpt' =>
                                        'New archaeological findings that are changing our understanding of ancient civilizations...',
                                ],
                                [
                                    'id' => 10,
                                    'title' => 'Digital Nomad Lifestyle',
                                    'category' => 'TRAVEL',
                                    'level' => 'Beginner',
                                    'reading_time' => 10,
                                    'image' => 'images/placeholder.jpg',
                                    'excerpt' => 'How technology is enabling a new way of working and traveling...',
                                ],
                                [
                                    'id' => 11,
                                    'title' => 'The Science of Sleep',
                                    'category' => 'HEALTH & LIFESTYLE',
                                    'level' => 'Intermediate',
                                    'reading_time' => 12,
                                    'image' => 'images/placeholder.jpg',
                                    'excerpt' => 'Understanding the importance of quality sleep and how to improve it...',
                                ],
                            ]);
                        @endphp

                        @foreach ($latestArticles as $article)
                            <div class="col-md-6 col-lg-3">
                                <div class="card article-card h-100">
                                    <img src="{{ asset($article['image']) }}" class="card-img-top"
                                        alt="{{ $article['title'] }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="badge bg-primary">{{ $article['level'] }}</span>
                                            <span class="badge bg-secondary">{{ $article['category'] }}</span>
                                        </div>
                                        <h5 class="card-title">{{ $article['title'] }}</h5>
                                        <p class="card-text">{{ $article['excerpt'] }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('client.read-to-lead.article.detail', $article['id']) }}" class="btn btn-outline-primary btn-sm">Read Now</a>
                                            <div class="text-muted small">
                                                <i class="fas fa-clock"></i> {{ $article['reading_time'] }} min
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Category Sections -->
            <div class="row g-4 mb-5">
                <!-- Health & Lifestyle Section -->
                <div class="col-md-6">
                    <div class="category-section">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="section-title">Health & Lifestyle</h3>
                            <a href="{{ route('client.read-to-lead.health') }}" class="btn btn-link">View All</a>
                        </div>
                        <div class="category-articles">
                            <!-- Featured Category Article -->
                            <div class="position-relative category-featured-article mb-4">
                                <img src="{{ asset('images/placeholder.jpg') }}" class="img-fluid w-100" alt="Health article">
                                <div class="article-overlay">
                                    <span class="badge bg-success mb-2">HEALTH & LIFESTYLE</span>
                                    <h4 class="text-white">The Mediterranean Diet Revolution</h4>
                                    <div class="d-flex align-items-center text-white-50">
                                        <span class="me-3"><i class="fas fa-clock"></i> 10 min read</span>
                                        <span><i class="fas fa-signal"></i> Intermediate</span>
                                    </div>
                                </div>
                                <a href="{{ route('client.read-to-lead.article.detail', 12) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Culture Section -->
                <div class="col-md-6">
                    <div class="category-section">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="section-title">Culture</h3>
                            <a href="{{ route('client.read-to-lead.culture') }}" class="btn btn-link">View All</a>
                        </div>
                        <div class="category-articles">
                            <!-- Featured Category Article -->
                            <div class="position-relative category-featured-article mb-4">
                                <img src="{{ asset('images/placeholder.jpg') }}" class="img-fluid w-100"
                                    alt="Culture article">
                                <div class="article-overlay">
                                    <span class="badge bg-danger mb-2">CULTURE</span>
                                    <h4 class="text-white">Contemporary Art in the Digital Age</h4>
                                    <div class="d-flex align-items-center text-white-50">
                                        <span class="me-3"><i class="fas fa-clock"></i> 12 min read</span>
                                        <span><i class="fas fa-signal"></i> Advanced</span>
                                    </div>
                                </div>
                                <a href="{{ route('client.read-to-lead.article.detail', 13) }}" class="stretched-link"></a>
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
        .main-content {
            padding-left: 120px;
            padding-right: 120px;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        @media (max-width: 1400px) {
            .main-content {
                padding-left: 80px;
                padding-right: 80px;
            }
        }

        @media (max-width: 992px) {
            .main-content {
                padding-left: 40px;
                padding-right: 40px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        /* Hero Section Styles */
        .hero-article {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            height: 500px;
        }

        .hero-article img {
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }

        /* Secondary Articles */
        .secondary-article {
            border-radius: 15px;
            overflow: hidden;
            height: 300px;
        }

        .secondary-article img {
            height: 100%;
            object-fit: cover;
        }

        .article-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }

        /* Sidebar Styles */
        .sidebar-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .popular-article-item {
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .popular-article-item:last-child {
            border-bottom: none;
        }

        .popular-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }

        /* Category Sections */
        .category-section {
            background: #fff;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .category-featured-article {
            border-radius: 10px;
            overflow: hidden;
            height: 250px;
        }

        /* General Styles */
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #007bff;
        }

        .article-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            color: #333;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-article {
                height: 300px;
            }

            .secondary-article {
                height: 200px;
            }

            .category-featured-article {
                height: 200px;
            }
        }
    </style>
@endpush
