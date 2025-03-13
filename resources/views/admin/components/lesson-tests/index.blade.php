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
                                            <td class="text-center align-middle">
                                                {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}
                                            </td>
                                            <td class="text-center align-middle">{{ $item->lesson->name }}</td>
                                            <td class="text-center align-middle">{{ $item->name }}</td>
                                            <td class="text-center align-middle">{{ $item->duration }}</td>
                                            <td class="text-center align-middle">{{ $item->minScore }}</td>
                                            <td class="text-center align-middle">{{ $item->maxScore }}</td>
                                            <td class="text-center align-middle">{{ $item->totalAttempt }}</td>
                                            <td class="text-center align-middle">{{ $item->maxAttempt }}</td>
                                            <td class="text-center align-middle">
                                                <div class="action_btns d-flex justify-content-center">
                                                    <button type="button"
                                                        class="action_btn mr_10 btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#editLessonTestModal"
                                                        onclick="populateEditModal({{ json_encode($item) }})"
                                                        title="Chỉnh sửa">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="action_btn mr_10 btn btn-outline-success btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#createQuestionLessonTestModal"
                                                        onclick="setLessonTestId({{ $item->id }})"
                                                        title="Thêm câu hỏi">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="action_btn btn btn-outline-info btn-sm"
                                                        onclick="toggleQuestionList({{ $item->id }})"
                                                        title="Xem danh sách câu hỏi">
                                                        <i class="fas fa-chevron-down"
                                                            id="chevron-{{ $item->id }}"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Questions List Row -->
                                        <tr id="question-list-{{ $item->id }}" class="question-list-row d-none">
                                            <td colspan="9" class="p-0">
                                                <div class="question-list-container">
                                                    <div class="ms-4 me-4 mb-3">
                                                        <table class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr class="bg-light">
                                                                    <th class="text-center" width="5%">STT</th>
                                                                    <th class="text-center" width="40%">Câu hỏi</th>
                                                                    <th class="text-center" width="10%">Thứ tự</th>
                                                                    <th class="text-center" width="35%">Câu trả lời</th>
                                                                    <th class="text-center" width="10%">Thao tác</th>
                                                                </tr>
                                                            </thead>
                                                            {{-- <tbody>
                                                                @forelse($item->questions as $index => $question)
                                                                    <tr>
                                                                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                                                                        <td class="align-middle">{{ $question->question }}</td>
                                                                        <td class="text-center align-middle">{{ $question->order_number }}</td>
                                                                        <td>
                                                                            <table class="table table-sm mb-0">
                                                                                @foreach ($question->answers as $answer)
                                                                                    <tr>
                                                                                        <td width="70%">{{ $answer->answer }}</td>
                                                                                        <td class="text-center" width="15%">
                                                                                            @if ($answer->isCorrect)
                                                                                                <span class="badge bg-success">Đúng</span>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td class="text-center" width="15%">
                                                                                            @if ($question->type === 'fill_in_blank')
                                                                                                @if ($answer->case_sensitive)
                                                                                                    <span class="badge bg-info">Phân biệt chữ</span>
                                                                                                @endif
                                                                                            @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </table>
                                                                        </td>
                                                                        <td class="text-center align-middle">
                                                                            <div class="action_btns d-flex justify-content-center">
                                                                                <button type="button"
                                                                                    class="action_btn mr_10 btn btn-outline-primary btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#editQuestionModal"
                                                                                    onclick="editQuestion({{ json_encode($question) }})"
                                                                                    title="Sửa câu hỏi">
                                                                                    <i class="far fa-edit"></i>
                                                                                </button>
                                                                                <form action="{{ route('admin.question-lesson-tests.destroy', $question->id) }}"
                                                                                    method="POST" class="d-inline">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"
                                                                                        class="action_btn btn btn-outline-danger btn-sm"
                                                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa câu hỏi này?')"
                                                                                        title="Xóa câu hỏi">
                                                                                        <i class="fas fa-trash"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="5" class="text-center">Chưa có câu hỏi nào</td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody> --}}
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    {{-- @if (count($lessonTests) == 0)
                                        <tr>
                                            <td colspan="9" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endif --}}
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

    <!-- Include Create Question Lesson Test Modal -->
    @include('admin.components.question-lesson-tests.modals.create')

    <!-- Include Edit Question Modal -->
    @include('admin.components.question-lesson-tests.modals.edit')

    <style>
        .question-list-container {
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
            max-height: 0;
        }

        .question-list-container.show {
            max-height: 2000px;
        }

        .rotate-icon {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, .02);
        }
    </style>

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

        function toggleQuestionList(id) {
            const container = document.querySelector(`#question-list-${id} .question-list-container`);
            const chevron = document.querySelector(`#chevron-${id}`);
            const row = document.querySelector(`#question-list-${id}`);

            row.classList.toggle('d-none');
            container.classList.toggle('show');
            chevron.classList.toggle('rotate-icon');
        }

        function editQuestion(question) {
            // Populate edit question modal
            const modal = document.querySelector('#editQuestionModal');
            modal.querySelector('#editQuestion').value = question.question;
            modal.querySelector('#editOrderNumber').value = question.order_number;
            // ... thêm logic để populate các trường khác
        }

        function setLessonTestId(id) {
            // Set giá trị cho input hidden lessonTestId
            document.querySelector('#lessonTestId').value = id;
        }
    </script>
@endsection
