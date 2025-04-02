class ColumnSelector {
    constructor() {
        this.columns = {};
        this.tableId = '';
        this.selectedColumns = new Set();
        this.isOpen = false;
    }

    async initialize(tableId) {
        this.tableId = tableId;
        try {
            const response = await fetch(`/api/table-columns/${tableId}`);
            this.columns = await response.json();

            // Khôi phục trạng thái đã lưu
            const savedColumns = localStorage.getItem(`${this.tableId}_columns`);
            this.selectedColumns = savedColumns ?
                new Set(JSON.parse(savedColumns)) :
                new Set(Object.keys(this.columns));

            this.renderColumnList();
            this.applySelection(false); // Áp dụng ngay khi khởi tạo, không đóng modal
        } catch (error) {
            console.error('Error fetching columns:', error);
        }
    }

    renderColumnList() {
        const container = document.getElementById('columnList');
        container.innerHTML = '';

        Object.entries(this.columns).forEach(([key, label]) => {
            const div = document.createElement('div');
            div.className = 'flex items-center justify-between p-2 hover:bg-gray-50';

            div.innerHTML = `
                <label for="col_${key}" class="flex items-center cursor-pointer w-full">
                    <span class="flex-grow">${label}</span>
                    <input type="checkbox"
                        id="col_${key}"
                        value="${key}"
                        ${this.selectedColumns.has(key) ? 'checked' : ''}
                        class="form-checkbox h-5 w-5 text-blue-600">
                </label>
            `;

            div.querySelector('input').addEventListener('change', (e) => {
                if (e.target.checked) {
                    this.selectedColumns.add(key);
                } else {
                    this.selectedColumns.delete(key);
                }
                this.applySelection(false); // Áp dụng ngay khi thay đổi
            });

            container.appendChild(div);
        });
    }

    applySelection(shouldClose = true) {
        localStorage.setItem(`${this.tableId}_columns`, JSON.stringify([...this.selectedColumns]));

        const table = document.querySelector(`table[data-table="${this.tableId}"]`);
        if (!table) return;

        Object.keys(this.columns).forEach(key => {
            const cells = table.querySelectorAll(`[data-column="${key}"]`);
            cells.forEach(cell => {
                cell.style.display = this.selectedColumns.has(key) ? '' : 'none';
            });
        });

        if (shouldClose) {
            this.closeModal();
        }
    }

    openModal() {
        const modal = document.getElementById('columnSelectorModal');
        const overlay = document.getElementById('columnSelectorOverlay');
        modal.classList.remove('translate-x-full');
        overlay.classList.remove('hidden');
        this.isOpen = true;
    }

    closeModal() {
        const modal = document.getElementById('columnSelectorModal');
        const overlay = document.getElementById('columnSelectorOverlay');
        modal.classList.add('translate-x-full');
        overlay.classList.add('hidden');
        this.isOpen = false;
    }

    toggleModal() {
        if (this.isOpen) {
            this.closeModal();
        } else {
            this.openModal();
        }
    }
}

const columnSelector = new ColumnSelector();

function toggleColumnSelector(tableId) {
    if (!columnSelector.isOpen) {
        columnSelector.initialize(tableId);
    }
    columnSelector.toggleModal();
}

// Thêm event listener để ngăn sự kiện click trên modal lan tỏa ra overlay
document.getElementById('columnSelectorModal').addEventListener('click', (e) => {
    e.stopPropagation();
});

// Thêm hàm closeColumnSelector toàn cục
function closeColumnSelector() {
    columnSelector.closeModal();
}