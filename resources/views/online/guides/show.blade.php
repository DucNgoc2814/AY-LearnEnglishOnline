@extends('online.layouts.master')

@section('title', isset($guide['title']) ? $guide['title'] : 'Hướng dẫn')

@section('content')
<div class="content-section">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('online.dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('online.guides.index') }}">Hướng dẫn</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ isset($guide['title']) ? $guide['title'] : 'Chi tiết' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fas fa-book me-2"></i>{{ isset($guide['title']) ? $guide['title'] : 'Hướng dẫn sử dụng' }}
                        </h5>
                        <a href="{{ route('online.guides.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($guide) && $guide)
                        <div class="mb-4">
                            <div class="mb-4">
                                <h6 class="fw-bold">Mô tả:</h6>
                                <p>{{ $guide['description'] ?? 'Hướng dẫn chi tiết về cách sử dụng hệ thống học trực tuyến.' }}</p>
                            </div>

                            <!-- Demo content for when guide is null - will be replaced with actual guide content -->
                            @if(!isset($guide['content']) || empty($guide['content']))
                                <div class="guide-content">
                                    <h4>Hướng dẫn sử dụng cơ bản</h4>
                                    
                                    <div class="alert alert-info mb-4">
                                        <i class="fas fa-info-circle me-2"></i>Nội dung này là ví dụ. Nó sẽ được thay thế bằng nội dung thực tế từ cơ sở dữ liệu.
                                    </div>
                                    
                                    <h5 class="mt-4">1. Đăng nhập hệ thống</h5>
                                    <p>Để đăng nhập vào hệ thống, bạn cần thực hiện các bước sau:</p>
                                    <ul>
                                        <li>Truy cập trang web chính thức tại địa chỉ: <a href="#">learning.amazingyou.edu.vn</a></li>
                                        <li>Nhập tên đăng nhập (mã học viên) và mật khẩu của bạn</li>
                                        <li>Nhấn nút "Đăng nhập" để vào hệ thống</li>
                                    </ul>
                                    <div class="text-center my-4">
                                        <img src="https://via.placeholder.com/800x450" alt="Hình ảnh đăng nhập" class="img-fluid rounded shadow-sm">
                                        <p class="text-muted mt-2"><i>Hình 1: Giao diện đăng nhập hệ thống</i></p>
                                    </div>
                                    
                                    <h5 class="mt-4">2. Tham gia lớp học trực tuyến</h5>
                                    <p>Để tham gia một buổi học trực tuyến, bạn có thể thực hiện theo một trong hai cách:</p>
                                    <h6 class="mt-3">Cách 1: Thông qua lịch học</h6>
                                    <ul>
                                        <li>Truy cập mục "Lịch học" trên thanh menu bên trái</li>
                                        <li>Tìm buổi học của bạn trong lịch và nhấn vào nút "Tham gia"</li>
                                    </ul>
                                    
                                    <h6 class="mt-3">Cách 2: Thông qua lớp học</h6>
                                    <ul>
                                        <li>Truy cập mục "Lớp học của tôi" trên thanh menu bên trái</li>
                                        <li>Chọn lớp học cụ thể và tìm buổi học đang diễn ra</li>
                                        <li>Nhấn vào nút "Tham gia buổi học"</li>
                                    </ul>
                                    
                                    <div class="text-center my-4">
                                        <img src="https://via.placeholder.com/800x450" alt="Tham gia lớp học" class="img-fluid rounded shadow-sm">
                                        <p class="text-muted mt-2"><i>Hình 2: Giao diện tham gia lớp học trực tuyến</i></p>
                                    </div>
                                    
                                    <h5 class="mt-4">3. Điểm danh</h5>
                                    <p>Việc điểm danh rất quan trọng để ghi nhận sự tham gia của bạn trong lớp học. Để điểm danh:</p>
                                    <ul>
                                        <li>Sau khi tham gia buổi học, hệ thống sẽ tự động hiển thị cửa sổ điểm danh</li>
                                        <li>Nếu không thấy cửa sổ này, bạn có thể vào mục "Điểm danh" trên thanh menu</li>
                                        <li>Nhấn nút "Điểm danh" để xác nhận sự có mặt của bạn</li>
                                    </ul>
                                    
                                    <div class="alert alert-warning mt-4">
                                        <i class="fas fa-exclamation-triangle me-2"></i><strong>Lưu ý:</strong> Việc điểm danh chỉ có hiệu lực trong khoảng thời gian quy định, thường là 15 phút đầu tiên của buổi học.
                                    </div>
                                </div>
                            @else
                                <div class="guide-content">
                                    {!! $guide['content'] !!}
                                </div>
                            @endif
                        </div>

                        <div class="border-top pt-4">
                            <h6 class="fw-bold mb-3">Tài liệu liên quan</h6>
                            @if(isset($guide['related_documents']) && count($guide['related_documents']) > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach($guide['related_documents'] as $document)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <span>
                                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                                {{ $document['name'] ?? 'Tài liệu hướng dẫn' }}
                                            </span>
                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-download me-1"></i>Tải xuống
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Không có tài liệu liên quan.</p>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-circle me-2"></i>Không tìm thấy hướng dẫn này.
                            <a href="{{ route('online.guides.index') }}" class="alert-link">Quay lại danh sách hướng dẫn</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Hướng dẫn khác</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            <a href="{{ route('online.guides.show', 'co-ban') }}" class="text-decoration-none">
                                <i class="fas fa-angle-right me-2 text-primary"></i>Hướng dẫn cơ bản
                            </a>
                        </li>
                        <li class="list-group-item px-0">
                            <a href="{{ route('online.guides.show', 'hoc-truc-tuyen') }}" class="text-decoration-none">
                                <i class="fas fa-angle-right me-2 text-primary"></i>Học trực tuyến
                            </a>
                        </li>
                        <li class="list-group-item px-0">
                            <a href="{{ route('online.guides.show', 'bai-tap-va-kiem-tra') }}" class="text-decoration-none">
                                <i class="fas fa-angle-right me-2 text-primary"></i>Bài tập và kiểm tra
                            </a>
                        </li>
                        <li class="list-group-item px-0">
                            <a href="{{ route('online.guides.show', 'su-dung-dinh-kem') }}" class="text-decoration-none">
                                <i class="fas fa-angle-right me-2 text-primary"></i>Sử dụng file đính kèm
                            </a>
                        </li>
                        <li class="list-group-item px-0">
                            <a href="{{ route('online.guides.show', 'thay-doi-mat-khau') }}" class="text-decoration-none">
                                <i class="fas fa-angle-right me-2 text-primary"></i>Thay đổi mật khẩu
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Bạn cần hỗ trợ?</h6>
                </div>
                <div class="card-body">
                    <p>Nếu bạn không tìm thấy câu trả lời cho vấn đề của mình, hãy liên hệ với đội ngũ hỗ trợ kỹ thuật của chúng tôi.</p>
                    <a href="{{ route('online.support.index') }}" class="btn btn-primary d-block">
                        <i class="fas fa-headset me-2"></i>Liên hệ hỗ trợ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .guide-content h4, .guide-content h5, .guide-content h6 {
        color: #0d6efd;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .guide-content img {
        max-width: 100%;
        height: auto;
    }
    
    .guide-content code {
        background-color: #f8f9fa;
        padding: 0.2rem 0.4rem;
        border-radius: 0.2rem;
    }
    
    .guide-content blockquote {
        border-left: 3px solid #0d6efd;
        padding-left: 1rem;
        color: #6c757d;
    }
</style>
@endpush 