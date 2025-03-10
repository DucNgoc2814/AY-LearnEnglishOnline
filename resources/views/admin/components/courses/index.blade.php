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
                                        <th class="text-center align-middle">STT</th>
                                        <th class="text-center align-middle">Tên danh mục</th>
                                        <th class="text-center align-middle">Tên khóa học</th>
                                        <th class="text-center align-middle">Ảnh khóa học</th>
                                        <th class="text-center align-middle">Giá khóa học</th>
                                        <th class="text-center align-middle">Giá giảm</th>
                                        <th class="text-center align-middle">Số bài học</th>
                                        <th class="text-center align-middle">Ngày tạo</th>
                                        <th class="text-center align-middle">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $key => $item)
                                        <tr>
                                            <td class="text-center align-middle">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}</td>
                                            <td class="text-center align-middle">{{ $item->category->name ?? 'N/A' }}</td>
                                            <td class="text-center align-middle">{{ $item->name }}</td>
                                            <td class="text-center align-middle"><img src="{{ asset($item->thumbnail) }}" alt="{{ $item->name }}" width="50"></td>
                                            <td class="text-center align-middle">{{ number_format($item->price) }}đ</td>
                                            <td class="text-center align-middle">{{ $item->salePrice ? number_format($item->salePrice) . 'đ' : 'N/A' }}</td>
                                            <td class="text-center align-middle">{{ $item->totalLessons() }}</td>
                                            <td class="text-center align-middle">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                            <td class="text-center align-middle">
                                                <div class="action_btns d-flex">
                                                    <a href="{{ route('admin.courses.by.course', ['courseId' => $item->id]) }}"
                                                        class="action_btn mr_10 btn btn-outline-info btn-sm"
                                                        title="Xem chi tiết">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
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

            // Populate description
            document.querySelector('#editCourseModal #description').value = item.description || '';

            // Populate thumbnail image
            const currentThumbnailDiv = document.querySelector('#currentThumbnail');
            if (item.thumbnail) {
                currentThumbnailDiv.innerHTML = `
                    <div class="mt-2">
                        <p>Ảnh hiện tại:</p>
                        <img src="{{ asset('') }}${item.thumbnail}"
                             alt="Current thumbnail"
                             class="img-thumbnail"
                             style="max-width: 200px">
                    </div>
                `;
            } else {
                currentThumbnailDiv.innerHTML = '<p class="text-muted">Chưa có ảnh</p>';
            }

            // Update form action
            const form = document.querySelector('#editCourseModal form');
            form.action = "{{ route('admin.courses.update', '') }}/" + item.id;
        }
    </script>
@endpush
