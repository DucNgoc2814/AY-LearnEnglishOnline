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
                                                    <button type="button"
                                                        class="action_btn btn btn-outline-info btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showLessonTestModal"
                                                        onclick="showLessonTest({{ json_encode($item) }})"
                                                        title="Xem chi tiết">
                                                        <i class="fas fa-eye"></i>
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

    <!-- Include Show Question Lesson Test Modal -->
    @include('admin.components.lesson-tests.modals.show')

    <!-- Include Create Question Lesson Test Modal -->
    @include('admin.components.question-lesson-tests.modals.create')

    <!-- Include Edit Question Modal -->
    @include('admin.components.question-lesson-tests.modals.edit')

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
    <script>
        function showLessonTest(lessonTest) {
            // Gọi API để lấy chi tiết bài kiểm tra
            fetch(`/admin/lesson-tests/${lessonTest.id}`)
                .then(response => response.json())
                .then(result => {
                    if (result.status) {
                        const lessonTestWithQuestions = result.data;
                        console.log('Lesson Test Data:', lessonTestWithQuestions);

                        const modal = document.querySelector('#showLessonTestModal');

                        modal.querySelector('#showLesson').textContent = lessonTestWithQuestions.lesson.name;
                        modal.querySelector('#showName').textContent = lessonTestWithQuestions.name;
                        modal.querySelector('#showDescription').textContent = lessonTestWithQuestions.description || 'Không có mô tả';
                        modal.querySelector('#showDuration').textContent = `${lessonTestWithQuestions.duration} phút`;
                        modal.querySelector('#showMaxAttempt').textContent = lessonTestWithQuestions.maxAttempt || 'Không giới hạn';
                        modal.querySelector('#showMinScore').textContent = lessonTestWithQuestions.minScore;
                        modal.querySelector('#showMaxScore').textContent = lessonTestWithQuestions.maxScore;
                        modal.querySelector('#showIsRequired').textContent = lessonTestWithQuestions.isRequired ? 'Bắt buộc' : 'Không bắt buộc';

                        // Hiển thị danh sách câu hỏi
                        const questionList = modal.querySelector('#questionList');
                        questionList.innerHTML = '';

                        console.log('Questions:', lessonTestWithQuestions.questions);

                        if (lessonTestWithQuestions.questions && lessonTestWithQuestions.questions.length > 0) {
                            lessonTestWithQuestions.questions.forEach((question, index) => {
                                console.log('Question:', question);
                                const row = createQuestionRow(question, index + 1);
                                questionList.appendChild(row);
                            });
                        } else {
                            questionList.innerHTML = `
                                <tr>
                                    <td colspan="6" class="text-center">Chưa có câu hỏi nào</td>
                                </tr>
                            `;
                        }

                        // Lưu lessonTestId để sử dụng khi thêm câu hỏi mới
                        window.lessonTestId = lessonTestWithQuestions.id;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Có thể thêm thông báo lỗi ở đây
                });
        }

        function createQuestionRow(question, index) {
            console.log('Creating row for question:', question);

            const typeLabels = {
                'multiple_choice': ['Trắc nghiệm', 'bg-primary'],
                'fill_in_blank': ['Điền từ', 'bg-success'],
                'true_false': ['Đúng/Sai', 'bg-warning'],
                'matching': ['Nối từ', 'bg-info'],
                'essay': ['Tự luận', 'bg-secondary']
            };

            const questionText = question.question || question.content || '';
            const questionType = question.type || 'unknown';
            const mediaUrl = question.mediaUrl || question.media_url || '';
            const answers = question.answers || [];

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="text-center align-middle">${index}</td>
                <td class="text-center align-middle">
                    <span class="badge ${typeLabels[questionType]?.[1] || 'bg-secondary'}">
                        ${typeLabels[questionType]?.[0] || questionType}
                    </span>
                </td>
                <td class="align-middle">${questionText}</td>
                <td class="text-center align-middle">
                    ${createMediaPreview(mediaUrl)}
                </td>
                <td class="align-middle">
                    ${createAnswersTable(answers)}
                </td>
                <td class="text-center align-middle">
                    <div class="action_btns d-flex justify-content-center">
                        <button type="button"
                            class="action_btn mr_10 btn btn-outline-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editQuestionModal"
                            onclick="editQuestion(${JSON.stringify(question)})"
                            title="Sửa câu hỏi">
                            <i class="far fa-edit"></i>
                        </button>
                    </div>
                </td>
            `;
            return tr;
        }

        function createMediaPreview(mediaUrl) {
            if (!mediaUrl) return '<span class="text-muted">Không có</span>';

            mediaUrl = String(mediaUrl);
            const extension = mediaUrl.split('.').pop().toLowerCase();
            const fullUrl = `{{ asset('uploads') }}/${mediaUrl}`;

            const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension);
            const isVideo = ['mp4', 'webm', 'mov', 'wmv', 'avi', 'flv'].includes(extension);
            const isAudio = ['mp3', 'wav', 'ogg'].includes(extension);

            if (isImage) {
                return `<img src="${fullUrl}" alt="Question media" width="50" onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">`;
            } else if (isVideo) {
                return `
                    <div class="d-flex justify-content-center align-items-center ">
                        <button type="button"
                            class="btn btn-sm btn-primary ms-2"
                            onclick="showVideoModal('${fullUrl}', '${extension}')"
                        >
                            <i class="fas fa-play"></i> Xem video
                        </button>
                    </div>`;
            } else if (isAudio) {
                return `
                    <audio controls controlsList="nodownload">
                        <source src="${fullUrl}" type="audio/${extension}">
                        Your browser does not support the audio tag.
                    </audio>`;
            }

            return `<a href="${fullUrl}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-file"></i> Xem file
                    </a>`;
        }

        function createAnswersTable(answers) {
            console.log('Creating answers table:', answers);

            if (!answers || answers.length === 0) return '<span class="text-muted">Không có câu trả lời</span>';

            return `
                <table class="table table-sm mb-0">
                    ${answers.map(answer => {
                        const answerText = answer.answer || answer.content || '';
                        const isCorrect = answer.isCorrect || answer.is_correct || false;
                        const caseSensitive = answer.case_sensitive || answer.caseSensitive || false;

                        return `
                            <tr>
                                <td width="70%">${answerText}</td>
                                <td class="text-center" width="15%">
                                    ${isCorrect ? '<span class="badge bg-success">Đúng</span>' : ''}
                                </td>
                                <td class="text-center" width="15%">
                                    ${caseSensitive ? '<span class="badge bg-info">Phân biệt chữ</span>' : ''}
                                </td>
                            </tr>
                        `;
                    }).join('')}
                </table>
            `;
        }

        // Thêm hàm để hiển thị modal video
        function showVideoModal(videoUrl, extension) {
            const modalHtml = `
                <div class="modal fade" id="videoPreviewModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Xem video</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <video width="100%" controls autoplay>
                                    <source src="${videoUrl}" type="video/${extension}">
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Xóa modal cũ nếu tồn tại
            const existingModal = document.getElementById('videoPreviewModal');
            if (existingModal) {
                existingModal.remove();
            }

            // Thêm modal mới vào body
            document.body.insertAdjacentHTML('beforeend', modalHtml);

            // Hiển thị modal
            const modal = new bootstrap.Modal(document.getElementById('videoPreviewModal'));
            modal.show();

            // Tự động xóa modal khi đóng
            document.getElementById('videoPreviewModal').addEventListener('hidden.bs.modal', function () {
                this.remove();
            });
        }
    </script>
@endsection
