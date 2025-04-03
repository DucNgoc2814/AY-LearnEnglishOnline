@extends('admin.layouts.master')
@section('title', 'Quản lý khóa học')
@section('content')
    <main class="flex-grow">
        <div class="flex justify-between items-center p-2 border-bottom">
            <h1 class="text-2xl font-bold">Khóa học <span class="text-gray-500">({{ $pagination['total'] }})</span></h1>
            <div class="flex space-x-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="modalHandler.open('createCourseModal')">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
                <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded"
                    onclick="modalHandler.open('trashCourseModal')">
                    <i class="fas fa-trash"></i> Xem khóa học đã xóa
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
                    <form action="{{ route('admin.courses.index') }}" method="GET">
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

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300" data-table="courses">
                <thead>
                    <tr>
                        <th class="border ps-1 py-1 border-gray-300 text-center">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="index">STT</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="category_id">Danh mục</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="title">Tiêu đề</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="course_type">Loại khóa học</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="course_format">Hình thức</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="price">Giá gốc</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="sale_price">Giá khuyến mãi</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="total_students">Số học viên</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="rating">Đánh giá</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="is_active">Trạng thái</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center">
                            <button onclick="toggleColumnSelector('courses')" class="p-2 hover:bg-gray-100 rounded">
                                <i class="fas fa-cog"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $key => $item)
                        <tr class="hover:bg-gray-100 transition-colors duration-150 text-center">
                            <td class="ps-1 pt-1">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                    data-id="{{ $item->id }}">
                            </td>
                            <td class="ps-1 pt-1" data-column="index">
                                {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}
                            </td>
                            <td class="ps-1 pt-1" data-column="category_id">{{ $item->category->name ?? 'N/A' }}</td>
                            <td class="ps-1 pt-1" data-column="title"><a href="#" class="text-blue-500">{{ $item->title }}</a></td>
                            <td class="ps-1 pt-1" data-column="course_type">
                                @switch($item->course_type)
                                    @case('self_paced')
                                        <span class="text-green-600">Tự học</span>
                                    @break

                                    @case('instructor_led')
                                        <span class="text-blue-600">Có giảng viên</span>
                                    @break

                                    @case('hybrid')
                                        <span class="text-purple-600">Kết hợp</span>
                                    @break
                                @endswitch
                            </td>
                            <td class="ps-1 pt-1" data-column="course_format">
                                @switch($item->course_format)
                                    @case('online')
                                        <span class="text-blue-600">Trực tuyến</span>
                                    @break

                                    @case('offline')
                                        <span class="text-orange-600">Trực tiếp</span>
                                    @break

                                    @case('hybrid')
                                        <span class="text-purple-600">Kết hợp</span>
                                    @break
                                @endswitch
                            </td>
                            <td class="ps-1 pt-1" data-column="price">{{ number_format($item->price) }}đ</td>
                            <td class="ps-1 pt-1" data-column="sale_price">{{ $item->sale_price ? number_format($item->sale_price) . 'đ' : 'N/A' }}
                            </td>
                            <td class="ps-1 pt-1" data-column="total_students">{{ number_format($item->total_students) }}</td>
                            <td class="ps-1 pt-1" data-column="rating">
                                <div class="flex items-center">
                                    {{ number_format($item->rating, 1) }}
                                    <i class="fas fa-star text-yellow-400 ml-1"></i>
                                    <span class="text-gray-500 text-sm ml-1">({{ $item->total_ratings }})</span>
                                </div>
                            </td>
                            <td class="ps-1 pt-1" data-column="is_active">
                                <span
                                    class="px-2 py-1 rounded-full text-sm {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                </span>
                            </td>
                            <td class="ps-1 pt-1 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="modalHandler.open('createLessonModal', {{ $item->id }})"
                                        class="text-blue-500 hover:text-blue-700"
                                        title="Thêm bài học">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="editCourse({{ $item->id }})" title="Chỉnh sửa">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.courses.destroy', $item->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?')"
                                            title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($courses) == 0)
                        <tr>
                            <td colspan="10" class="text-center ps-1 pt-1">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="flex justify-between items-center p-4 bg-white border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Hiển thị từ <span
                        class="font-medium">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}</span>
                    đến <span
                        class="font-medium">{{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}</span>
                    của <span class="font-medium">{{ $pagination['total'] }}</span> bản ghi
                </div>
                <div class="flex items-center space-x-1">
                    @if ($pagination['current_page'] > 1)
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

                    @php
                        $start = max(1, $pagination['current_page'] - 2);
                        $end = min($pagination['last_page'], $pagination['current_page'] + 2);
                    @endphp

                    @if ($start > 1)
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == $pagination['current_page'])
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

                    @if ($pagination['current_page'] < $pagination['last_page'])
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

    @include('admin.components.courses.modals.create')
    @include('admin.components.courses.modals.edit')
    @include('admin.components.courses.modals.trash')
    @include('admin.components.lessons.modals.create')

@endsection
