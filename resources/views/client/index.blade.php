@extends('client.layouts.master')

@section('title', 'EduBlink – Education & Online Course WordPress Theme')

@section('meta')
    <meta name='robots' content='max-image-preview:large' />
    <style>
        img:is([sizes="auto" i],
        [sizes^="auto," i]) {
            contain-intrinsic-size: 3000px 1500px
        }
    </style>
    <link rel="alternate" type="application/rss+xml" title="EduBlink &raquo; Feed" href="feed/index.html" />
    <link rel="alternate" type="application/rss+xml" title="EduBlink &raquo; Comments Feed" href="comments/feed/index.html" />
@endsection

@section('body_class', 'home page-template-default page edublink-page-content')

@section('content')
    <div class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1>Get <span>2500+</span><br>Best Online Courses<br>From EduBlink</h1>
                        <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.</p>
                        <div class="hero-btn-group">
                            <a href="{{ url('/courses') }}" class="edu-btn">Find courses <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="{{ asset('themes/client/assets/images/hero-image.png') }}" alt="Hero Image">
                        <div class="shape-group">
                            <img src="{{ asset('themes/client/assets/images/shape-1.png') }}" alt="Shape" class="shape-1">
                            <img src="{{ asset('themes/client/assets/images/shape-2.png') }}" alt="Shape" class="shape-2">
                        </div>
                        <div class="instructor-card">
                            <h5>Instructor</h5>
                            <p>200+ Instactors</p>
                            <div class="instructor-images">
                                <img src="{{ asset('themes/client/assets/images/instructor-1.jpg') }}" alt="Instructor">
                                <img src="{{ asset('themes/client/assets/images/instructor-2.jpg') }}" alt="Instructor">
                                <img src="{{ asset('themes/client/assets/images/instructor-3.jpg') }}" alt="Instructor">
                                <img src="{{ asset('themes/client/assets/images/instructor-4.jpg') }}" alt="Instructor">
                                <span class="instructor-count">+</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="categories-area section-gap-equal">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="title">Top Categories</h2>
                <p>Explore our popular course categories</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="category-box">
                        <div class="icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="content">
                            <h5><a href="#">Development</a></h5>
                            <p>40 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="category-box">
                        <div class="icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <div class="content">
                            <h5><a href="#">Design</a></h5>
                            <p>35 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="category-box">
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="content">
                            <h5><a href="#">Business</a></h5>
                            <p>25 Courses</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="category-box">
                        <div class="icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="content">
                            <h5><a href="#">Marketing</a></h5>
                            <p>30 Courses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Courses Section -->
    <div class="courses-area section-gap-equal bg-color-light">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="title">Popular Courses</h2>
                <p>Explore our most popular courses</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="course-card">
                        <div class="course-image">
                            <a href="#">
                                <img src="{{ asset('themes/client/assets/images/course-1.jpg') }}" alt="Course Image">
                            </a>
                            <div class="course-price">$49</div>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="category">Development</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>(4.5)</span>
                                </div>
                            </div>
                            <h4 class="title"><a href="#">Web Development Masterclass</a></h4>
                            <p>Master the basics of web development with HTML, CSS, and JavaScript</p>
                            <div class="course-footer">
                                <div class="author">
                                    <img src="{{ asset('themes/client/assets/images/instructor-1.jpg') }}" alt="Author">
                                    <span>John Smith</span>
                                </div>
                                <div class="lessons">
                                    <i class="fas fa-book-open"></i>
                                    <span>24 Lessons</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="course-card">
                        <div class="course-image">
                            <a href="#">
                                <img src="{{ asset('themes/client/assets/images/course-2.jpg') }}" alt="Course Image">
                            </a>
                            <div class="course-price">$79</div>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="category">Design</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span>(5.0)</span>
                                </div>
                            </div>
                            <h4 class="title"><a href="#">UI/UX Design Principles</a></h4>
                            <p>Learn the fundamentals of UI/UX design and create stunning interfaces</p>
                            <div class="course-footer">
                                <div class="author">
                                    <img src="{{ asset('themes/client/assets/images/instructor-2.jpg') }}" alt="Author">
                                    <span>Sarah Johnson</span>
                                </div>
                                <div class="lessons">
                                    <i class="fas fa-book-open"></i>
                                    <span>32 Lessons</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="course-card">
                        <div class="course-image">
                            <a href="#">
                                <img src="{{ asset('themes/client/assets/images/course-3.jpg') }}" alt="Course Image">
                            </a>
                            <div class="course-price">$99</div>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="category">Business</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <span>(4.0)</span>
                                </div>
                            </div>
                            <h4 class="title"><a href="#">Business Strategy Fundamentals</a></h4>
                            <p>Develop effective business strategies for growth and success</p>
                            <div class="course-footer">
                                <div class="author">
                                    <img src="{{ asset('themes/client/assets/images/instructor-3.jpg') }}" alt="Author">
                                    <span>Michael Brown</span>
                                </div>
                                <div class="lessons">
                                    <i class="fas fa-book-open"></i>
                                    <span>40 Lessons</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="course-view-all text-center">
                <a href="{{ url('/courses') }}" class="edu-btn">View All Courses <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
@endsection
