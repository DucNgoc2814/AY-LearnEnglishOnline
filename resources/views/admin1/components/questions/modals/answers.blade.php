<!-- Modal hiển thị danh sách câu trả lời -->
<div id="answersModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="answersModalLabel" role="dialog" aria-modal="true">
    <!-- Lớp nền mờ -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <!-- Container modal -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
            <!-- Header của modal -->
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold leading-6 text-gray-900" id="answersModalLabel">
                        Danh sách câu trả lời
                    </h3>
                    <button type="button"
                            class="text-gray-400 hover:text-gray-500"
                            onclick="modalHandler.close('answersModal')">
                        <span class="sr-only">Đóng</span>
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Nội dung của modal -->
                <div class="mt-4">
                    <!-- Phần hiển thị câu hỏi -->
                    <div class="mb-4">
                        <h6 class="text-sm font-medium text-gray-700">Câu hỏi:</h6>
                        <p id="questionText" class="mt-1 text-gray-600"></p>
                    </div>

                    <!-- Phần giải thích đáp án đúng -->
                    <div class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
                        <h6 class="text-sm font-medium text-green-700 mb-2">
                            <i class="fas fa-info-circle mr-2"></i>Giải thích đáp án:
                        </h6>
                        <p id="explanationText" class="text-green-600 text-sm"></p>
                    </div>

                    <!-- Bảng danh sách câu trả lời -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        STT
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Câu trả lời
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Đúng/Sai
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Loại
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Thứ tự
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="answersTableBody" class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">
                                        <i class="fas fa-spinner fa-spin mr-2"></i>
                                        Đang tải dữ liệu...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer của modal -->
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                        onclick="modalHandler.close('answersModal')">
                    Đóng
                </button>
            </div>
        </div>
    </div>
</div>
