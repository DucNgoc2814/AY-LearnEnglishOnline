<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editLessonModal" aria-labelledby="editLessonModalLabel"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editLessonModalLabel">Chỉnh sửa bài học</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="closeEditLessonModal()" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mb-4 p-3 bg-blue-50 rounded-md mt-4">
                    <p class="text-gray-700">Bạn đang chỉnh sửa bài học của khóa học: <span id="edit_CourseTitleDisplay" class="font-semibold"></span></p>
                </div>

                <form id="edit_LessonForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="course_id" id="edit_LessonCourseId">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_Name">
                                    Tên bài học <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_Name" name="name" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_Description">
                                    Mô tả
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline tinymce-editor"
                                    id="edit_Description" name="description" rows="4"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_OrderNumber">
                                        Thứ tự <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_OrderNumber" name="order_number" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_IsPreview">
                                        Cho phép xem thử
                                    </label>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox" name="is_preview"
                                                id="edit_IsPreview" value="1">
                                            <span class="ml-2">Cho phép xem thử</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="closeEditLessonModal()">
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

<script>
    // Thêm function mới để gọi API
    function editLesson(id) {
        console.log('Editing lesson:', id); // Debug log

        fetch(`/admin/lessons/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(response => {
                console.log('Response:', response); // Debug log
                if (response.status) {
                    populateLessonEditModal(response.data);
                } else {
                    throw new Error(response.message || 'Có lỗi xảy ra khi lấy thông tin bài học');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Đăng nhập lỗi chi tiết hơn để dễ debug
                if (error.stack) {
                    console.error('Stack trace:', error.stack);
                }
                // Hiển thị thông báo lỗi rõ ràng hơn
                alert('Đã có lỗi xảy ra khi cập nhật bài học: ' + error.message);

                // Đảm bảo nút submit được kích hoạt lại ngay cả khi có lỗi
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            });
    }

    function populateLessonEditModal(item) {
        console.log('Populating modal with:', item); // Để debug
        modalHandler.open('editLessonModal');
        const form = document.getElementById('edit_LessonForm');

        // Cập nhật action URL của form
        form.action = `/admin/lessons/${item.id}`;

        // Điền các giá trị vào form
        form.querySelector('#edit_Name').value = item.name || '';

        // Hiển thị tên khóa học
        document.getElementById('edit_CourseTitleDisplay').textContent = item.course ? item.course.name : '';
        form.querySelector('#edit_LessonCourseId').value = item.course_id || '';

        // Xử lý TinyMCE cho phần mô tả
        if (tinymce.get('edit_Description')) {
            tinymce.get('edit_Description').setContent(item.description || '');
        } else {
            setTimeout(() => {
                tinymce.init({
                    selector: '#edit_Description',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    height: 300,
                    setup: function(editor) {
                        editor.on('init', function() {
                            editor.setContent(item.description || '');
                        });
                    }
                });
            }, 100);
        }

        form.querySelector('#edit_OrderNumber').value = item.order_number || '';
        form.querySelector('#edit_IsPreview').checked = Boolean(item.is_preview);

        // Xử lý submit form
        form.onsubmit = function(e) {
            e.preventDefault();
            console.log('Form submitted');

            const formData = new FormData(this);

            // Thêm method PUT
            formData.append('_method', 'PUT');

            // Lấy nội dung từ TinyMCE
            if (tinymce.get('edit_Description')) {
                formData.set('description', tinymce.get('edit_Description').getContent());
            }

            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = 'Đang xử lý...';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                console.log('Response status:', response.status);
                // Kiểm tra xem response có phải là JSON không
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    // Nếu không phải JSON (có thể là HTML redirect), vẫn xem như thành công
                    if (response.status >= 200 && response.status < 300) {
                        return { success: true, message: 'Cập nhật thành công!' };
                    } else {
                        throw new Error('Phản hồi không hợp lệ từ máy chủ');
                    }
                }
            })
            .then(data => {
                console.log('Server response:', data);
                if (data.success || (data.status && data.status === true)) {
                    alert('Cập nhật thành công!');
                    window.location.reload();
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Đăng nhập lỗi chi tiết hơn để dễ debug
                if (error.stack) {
                    console.error('Stack trace:', error.stack);
                }
                // Hiển thị thông báo lỗi rõ ràng hơn
                alert('Đã có lỗi xảy ra khi cập nhật bài học: ' + error.message);
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            });
        };
    }

    // Đóng modal
    function closeEditLessonModal() {
        // Xóa instance TinyMCE để tránh xung đột
        if (tinymce.get('edit_Description')) {
            tinymce.get('edit_Description').remove();
        }
        modalHandler.close('editLessonModal');
    }
</script>
