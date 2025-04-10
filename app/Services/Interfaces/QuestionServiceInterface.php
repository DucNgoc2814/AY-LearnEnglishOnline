<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseServiceInterface;

interface QuestionServiceInterface extends BaseServiceInterface
{
    /**
     * Tìm kiếm câu hỏi theo tên
     *
     * @param string $keyword Từ khóa tìm kiếm
     * @return array
     */
    public function searchByName($keyword);

    /**
     * Tìm câu hỏi với URLs đầy đủ
     *
     * @param int $id ID của câu hỏi
     * @return array|object
     */
    public function findWithFullUrls($id);

    /**
     * Xử lý việc upload file media và chuyển đến thư mục tương ứng
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $mediaType (images, videos, sounds)
     * @return string|null Path của file đã upload
     */
    public function handleMediaUpload($file, $mediaType);

    /**
     * Xóa file media từ hệ thống lưu trữ
     *
     * @param string $path Đường dẫn file cần xóa
     * @return bool Kết quả xóa file
     */
    public function deleteMedia($path);
}
