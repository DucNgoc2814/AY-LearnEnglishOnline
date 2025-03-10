@extends('admin.layouts.master')
@section('title', isset($course) ? "Danh sách bài học - {$course->name}" : 'Quản lý bài học')
@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>
                                @if(isset($course))
                                    Danh sách bài học - Khóa học: {{ $course->name }}
                                @else
                                    Bài học
                                @endif
                            </h4>
                            <div class="box_right d-flex lms_block">
                                @if(isset($course))
                                    <div class="add_button me-2">
                                        <a href="{{ route('admin.courses.index') }}" class="btn_1">
                                            <i class="fas fa-arrow-left"></i> Quay lại
                                        </a>
                                    </div>
                                @endif
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form action="{{ route('admin.lessons.index') }}" method="GET">
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
                                        data-bs-target="#createLessonModal">
                                        Thêm mới
                                    </button>
                                </div>
                                <div class="add_button ms-2">
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#trashLessonModal">
                                        Xem bài học đã xóa
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">STT</th>
                                        <th class="text-center align-middle">Tên khóa học</th>
                                        <th class="text-center align-middle">Tên bài học</th>
                                        <th class="text-center align-middle">Miêu tả</th>
                                        <th class="text-center align-middle">Xem Free</th>
                                        <th class="text-center align-middle">Tổng View</th>
                                        <th class="text-center align-middle">Tổng comment</th>
                                        <th class="text-center align-middle">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lessons as $key => $item)
                                        <tr>
                                            <td class="text-center align-middle">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}</td>
                                            <td class="text-center align-middle">{{ $item->course->name ?? 'N/A' }}</td>
                                            <td class="text-center align-middle">{{ $item->name }}</td>
                                            <td class="text-center align-middle">{{ Str::limit($item->description, 50) }}</td>
                                            <td class="text-center align-middle">
                                                <span class="badge {{ $item->isPreview ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $item->isPreview ? 'Có' : 'Không' }}
                                                </span>
                                            </td>
                                            <td class="text-center align-middle">{{ number_format($item->totalView) }}</td>
                                            <td class="text-center align-middle">{{ number_format($item->totalComment) }}</td>
                                            <td class="text-center align-middle">
                                                <div class="action_btns d-flex justify-content-center">
                                                    <button type="button"
                                                        class="action_btn mr_10 btn btn-outline-info btn-sm"
                                                        onclick="showLessonDetails({{ $item->id }})"
                                                        title="Xem chi tiết">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="action_btn mr_10 btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editLessonModal"
                                                        onclick="populateEditModal({{ json_encode($item) }})"
                                                        title="Chỉnh sửa">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.lessons.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="action_btn btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa bài học này?')"
                                                            title="Xóa">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if (count($lessons) == 0)
                                        <tr>
                                            <td colspan="8" class="text-center">Không có dữ liệu</td>
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
    @include('admin.components.lessons.modals.create')

    <!-- Include Edit Modal -->
    @include('admin.components.lessons.modals.edit')

    <!-- Include Trash Modal -->
    @include('admin.components.lessons.modals.trash')
@endsection

@push('scripts')
    <script>
        function populateEditModal(item) {
            document.querySelector('#editLessonModal #lessonName').value = item.name;
            document.querySelector('#editLessonModal #categoryId').value = item.categoryId;
            document.querySelector('#editLessonModal #price').value = item.price;
            document.querySelector('#editLessonModal #salePrice').value = item.salePrice;

            // Populate description
            document.querySelector('#editLessonModal #description').value = item.description || '';

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
            const form = document.querySelector('#editLessonModal form');
            form.action = "{{ route('admin.lessons.update', '') }}/" + item.id;
        }

        function showLessonDetails(id) {
            fetch(`/admin/lessons/${id}`)
                .then(response => response.json())
                .then(response => {
                    if (response.status && response.data) {
                        const lesson = response.data;
                        document.querySelector('#show-name').textContent = lesson.name;
                        document.querySelector('#show-category').textContent = lesson.category ? lesson.category.name : 'N/A';
                        document.querySelector('#show-price').textContent = lesson.price ? new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(lesson.price) : 'N/A';
                        const modal = new bootstrap.Modal(document.querySelector('#showLessonModal'));
                        modal.show();
                    }
                });
        }
    </script>
@endpush
