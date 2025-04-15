@extends('online.layouts.master')

@section('title', 'Hướng dẫn sử dụng')

@section('content')
    <div class="row mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 text-primary">
                    <i class="fas fa-book me-2"></i>Hướng dẫn sử dụng
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="fas fa-laptop text-primary fs-1"></i>
                                </div>
                                <h5 class="card-title text-center mb-3">Hướng dẫn cơ bản</h5>
                                <p class="card-text text-muted">Tìm hiểu những tính năng cơ bản của hệ thống học trực
                                    tuyến và cách sử dụng hiệu quả.</p>
                            </div>
                            <div class="card-footer bg-white border-0 text-center">
                                <a href="{{ route('online.guides.show', 'co-ban') }}" class="btn btn-outline-primary">
                                    Xem hướng dẫn
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="fas fa-video text-primary fs-1"></i>
                                </div>
                                <h5 class="card-title text-center mb-3">Học trực tuyến</h5>
                                <p class="card-text text-muted">Hướng dẫn chi tiết về cách tham gia các buổi học trực
                                    tuyến, tương tác với giảng viên và bạn học.</p>
                            </div>
                            <div class="card-footer bg-white border-0 text-center">
                                <a href="{{ route('online.guides.show', 'hoc-truc-tuyen') }}"
                                    class="btn btn-outline-primary">
                                    Xem hướng dẫn
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="fas fa-tasks text-primary fs-1"></i>
                                </div>
                                <h5 class="card-title text-center mb-3">Bài tập và kiểm tra</h5>
                                <p class="card-text text-muted">Cách làm bài tập, nộp bài và tham gia kiểm tra trực
                                    tuyến hiệu quả.</p>
                            </div>
                            <div class="card-footer bg-white border-0 text-center">
                                <a href="{{ route('online.guides.show', 'bai-tap-va-kiem-tra') }}"
                                    class="btn btn-outline-primary">
                                    Xem hướng dẫn
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if (isset($guides) && count($guides) > 0)
                        @foreach ($guides as $guide)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="text-center mb-3">
                                            <i class="fas fa-file-alt text-primary fs-1"></i>
                                        </div>
                                        <h5 class="card-title text-center mb-3">
                                            {{ $guide['title'] ?? 'Tiêu đề hướng dẫn' }}</h5>
                                        <p class="card-text text-muted">
                                            {{ $guide['description'] ?? 'Mô tả nội dung hướng dẫn' }}</p>
                                    </div>
                                    <div class="card-footer bg-white border-0 text-center">
                                        <a href="{{ route('online.guides.show', $guide['id'] ?? 'guide') }}"
                                            class="btn btn-outline-primary">
                                            Xem hướng dẫn
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="mt-4">
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <h5 class="mb-3">Cần trợ giúp thêm?</h5>
                            <p>Nếu bạn không tìm thấy thông tin cần thiết trong các hướng dẫn trên, vui lòng liên hệ với
                                bộ phận hỗ trợ của chúng tôi.</p>
                            <a href="{{ route('online.support.index') }}" class="btn btn-primary">
                                <i class="fas fa-headset me-2"></i>Liên hệ hỗ trợ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
