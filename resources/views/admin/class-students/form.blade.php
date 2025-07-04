@extends('admin.layouts.app')

@section('title', isset($item) ? 'Edit' : 'Create New')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">
            {{ isset($item) ? 'Edit' : 'Create New' }}
        </h2>

        <form action="{{ isset($item) ? route($route.'.update', $item->id) : route($route.'.store') }}" method="POST">
            @csrf
            @if(isset($item))
                @method('PUT')
            @endif

            <!-- Chọn lớp học -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="class_id">
                    Lớp học
                </label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="class_id"
                    name="class_id"
                    required
                >
                    <option value="">Chọn lớp học...</option>
                    @foreach($fields['class_id']['options'] ?? [] as $value => $label)
                        <option value="{{ $value }}" {{ old('class_id', isset($item) ? $item->class_id : '') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('class_id')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Chọn học viên -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="registration_id">
                    Học viên
                </label>
                <select
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline select2-multiple"
                    id="registration_id"
                    name="registration_id[]"
                    multiple
                    required
                >
                    <option value="">Vui lòng chọn lớp học để xem danh sách học viên</option>
                </select>
                @error('registration_id')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
                @error('registration_id.*')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ngày bắt đầu -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">
                    Ngày bắt đầu
                </label>
                <input
                    type="date"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="start_date"
                    name="start_date"
                    value="{{ old('start_date', isset($item) ? $item->start_date : '') }}"
                    required
                >
                @error('start_date')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ghi chú -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">
                    Ghi chú
                </label>
                <textarea
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="notes"
                    name="notes"
                    rows="3"
                >{{ old('notes', isset($item) ? $item->notes : '') }}</textarea>
                @error('notes')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ isset($item) ? 'Update' : 'Create' }}
                </button>
                <a href="{{ route($route.'.index') }}" class="text-gray-600 hover:text-gray-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<!-- Đảm bảo jQuery được load -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo select2
    if($.fn.select2) {
        $('.select2-multiple').select2({
            theme: 'classic',
            placeholder: 'Chọn học viên...',
            allowClear: true,
            width: '100%'
        });
    }

    // Xử lý khi thay đổi lớp học
    $('select[name="class_id"]').on('change', function() {
        var classId = $(this).val();
        var studentSelect = $('select[name="registration_id[]"]');

        // Reset select box học viên
        studentSelect.empty().append('<option value="">Chọn học viên...</option>');

        if (!classId) {
            return;
        }

        // Hiển thị loading
        studentSelect.append('<option value="" disabled>Đang tải...</option>');

        // Gọi API để lấy danh sách học viên
        $.ajax({
            url: '{{ route("admin.class-students.get-students") }}',
            method: 'GET',
            data: { class_id: classId },
            success: function(response) {
                // Xóa option loading
                studentSelect.empty().append('<option value="">Chọn học viên...</option>');

                if (response && typeof response === 'object') {
                    Object.keys(response).forEach(function(key) {
                        studentSelect.append(new Option(response[key], key));
                    });
                }

                // Trigger change để cập nhật Select2
                studentSelect.trigger('change');
            },
            error: function(xhr, status, error) {
                console.error('API Error:', error);
                studentSelect.empty().append('<option value="">Có lỗi xảy ra khi tải danh sách học viên</option>');
            }
        });
    });
});
</script>
@endpush
@endsection
