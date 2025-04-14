<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editQuestionModal" aria-labelledby="editQuestionModalLabel"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editQuestionModalLabel">Chỉnh sửa câu hỏi</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeEditQuestionModal()"
                        aria-label="Close">
                        <span class="sr-only">Đóng</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editQuestionForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="question_id" id="edit_questionId">
                    <input type="hidden" name="media_url" id="edit_media_url">

                    <div class="mt-4">
                        <!-- Bài kiểm tra -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_test_id">
                                Bài kiểm tra <span class="text-red-500">*</span>
                            </label>
                            <select
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="edit_test_id" name="test_id" required>
                                <option value="">Chọn bài kiểm tra</option>
                                @foreach (\App\Models\Test::all() as $test)
                                    <option value="{{ $test->id }}">
                                        {{ $test->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Loại câu hỏi -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_type">
                                Loại câu hỏi <span class="text-red-500">*</span>
                            </label>
                            <select
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="edit_type" name="type" required>
                                <option value="text">Văn bản</option>
                                <option value="image">Hình ảnh</option>
                                <option value="video">Video</option>
                                <option value="audio">Âm thanh</option>
                            </select>
                        </div>

                        <!-- Nội dung câu hỏi -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_question">
                                Nội dung câu hỏi <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="edit_question" name="question" required>
                        </div>

                        <!-- Thứ tự -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_order_number">
                                Thứ tự <span class="text-red-500">*</span>
                            </label>
                            <input type="number"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="edit_order_number" name="order_number" min="0" required>
                        </div>

                        <!-- Giải thích đáp án đúng -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2"
                                for="edit_correct_answer_explanation">
                                Giải thích đáp án đúng
                            </label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="edit_correct_answer_explanation" name="correct_answer_explanation" rows="3"
                                placeholder="Nhập giải thích cho đáp án đúng"></textarea>
                            <p class="text-xs text-gray-500 mt-1">Giải thích này sẽ được hiển thị cho học viên sau khi
                                họ hoàn thành câu hỏi</p>
                        </div>

                        <!-- Media upload -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_media_file">
                                Tệp Media
                            </label>
                            <div class="preview-container mb-2">
                                <div id="edit_mediaPreviewContainer" class="hidden">
                                    <img id="edit_imagePreview" src=""
                                        class="hidden max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                        style="max-height: 200px; object-fit: contain;"
                                        onclick="openEditMediaModal(this.src)">
                                    <video id="edit_videoPreview"
                                        class="hidden max-w-xs rounded-lg shadow-md cursor-pointer"
                                        style="max-height: 200px; width: 100%;" controls>
                                        <source src="" type="video/mp4">
                                    </video>
                                    <audio id="edit_audioPreview" class="hidden w-full" controls>
                                        <source src="" type="audio/mpeg">
                                    </audio>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button" id="edit_chooseMediaBtn"
                                    class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Chọn tệp
                                </button>
                                <button type="button" onclick="clearEditMedia()"
                                    class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Xóa tệp
                                </button>
                            </div>
                            <input type="file" class="hidden" id="edit_media_file" name="media_file"
                                accept="image/*,video/*,audio/*">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2"
                            for="edit_correct_answer_explanation">
                            Giải thích đáp án đúng
                        </label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('correct_answer_explanation') ? 'border-red-500' : '' }}"
                            id="edit_correct_answer_explanation" name="correct_answer_explanation" rows="3"
                            placeholder="Nhập giải thích cho đáp án đúng"></textarea>
                        @if (session('errors') && session('errors')->has('correct_answer_explanation'))
                            <p class="text-red-500 text-xs italic mt-1">
                                {{ session('errors')->first('correct_answer_explanation') }}</p>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">Giải thích này sẽ được hiển thị cho học viên sau khi họ
                            hoàn thành bài test</p>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="closeEditQuestionModal()">
                            Hủy
                        </button>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal xem media cho edit -->
