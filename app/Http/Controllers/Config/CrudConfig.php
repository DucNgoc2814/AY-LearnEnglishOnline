<?php

namespace App\Http\Controllers\Config;

class CrudConfig
{
    /**
     * Cấu hình các thông báo cho CRUD
     */
    const MESSAGES = [
        'create' => [
            'success' => 'Tạo mới thành công!',
            'error' => 'Có lỗi xảy ra khi tạo mới!'
        ],
        'update' => [
            'success' => 'Cập nhật thành công!',
            'error' => 'Có lỗi xảy ra khi cập nhật!'
        ],
        'delete' => [
            'success' => 'Xóa thành công!',
            'error' => 'Có lỗi xảy ra khi xóa!'
        ],
        'not_found' => 'Không tìm thấy dữ liệu!'
    ];

    /**
     * Cấu hình số bản ghi mỗi trang cho phân trang
     */
    const PAGINATION = [
        'per_page' => 10
    ];

    /**
     * Cấu hình các trạng thái
     */
    const STATUS = [
        'active' => 1,
        'inactive' => 0
    ];

    /**
     * Cấu hình đường dẫn upload file
     */
    const UPLOAD_PATH = [
        'images' => 'uploads/images/',
        'files' => 'uploads/files/'
    ];

    /**
     * Cấu hình các định dạng file cho phép upload
     */
    const ALLOWED_FILE_TYPES = [
        'images' => ['jpg', 'jpeg', 'png', 'gif'],
        'documents' => ['pdf', 'doc', 'docx', 'xls', 'xlsx']
    ];

    /**
     * Cấu hình kích thước file tối đa (bytes)
     */
    const MAX_FILE_SIZE = [
        'images' => 2048000,  // 2MB
        'documents' => 5120000 // 5MB
    ];
} 