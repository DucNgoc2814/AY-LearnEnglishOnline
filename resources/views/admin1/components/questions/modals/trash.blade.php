<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="trashQuestionModal" aria-labelledby="trashQuestionModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="trashQuestionModalLabel">Danh sách câu hỏi đã xóa</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('trashQuestionModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mt-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bài kiểm tra</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loại câu hỏi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nội dung câu hỏi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày xóa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(isset($trashList) && count($trashList) > 0)
                                @foreach ($trashList as $question)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $question->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $question->test->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $typeLabels = [
                                                    'text' => 'Văn bản',
                                                    'image' => 'Hình ảnh',
                                                    'video' => 'Video',
                                                    'audio' => 'Âm thanh'
                                                ];
                                            @endphp
                                            <span class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full">
                                                {{ $typeLabels[$question->type] ?? $question->type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap max-w-xs truncate">{{ $question->question }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($question->deleted_at)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('admin.questions.restore', $question->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 p-1 rounded"
                                                    title="Khôi phục"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục câu hỏi này?')">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                        Không có câu hỏi nào đã xóa.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang cho thùng rác -->
                @if(isset($trashPagination))
                <div class="mt-4 px-6 py-4 flex items-center justify-between border-t">
                    <div class="text-sm text-gray-700">
                        Hiển thị từ {{ ($trashPagination['current_page'] - 1) * $trashPagination['per_page'] + 1 }}
                        đến {{ min($trashPagination['current_page'] * $trashPagination['per_page'], $trashPagination['total']) }}
                        của {{ $trashPagination['total'] }} bản ghi
                    </div>
                    <div>
                        {!! $trashPagination['links'] !!}
                    </div>
                </div>
                @endif

                <div class="flex justify-end pt-2 mt-4 border-t">
                    <button type="button"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded"
                        onclick="modalHandler.close('trashQuestionModal')">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
