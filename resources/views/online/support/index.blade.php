@extends('online.layouts.master')

@section('title', 'Hỗ trợ')

@section('content')
<div class="content-section">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-question-circle me-2"></i>Trung tâm Hỗ trợ
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Form gửi yêu cầu hỗ trợ -->
                            <h6 class="fw-bold mb-4">Gửi yêu cầu hỗ trợ mới</h6>
                            
                            @if(session('success'))
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                </div>
                            @endif
                            
                            <form action="{{ route('online.support.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" required value="{{ old('subject') }}">
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Mức độ ưu tiên <span class="text-danger">*</span></label>
                                    <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                                        <option value="">-- Chọn mức độ ưu tiên --</option>
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Thấp</option>
                                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Trung bình</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Cao</option>
                                    </select>
                                    @error('priority')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Mô tả chi tiết vấn đề bạn đang gặp phải. Thông tin càng cụ thể, chúng tôi càng hỗ trợ bạn tốt hơn.</div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="attachment" class="form-label">Đính kèm tập tin (nếu có)</label>
                                    <input class="form-control @error('attachment') is-invalid @enderror" type="file" id="attachment" name="attachment">
                                    @error('attachment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Hỗ trợ các định dạng: .jpg, .png, .pdf, .doc, .docx. Kích thước tối đa: 5MB.</div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i>Gửi yêu cầu hỗ trợ
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Thông tin liên hệ</h6>
                                    <p>Bạn có thể liên hệ với bộ phận hỗ trợ của chúng tôi qua các kênh sau:</p>
                                    
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <a href="mailto:support@amazingyou.edu.vn" class="text-decoration-none">support@amazingyou.edu.vn</a>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            <a href="tel:+84123456789" class="text-decoration-none">+84 123 456 789</a>
                                        </li>
                                        <li>
                                            <i class="fab fa-facebook-messenger text-primary me-2"></i>
                                            <a href="#" class="text-decoration-none">Messenger</a>
                                        </li>
                                    </ul>
                                    
                                    <hr class="my-4">
                                    
                                    <h6 class="fw-bold mb-3">Giờ hỗ trợ</h6>
                                    <p class="mb-0">Thứ Hai - Thứ Sáu: 8:00 - 17:30</p>
                                    <p class="mb-0">Thứ Bảy: 8:00 - 12:00</p>
                                    <p>Chủ Nhật: Nghỉ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Danh sách các yêu cầu hỗ trợ đã gửi -->
                    <div class="row mt-5">
                        <div class="col-12">
                            <h6 class="fw-bold mb-4">Lịch sử yêu cầu hỗ trợ</h6>
                            
                            @if(isset($tickets) && count($tickets) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Ngày yêu cầu</th>
                                                <th>Tiêu đề</th>
                                                <th>Mức độ ưu tiên</th>
                                                <th>Trạng thái</th>
                                                <th>Cập nhật cuối</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tickets as $index => $ticket)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $ticket->created_at ?? date('d/m/Y') }}</td>
                                                    <td>{{ $ticket->subject ?? 'Yêu cầu hỗ trợ' }}</td>
                                                    <td>
                                                        @if(isset($ticket->priority) && $ticket->priority == 'high')
                                                            <span class="badge bg-danger">Cao</span>
                                                        @elseif(isset($ticket->priority) && $ticket->priority == 'medium')
                                                            <span class="badge bg-warning text-dark">Trung bình</span>
                                                        @else
                                                            <span class="badge bg-info text-dark">Thấp</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($ticket->status) && $ticket->status == 'resolved')
                                                            <span class="badge bg-success">Đã giải quyết</span>
                                                        @elseif(isset($ticket->status) && $ticket->status == 'in_progress')
                                                            <span class="badge bg-primary">Đang xử lý</span>
                                                        @else
                                                            <span class="badge bg-secondary">Đang chờ</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $ticket->updated_at ?? date('d/m/Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>Bạn chưa gửi yêu cầu hỗ trợ nào.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Các câu hỏi thường gặp -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-question-circle me-2"></i>Câu hỏi thường gặp
                    </h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Làm thế nào để điểm danh trong lớp học?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Để điểm danh, bạn cần tham gia buổi học và nhấn vào nút "Điểm danh" trong mục điểm danh. Việc điểm danh chỉ có hiệu lực trong 15 phút đầu tiên của buổi học. Chi tiết hơn, bạn có thể tham khảo <a href="{{ route('online.guides.show', 'diem-danh') }}">hướng dẫn điểm danh</a>.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Tôi quên mật khẩu đăng nhập, phải làm thế nào?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Nếu quên mật khẩu, bạn có thể nhấn vào liên kết "Quên mật khẩu" trên trang đăng nhập. Hệ thống sẽ gửi hướng dẫn đặt lại mật khẩu qua email đã đăng ký. Nếu vẫn gặp vấn đề, vui lòng liên hệ với bộ phận hỗ trợ qua email hoặc điện thoại.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Làm thế nào để tham gia buổi học trực tuyến?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Để tham gia buổi học trực tuyến, bạn có thể vào mục "Lớp học của tôi" hoặc "Lịch học", sau đó nhấn vào nút "Tham gia" của buổi học tương ứng. Cần đảm bảo kết nối internet ổn định và thiết bị có camera, microphone để tham gia hiệu quả.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Làm thế nào để xem điểm số và kết quả học tập?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Bạn có thể xem điểm số và kết quả học tập bằng cách vào mục "Điểm" trong menu bên trái. Tại đây, bạn sẽ thấy điểm của tất cả các khóa học và có thể xem chi tiết điểm từng phần bằng cách nhấn vào khóa học cụ thể.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 