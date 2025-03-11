@extends('admin.layouts.master')
@section('title', 'Quản lý bài kiểm tra')
@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Danh sách bài kiểm tra</h4>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form action="{{ route('admin.lesson-tests.index') }}" method="GET">
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
                                        data-bs-target="#createLessonTestModal">
                                        Thêm mới
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">STT</th>
                                        <th class="text-center align-middle">Bài học</th>
                                        <th class="text-center align-middle">Tên bài kiểm tra</th>
                                        <th class="text-center align-middle">Thời gian (phút)</th>
                                        <th class="text-center align-middle">Điểm tối thiểu</th>
                                        <th class="text-center align-middle">Điểm tối đa</th>
                                        <th class="text-center align-middle">Tổng số lần làm</th>
                                        <th class="text-center align-middle">Số lần được làm</th>
                                        <th class="text-center align-middle">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lessonTests as $key => $item)
                                        <tr>
                                            <td class="text-center align-middle">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}</td>
                                            <td class="text-center align-middle">{{ $item->lesson->name }}</td>
                                            <td class="text-center align-middle">{{ $item->name }}</td>
                                            <td class="text-center align-middle">{{ $item->duration }}</td>
                                            <td class="text-center align-middle">{{ $item->minScore }}</td>
                                            <td class="text-center align-middle">{{ $item->maxScore }}</td>
                                            <td class="text-center align-middle">{{ $item->totalAttempt }}</td>
                                            <td class="text-center align-middle">{{ $item->maxAttempt }}</td>
                                            <td class="text-center align-middle">
                                                <div class="action_btns d-flex">
                                                    <button type="button"
                                                        class="action_btn mr_10 btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#editLessonTestModal"
                                                        onclick="populateEditModal({{ json_encode($item) }})"
                                                        title="Chỉnh sửa">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="action_btn mr_10 btn btn-outline-success btn-sm"
                                                        title="Thêm câu hỏi">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="action_btn btn btn-outline-info btn-sm"
                                                        title="Xem chi tiết">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if (count($lessonTests) == 0)
                                        <tr>
                                            <td colspan="9" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Hiển thị từ {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}
                                    đến
                                    {{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}
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
    @include('admin.components.lesson-tests.modals.create')

    <!-- Include Edit Modal -->
    @include('admin.components.lesson-tests.modals.edit')

    <!-- Include Trash Modal -->
    @include('admin.components.lesson-tests.modals.trash')
@endsection

@push('scripts')
    <script>
        function populateEditModal(item) {
            const modal = document.querySelector('#editLessonTestModal');

            // Cập nhật select box bài học
            modal.querySelector('#editLessonId').value = item.lessonId;

            // Cập nhật các trường input
            modal.querySelector('#editName').value = item.name;
            modal.querySelector('#editDescription').value = item.description;
            modal.querySelector('#editDuration').value = item.duration;
            modal.querySelector('#editMinScore').value = item.minScore;
            modal.querySelector('#editMaxScore').value = item.maxScore;
            modal.querySelector('#editMaxAttempt').value = item.maxAttempt;
            modal.querySelector('#editIsRequired').checked = item.isRequired;

            // Cập nhật action URL của form
            modal.querySelector('form').setAttribute('action', `{{ url('admin/lesson-tests') }}/${item.id}`);
        }
    </script>
@endpush
