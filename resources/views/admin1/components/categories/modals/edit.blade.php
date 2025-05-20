<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editCategoryModal" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editCategoryModalLabel">Chỉnh sửa danh mục</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" 
                        onclick="modalHandler.close('editCategoryModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editCategoryForm" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryName">
                            Tên danh mục <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('name') ? 'border-red-500' : '' }}"
                            id="categoryName" name="name" placeholder="Nhập tên danh mục" required>
                        @if (session('errors') && session('errors')->has('name'))
                            <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('name') }}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Mô tả
                        </label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('description') ? 'border-red-500' : '' }}"
                            id="description" name="description" rows="3" placeholder="Nhập mô tả danh mục"></textarea>
                        @if (session('errors') && session('errors')->has('description'))
                            <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('description') }}</p>
                        @endif
                    </div>
                    
                    <div class="flex justify-end pt-2 border-t">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2" 
                            onclick="modalHandler.close('editCategoryModal')">
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
