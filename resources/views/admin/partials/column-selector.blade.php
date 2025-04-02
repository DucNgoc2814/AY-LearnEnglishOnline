<div id="columnSelectorOverlay" class="fixed inset-0 bg-transparent hidden" onclick="closeColumnSelector()"></div>
<div id="columnSelectorModal" class="fixed top-0 right-0 h-screen bg-white shadow-lg w-64 transform translate-x-full transition-transform duration-300 z-50">
    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Tùy chọn hiển thị</h3>
            <button type="button" onclick="closeColumnSelector()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="space-y-2" id="columnList">
            <!-- Các checkbox sẽ được render động -->
        </div>
    </div>
</div>