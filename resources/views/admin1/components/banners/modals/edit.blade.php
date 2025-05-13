<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editBannerModal" aria-labelledby="editBannerModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editBannerModalLabel">Chỉnh sửa banner</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="closeEditBannerModal()" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="banner_id" id="edit_bannerId">
                    <input type="hidden" name="image_url" id="edit_image_url">
                    <div class="mt-4">
                        <!-- Thông tin cơ bản -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_title">
                                Tiêu đề <span class="text-red-500">*</span>
                                </label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_title" name="title" required>
                            </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_link_url">
                                Đường dẫn liên kết
                            </label>
                            <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="edit_link_url" name="link_url" placeholder="https://">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_position">
                                    Vị trí <span class="text-red-500">*</span>
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_position" name="position" required>
                                    <option value="home_top">Trang chủ - Trên</option>
                                    <option value="home_middle">Trang chủ - Giữa</option>
                                    <option value="home_bottom">Trang chủ - Dưới</option>
                                    <option value="sidebar">Thanh bên</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_order">
                                    Thứ tự hiển thị
                                </label>
                                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_order" name="order" min="0">
                            </div>
                            </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_start_date">
                                    Ngày bắt đầu
                                </label>
                                <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_start_date" name="start_date">
                            </div>

                                <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_end_date">
                                    Ngày kết thúc
                                    </label>
                                <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_end_date" name="end_date">
                            </div>
                        </div>

                        <!-- Banner Image -->
                            <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_image">
                                Ảnh banner <span class="text-red-500">*</span>
                                </label>
                                <div class="preview-container mb-2">
                                <img id="edit_imagePreview" src="" class="hidden max-w-full h-auto rounded-lg shadow-md cursor-pointer"
                                    style="max-height: 200px; object-fit: contain;" onclick="openImageModal(this.src)">
                                </div>
                                <div class="flex space-x-2">
                                <button type="button" id="edit_chooseImageBtn"
                                        class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                        Chọn ảnh
                                    </button>
                                <button type="button" onclick="clearEditImage()"
                                        class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                        Xóa ảnh
                                    </button>
                            </div>
                            <input type="file" class="hidden" id="edit_image" name="image" accept="image/*">
                            </div>

                        <!-- Trạng thái -->
                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="edit_is_active" name="is_active" value="1">
                                        <span class="ml-2 text-gray-700">Kích hoạt</span>
                                    </label>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="closeEditBannerModal()">
                            Hủy
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cập nhật
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
    function editBanner(id) {
        console.log('Editing banner:', id);

        fetch(`/admin/banners/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(response => {
                console.log('Response:', response);
                if (response.status) {
                    populateBannerEditModal(response.data);
                } else {
                    throw new Error(response.message || 'Không thể tải thông tin banner');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi tải dữ liệu: ' + error.message);
            });
    }

    function populateBannerEditModal(banner) {
        console.log('Populating modal with:', banner);
        modalHandler.open('editBannerModal');

        const form = document.getElementById('editBannerForm');
        form.action = `/admin/banners/${banner.id}`;

        // Điền dữ liệu vào form
        document.getElementById('edit_bannerId').value = banner.id;
        document.getElementById('edit_title').value = banner.title;
        document.getElementById('edit_link_url').value = banner.link_url || '';
        document.getElementById('edit_position').value = banner.position;
        document.getElementById('edit_order').value = banner.order;

        // Xử lý ngày
        if (banner.start_date) {
            const startDate = new Date(banner.start_date);
            document.getElementById('edit_start_date').value = startDate.toISOString().slice(0, 16);
        } else {
            document.getElementById('edit_start_date').value = '';
        }

        if (banner.end_date) {
            const endDate = new Date(banner.end_date);
            document.getElementById('edit_end_date').value = endDate.toISOString().slice(0, 16);
        } else {
            document.getElementById('edit_end_date').value = '';
        }

        // Lưu URL hiện tại vào input hidden để giữ lại khi không upload file mới
        document.getElementById('edit_image_url').value = banner.image_url || '';

        // Hiển thị ảnh
        const imagePreview = document.getElementById('edit_imagePreview');
        if (banner.image_url) {
            console.log('Setting image:', banner.image_url);
            imagePreview.src = banner.image_url;
            imagePreview.classList.remove('hidden');
        } else {
            imagePreview.classList.add('hidden');
        }

        // Checkbox
        document.getElementById('edit_is_active').checked = Boolean(banner.is_active);

        // Xóa input hidden nếu có
        const removeImageInput = form.querySelector('input[name="remove_image"]');
        if (removeImageInput) removeImageInput.remove();
    }

    function handleEditImageUpload(input) {
        const preview = document.getElementById('edit_imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');

                // Xóa URL hiện tại
                document.getElementById('edit_image_url').value = '';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearEditImage() {
        const preview = document.getElementById('edit_imagePreview');
        const input = document.getElementById('edit_image');
        const urlInput = document.getElementById('edit_image_url');

        preview.src = '';
        preview.classList.add('hidden');
        input.value = '';
        urlInput.value = ''; // Xóa giá trị URL hiện tại

        // Thêm input hidden để đánh dấu xóa ảnh
        let removeInput = document.querySelector('input[name="remove_image"]');
        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_image';
            removeInput.value = '1';
            input.parentNode.appendChild(removeInput);
        }
        removeInput.value = '1';
    }

    function closeEditBannerModal() {
        modalHandler.close('editBannerModal');
        document.getElementById('editBannerForm').reset();

        // Xóa input hidden nếu có
        const form = document.getElementById('editBannerForm');
        const removeImageInput = form.querySelector('input[name="remove_image"]');
        if (removeImageInput) removeImageInput.remove();
    }

    // Thêm event listeners khi tài liệu đã sẵn sàng
    document.addEventListener('DOMContentLoaded', function() {
        // Đăng ký sự kiện cho form edit
        const editForm = document.getElementById('editBannerForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const bannerId = document.getElementById('edit_bannerId').value;
                const formData = new FormData(this);

                // Xử lý input hidden
                const imageInput = document.getElementById('edit_image');

                // Nếu không có file upload mới, sử dụng URL hiện tại
                if (!imageInput.files.length && document.getElementById('edit_image_url').value && !formData.has('remove_image')) {
                    // Không thêm gì vào formData nếu đang giữ nguyên ảnh
                    console.log('Keeping current image:', document.getElementById('edit_image_url').value);
                }

                // Gửi form bằng AJAX
                fetch(`/admin/banners/${bannerId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert('Cập nhật thành công!');
                            closeEditBannerModal();
                            // Reload trang để cập nhật dữ liệu
                            window.location.reload();
                        } else {
                            alert('Lỗi: ' + result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Đã xảy ra lỗi khi cập nhật');
                    });
            });
        }

        // Xử lý sự kiện click cho nút "Chọn ảnh"
        const imageBtn = document.getElementById('edit_chooseImageBtn');
        if (imageBtn) {
            imageBtn.addEventListener('click', function() {
                document.getElementById('edit_image').click();
            });
        }

        // Xử lý preview ảnh
        const imageInput = document.getElementById('edit_image');
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                handleEditImageUpload(this);

                // Xóa input hidden remove_image nếu chọn file mới
                const removeInput = document.querySelector('input[name="remove_image"]');
                if (removeInput) removeInput.remove();
            });
        }

        // Đóng modal khi nhấn ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeEditBannerModal();
            }
        });

        // Đóng modal khi click bên ngoài
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('editBannerModal');
            if (event.target === modal) {
                closeEditBannerModal();
            }
        });
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
