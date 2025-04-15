<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editClassModal" aria-labelledby="editClassModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editClassModalLabel">Chỉnh sửa lớp học</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('editClassModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editClassForm" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Tên lớp học <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Mã lớp <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="code" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Khóa học <span class="text-red-500">*</span>
                            </label>
                            <select name="course_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Chọn khóa học</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Giáo viên <span class="text-red-500">*</span>
                            </label>
                            <select name="teacher_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Chọn giáo viên</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Loại lớp <span class="text-red-500">*</span>
                            </label>
                            <select name="class_type" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="online">Online</option>
                                <option value="offline">Offline</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Trạng thái <span class="text-red-500">*</span>
                            </label>
                            <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="pending">Chờ</option>
                                <option value="active">Đang học</option>
                                <option value="completed">Hoàn thành</option>
                                <option value="cancelled">Đã hủy</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Ngày bắt đầu <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="start_date" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Ngày kết thúc <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="end_date" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Hạn đăng ký
                            </label>
                            <input type="date" name="enrollment_deadline" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Học phí
                            </label>
                            <input type="number" name="fee" min="0" step="0.01" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Số học viên tối thiểu <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="min_students" min="1" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Số học viên tối đa <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="max_students" min="1" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Mô tả
                            </label>
                            <textarea name="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Lịch học
                            </label>
                            <textarea name="schedule" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Định dạng JSON"></textarea>
                        </div>

                        <div class="col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" class="form-checkbox h-4 w-4 text-blue-600">
                                <span class="ml-2 text-gray-700">Kích hoạt</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-4">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="modalHandler.close('editClassModal')">
                            Hủy
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
