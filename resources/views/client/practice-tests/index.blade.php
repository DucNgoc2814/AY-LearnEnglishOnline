@extends('client.layouts.master')

@section('title', 'Bài Thi Thử TOEIC')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">Bài Thi Thử TOEIC</h1>
            
            <div class="row g-4">
                <!-- Bài thi thử Full Test -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Full Test TOEIC</h5>
                            <p class="card-text">
                                <i class="fas fa-clock me-2"></i> 120 phút<br>
                                <i class="fas fa-question-circle me-2"></i> 200 câu hỏi<br>
                                <i class="fas fa-star me-2"></i> Mô phỏng thi thật
                            </p>
                            <a href="#" class="btn btn-primary w-100">Bắt đầu thi</a>
                        </div>
                    </div>
                </div>

                <!-- Mini Test Listening -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Mini Test - Listening</h5>
                            <p class="card-text">
                                <i class="fas fa-clock me-2"></i> 45 phút<br>
                                <i class="fas fa-question-circle me-2"></i> 100 câu hỏi<br>
                                <i class="fas fa-headphones me-2"></i> Tập trung Listening
                            </p>
                            <a href="#" class="btn btn-primary w-100">Bắt đầu thi</a>
                        </div>
                    </div>
                </div>

                <!-- Mini Test Reading -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Mini Test - Reading</h5>
                            <p class="card-text">
                                <i class="fas fa-clock me-2"></i> 45 phút<br>
                                <i class="fas fa-question-circle me-2"></i> 100 câu hỏi<br>
                                <i class="fas fa-book-reader me-2"></i> Tập trung Reading
                            </p>
                            <a href="#" class="btn btn-primary w-100">Bắt đầu thi</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin thêm -->
            <div class="mt-5">
                <h3 class="text-center mb-4">Tại sao nên làm bài thi thử?</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-chart-line fa-3x mb-3 text-primary"></i>
                            <h5>Đánh giá trình độ</h5>
                            <p>Biết được điểm mạnh, điểm yếu của bản thân</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-clock fa-3x mb-3 text-primary"></i>
                            <h5>Làm quen định dạng</h5>
                            <p>Hiểu rõ cấu trúc và thời gian của bài thi thật</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-graduation-cap fa-3x mb-3 text-primary"></i>
                            <h5>Cải thiện kỹ năng</h5>
                            <p>Luyện tập và nâng cao khả năng làm bài</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .fa-3x {
        color: #007bff;
    }
</style>
@endpush 