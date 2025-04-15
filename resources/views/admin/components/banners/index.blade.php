@extends('admin.layouts.master')
@section('title', 'Quản lý banner')
@section('content')
    <main class="flex-grow">
        <div class="flex justify-between items-center p-2 border-bottom">
            <h1 class="text-2xl font-bold">Banner <span class="text-gray-500">({{ $pagination['total'] }})</span></h1>
            <div class="flex space-x-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="modalHandler.open('createBannerModal')">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
                <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded"
                    onclick="modalHandler.open('trashBannerModal')">
                    <i class="fas fa-trash"></i> Xem banner đã xóa
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
                    <form action="{{ route('admin.banners.index') }}" method="GET">
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
            <table class="min-w-full bg-white border border-gray-300" data-table="banners">
                <thead>
                    <tr>
                        <th class="border ps-1 py-1 border-gray-300 text-center">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="index">STT</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="title">Tiêu đề</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="image">Ảnh banner</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="position">Vị trí</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="order">Thứ tự</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="start_date">Ngày bắt đầu</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="end_date">Ngày kết thúc</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center">
                            <button class="p-2 hover:bg-gray-100 rounded">
                                <i class="fas fa-cog"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $key => $item)
                        <tr class="hover:bg-gray-100 transition-colors duration-150 text-center">
                            <td class="ps-1 pt-1">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                    data-id="{{ $item->id }}">
                            </td>
                            <td class="ps-1 pt-1" data-column="index">
                                {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}
                            </td>
                            <td class="ps-1 pt-1" data-column="title">
                                <a href="{{ $item->link_url }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                    {{ $item->title }}
                                </a>
                            </td>
                            <td class="ps-1 pt-1" data-column="image">
                                @if ($item->image_url)
                                    <img src="{{ $item->image_url }}"
                                        alt="{{ $item->title }}"
                                        data-column="image"
                                        class="h-10 w-20 object-cover rounded cursor-pointer"
                                        onclick="openImageModal('{{ $item->image_url }}')"
                                        onerror="this.onerror=null;">
                                @else
                                    <span class="text-gray-400">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="ps-1 pt-1" data-column="position">
                                @switch($item->position)
                                    @case('home_top')
                                        <span class="text-blue-600">Trang chủ - Trên</span>
                                    @break

                                    @case('home_middle')
                                        <span class="text-green-600">Trang chủ - Giữa</span>
                                    @break

                                    @case('home_bottom')
                                        <span class="text-orange-600">Trang chủ - Dưới</span>
                                    @break

                                    @case('sidebar')
                                        <span class="text-purple-600">Thanh bên</span>
                                    @break
                                @endswitch
                            </td>
                            <td class="ps-1 pt-1" data-column="order">{{ $item->order }}</td>
                            <td class="ps-1 pt-1" data-column="start_date">
                                {{ $item->start_date ? \Carbon\Carbon::parse($item->start_date)->format('d/m/Y H:i') : 'N/A' }}
                            </td>
                            <td class="ps-1 pt-1" data-column="end_date">
                                {{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('d/m/Y H:i') : 'N/A' }}
                            </td>

                            <td class="ps-1 pt-1 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="editBanner({{ $item->id }})" title="Chỉnh sửa">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.banners.destroy', $item->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa banner này?')"
                                            title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($banners) == 0)
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

    @include('admin.components.banners.modals.create')
    @include('admin.components.banners.modals.edit')
    @include('admin.components.banners.modals.trash')

    <!-- Modal xem ảnh -->
    <div id="imageModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="relative bg-white rounded-lg max-w-3xl w-full mx-auto">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900" id="imageModalLabel">Xem ảnh</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeImageModal()">
                        <span class="sr-only">Đóng</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Body -->
                <div class="p-4">
                    <img id="modalImage" src="" alt="Preview" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(src) {
            const modalImage = document.getElementById('modalImage');

            // Thêm sự kiện xử lý lỗi cho ảnh
            modalImage.onerror = function() {
                // Nếu ảnh gốc lỗi, thử tải lại với domain S3
                const s3Url = src.replace(/^https?:\/\/[^\/]+/, 'https://ay-learn-english-online.s3.ap-southeast-2.amazonaws.com');
                this.src = s3Url;

                // Nếu vẫn lỗi sau khi thử với S3
                this.onerror = function() {
                    this.src = '/path/to/default/image.jpg'; // Thay thế bằng ảnh mặc định
                    console.error('Không thể tải ảnh:', src);
                }
            };

            modalImage.src = src;
            modalHandler.open('imageModal');
        }

        // Thêm xử lý lỗi cho tất cả ảnh banner trong bảng
        document.addEventListener('DOMContentLoaded', function() {
            const bannerImages = document.querySelectorAll('img[data-column="image"]');
            bannerImages.forEach(img => {
                img.onerror = function() {
                    const originalSrc = this.src;
                    // Thử tải lại với domain S3
                    const s3Url = originalSrc.replace(/^https?:\/\/[^\/]+/, 'https://ay-learn-english-online.s3.ap-southeast-2.amazonaws.com');
                    this.src = s3Url;

                    // Nếu vẫn lỗi sau khi thử với S3
                    this.onerror = function() {
                        this.src = '/path/to/default/image.jpg'; // Thay thế bằng ảnh mặc định
                        console.error('Không thể tải ảnh:', originalSrc);
                    }
                };
            });
        });

        function closeImageModal() {
            modalHandler.close('imageModal');
        }

        // Đóng modal khi click bên ngoài
        window.onclick = function(event) {
            const imageModal = document.getElementById('imageModal');
            if (event.target === imageModal) {
                closeImageModal();
            }
        }

        // Đóng modal với phím Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
@endsection
