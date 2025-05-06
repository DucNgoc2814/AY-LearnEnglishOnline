<?php

namespace App\Services\Interfaces;

interface AnswerServiceInterface extends BaseServiceInterface
{
    /**
     * Tìm kiếm câu trả lời theo nội dung
     *
     * @param string $keyword Từ khóa tìm kiếm
     * @return array
     */
    public function searchByName($keyword);

    /**
     * Xử lý việc upload file và lưu vào đường dẫn thích hợp
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $fileType Loại file (images, videos, sounds)
     * @return string|null Path của file đã upload
     */
    public function handleFileUpload($file, $fileType);

    /**
     * Xóa file media từ hệ thống lưu trữ
     *
     * @param string $path Đường dẫn file cần xóa
     * @return bool Kết quả xóa file
     */
    public function deleteFile($path);

    /**
     * Lấy URL đầy đủ của file đã upload
     *
     * @param string $path Đường dẫn tương đối của file
     * @return string|null URL đầy đủ của file
     */
    public function getFullUrl($path);
}
