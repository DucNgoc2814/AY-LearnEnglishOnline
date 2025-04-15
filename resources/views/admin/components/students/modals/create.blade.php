<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="createStudentModal" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="createStudentModalLabel">Thêm học viên mới</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('createStudentModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                                    Tài khoản người dùng <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="user_id" name="user_id" required>
                                    <option value="">-- Chọn tài khoản --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="full_name">
                                    Họ và tên <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="full_name" name="full_name" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <div class="flex">
                                    <input type="text"
                                        class="shadow appearance-none border rounded-l w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="email" name="email" required>
                                    <span class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-l-0 border-gray-300 rounded-r">
                                        @ay.learning.english
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Chỉ cần nhập phần tên, phần domain sẽ tự động thêm vào</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                    Mật khẩu <span class="text-red-500">*</span>
                                </label>
                                <input type="password"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="password" name="password" required minlength="6" maxlength="20">
                                <ul class="text-xs mt-1 space-y-1" id="password-requirements">
                                    <li id="length-check" class="flex items-center text-red-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Độ dài từ 6-20 ký tự</span>
                                    </li>
                                    <li id="uppercase-check" class="flex items-center text-red-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Phải bắt đầu bằng chữ hoa</span>
                                    </li>
                                    <li id="lowercase-check" class="flex items-center text-red-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Phải có ít nhất một chữ thường</span>
                                    </li>
                                    <li id="number-check" class="flex items-center text-red-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Phải có ít nhất một số</span>
                                    </li>
                                    <li id="special-check" class="flex items-center text-red-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Phải có ít nhất một ký tự đặc biệt (@$!%*#?&)</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="date_of_birth">
                                    Ngày sinh
                                </label>
                                <input type="date"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="date_of_birth" name="date_of_birth">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="gender">
                                    Giới tính
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="gender" name="gender">
                                    <option value="">-- Chọn giới tính --</option>
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                                    Số điện thoại
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="phone" name="phone">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                                    Địa chỉ
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="address" name="address" rows="2"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="bio">
                                    Tiểu sử
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="bio" name="bio" rows="3"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="avatar">
                                    Ảnh đại diện
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 mb-2">
                                    <div id="preview-container" class="mb-3 flex items-center justify-center bg-gray-50" style="height: 180px;">
                                        <img id="preview-image" src="#" alt="Preview" class="w-full h-full object-contain hidden">
                                        <div id="placeholder" class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p class="mt-1 text-sm text-gray-500">Tải ảnh lên</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center space-x-2">
                                        <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden">
                                        <button type="button" onclick="document.getElementById('avatar').click()"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Chọn ảnh
                                        </button>
                                        <button type="button" onclick="removeImage()"
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
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent1_name">
                                        Họ và tên
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent1_name" name="parent1_name">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent1_relationship">
                                        Quan hệ
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent1_relationship" name="parent1_relationship">
                                        <option value="">-- Chọn quan hệ --</option>
                                        <option value="father">Cha</option>
                                        <option value="mother">Mẹ</option>
                                        <option value="guardian">Người giám hộ</option>
                                        <option value="other">Khác</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent1_phone">
                                        Số điện thoại
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent1_phone" name="parent1_phone">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent1_email">
                                        Email
                                    </label>
                                    <input type="email"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent1_email" name="parent1_email">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent1_occupation">
                                        Nghề nghiệp
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent1_occupation" name="parent1_occupation">
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox" name="parent1_is_emergency_contact" value="1">
                                        <span class="ml-2">Là người liên hệ khẩn cấp</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Phụ huynh 2 -->
                            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                                <h5 class="font-medium text-gray-700 mb-3">Phụ huynh 2</h5>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent2_name">
                                        Họ và tên
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent2_name" name="parent2_name">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent2_relationship">
                                        Quan hệ
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent2_relationship" name="parent2_relationship">
                                        <option value="">-- Chọn quan hệ --</option>
                                        <option value="father">Cha</option>
                                        <option value="mother">Mẹ</option>
                                        <option value="guardian">Người giám hộ</option>
                                        <option value="other">Khác</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent2_phone">
                                        Số điện thoại
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent2_phone" name="parent2_phone">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent2_email">
                                        Email
                                    </label>
                                    <input type="email"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent2_email" name="parent2_email">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent2_occupation">
                                        Nghề nghiệp
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="parent2_occupation" name="parent2_occupation">
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox" name="parent2_is_emergency_contact" value="1">
                                        <span class="ml-2">Là người liên hệ khẩn cấp</span>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="flex items-center">
                                    <input type="checkbox" class="form-checkbox" name="is_active" value="1" checked>
                                    <span class="ml-2">Kích hoạt tài khoản</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-2 border-t mt-6">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="modalHandler.close('createStudentModal')">
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

@push('scripts')
<script>
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('preview-image');
                const placeholder = document.getElementById('placeholder');
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    function removeImage() {
        const input = document.getElementById('avatar');
        const previewImage = document.getElementById('preview-image');
        const placeholder = document.getElementById('placeholder');

        input.value = '';
        previewImage.src = '#';
        previewImage.classList.add('hidden');
        placeholder.classList.remove('hidden');
    }

    // Password validation
    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        const requirements = {
            'length-check': password.length >= 6 && password.length <= 20,
            'uppercase-check': /^[A-Z]/.test(password),
            'lowercase-check': /[a-z]/.test(password),
            'number-check': /[0-9]/.test(password),
            'special-check': /[@$!%*#?&]/.test(password)
        };

        // Update each requirement's status
        Object.entries(requirements).forEach(([id, valid]) => {
            const element = document.getElementById(id);
            if (valid) {
                element.classList.remove('text-red-500');
                element.classList.add('text-emerald-500');
                element.querySelector('svg').innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                `;
                element.querySelector('span').style.transition = 'color 0.3s ease';
            } else {
                element.classList.remove('text-emerald-500');
                element.classList.add('text-red-500');
                element.querySelector('svg').innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                `;
            }
        });

        // Check if all requirements are met
        const allValid = Object.values(requirements).every(valid => valid);
        const input = e.target;

        if (!allValid) {
            input.setCustomValidity('Vui lòng đáp ứng tất cả các yêu cầu về mật khẩu');
        } else {
            input.setCustomValidity('');
        }
    });
</script>
@endpush
