@extends('admin.layouts.master')
@section('title', isset($course) ? "Danh sách bài học - {$course->name}" : 'Quản lý bài học')
@section('content')
    <main class="flex-grow">
        <div class="flex justify-between items-center p-2 border-bottom">
            <h1 class="text-2xl font-bold">
                @if (!empty($course))
                    Khóa học: {{ $course->name }}
                @else
                    Bài học <span class="text-gray-500">({{ $pagination['total'] }})</span>
                @endif
            </h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.courses.index') }}" class="bg-blue-500 text-white px-2 py-1 rounded">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded" onclick="modalHandler.open('trashLessonModal')">
                    <i class="fas fa-trash"></i> Xem bài học đã xóa
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
                    <form action="{{ route('admin.lessons.index') }}" method="GET">
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

        @if (!empty($course))
            <div class="bg-white p-4 mb-4 rounded shadow">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <h5 class="font-bold mb-2">Thông tin khóa học</h5>
                        <div class="mt-3">
                            @if ($course->thumbnail)
                                <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->name }}"
                                    class="rounded max-w-full h-auto" style="max-width: 200px">
                            @else
                                <div class="p-4 bg-gray-100 text-center rounded">Chưa có ảnh</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-3">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <tr>
                                    <th class="text-left p-2 w-48">Tên khóa học:</th>
                                    <td class="p-2">{{ $course->name }}</td>
                                    <th class="text-left p-2">Tổng số đăng ký:</th>
                                    <td class="p-2">{{ $course->totalEnrollments() }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left p-2">Giá gốc:</th>
                                    <td class="p-2">{{ number_format($course->price) }}đ</td>
                                    <th class="text-left p-2">Tổng số bài học:</th>
                                    <td class="p-2">{{ $course->totalLessons() }} bài</td>
                                </tr>
                                <tr>
                                    <th class="text-left p-2">Giá khuyến mãi:</th>
                                    <td class="p-2">{{ number_format($course->sale_price) }}đ</td>
                                    <th class="text-left p-2">Tổng doanh thu:</th>
                                    <td class="p-2">{{ number_format($course->totalRevenue()) }}đ</td>
                                </tr>
                                <tr>
                                    <th class="text-left p-2">Tổng thời lượng:</th>
                                    <td class="p-2">{{ $course->totalDuration() }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-end space-x-2 mb-3">
            <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="modalHandler.open('createLessonModal')">
                <i class="fas fa-plus"></i> Thêm mới bài học
            </button>
            <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded" onclick="modalHandler.open('trashVideoLessonModal')">
                <i class="fas fa-trash"></i> Xem video/zoom bài học đã xóa
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border ps-1 py-1 border-gray-300 text-start">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">STT</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Tên bài học</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Miêu tả</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Xem Free</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Tổng View <i class="fas fa-sort"></i></th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Tổng comment <i class="fas fa-sort"></i></th>
                        <th class="border ps-1 py-1 border-gray-300 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $key => $item)
                        <tr class="hover:bg-gray-100 transition-colors duration-150">
                            <td class="ps-1 pt-1">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" data-id="{{ $item->id }}">
                            </td>
                            <td class="ps-1 pt-1">
                                {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}
                            </td>
                            <td class="ps-1 pt-1">{{ $item->name }}</td>
                            <td class="ps-1 pt-1">{{ Str::limit($item->description, 50) }}</td>
                            <td class="ps-1 pt-1">
                                <span class="px-2 py-1 rounded text-xs {{ $item->isPreview ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                    {{ $item->isPreview ? 'Có' : 'Không' }}
                                </span>
                            </td>
                            <td class="ps-1 pt-1">{{ number_format($item->totalView) }}</td>
                            <td class="ps-1 pt-1">{{ number_format($item->totalComment) }}</td>
                            <td class="ps-1 pt-1 text-center">
                                <div class="flex justify-center space-x-2">
                                    <div class="relative inline-block">
                                        <button class="text-blue-500 hover:text-blue-700" onclick="toggleDropdown({{ $item->id }})" title="Thêm mới video/zoom bài học">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <div id="dropdown-{{ $item->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="setLessonIdForVideo({{ $item->id }}); modalHandler.open('createVideoLessonModal')">
                                                <i class="fas fa-video mr-2"></i>Bài học video
                                            </a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="modalHandler.open('createZoomSessionModal')">
                                                <i class="fas fa-chalkboard-teacher mr-2"></i>Bài học zoom
                                            </a>
                                        </div>
                                    </div>
                                    <button class="text-blue-500 hover:text-blue-700" onclick="toggleVideoList({{ $item->id }})" title="Xem danh sách video">
                                        <i class="fas fa-list"></i>
                                    </button>
                                    <button class="text-blue-500 hover:text-blue-700" onclick="populateEditModal({{ json_encode($item) }}); modalHandler.open('editLessonModal')" title="Chỉnh sửa">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.lessons.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Bạn có chắc chắn muốn xóa bài học này?')" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Video list row -->
                        <tr id="video-list-{{ $item->id }}" class="bg-gray-50">
                            <td colspan="9" class="p-0">
                                <div class="video-list-container">
                                    <div class="p-3">
                                        <h6 class="font-bold mb-2">Danh sách video bài học</h6>
                                        @if(count($item->videoLessons) > 0)
                                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                                @foreach($item->videoLessons as $video)
                                                    <div class="bg-white p-3 rounded shadow">
                                                        <div class="flex justify-between items-center mb-2">
                                                            <h6 class="font-bold">{{ $video->name }}</h6>
                                                            <div class="flex space-x-1">
                                                                <button class="text-blue-500 hover:text-blue-700" onclick="showVideo('{{ $video->videoUrl }}')" title="Xem video">
                                                                    <i class="fas fa-play"></i>
                                                                </button>
                                                                <button class="text-blue-500 hover:text-blue-700" onclick="populateEditVideoModal({{ json_encode($video) }}); modalHandler.open('editVideoLessonModal')" title="Chỉnh sửa">
                                                                    <i class="far fa-edit"></i>
                                                                </button>
                                                                <form action="{{ route('admin.video-lessons.destroy', $video->id) }}" method="POST" class="inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Bạn có chắc chắn muốn xóa video này?')" title="Xóa">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <p class="text-sm text-gray-600">Thời lượng: {{ $video->duration }}</p>
                                                        @if($video->thumbnailUrl)
                                                            <img src="{{ asset($video->thumbnailUrl) }}" alt="{{ $video->name }}" class="w-full h-32 object-cover rounded mt-2">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-gray-500">Chưa có video nào cho bài học này.</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($lessons) == 0)
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
                    <!-- Phân trang -->
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

                    @if ($start > 1)
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == $pagination['current_page'])
                            <span class="px-3 py-1 bg-blue-600 text-white border border-blue-600 rounded-md font-medium shadow-sm">
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

    @include('admin.components.lessons.modals.create')
    @include('admin.components.lessons.modals.edit')
    @include('admin.components.lessons.modals.trash')
    @include('admin.components.video-lessons.modals.create')
    @include('admin.components.zoom-sessions.modals.create')
    @include('admin.components.video-lessons.modals.edit')
    @include('admin.components.video-lessons.modals.trash')

    <!-- Video Modal -->
    <div class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center" id="videoModal">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl">
            <div class="flex justify-between items-center p-4 border-b">
                <h5 class="text-lg font-bold">Xem Video</h5>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeVideoModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <video id="videoPlayer" class="w-full" controls>
                    <source src="" type="video/mp4">
                    Trình duyệt của bạn không hỗ trợ thẻ video.
                </video>
            </div>
        </div>
    </div>

    <div class="flex items-center space-x-2 mt-2 hidden" id="bulkActionButtons">
        <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="confirmBulkDelete()">
            <i class="fas fa-trash"></i> Xóa đã chọn
        </button>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(`dropdown-${id}`);
            dropdown.classList.toggle('hidden');
        }

        function populateEditModal(item) {
            modalHandler.open('editLessonModal');
            
            modalHandler.setEditModalData('editLessonModal', {
                name: item.name,
                orderNumber: item.orderNumber,
                description: item.description || '',
                isPreview: item.isPreview,
                actionUrl: "{{ route('admin.lessons.update', '') }}/" + item.id
            });
        }

        function setLessonIdForVideo(lessonId) {
            document.getElementById('lessonId').value = lessonId;
        }

        function showVideo(videoUrl) {
            const videoPlayer = document.getElementById('videoPlayer');
            videoPlayer.src = '/' + videoUrl;
            document.getElementById('videoModal').classList.remove('hidden');
        }

        function closeVideoModal() {
            const videoPlayer = document.getElementById('videoPlayer');
            videoPlayer.pause();
            videoPlayer.currentTime = 0;
            document.getElementById('videoModal').classList.add('hidden');
        }

        function toggleVideoList(lessonId) {
            const videoRow = document.querySelector(`#video-list-${lessonId}`);
            const button = event.currentTarget;
            const icon = button.querySelector('i');
            const container = videoRow.querySelector('.video-list-container');

            if (videoRow) {
                container.classList.toggle('max-h-0');
                container.classList.toggle('max-h-screen');
                icon.classList.toggle('rotate-180');
            }
        }

        function populateEditVideoModal(video) {
            modalHandler.open('editVideoLessonModal');
            
            modalHandler.setEditModalData('editVideoLessonModal', {
                name: video.name,
                duration: video.duration,
                lessonId: video.lessonId,
                thumbnailUrl: video.thumbnailUrl,
                videoUrl: video.videoUrl,
                actionUrl: `/admin/video-lessons/${video.id}`
            });
        }
        
        function confirmBulkDelete() {
            const selectedIds = tableHandler.getSelectedIds();
            if (selectedIds.length === 0) {
                alert('Vui lòng chọn ít nhất một mục để xóa');
                return;
            }
            
            if (confirm(`Bạn có chắc chắn muốn xóa ${selectedIds.length} mục đã chọn?`)) {
                // Gửi request xóa hàng loạt
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('admin.lessons.bulk-delete') }}';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                
                const ids = document.createElement('input');
                ids.type = 'hidden';
                ids.name = 'ids';
                ids.value = selectedIds.join(',');
                
                form.appendChild(csrfToken);
                form.appendChild(method);
                form.appendChild(ids);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
    
    <style>
        .video-list-container {
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
            max-height: 0;
        }
        
        .video-list-container.max-h-screen {
            max-height: 100vh;
        }
        
        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
    </style>
@endpush
