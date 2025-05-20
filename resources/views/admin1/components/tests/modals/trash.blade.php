<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="trashTestModal" aria-labelledby="trashTestModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="trashTestModalLabel">Danh sách bài test đã xóa</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('trashTestModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mt-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tên bài test
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Loại test
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Điểm tối thiểu
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ngày xóa
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Thao tác
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(isset($trashList) && count($trashList) > 0)
                                @foreach ($trashList as $test)
                                    <tr class="hover:bg-gray-100 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $test->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @switch($test->type)
                                                @case('lesson_test')
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">Bài học</span>
                                                    @break
                                                @case('final_exam')
                                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-0.5 rounded">Thi cuối khóa</span>
                                                    @break
                                                @case('entrance_test')
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded">Test đầu vào</span>
                                                    @break
                                                @case('session_test')
                                                    <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2 py-0.5 rounded">Buổi học</span>
                                                    @break
                                                @default
                                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded">{{ $test->type }}</span>
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $test->min_score }}/{{ $test->max_score }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($test->deleted_at)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <form action="{{ route('admin.tests.restore', $test->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 p-1 rounded transition-colors duration-150"
                                                    title="Khôi phục"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục bài test này?')">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        Không có bài test nào đã xóa.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    @if(isset($trashPagination) && $trashPagination['total'] > 0)
                    <div class="flex justify-between items-center p-4 bg-white border-t border-gray-200">
                        <div class="text-sm text-gray-600">
                            Hiển thị từ <span class="font-medium">{{ ($trashPagination['current_page'] - 1) * $trashPagination['per_page'] + 1 }}</span>
                            đến <span class="font-medium">{{ min($trashPagination['current_page'] * $trashPagination['per_page'], $trashPagination['total']) }}</span>
                            của <span class="font-medium">{{ $trashPagination['total'] }}</span> bản ghi
                        </div>
                        <div class="flex items-center space-x-1">
                            @if($trashPagination['current_page'] > 1)
                                <a href="{{ request()->url() }}?page=1{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                                   class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                                <a href="{{ request()->url() }}?page={{ $trashPagination['current_page'] - 1 }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                                   class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            @else
                                <span class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-angle-double-left"></i>
                                </span>
                                <span class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-angle-left"></i>
                                </span>
                            @endif

                            @php
                                $start = max(1, $trashPagination['current_page'] - 2);
                                $end = min($trashPagination['last_page'], $trashPagination['current_page'] + 2);
                            @endphp

                            @if($start > 1)
                                <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                            @endif

                            @for($i = $start; $i <= $end; $i++)
                                @if($i == $trashPagination['current_page'])
                                    <span class="px-3 py-1 bg-blue-600 text-white border border-blue-600 rounded-md font-medium shadow-sm">
                                        {{ $i }}
                                    </span>
                                @else
                                    <a href="{{ request()->url() }}?page={{ $i }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                                       class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                                        {{ $i }}
                                    </a>
                                @endif
                            @endfor

                            @if($end < $trashPagination['last_page'])
                                <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                            @endif

                            @if($trashPagination['current_page'] < $trashPagination['last_page'])
                                <a href="{{ request()->url() }}?page={{ $trashPagination['current_page'] + 1 }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                                   class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                                <a href="{{ request()->url() }}?page={{ $trashPagination['last_page'] }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                                   class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            @else
                                <span class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                                <span class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-angle-double-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <div class="flex justify-end pt-2 mt-4 border-t">
                    <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded"
                        onclick="modalHandler.close('trashTestModal')">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
