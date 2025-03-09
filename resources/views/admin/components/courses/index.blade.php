@extends('admin.layouts.master')
@section('title', 'Quản lý khóa học')
@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
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
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#createCourseModal">
                                        Thêm mới
                                    </button>
                                </div>
                                <div class="add_button ms-2">
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#trashCourseModal">
                                        Xem khóa học đã xóa
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên danh mục</th>
                                        <th>Tên khóa học</th>
                                        <th>Ảnh khóa học</th>
                                        <th>Giá khóa học</th>
                                        <th>Giá giảm</th>
                                        <th>Số bài học</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $key => $item)
                                        <tr>
                                            <td>{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}</td>
                                            <td>{{ $item->category->name ?? 'N/A' }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><img src="{{ asset($item->thumbnail) }}" alt="{{ $item->name }}" width="50"></td>
                                            <td>{{ number_format($item->price) }}đ</td>
                                            <td>{{ $item->salePrice ? number_format($item->salePrice) . 'đ' : 'N/A' }}</td>
                                            <td>{{ $item->totalLessons() }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="action_btns d-flex">
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
                                                            class="action_btn btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?')"
                                                            title="Xóa">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if (count($courses) == 0)
                                        <tr>
                                            <td colspan="9" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Hiển thị từ {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}
                                    đến {{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}
                                    của {{ $pagination['total'] }} bản ghi
                                </div>
                                <div>
                                    {{ $pagination['links'] }}
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

    <!-- Include Edit Modal -->
    @include('admin.components.courses.modals.edit')

    <!-- Include Show Modal -->
    @include('admin.components.courses.modals.show')

    <!-- Include Trash Modal -->
    @include('admin.components.courses.modals.trash')
@endsection

@push('scripts')
    <script>
        function populateEditModal(item) {
            document.querySelector('#editCourseModal #courseName').value = item.name;
            document.querySelector('#editCourseModal #categoryId').value = item.categoryId;
            document.querySelector('#editCourseModal #price').value = item.price;
            document.querySelector('#editCourseModal #salePrice').value = item.salePrice;
            document.querySelector('#editCourseModal #sortDescription').value = item.sortDescription;
            document.querySelector('#editCourseModal #description').value = item.description;
            document.querySelector('#editCourseModal form').setAttribute('action', '{{ url('admin/courses') }}/' + item.id);

            if (item.thumbnail) {
                document.querySelector('#currentThumbnail').innerHTML = `<img src="${item.thumbnail}" alt="Current thumbnail" width="100">`;
            }
        }

        function showCourseDetails(id) {
            fetch(`/admin/courses/${id}`)
                .then(response => response.json())
                .then(response => {
                    if (response.status && response.data) {
                        const course = response.data;
                        document.querySelector('#show-name').textContent = course.name;
                        document.querySelector('#show-category').textContent = course.category ? course.category.name : 'N/A';
                        document.querySelector('#show-price').textContent = course.price ? new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(course.price) : 'N/A';
                        const modal = new bootstrap.Modal(document.querySelector('#showCourseModal'));
                        modal.show();
                    }
                });
        }
    </script>
@endpush