<div id="editMediaModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="editMediaModalLabel"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="relative bg-white rounded-lg max-w-3xl w-full mx-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900" id="editMediaModalLabel">Xem media</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeEditMediaModal()">
                    <span class="sr-only">Đóng</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Body -->
            <div class="p-4">
                <div id="editMediaContent"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function editQuestion(id) {
        console.log('Editing question:', id);

        fetch(`/admin/questions/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(response => {
                console.log('Response:', response);
                if (response.status) {
                    populateQuestionEditModal(response.data);
                } else {
                    throw new Error(response.message || 'Không thể tải thông tin câu hỏi');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi tải dữ liệu: ' + error.message);
            });
    }

    function populateQuestionEditModal(question) {
        console.log('Populating modal with:', question);
        modalHandler.open('editQuestionModal');

        const form = document.getElementById('editQuestionForm');
        form.action = `/admin/questions/${question.id}`;

        // Điền dữ liệu vào form
        document.getElementById('edit_questionId').value = question.id;
        document.getElementById('edit_test_id').value = question.test_id;
        document.getElementById('edit_type').value = question.type;
        document.getElementById('edit_question').value = question.question;
        document.getElementById('edit_order_number').value = question.order_number;

        // Lưu URL hiện tại vào input hidden để giữ lại khi không upload file mới
        document.getElementById('edit_media_url').value = question.media_url || '';

        // Reset previews
        resetEditPreviews();

        // Hiển thị media
        if (question.media_url) {
            console.log('Setting media:', question.media_url);
            const mediaPreviewContainer = document.getElementById('edit_mediaPreviewContainer');

            // Sử dụng full_media_url từ service nếu có
            const mediaUrl = question.full_media_url || question.media_url;

            // Hiển thị preview phù hợp với loại câu hỏi
            if (question.type === 'image') {
                const imagePreview = document.getElementById('edit_imagePreview');
                imagePreview.src = mediaUrl;
                imagePreview.classList.remove('hidden');
                mediaPreviewContainer.classList.remove('hidden');
            } else if (question.type === 'video') {
                const videoPreview = document.getElementById('edit_videoPreview');
                const videoSource = videoPreview.querySelector('source');
                videoSource.src = mediaUrl;
                videoPreview.load();
                videoPreview.classList.remove('hidden');
                mediaPreviewContainer.classList.remove('hidden');
            } else if (question.type === 'audio') {
                const audioPreview = document.getElementById('edit_audioPreview');
                const audioSource = audioPreview.querySelector('source');
                audioSource.src = mediaUrl;
                audioPreview.load();
                audioPreview.classList.remove('hidden');
                mediaPreviewContainer.classList.remove('hidden');
            }
        }

        // Xóa các input hidden nếu có
        const removeMediaInput = form.querySelector('input[name="remove_media"]');
        if (removeMediaInput) removeMediaInput.remove();
    }

    function resetEditPreviews() {
        const imagePreview = document.getElementById('edit_imagePreview');
        const videoPreview = document.getElementById('edit_videoPreview');
        const audioPreview = document.getElementById('edit_audioPreview');
        const mediaPreviewContainer = document.getElementById('edit_mediaPreviewContainer');

        imagePreview.classList.add('hidden');
        videoPreview.classList.add('hidden');
        audioPreview.classList.add('hidden');
        mediaPreviewContainer.classList.add('hidden');
    }

    function handleEditMediaUpload(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileType = file.type;
            const reader = new FileReader();

            // Reset previews
            resetEditPreviews();

            reader.onload = function(e) {
                const mediaPreviewContainer = document.getElementById('edit_mediaPreviewContainer');
                mediaPreviewContainer.classList.remove('hidden');

                if (fileType.startsWith('image/')) {
                    const imagePreview = document.getElementById('edit_imagePreview');
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');

                    // Đồng bộ loại câu hỏi
                    document.getElementById('edit_type').value = 'image';
                } else if (fileType.startsWith('video/')) {
                    const videoPreview = document.getElementById('edit_videoPreview');
                    const videoSource = videoPreview.querySelector('source');
                    videoSource.src = e.target.result;
                    videoPreview.load();
                    videoPreview.classList.remove('hidden');

                    // Đồng bộ loại câu hỏi
                    document.getElementById('edit_type').value = 'video';
                } else if (fileType.startsWith('audio/')) {
                    const audioPreview = document.getElementById('edit_audioPreview');
                    const audioSource = audioPreview.querySelector('source');
                    audioSource.src = e.target.result;
                    audioPreview.load();
                    audioPreview.classList.remove('hidden');

                    // Đồng bộ loại câu hỏi
                    document.getElementById('edit_type').value = 'audio';
                }
            }

            reader.readAsDataURL(file);
        }
    }

    function clearEditMedia() {
        const mediaFileInput = document.getElementById('edit_media_file');
        const urlInput = document.getElementById('edit_media_url');

        resetEditPreviews();
        mediaFileInput.value = '';
        urlInput.value = ''; // Xóa giá trị URL hiện tại

        // Thêm input hidden để đánh dấu xóa media
        let removeInput = document.querySelector('input[name="remove_media"]');
        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_media';
            removeInput.value = '1';
            mediaFileInput.parentNode.appendChild(removeInput);
        }
    }

    function closeEditQuestionModal() {
        modalHandler.close('editQuestionModal');
        document.getElementById('editQuestionForm').reset();
        resetEditPreviews();

        // Xóa các input hidden nếu có
        const form = document.getElementById('editQuestionForm');
        const removeMediaInput = form.querySelector('input[name="remove_media"]');
        if (removeMediaInput) removeMediaInput.remove();
    }

    function openEditMediaModal(src) {
        const mediaModal = document.getElementById('editMediaModal');
        const mediaContent = document.getElementById('editMediaContent');
        const fileType = typeof src === 'string' && src.includes(';') ? src.split(';')[0].split(':')[1] : null;

        // Hiển thị nội dung phù hợp dựa vào loại tệp hoặc type của câu hỏi
        if (fileType && fileType.startsWith('image') || document.getElementById('edit_type').value === 'image') {
            mediaContent.innerHTML = `<img src="${src}" class="w-full h-auto" />`;
        } else if (fileType && fileType.startsWith('video') || document.getElementById('edit_type').value === 'video') {
            mediaContent.innerHTML = `<video src="${src}" controls class="w-full h-auto"></video>`;
        } else if (fileType && fileType.startsWith('audio') || document.getElementById('edit_type').value === 'audio') {
            mediaContent.innerHTML = `<audio src="${src}" controls class="w-full"></audio>`;
        }

        mediaModal.classList.remove('hidden');
    }

    function closeEditMediaModal() {
        const mediaModal = document.getElementById('editMediaModal');
        mediaModal.classList.add('hidden');
    }

    // Các event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Đăng ký sự kiện cho form edit
        const editForm = document.getElementById('editQuestionForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const questionId = document.getElementById('edit_questionId').value;
                const formData = new FormData(this);

                // Gửi form bằng AJAX
                fetch(`/admin/questions/${questionId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert('Cập nhật thành công!');
                            closeEditQuestionModal();
                            // Reload trang để cập nhật dữ liệu
                            window.location.reload();
                        } else {
                            alert('Lỗi: ' + result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Đã xảy ra lỗi khi cập nhật');
                    });
            });
        }

        // Xử lý sự kiện click cho nút "Chọn media"
        const mediaBtn = document.getElementById('edit_chooseMediaBtn');
        if (mediaBtn) {
            mediaBtn.addEventListener('click', function() {
                document.getElementById('edit_media_file').click();
            });
        }

        // Xử lý preview media
        const mediaInput = document.getElementById('edit_media_file');
        if (mediaInput) {
            mediaInput.addEventListener('change', function(e) {
                handleEditMediaUpload(this);

                // Xóa input hidden remove_media nếu chọn file mới
                const removeInput = document.querySelector('input[name="remove_media"]');
                if (removeInput) removeInput.remove();
            });
        }

        // Cập nhật thuộc tính accept khi thay đổi loại câu hỏi
        const typeSelect = document.getElementById('edit_type');
        if (typeSelect) {
            typeSelect.addEventListener('change', function() {
                updateEditMediaAccept();
            });
        }

        function updateEditMediaAccept() {
            const type = document.getElementById('edit_type').value;
            const mediaInput = document.getElementById('edit_media_file');

            if (type === 'image') {
                mediaInput.setAttribute('accept', 'image/*');
            } else if (type === 'video') {
                mediaInput.setAttribute('accept', 'video/*');
            } else if (type === 'audio') {
                mediaInput.setAttribute('accept', 'audio/*');
            } else {
                mediaInput.setAttribute('accept', 'image/*,video/*,audio/*');
            }
        }
    });
</script>

<!-- Thêm styles -->
<style>
    .preview-container {
        min-height: 50px;
        border: 2px dashed #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8fafc;
    }

    .preview-container img,
    .preview-container video {
        max-width: 100%;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }

    .preview-container img:hover,
    .preview-container video:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Modal animation */
    .modal-content {
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>
