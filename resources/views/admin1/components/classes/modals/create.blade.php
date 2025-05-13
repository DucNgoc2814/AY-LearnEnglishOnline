<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="createClassModal" aria-labelledby="createClassModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900" id="createClassModalLabel">
                        Thêm lớp học mới
                    </h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('createClassModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.classes.store') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Tên lớp học <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Mã lớp <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="code" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                    <p class="text-sm text-gray-500 mt-1">Mã lớp phải là duy nhất</p>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Giáo viên <span class="text-red-500">*</span>
                                    </label>
                                    <select name="teacher_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
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
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Ngày bắt đầu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" name="start_date" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Ngày kết thúc <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" name="end_date" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Hạn đăng ký <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="enrollment_deadline" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-3">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Số lượng học viên</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Số học viên tối thiểu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="min_students" min="1" value="5" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Số học viên tối đa <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="max_students" min="1" value="30" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-3">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Thông tin bổ sung</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-bold mb-2">
                                            Lịch học
                                        </label>
                                        <textarea name="schedule" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" placeholder="Định dạng JSON"></textarea>
                                        <p class="text-sm text-gray-500 mt-1">Ví dụ: {"monday":["08:00 - 10:00"],"wednesday":["08:00 - 10:00"]}</p>
                                    </div>

                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                                Trạng thái <span class="text-red-500">*</span>
                                            </label>
                                            <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500" required>
                                                <option value="pending">Chờ</option>
                                                <option value="active">Đang học</option>
                                                <option value="completed">Hoàn thành</option>
                                                <option value="cancelled">Đã hủy</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="flex items-center space-x-2 cursor-pointer">
                                                <input type="checkbox" name="is_active" value="1" checked
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
                                    <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 mt-6 border-t border-gray-200">
                        <button type="button" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-200 ease-in-out"
                            onclick="modalHandler.close('createClassModal')">
                            Hủy
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                            Thêm mới
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
