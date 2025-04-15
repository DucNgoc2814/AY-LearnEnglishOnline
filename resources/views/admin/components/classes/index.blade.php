@extends('admin.layouts.master')
@section('title', 'Quản lý lớp học')
@section('content')
    <main class="flex-grow">
        <div class="flex justify-between items-center p-2 border-bottom">
            <h1 class="text-2xl font-bold">Lớp học <span class="text-gray-500">({{ $pagination['total'] }})</span></h1>
            <div class="flex space-x-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="modalHandler.open('createClassModal')">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
                <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded" onclick="modalHandler.open('trashClassModal')">
                    <i class="fas fa-trash"></i> Xem lớp học đã xóa
                </button>
            </div>
        </div>

        <div class="flex justify-between items-cente ms-2 mb-1">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <button class="bg-gray-200 px-1 py-1 rounded">Bộ lọc</button>
                    <ul class="absolute hidden bg-white shadow-lg rounded mt-2">
                        <li><a class="block px-1 py-1 text-gray-800 hover:bg-gray-200" href="#">Tạo mới</a></li>
                    </ul>
                </div>
                <div class="relative w-300">
                    <form action="{{ route('admin.classes.index') }}" method="GET">
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
                <button class="bg-gray-200 px-2 me-2 rounded" title="Tùy chọn hiển thị"><i class="fas fa-th-large"></i></button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border ps-1 py-1 border-gray-300 text-start">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">STT</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Mã lớp</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Tên lớp</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Giáo viên</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Thời gian</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Số học viên</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Trạng thái</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Kích hoạt</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $key => $item)
                        <tr class="hover:bg-gray-100 transition-colors duration-150">
                            <td class="ps-1 pt-1">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600" data-id="{{ $item->id }}">
                            </td>
                            <td class="ps-1 pt-1">
                                {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}
                            </td>
                            <td class="ps-1 pt-1">{{ $item->code }}</td>
                            <td class="ps-1 pt-1"><a href="#" class="text-blue-500">{{ $item->name }}</a></td>
                            <td class="ps-1 pt-1">{{ $item->teacher->name }}</td>
                            <td class="ps-1 pt-1">
                                <div class="text-xs">
                                    <div>Bắt đầu: {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y H:i') }}</div>
                                    <div>Kết thúc: {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y H:i') }}</div>
                                    <div>Hạn đăng ký: {{ $item->enrollment_deadline ? \Carbon\Carbon::parse($item->enrollment_deadline)->format('d/m/Y') : 'Không có' }}</div>
                                </div>
                            </td>
                            <td class="ps-1 pt-1">
                                <div class="text-xs">
                                    <div>Hiện tại: {{ $item->current_students }}/{{ $item->max_students }}</div>
                                    <div>Tối thiểu: {{ $item->min_students }}</div>
                                </div>
                            </td>
                            <td class="ps-1 pt-1">
                                @switch($item->status)
                                    @case('pending')
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Chờ</span>
                                        @break
                                    @case('active')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Đang học</span>
                                        @break
                                    @case('completed')
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Hoàn thành</span>
                                        @break
                                    @case('cancelled')
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Đã hủy</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="ps-1 pt-1">
                                <span class="{{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2 py-1 rounded-full text-xs">
                                    {{ $item->is_active ? 'Có' : 'Không' }}
                                </span>
                            </td>
                            <td class="ps-1 pt-1 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="populateEditModal({{ json_encode($item) }})"
                                        title="Chỉnh sửa">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.classes.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Xóa"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa lớp học này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($classes) == 0)
                        <tr>
                            <td colspan="9" class="text-center ps-1 pt-1">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="flex justify-between items-center p-4 bg-white border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Hiển thị từ <span class="font-medium">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}</span>
                    đến <span class="font-medium">{{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}</span>
                    của <span class="font-medium">{{ $pagination['total'] }}</span> bản ghi
                </div>
                <div class="flex items-center space-x-1">
                    @if($pagination['current_page'] > 1)
                        <a href="{{ request()->url() }}?page=1{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                           class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <a href="{{ request()->url() }}?page={{ $pagination['current_page'] - 1 }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
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
                        $start = max(1, $pagination['current_page'] - 2);
                        $end = min($pagination['last_page'], $pagination['current_page'] + 2);
                    @endphp

                    @if($start > 1)
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif

                    @for($i = $start; $i <= $end; $i++)
                        @if($i == $pagination['current_page'])
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

                    @if($end < $pagination['last_page'])
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif

                    @if($pagination['current_page'] < $pagination['last_page'])
                        <a href="{{ request()->url() }}?page={{ $pagination['current_page'] + 1 }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                           class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-right"></i>
                        </a>
                        <a href="{{ request()->url() }}?page={{ $pagination['last_page'] }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
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
        </div>
    </main>
    @include('admin.components.classes.modals.create')
    @include('admin.components.classes.modals.edit')
    @include('admin.components.classes.modals.trash')

    <div class="flex items-center space-x-2 mt-2 hidden" id="bulkActionButtons">
        <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="confirmBulkDelete()">
            <i class="fas fa-trash"></i> Xóa đã chọn
        </button>
    </div>
@endsection

@push('scripts')
    <script>
        function populateEditModal(item) {
            modalHandler.open('editClassModal');

            modalHandler.setEditModalData('editClassModal', {
                name: item.name,
                code: item.code,
                teacher_id: item.teacher_id,
                start_date: item.start_date,
                end_date: item.end_date,
                enrollment_deadline: item.enrollment_deadline,
                max_students: item.max_students,
                min_students: item.min_students,
                status: item.status,
                description: item.description,
                schedule: item.schedule,
                is_active: item.is_active,
                actionUrl: '{{ url('admin/classes') }}/' + item.id
            });
        }
    </script>
@endpush
