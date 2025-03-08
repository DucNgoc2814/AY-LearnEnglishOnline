@extends('admin.layouts.master')
@section('title', 'Quản lý khóa học')
@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="dashboard_header mb_50">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="dashboard_header_title">
                                    <h3>Danh sách khóa học</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p><a href="javascript:;">Dashboard</a> <i class="fas fa-caret-right"></i> Khóa học</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Khóa học</h4>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form action="{{ route('admin.courses.index') }}" method="GET">
                                            <div class="search_field">
                                                <input type="text" name="search" placeholder="Tìm kiếm..."
                                                    value="{{ request('search') }}">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="add_button ms-2">
                                    <button type="button" class="btn_1 btn_add" data-bs-toggle="modal"
                                        data-bs-target="#createCategoryModal">
                                        Thêm mới
                                    </button>
                                </div>
                                <div class="add_button ms-2">
                                    <button type="button" class="btn_1 btn_trash" data-bs-toggle="modal"
                                        data-bs-target="#trashCourseModal">
                                        Xem khóa học đã xóa
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="QA_table mb_30">
                            <div class="dataTables_wrapper no-footer">
                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên danh mục</th>
                                            <th scope="col">Tên khóa học</th>
                                            <th scope="col">Ảnh khóa học</th>
                                            <th scope="col">Giá khóa học</th>
                                            <th scope="col">Giá giảm khóa học</th>
                                            <th scope="col">Số bài học</th>
                                            <th scope="col">Lượt đánh giá trung bình</th>
                                            <th scope="col">Thời gian phát hành</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->category->name ?? 'N/A' }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td><img src="{{ asset($item->thumbnail) }}" alt="{{ $item->name }}" width="50"></td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->salePrice }}</td>
                                                <td>{{ $item->totalLessons() }}</td>
                                                <td>{{ $item->ratings->avg('rating') ?? 'N/A' }}</td>
                                                <td>{{ $item->releaseTime->format('d/m/Y') }}</td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <button type="button"
                                                            class="action_btn mr_10 btn btn-outline-info btn-sm view-course-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showCourseModal"
                                                            onclick="showCourseDetails({{ $item->id }})"
                                                            title="Xem chi tiết">
                                                            <i class="far fa-eye"></i>
                                                        </button>
                                                        <button type="button"
                                                            class="action_btn mr_10 btn btn-outline-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editCourseModal"
                                                            onclick="populateEditModal({{ json_encode($item) }})"
                                                            title="Chỉnh sửa">
                                                            <i class="far fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.courses.destroy', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="action_btn mr_10 btn btn-outline-danger btn-sm"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?')"
                                                                title="Xóa">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="dataTables_paginate paging_simple_numbers mt-3"
                                    id="DataTables_Table_0_paginate">
                                    {{ $items->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Create Modal -->
    @include('admin.components.courses.modals.create')

    <!-- Include Trash Modal -->
    @include('admin.components.courses.modals.trash')

    <!-- Include Edit Modal -->
    @include('admin.components.courses.modals.edit')

    <!-- Include Show Modal -->
    @include('admin.components.courses.modals.show')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Xóa tất cả event listener cũ
            $('.btn_add, .btn_trash').off('click');

            // Event cho nút thêm mới
            $('.btn_add').on('click', function(e) {
                e.preventDefault();
                $('#trashCourseModal').modal('hide'); // Ẩn modal trash nếu đang mở
                var createModal = new bootstrap.Modal(document.getElementById('createCategoryModal'));
                createModal.show();
            });

            // Event cho nút xem rác
            $('.btn_trash').on('click', function(e) {
                e.preventDefault();
                $('#createCategoryModal').modal('hide'); // Ẩn modal create nếu đang mở
                var trashModal = new bootstrap.Modal(document.getElementById('trashCourseModal'));
                trashModal.show();
            });

            // Xử lý khi đóng modal
            $('#createCategoryModal, #trashCourseModal').on('hidden.bs.modal', function () {
                $(this).find('form').trigger('reset');
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                // Xóa backdrop và reset body
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('overflow', '');
                $('body').css('padding-right', '');
            });

            // Xử lý khi nhấn nút đóng modal
            $('.btn-close, .btn-secondary').on('click', function() {
                $('#createCategoryModal').modal('hide');
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('overflow', '');
                $('body').css('padding-right', '');
            });

            // Hiển thị modal nếu có lỗi validation
            @if(session('errors') && session('errors')->any())
                $('#createCategoryModal').modal('show');
            @endif
        });

        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        function showCourseDetails(id) {
            // Reset modal content
            $('#showCourseModal .modal-body p').text('');
            $('#show-thumbnail').attr('src', '');

            // Fetch course details
            $.get(`/admin/courses/${id}`, function(response) {
                if (response.status && response.data) {
                    const course = response.data;

                    // Format currency
                    const formatCurrency = (number) => {
                        return new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(number);
                    };

                    // Populate modal
                    $('#show-name').text(course.name || 'N/A');
                    $('#show-category').text(course.category ? course.category.name : 'N/A');
                    $('#show-slug').text(course.slug || 'N/A');
                    $('#show-releaseTime').text(course.releaseTime ? new Date(course.releaseTime).toLocaleDateString('vi-VN') : 'N/A');
                    $('#show-price').text(course.price ? formatCurrency(course.price) : 'N/A');
                    $('#show-salePrice').text(course.salePrice ? formatCurrency(course.salePrice) : 'Không có');
                    $('#show-totalStudent').text(course.totalStudent || '0');
                    $('#show-rating').text(course.rating ? course.rating + '/5' : 'Chưa có đánh giá');
                    $('#show-totalRating').text(course.totalRating || '0');
                    $('#show-sortDescription').text(course.sortDescription || 'Không có mô tả ngắn');
                    $('#show-description').text(course.description || 'Không có mô tả');

                    if (course.thumbnail) {
                        $('#show-thumbnail').attr('src', '/' + course.thumbnail);
                    }

                    // Show modal
                    $('#showCourseModal').modal('show');
                } else {
                    alert('Không thể tải thông tin khóa học');
                }
            }).fail(function(error) {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi tải thông tin khóa học');
            });
        }
    </script>
