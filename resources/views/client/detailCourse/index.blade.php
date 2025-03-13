@extends('client.layouts.master')
@section('title', 'Chi tiết khóa học')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush
@push('styles')
    <style>
        .button a.enrolled {
            background-color: #22c55e;
            /* green-500 */
            color: white;
            transition: all 0.3s ease;
        }

        .button a.enrolled:hover {
            background-color: #16a34a;
            /* green-600 */
        }
    </style>
@endpush
@section('content')
    @include('client.detailCourse.bannerCourse')
    <section class="course-decription">
        <div class="container">
            <div class="row">
                @include('client.detailCourse.tabList')
                <div class="col-lg-4 col-md-12 col-sm-12 order-1 order-lg-2">
                    <div class="course-right-section">
                        <div class="course-card">
                            <div class="card-img">
                                <div class="courses-card-image">
                                    <img loading="lazy" class="w-100"
                                        src="{{ asset('themes/client/uploads/thumbnails/course_thumbnails/optimized/course_thumbnail_default-new_131701063901.jpg') }}">
                                </div>
                            </div>
                            <div class="ammount d-flex">
                                <h1 class="fw-500 text-danger">{{ number_format($course->salePrice, 0, ',', '.') }}đ</h1>
                                <h3 class="fw-500"><del>{{ number_format($course->price, 0, ',', '.') }}đ</del></h3>
                            </div>
                            <div class="enrol">
                                <div class="icon">
                                    <i class="fas fa-book text-primary"></i>
                                    <h4 class="ms-2">Bài học</h4>
                                </div>
                                <h5>{{ $course->totalLessons() }}</h5>
                            </div>

                            <div class="enrol">
                                <div class="icon">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <h4 class="ms-2">Bài kiểm tra</h4>
                                </div>

                                <h5>{{ $course->totalTests() }}</h5>
                            </div>

                            <div class="enrol">
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                    <h4 class="ms-2">Thời lượng</h4>
                                </div>
                                <h5>{{ $course->totalDuration() }}</h5>
                            </div>

                            <div class="enrol">
                                <div class="icon">
                                    <i class="fas fa-graduation-cap text-warning"></i>
                                    <h4 class="ms-2">Bằng cấp</h4>
                                </div>
                                <h5>Có</h5>
                            </div>


                            <!-- button -->
                            <div class="button">
                                @if ($isEnrolled)
                                    <a href="{{ route('course.learning', $course->slug) }}" class="enrolled">
                                        <i class="fas fa-play-circle"></i> Vào học
                                    </a>
                                @else
                                    <a href="#" id="openBuyNowModal">
                                        <i class="fas fa-credit-card"></i> Mua ngay
                                    </a>
                                @endif
                            </div>

                            <!-- Custom Modal -->
                            <div id="buyNowModal" class="custom-modal">
                                <div class="custom-modal-overlay"></div>
                                <div class="custom-modal-container">
                                    <div class="custom-modal-content">
                                        <button type="button" class="custom-modal-close" id="closeModal">&times;</button>

                                        <div class="custom-modal-flex-container">
                                            <!-- Left Column - Course Info -->
                                            <div class="custom-modal-left-column">
                                                <div class="custom-modal-course-header">
                                                    <div class="custom-modal-course-logo">
                                                        <img src="{{ asset('themes/client/uploads/thumbnails/course_thumbnails/optimized/course_thumbnail_default-new_131701063901.jpg') }}"
                                                            alt="Course logo">
                                                    </div>
                                                    <h2 class="custom-modal-course-title">Khóa học {{ $course->name }}</h2>
                                                </div>
                                                <p class="custom-modal-course-description">
                                                    Khóa học {{ $course->name }} này là nền tảng vững chắc để học tiếp
                                                    React, Vue.js, Node.js, v.v.
                                                    Mục tiêu là giúp bạn có thể làm chủ {{ $course->name }} thông qua việc
                                                    am hiểu cơ chế hoạt động của ngôn ngữ.
                                                </p>

                                                <div class="custom-modal-benefits">
                                                    <h3>Bạn nhận được gì từ khóa học này?</h3>
                                                    <ul>
                                                        <li>Hiểu sâu sắc về ngôn ngữ {{ $course->name }}</li>
                                                        <li>Thành thạo tư duy lập trình, kỹ thuật lập trình</li>
                                                        <li>Xây dựng được các ứng dụng web phức tạp</li>
                                                        <li>Hiểu về RESTful API, làm việc với API</li>
                                                        <li>Xây dựng được ứng dụng web thời gian thực</li>
                                                        <li>Bạn sẽ được nhiều hơn với số tiền bỏ ra!</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- Right Column - Payment Details -->
                                            <div class="custom-modal-right-column">
                                                <div class="custom-modal-payment-form">
                                                    <form action="{{ route('payment.qr', $course->slug) }}" method="GET">
                                                        <h3 class="custom-modal-payment-title">Chi tiết thanh toán</h3>

                                                        <div class="custom-modal-payment-details">
                                                            <div class="custom-modal-price-row">
                                                                <span class="custom-modal-price-label">Giá gốc</span>
                                                                <span
                                                                    class="custom-modal-original-price">{{ number_format($course->price) }}đ</span>
                                                            </div>

                                                            <div class="custom-modal-price-row">
                                                                <span class="custom-modal-price-label">Giá ưu đãi hôm
                                                                    nay</span>
                                                                <span
                                                                    class="custom-modal-sale-price">{{ number_format($course->salePrice) }}đ</span>
                                                            </div>

                                                            <!-- Thêm div hiển thị giá giảm từ voucher -->
                                                            <div class="custom-modal-price-row voucher-discount"
                                                                style="display: none;">
                                                                <span class="custom-modal-price-label">Giảm giá
                                                                    voucher</span>
                                                                <span class="custom-modal-voucher-discount">-0đ</span>
                                                            </div>

                                                            <div class="custom-modal-coupon">
                                                                <input type="hidden" name="amount"
                                                                    value="{{ $course->salePrice }}" id="final-amount">
                                                                <input type="hidden" name="discount_amount" value="0"
                                                                    id="discount-amount">
                                                                <input type="text" name="coupon_code"
                                                                    placeholder="Nhập mã giảm giá (nếu có)"
                                                                    class="custom-modal-coupon-input" value="">
                                                                <button type="button" class="custom-modal-coupon-btn">Áp
                                                                    dụng</button>
                                                            </div>

                                                            <div class="custom-modal-coupon-link">
                                                                <a href="#"><i class="fas fa-tag"></i> Xem danh sách
                                                                    mã giảm giá</a>
                                                            </div>

                                                            <div class="custom-modal-total">
                                                                <span class="custom-modal-total-label">TỔNG</span>
                                                                <span
                                                                    class="custom-modal-total-price">{{ number_format($course->salePrice) }}đ</span>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="custom-modal-checkout-btn">
                                                            Tiếp tục thanh toán
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    @include('client.detailCourse.relatedCourse')
@endsection



@push('scripts')
    <script src="{{ asset('js/detailCourse.js') }}"></script>
@endpush
