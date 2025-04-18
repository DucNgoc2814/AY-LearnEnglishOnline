<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="createBannerModal" aria-labelledby="createBannerModalLabel"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="createBannerModalLabel">Thêm banner mới</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('createBannerModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div id="createBannerErrors" class="hidden">
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Có lỗi xảy ra:</h3>
                                <div class="mt-2 text-sm text-red-700" id="createBannerErrorList"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="createBannerForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <!-- Thông tin cơ bản -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Tiêu đề <span class="text-red-500">*</span>
                            </label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="title" name="title" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="link_url">
                                Đường dẫn liên kết
                            </label>
                            <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="link_url" name="link_url" placeholder="https://">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="position">
                                    Vị trí <span class="text-red-500">*</span>
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="position" name="position" required>
                                    <option value="home_top">Trang chủ - Trên</option>
                                    <option value="home_middle">Trang chủ - Giữa</option>
                                    <option value="home_bottom">Trang chủ - Dưới</option>
                                    <option value="sidebar">Thanh bên</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="order">
                                    Thứ tự hiển thị
                                </label>
                                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="order" name="order" min="0" value="0">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">
                                    Ngày bắt đầu
                                </label>
                                <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="start_date" name="start_date">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="end_date">
                                    Ngày kết thúc
                                </label>
                                <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="end_date" name="end_date">
                            </div>
                        </div>

                        <!-- Banner Image -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                Ảnh banner <span class="text-red-500">*</span>
                            </label>
                            <div class="preview-container mb-2">
                                <img id="imagePreview" src="" class="hidden max-w-full h-auto rounded-lg shadow-md cursor-pointer"
                                    style="max-height: 200px; object-fit: contain;" onclick="openImageModal(this.src)">
                            </div>
                            <div class="flex space-x-2">
                                <button type="button" id="chooseImageBtn"
                                    class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Chọn ảnh
                                </button>
                                <button type="button" onclick="clearImage()"
                                    class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Xóa ảnh
                                </button>
                            </div>
                            <input type="file" class="hidden" id="image" name="image" accept="image/*" required>
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                    id="is_active" name="is_active" value="1" checked>
                                <span class="ml-2 text-gray-700">Kích hoạt</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="modalHandler.close('createBannerModal')">
                            Hủy
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Thêm mới
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createBannerForm');
    const errorsDiv = document.getElementById('createBannerErrors');
    const errorsList = document.getElementById('createBannerErrorList');

    // Biến để lưu trữ file đã chọn
    let selectedImage = null;

    // Xử lý sự kiện click cho nút "Chọn ảnh"
    document.getElementById('chooseImageBtn').addEventListener('click', function() {
        document.getElementById('image').click();
    });

    // Xử lý preview ảnh
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(this.files[0]);
            selectedImage = this.files[0];
        }
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Reset errors
        errorsDiv.classList.add('hidden');
        errorsList.innerHTML = '';

        const formData = new FormData(this);

        // Kiểm tra file ảnh
        const imageFile = document.getElementById('image').files[0];
        if (!imageFile) {
            errorsDiv.classList.remove('hidden');
            errorsList.innerHTML = '<ul class="list-disc list-inside"><li>Vui lòng chọn ảnh banner</li></ul>';
            return;
        }

        // Kiểm tra các trường bắt buộc khác
        const title = document.getElementById('title').value.trim();
        const position = document.getElementById('position').value;

        if (!title) {
            errorsDiv.classList.remove('hidden');
            errorsList.innerHTML = '<ul class="list-disc list-inside"><li>Vui lòng nhập tiêu đề banner</li></ul>';
            return;
        }

        // Hiển thị loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';

        fetch('{{ route('admin.banners.store') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Reset loading state
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;

            if (data.status === false) {
                // Show validation errors
                errorsDiv.classList.remove('hidden');
                if (data.errors) {
                    let errorHtml = '<ul class="list-disc list-inside">';
                    Object.keys(data.errors).forEach(key => {
                        data.errors[key].forEach(error => {
                            errorHtml += `<li>${error}</li>`;
                        });
                    });
                    errorHtml += '</ul>';
                    errorsList.innerHTML = errorHtml;
                } else {
                    errorsList.innerHTML = `<ul class="list-disc list-inside"><li>${data.message}</li></ul>`;
                }
            } else {
                // Success
                modalHandler.close('createBannerModal');
                alert('Thêm banner thành công!');
                window.location.reload();
            }
        })
        .catch(error => {
            // Reset loading state
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;

            console.error('Error:', error);
            errorsDiv.classList.remove('hidden');
            errorsList.innerHTML = '<ul class="list-disc list-inside"><li>Có lỗi xảy ra khi thêm banner</li></ul>';
        });
    });
});

function clearImage() {
    const preview = document.getElementById('imagePreview');
    const input = document.getElementById('image');
    preview.src = '';
    preview.classList.add('hidden');
    input.value = '';
    selectedImage = null;
}

function openImageModal(src) {
    const modalImage = document.getElementById('modalImage');
    modalImage.src = src;
    modalHandler.open('imageModal');
}

function closeImageModal() {
    modalHandler.close('imageModal');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const imageModal = document.getElementById('imageModal');
    if (event.target === imageModal) {
        closeImageModal();
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeImageModal();
    }
});
</script>

<style>
    .preview-container {
        min-height: 50px;
        border: 2px dashed #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8fafc;
    }

    .preview-container img {
        max-width: 100%;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }

    .preview-container img:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Modal animation */
    .modal-content {
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>
