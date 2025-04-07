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
                    <p class="text-gray-700">Bạn đang chỉnh sửa bài học của khóa học: <span id="editCourseTitleDisplay" class="font-semibold"></span></p>
                </div>

                <form id="editLessonForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="course_id" id="editLessonCourseId">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="editName">
                                    Tên bài học <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="editName" name="name" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="editDescription">
                                    Mô tả
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="editDescription" name="description" rows="4"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="editOrderNumber">
                                        Thứ tự <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="editOrderNumber" name="order_number" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="editIsPreview">
                                        Cho phép xem thử
                                    </label>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox" name="is_preview"
                                                id="editIsPreview" value="1">
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
                alert('Có lỗi xảy ra: ' + error.message);
            });
    }

    function populateLessonEditModal(item) {
        console.log('Populating modal with:', item); // Để debug
        modalHandler.open('editLessonModal');
        const form = document.getElementById('editLessonForm');

        // Cập nhật action URL của form
        form.action = `/admin/lessons/${item.id}`;

        // Điền các giá trị vào form
        form.querySelector('#editName').value = item.name || '';
        form.querySelector('#editDescription').value = item.description || '';
        form.querySelector('#editOrderNumber').value = item.order_number || '';
        form.querySelector('#editIsPreview').checked = Boolean(item.is_preview);
        form.querySelector('#editLessonCourseId').value = item.course_id || '';
        document.getElementById('editCourseTitleDisplay').textContent = item.course_name || '';

        // Xử lý submit form
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');

            const formData = new FormData();

            // Thêm các trường dữ liệu cơ bản
            const formElements = this.elements;
            for (let element of formElements) {
                if (element.name) {
                    formData.append(element.name, element.value);
                }
            }

            // Thêm method PUT
            formData.append('_method', 'PUT');

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
                return response.json();
            })
            .then(data => {
                console.log('Server response:', data);
                if (data.success) {
                    alert('Cập nhật thành công!');
                    window.location.reload();
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra: ' + error.message);
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            });
        });
    }

    // Đóng modal
    function closeEditLessonModal() {
        modalHandler.close('editLessonModal');
    }
</script>
