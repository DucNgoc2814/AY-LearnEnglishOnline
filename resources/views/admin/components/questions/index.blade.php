@extends('admin.layouts.master')

@section('title', 'Quản lý câu hỏi')

@section('content')
    <main class="flex-grow">
        <div class="flex justify-between items-center p-2 border-bottom">
            <h1 class="text-2xl font-bold">Câu hỏi <span class="text-gray-500">({{ $pagination['total'] ?? 0 }})</span></h1>
            <div class="flex space-x-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="modalHandler.open('createQuestionModal')">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
                <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded"
                    onclick="modalHandler.open('trashQuestionModal')">
                    <i class="fas fa-trash"></i> Xem câu hỏi đã xóa
                </button>
            </div>
        </div>

        <div class="flex justify-between items-center ms-2 mb-1">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <button class="bg-gray-200 px-1 py-1 rounded">Bộ lọc</button>
                    <ul class="absolute hidden bg-white shadow-lg rounded mt-2">
                        <li><a class="block px-1 py-1 text-gray-800 hover:bg-gray-200" href="#">Tạo mới</a></li>
                    </ul>
                </div>
                <div class="relative w-300">
                    <form action="{{ route('admin.questions.index') }}" method="GET">
                        <input type="text" name="search" class="border border-gray-300 rounded w-full px-1 py-1 w-3xl"
                            placeholder="Tìm kiếm..." value="{{ request('search') }}">
                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="bg-gray-200 px-2 rounded" title="Làm mới"><i class="fas fa-sync-alt"></i></button>
                <button class="bg-gray-200 px-2 me-2 rounded" title="Tùy chọn hiển thị"><i
                        class="fas fa-th-large"></i></button>
            </div>
        </div>

        <!-- Thông báo -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-2" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-2" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300" data-table="questions">
                <thead>
                    <tr>
                        <th class="border ps-1 py-1 border-gray-300 text-center">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="index">STT</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="test_id">Bài kiểm tra</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="type">Loại câu hỏi</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="question">Nội dung câu hỏi</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="media_url">Media</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="order_number">Thứ tự</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center">
                            <button class="p-2 hover:bg-gray-100 rounded">
                                <i class="fas fa-cog"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $key => $question)
                        <tr class="hover:bg-gray-100 transition-colors duration-150 text-center">
                            <td class="ps-1 pt-1">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                    data-id="{{ $question->id }}">
                            </td>
                            <td class="ps-1 pt-1" data-column="index">
                                {{ (($pagination['current_page'] ?? 1) - 1) * ($pagination['per_page'] ?? 10) + $key + 1 }}
                            </td>
                            <td class="ps-1 pt-1" data-column="test_id">{{ $question->test->name ?? 'N/A' }}</td>
                            <td class="ps-1 pt-1" data-column="type">
                                @php
                                    $typeLabels = [
                                        'text' => 'Văn bản',
                                        'image' => 'Hình ảnh',
                                        'video' => 'Video',
                                        'audio' => 'Âm thanh'
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded-full text-sm {{ $question->type == 'text' ? 'bg-blue-100 text-blue-800' : ($question->type == 'image' ? 'bg-green-100 text-green-800' : ($question->type == 'video' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800')) }}">
                                    {{ $typeLabels[$question->type] ?? $question->type }}
                                </span>
                            </td>
                            <td class="ps-1 pt-1 max-w-xs truncate" data-column="question">
                                {{ $question->question }}
                            </td>
                            <td class="ps-1 pt-1" data-column="media_url">
                                @if($question->media_url)
                                    @if($question->type == 'image')
                                        <img src="{{ asset($question->media_url) }}" alt="Media" class="h-10 w-10 object-cover rounded mx-auto">
                                    @elseif($question->type == 'video')
                                        <i class="fas fa-video text-blue-500 text-xl"></i>
                                    @elseif($question->type == 'audio')
                                        <i class="fas fa-volume-up text-green-500 text-xl"></i>
                                    @else
                                        <i class="fas fa-file-alt text-gray-500 text-xl"></i>
                                    @endif
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </td>
                            <td class="ps-1 pt-1" data-column="order_number">{{ $question->order_number }}</td>
                            <td class="ps-1 pt-1 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="editQuestion({{ $question->id }})" title="Chỉnh sửa">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa câu hỏi này?')"
                                            title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($questions ?? []) == 0)
                        <tr>
                            <td colspan="8" class="text-center ps-1 pt-1">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="flex justify-between items-center p-4 bg-white border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    @if(isset($pagination) && isset($pagination['total']))
                    Hiển thị từ <span
                        class="font-medium">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}</span>
                    đến <span
                        class="font-medium">{{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}</span>
                    của <span class="font-medium">{{ $pagination['total'] }}</span> bản ghi
                    @endif
                </div>
                <div class="flex items-center space-x-1">
                    @if(isset($pagination) && isset($pagination['current_page']) && $pagination['current_page'] > 1)
                        <a href="{{ request()->url() }}?page=1{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                            class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <a href="{{ request()->url() }}?page={{ $pagination['current_page'] - 1 }}{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                            class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-left"></i>
                        </a>
                    @else
                        <span
                            class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-double-left"></i>
                        </span>
                        <span
                            class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-left"></i>
                        </span>
                    @endif

                    @if(isset($pagination) && isset($pagination['last_page']))
                    @php
                        $start = max(1, ($pagination['current_page'] ?? 1) - 2);
                        $end = min($pagination['last_page'], ($pagination['current_page'] ?? 1) + 2);
                    @endphp

                    @if ($start > 1)
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == ($pagination['current_page'] ?? 1))
                            <span
                                class="px-3 py-1 bg-blue-600 text-white border border-blue-600 rounded-md font-medium shadow-sm">
                                {{ $i }}
                            </span>
                        @else
                            <a href="{{ request()->url() }}?page={{ $i }}{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                                class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor

                    @if ($end < $pagination['last_page'])
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif
                    @endif

                    @if(isset($pagination) && isset($pagination['current_page']) && isset($pagination['last_page']) && $pagination['current_page'] < $pagination['last_page'])
                        <a href="{{ request()->url() }}?page={{ $pagination['current_page'] + 1 }}{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                            class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-right"></i>
                        </a>
                        <a href="{{ request()->url() }}?page={{ $pagination['last_page'] }}{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                            class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    @else
                        <span
                            class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-right"></i>
                        </span>
                        <span
                            class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-double-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Các modal -->
    @include('admin.components.questions.modals.create')
    @include('admin.components.questions.modals.edit')
    @include('admin.components.questions.modals.trash')

    <script>
        const modalHandler = {
            open: function(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            },
            close: function(modalId) {
                document.getElementById(modalId).classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        };
    </script>
@endsection
