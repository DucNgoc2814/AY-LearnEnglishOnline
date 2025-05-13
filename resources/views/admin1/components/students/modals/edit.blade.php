<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editStudentModal" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editStudentModalLabel">Chỉnh sửa học viên</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('editStudentModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editStudentForm" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_full_name">
                                    Họ và tên <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_full_name" name="full_name" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Email
                                </label>
                                <div class="flex">
                                    <span class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100" id="edit_email_display"></span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_date_of_birth">
                                    Ngày sinh
                                </label>
                                <input type="date"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_date_of_birth" name="date_of_birth">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_gender">
                                    Giới tính
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_gender" name="gender">
                                    <option value="">-- Chọn giới tính --</option>
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_phone">
                                    Số điện thoại
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_phone" name="phone">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_address">
                                    Địa chỉ
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_address" name="address" rows="2"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_bio">
                                    Tiểu sử
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_bio" name="bio" rows="3"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_avatar">
                                    Ảnh đại diện
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 mb-2">
                                    <div id="edit-preview-container" class="mb-3 flex items-center justify-center bg-gray-50" style="height: 180px;">
                                        <img id="edit-preview-image" src="#" alt="Preview" class="w-full h-full object-contain hidden">
                                        <div id="edit-placeholder" class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p class="mt-1 text-sm text-gray-500">Tải ảnh lên</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center space-x-2">
                                        <input type="file" id="edit_avatar" name="avatar" accept="image/*" class="hidden">
                                        <button type="button" onclick="document.getElementById('edit_avatar').click()"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Chọn ảnh
                                        </button>
                                        <button type="button" onclick="removeEditImage()"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Xóa ảnh
                                        </button>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500">Định dạng cho phép: PNG, JPG, JPEG. Tối đa 2MB.</p>
                            </div>
                        </div>

                        <!-- Thông tin phụ huynh -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin phụ huynh</h4>

                            <!-- Phụ huynh 1 -->
                            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                                <h5 class="font-medium text-gray-700 mb-3">Phụ huynh 1</h5>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent1_name">
                                        Họ và tên
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent1_name" name="parent1_name">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent1_relationship">
                                        Quan hệ
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent1_relationship" name="parent1_relationship">
                                        <option value="">-- Chọn quan hệ --</option>
                                        <option value="father">Cha</option>
                                        <option value="mother">Mẹ</option>
                                        <option value="guardian">Người giám hộ</option>
                                        <option value="other">Khác</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent1_phone">
                                        Số điện thoại
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent1_phone" name="parent1_phone">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent1_email">
                                        Email
                                    </label>
                                    <input type="email"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent1_email" name="parent1_email">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent1_occupation">
                                        Nghề nghiệp
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent1_occupation" name="parent1_occupation">
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox" name="parent1_is_emergency_contact" value="1" id="edit_parent1_is_emergency_contact">
                                        <span class="ml-2">Là người liên hệ khẩn cấp</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Phụ huynh 2 -->
                            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                                <h5 class="font-medium text-gray-700 mb-3">Phụ huynh 2</h5>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent2_name">
                                        Họ và tên
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent2_name" name="parent2_name">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent2_relationship">
                                        Quan hệ
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent2_relationship" name="parent2_relationship">
                                        <option value="">-- Chọn quan hệ --</option>
                                        <option value="father">Cha</option>
                                        <option value="mother">Mẹ</option>
                                        <option value="guardian">Người giám hộ</option>
                                        <option value="other">Khác</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent2_phone">
                                        Số điện thoại
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent2_phone" name="parent2_phone">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent2_email">
                                        Email
                                    </label>
                                    <input type="email"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent2_email" name="parent2_email">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_parent2_occupation">
                                        Nghề nghiệp
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_parent2_occupation" name="parent2_occupation">
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox" name="parent2_is_emergency_contact" value="1" id="edit_parent2_is_emergency_contact">
                                        <span class="ml-2">Là người liên hệ khẩn cấp</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="flex items-center">
                                    <input type="checkbox" class="form-checkbox" name="is_active" value="1" id="edit_is_active">
                                    <span class="ml-2">Kích hoạt tài khoản</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-2 border-t mt-6">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="modalHandler.close('editStudentModal')">
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

@push('scripts')
    <script>
        function populateEditModal(item) {
            console.log('Populating modal with:', item);
            modalHandler.open('editStudentModal');

            const form = document.getElementById('editStudentForm');
            form.action = `{{ url('admin/students') }}/${item.id}`;

            // Điền dữ liệu vào form
            // Hiển thị tài khoản người dùng
            document.getElementById('edit_full_name').value = item.full_name || '';
            document.getElementById('edit_email_display').textContent = item.email || '';

            // Format ngày sinh từ YYYY-MM-DD sang định dạng của input date
            if (item.date_of_birth) {
                const date = new Date(item.date_of_birth);
                const formattedDate = date.toISOString().split('T')[0];
                document.getElementById('edit_date_of_birth').value = formattedDate;
            } else {
                document.getElementById('edit_date_of_birth').value = '';
            }

            document.getElementById('edit_gender').value = item.gender || '';
            document.getElementById('edit_phone').value = item.phone || '';
            document.getElementById('edit_address').value = item.address || '';
            document.getElementById('edit_bio').value = item.bio || '';

            // Hiển thị avatar
            const avatarPreview = document.getElementById('edit-preview-image');
            const placeholder = document.getElementById('edit-placeholder');
            if (item.avatar) {
                console.log('Setting avatar:', item.avatar);
                // Sử dụng CloudFront URL nếu có, nếu không sử dụng S3 URL
                const cloudFrontDomain = '{{ config('filesystems.disks.cloudfront.domain') }}';
                const s3Bucket = '{{ config('filesystems.disks.s3.bucket') }}';
                const s3Region = '{{ config('filesystems.disks.s3.region') }}';

                let avatarUrl;
                if (cloudFrontDomain) {
                    avatarUrl = `https://${cloudFrontDomain}/${item.avatar}`;
                } else {
                    avatarUrl = `https://${s3Bucket}.s3.${s3Region}.amazonaws.com/${item.avatar}`;
                }

                avatarPreview.src = avatarUrl;
                avatarPreview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                avatarPreview.src = '{{ asset('images/default-avatar.png') }}';
                avatarPreview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }

            // Thông tin phụ huynh 1
            document.getElementById('edit_parent1_name').value = item.parent1_name || '';
            document.getElementById('edit_parent1_relationship').value = item.parent1_relationship || '';
            document.getElementById('edit_parent1_phone').value = item.parent1_phone || '';
            document.getElementById('edit_parent1_email').value = item.parent1_email || '';
            document.getElementById('edit_parent1_occupation').value = item.parent1_occupation || '';
            document.getElementById('edit_parent1_is_emergency_contact').checked = Boolean(item.parent1_is_emergency_contact);

            // Thông tin phụ huynh 2
            document.getElementById('edit_parent2_name').value = item.parent2_name || '';
            document.getElementById('edit_parent2_relationship').value = item.parent2_relationship || '';
            document.getElementById('edit_parent2_phone').value = item.parent2_phone || '';
            document.getElementById('edit_parent2_email').value = item.parent2_email || '';
            document.getElementById('edit_parent2_occupation').value = item.parent2_occupation || '';
            document.getElementById('edit_parent2_is_emergency_contact').checked = Boolean(item.parent2_is_emergency_contact);

            // Trạng thái tài khoản
            document.getElementById('edit_is_active').checked = Boolean(item.is_active);

            // Xóa input hidden nếu có
            const removeAvatarInput = form.querySelector('input[name="remove_avatar"]');
            if (removeAvatarInput) removeAvatarInput.remove();
        }

        // Xử lý upload avatar
        function handleEditAvatarUpload(input) {
            const preview = document.getElementById('edit-preview-image');
            const placeholder = document.getElementById('edit-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Xóa avatar
        function clearEditAvatar() {
            const input = document.getElementById('edit_avatar');
            const preview = document.getElementById('edit-preview-image');
            const placeholder = document.getElementById('edit-placeholder');

            input.value = '';
            preview.src = '#';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');

            // Thêm input hidden để đánh dấu xóa avatar
            let removeInput = document.querySelector('input[name="remove_avatar"]');
            if (!removeInput) {
                removeInput = document.createElement('input');
                removeInput.type = 'hidden';
                removeInput.name = 'remove_avatar';
                removeInput.value = '1';
                input.parentNode.appendChild(removeInput);
            }
            removeInput.value = '1';
        }

        // Xử lý đóng modal
        function closeEditStudentModal() {
            modalHandler.close('editStudentModal');
            document.getElementById('editStudentForm').reset();

            // Xóa input hidden nếu có
            const form = document.getElementById('editStudentForm');
            const removeAvatarInput = form.querySelector('input[name="remove_avatar"]');
            if (removeAvatarInput) removeAvatarInput.remove();
        }

        // Thêm event listeners khi tài liệu đã sẵn sàng
        document.addEventListener('DOMContentLoaded', function() {
            // Đăng ký sự kiện cho form edit
            const editForm = document.getElementById('editStudentForm');
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const studentId = document.querySelector('input[name="student_id"]').value;
                    const formData = new FormData(this);

                    // Gửi form bằng AJAX
                    fetch(`/admin/students/${studentId}`, {
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
                            closeEditStudentModal();
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

            // Xử lý sự kiện upload avatar
            const avatarInput = document.getElementById('edit_avatar');
            if (avatarInput) {
                avatarInput.addEventListener('change', function() {
                    handleEditAvatarUpload(this);

                    // Xóa input hidden remove_avatar nếu chọn file mới
                    const removeInput = document.querySelector('input[name="remove_avatar"]');
                    if (removeInput) removeInput.remove();
                });
            }

            // Đóng modal khi nhấn ESC
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeEditStudentModal();
                }
            });

            // Đóng modal khi click bên ngoài
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('editStudentModal');
                if (event.target === modal) {
                    closeEditStudentModal();
                }
            });
        });
    </script>
@endpush