@endpush

@push('styles')
    <style>
        /* Điều chỉnh độ trong suốt của modal backdrop */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.1) !important; /* Giảm độ đậm của nền đen */
        }

        .modal-header {
            background: #f3f6f9;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .modal-content {
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Thêm shadow nhẹ */
        }

        .modal-footer {
            border-top: 1px solid #e4e6ef;
            background: #f3f6f9;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        /* Fix vấn đề scroll */
        body.modal-open {
            overflow: auto !important;
            padding-right: 0 !important;
        }

        /* Loại bỏ padding mặc định của modal */
        .modal {
            padding-right: 0 !important;
        }

        /* Thêm animation mượt mà cho modal */
        .modal.fade .modal-dialog {
            transition: transform .2s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        /* Thêm styles cho action buttons */
        .action_btns {
            gap: 5px; /* Khoảng cách giữa các nút */
        }

        .action_btn {
            padding: 5px 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .action_btn:hover {
            transform: translateY(-2px);
        }

        /* Màu sắc cho từng loại nút */
        .btn-outline-info:hover {
            color: #fff;
        }

        .mr_10 {
            margin-right: 5px;
        }

        #showCourseModal .modal-body p {
            padding: 0.5rem;
            margin-bottom: 0;
            background-color: #f8f9fa;
            border-radius: 4px;
            min-height: 2.5rem;
            display: flex;
            align-items: center;
        }

        #showCourseModal .form-label {
            margin-bottom: 0.2rem;
            color: #495057;
        }

        #showCourseModal img {
            border-radius: 4px;
            border: 1px solid #dee2e6;
            padding: 0.25rem;
        }
    </style>
@endpush
