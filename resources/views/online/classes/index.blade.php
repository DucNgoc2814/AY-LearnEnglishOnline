@extends('online.layouts.master')

@section('title', 'My Classes')

@push('styles')
    <style>
        :root {
            --primary-color: #2962ff;
            --primary-hover: #1565c0;
            --success-color: #2e7d32;
            --success-light: #e8f5e9;
            --warning-color: #ed6c02;
            --warning-light: #fff4e5;
            --info-color: #0288d1;
            --info-light: #e1f5fe;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
        }

        .class-card {
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            background: #fff;
            overflow: hidden;
        }

        .class-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .class-header {
            padding: 20px;
            border-bottom: 1px solid var(--gray-300);
        }

        .class-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 10px;
        }

        .class-info {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 10px;
        }

        .info-item {
            display: flex;
            align-items: center;
            color: var(--gray-600);
            font-size: 14px;
            margin-right: 15px;
        }

        .info-item i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        .class-content {
            padding: 20px;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            min-width: 120px;
            margin-right: 10px;
        }

        .btn-view {
            background-color: var(--primary-color);
            color: white !important;
        }

        .btn-view:hover {
            background-color: var(--primary-hover);
        }

        .btn-locked {
            background-color: var(--gray-600);
            color: white !important;
            cursor: not-allowed;
        }

        .course-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .course-description {
            color: var(--gray-600);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .class-info {
                flex-direction: column;
                gap: 10px;
            }

            .action-btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 text-primary">
                    <i class="fas fa-graduation-cap me-2"></i>My Courses
                </h5>
            </div>
            <div class="card-body">
                <div class="class-list">
                    <!-- Course 1 -->
                    <div class="class-card">
                                    <div class="class-header">
                            <img src="{{ asset('images/course1.jpg') }}" alt="Course 1" class="course-image">
                            <h3 class="class-title">Basic IELTS Course</h3>
                                        <div class="class-info">
                                            <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>3 months</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-book"></i>
                                    <span>12 lessons</span>
                                            </div>
                                            <div class="info-item">
                                    <i class="fas fa-signal"></i>
                                    <span>Basic</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="class-content">
                            <p class="course-description">
                                Basic IELTS course for beginners, helping to build a solid foundation for the IELTS exam.
                            </p>
                                        <div class="class-actions">
                                @if($hasAccessToCourse1)
                                    <a href="{{ route('online.courses.show') }}" class="action-btn btn-view">
                                        <i class="fas fa-eye me-2"></i>View Course
                                            </a>
                                @else
                                    <button class="action-btn btn-locked" disabled>
                                        <i class="fas fa-lock me-2"></i>Not Enrolled
                                    </button>
                                @endif
                                        </div>
                                    </div>
                                </div>

                    <!-- Course 2 -->
                    <div class="class-card">
                                    <div class="class-header">
                            <img src="{{ asset('images/course2.jpg') }}" alt="Course 2" class="course-image">
                            <h3 class="class-title">Intermediate IELTS Course</h3>
                                        <div class="class-info">
                                            <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>4 months</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-book"></i>
                                    <span>16 lessons</span>
                                            </div>
                                            <div class="info-item">
                                    <i class="fas fa-signal"></i>
                                    <span>Intermediate</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="class-content">
                            <p class="course-description">
                                Intermediate IELTS course to enhance skills and aim for band scores 6.0-7.0.
                            </p>
                                        <div class="class-actions">
                                @if($hasAccessToCourse2)
                                    <a href="{{ route('online.courses.show2') }}" class="action-btn btn-view">
                                        <i class="fas fa-eye me-2"></i>View Course
                                            </a>
                                @else
                                    <button class="action-btn btn-locked" disabled>
                                        <i class="fas fa-lock me-2"></i>Not Enrolled
                                    </button>
                                @endif
                                        </div>
                                    </div>
                                </div>

                    <!-- Course 3 -->
                    <div class="class-card">
                                    <div class="class-header">
                            <img src="{{ asset('images/course3.jpg') }}" alt="Course 3" class="course-image">
                            <h3 class="class-title">Advanced IELTS Course</h3>
                                        <div class="class-info">
                                            <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>4 months</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-book"></i>
                                    <span>20 lessons</span>
                                            </div>
                                            <div class="info-item">
                                    <i class="fas fa-signal"></i>
                                    <span>Advanced</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="class-content">
                            <p class="course-description">
                                Advanced IELTS course for students aiming to achieve band scores 7.0-8.0.
                            </p>
                            <div class="class-actions">
                                @if($hasAccessToCourse3)
                                    <a href="{{ route('online.courses.show3') }}" class="action-btn btn-view">
                                        <i class="fas fa-eye me-2"></i>View Course
                                    </a>
                                                @else
                                    <button class="action-btn btn-locked" disabled>
                                        <i class="fas fa-lock me-2"></i>Not Enrolled
                                    </button>
                                                @endif
                                            </div>
                        </div>
                    </div>

                    <!-- Course 4 -->
                    <div class="class-card">
                        <div class="class-header">
                            <img src="{{ asset('images/course4.jpg') }}" alt="Course 4" class="course-image">
                            <h3 class="class-title">Expert IELTS Course</h3>
                            <div class="class-info">
                                <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>6 months</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-book"></i>
                                    <span>24 lessons</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-signal"></i>
                                    <span>Expert</span>
                                                </div>
                                            </div>
                                        </div>
                        <div class="class-content">
                            <p class="course-description">
                                Expert IELTS course helping students achieve band scores 8.0-9.0 and master all skills.
                            </p>
                                        <div class="class-actions">
                                @if($hasAccessToCourse4)
                                    <a href="{{ route('online.courses.show4') }}" class="action-btn btn-view">
                                        <i class="fas fa-eye me-2"></i>View Course
                                            </a>
                                @else
                                    <button class="action-btn btn-locked" disabled>
                                        <i class="fas fa-lock me-2"></i>Not Enrolled
                                    </button>
                                @endif
                                        </div>
                                    </div>
                                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
