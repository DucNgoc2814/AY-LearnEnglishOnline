@extends('admin.layouts.app')

@section('title', 'Danh sách học viên trong lớp')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900">
                {{ $title ?? 'Danh sách học viên trong lớp' }}
            </h2>
            <a href="{{ route($route.'.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Thêm mới
            </a>
        </div>

        <!-- Bảng danh sách -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lớp học
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Học viên
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ngày bắt đầu
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ghi chú
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $currentClass = null;
                        $rowspanCount = [];

                        // Tính số học viên cho mỗi lớp
                        foreach($items as $item) {
                            $classKey = $item->class->name . ' (' . $item->class->code . ')';
                            if (!isset($rowspanCount[$classKey])) {
                                $rowspanCount[$classKey] = 1;
                            } else {
                                $rowspanCount[$classKey]++;
                            }
                        }
                    @endphp

                    @forelse($items as $item)
                        <tr>
                            @php
                                $classKey = $item->class->name . ' (' . $item->class->code . ')';
                            @endphp

                            @if($currentClass !== $classKey)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" rowspan="{{ $rowspanCount[$classKey] }}">
                                    {{ $classKey }}
                                </td>
                                @php
                                    $currentClass = $classKey;
                                @endphp
                            @endif

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $item->student_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $item->start_date ? date('d/m/Y', strtotime($item->start_date)) : '' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $item->notes }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route($route.'.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Sửa
                                </a>
                                <form action="{{ route($route.'.destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Không có dữ liệu
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <div class="mt-4">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
