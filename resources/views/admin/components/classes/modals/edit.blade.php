<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editClassModal" aria-labelledby="editClassModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900" id="editClassModalLabel">
                        Chỉnh sửa lớp học
                    </h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('editClassModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="edit_classForm" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_name">
                                        Tên lớp học <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="edit_name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_code">
                                        Mã lớp <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="edit_code" name="code" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                    <p class="text-sm text-gray-500 mt-1">Mã lớp phải là duy nhất</p>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_teacher_id">
                                        Giáo viên <span class="text-red-500">*</span>
                                    </label>
                                    <select id="edit_teacher_id" name="teacher_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                        <option value="">Chọn giáo viên</option>
                                        @if(isset($teachers) && count($teachers) > 0)
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>Không có giáo viên nào</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-3">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Thời gian</h4>
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_start_date">
                                        Ngày bắt đầu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" id="edit_start_date" name="start_date" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_end_date">
                                        Ngày kết thúc <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" id="edit_end_date" name="end_date" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_enrollment_deadline">
                                        Hạn đăng ký
                                    </label>
                                    <input type="date" id="edit_enrollment_deadline" name="enrollment_deadline" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <div class="col-span-3">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Số lượng học viên</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_min_students">
                                        Số học viên tối thiểu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="edit_min_students" name="min_students" min="1" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_max_students">
                                        Số học viên tối đa <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="edit_max_students" name="max_students" min="1" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-3">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Thông tin bổ sung</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_schedule">
                                            Lịch học
                                        </label>
                                        <textarea id="edit_schedule" name="schedule" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" placeholder="Định dạng JSON"></textarea>
                                        <p class="text-sm text-gray-500 mt-1">Ví dụ: {"monday":["08:00 - 10:00"],"wednesday":["08:00 - 10:00"]}</p>
                                    </div>

                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_status">
                                                Trạng thái <span class="text-red-500">*</span>
                                            </label>
                                            <select id="edit_status" name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                                <option value="pending">Chờ</option>
                                                <option value="active">Đang học</option>
                                                <option value="completed">Hoàn thành</option>
                                                <option value="cancelled">Đã hủy</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="flex items-center space-x-2 cursor-pointer">
                                                <input type="checkbox" id="edit_is_active" name="is_active" value="1"
                                                    class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500 cursor-pointer">
                                                <span class="text-gray-700 font-medium">Kích hoạt lớp học</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Mô tả
                                    </label>
                                    <textarea id="edit_description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 mt-6 border-t border-gray-200">
                        <button type="button" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-200 ease-in-out"
                            onclick="modalHandler.close('editClassModal')">
                            Hủy
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function populateEditModal(item) {
        console.log('Editing class:', item);
        modalHandler.open('editClassModal');

        const form = document.getElementById('edit_classForm');
        form.action = `/admin/classes/${item.id}`;

        // Điền dữ liệu vào form
        document.getElementById('edit_name').value = item.name || '';
        document.getElementById('edit_code').value = item.code || '';
        document.getElementById('edit_teacher_id').value = item.teacher_id || '';

        // Xử lý các trường datetime
        if (item.start_date) {
            document.getElementById('edit_start_date').value = new Date(item.start_date).toISOString().slice(0, 16);
        }
        if (item.end_date) {
            document.getElementById('edit_end_date').value = new Date(item.end_date).toISOString().slice(0, 16);
        }
        if (item.enrollment_deadline) {
            document.getElementById('edit_enrollment_deadline').value = new Date(item.enrollment_deadline).toISOString().slice(0, 10);
        }

        // Điền các trường số
        document.getElementById('edit_min_students').value = item.min_students || '';
        document.getElementById('edit_max_students').value = item.max_students || '';

        // Điền các trường text và select
        document.getElementById('edit_status').value = item.status || 'pending';
        document.getElementById('edit_description').value = item.description || '';

        // Xử lý trường JSON schedule
        if (item.schedule) {
            try {
                const scheduleStr = typeof item.schedule === 'string' ? item.schedule : JSON.stringify(item.schedule);
                document.getElementById('edit_schedule').value = scheduleStr;
            } catch (e) {
                console.error('Error parsing schedule:', e);
                document.getElementById('edit_schedule').value = '';
            }
        }

        // Xử lý checkbox
        document.getElementById('edit_is_active').checked = Boolean(item.is_active);

        // Khởi tạo TinyMCE cho trường mô tả chi tiết nếu cần
        if (tinymce.get('edit_description')) {
            tinymce.get('edit_description').setContent(item.description || '');
        } else {
            setTimeout(function() {
                tinymce.init({
                    selector: '#edit_description',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    height: 300,
                    language: 'vi',
                    image_title: true,
                    automatic_uploads: true,
                    file_picker_types: 'image',
                    entity_encoding: 'raw',
                    encoding: 'UTF-8'
                });
            }, 100);
        }
    }
</script>
