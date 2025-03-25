class TableHandler {
    constructor() {
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        document.addEventListener('DOMContentLoaded', () => {
            // Xử lý checkbox "chọn tất cả"
            const selectAllCheckboxes = document.querySelectorAll('thead input[type="checkbox"]');
            selectAllCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', (e) => {
                    const table = e.target.closest('table');
                    const rowCheckboxes = table.querySelectorAll('tbody input[type="checkbox"]');
                    rowCheckboxes.forEach(rowCheckbox => {
                        rowCheckbox.checked = e.target.checked;
                    });
                });
            });

            // Xử lý các checkbox riêng lẻ
            const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    this.updateSelectAllCheckbox(checkbox.closest('table'));
                });
            });
        });
    }

    updateSelectAllCheckbox(table) {
        const selectAllCheckbox = table.querySelector('thead input[type="checkbox"]');
        const rowCheckboxes = table.querySelectorAll('tbody input[type="checkbox"]');
        
        if (rowCheckboxes.length === 0 || !selectAllCheckbox) return;
        
        const allChecked = Array.from(rowCheckboxes).every(checkbox => checkbox.checked);
        const someChecked = Array.from(rowCheckboxes).some(checkbox => checkbox.checked);
        
        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = someChecked && !allChecked;
    }

    getSelectedIds() {
        const selectedCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
        return Array.from(selectedCheckboxes).map(checkbox => {
            return checkbox.getAttribute('data-id');
        });
    }
}

const tableHandler = new TableHandler(); 