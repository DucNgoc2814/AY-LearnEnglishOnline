<?php

namespace App\Services;

use App\Services\Interfaces\AnswerServiceInterface;
use App\Repositories\Interfaces\AnswerRepositoryInterface;
use Illuminate\Support\Facades\Log;

class AnswerService extends BaseService implements AnswerServiceInterface
{
    public function __construct(AnswerRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $answers = $this->repository->searchByName($keyword);
            return $this->successResponse($answers, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }

    /**
     * Xử lý việc upload file và lưu vào đường dẫn thích hợp
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $fileType Loại file (images, videos, sounds)
     * @return string|null Path của file đã upload
     */
    public function handleFileUpload($file, $fileType)
    {
        try {
            if (!$file || !$file->isValid()) {
                throw new \Exception('Invalid file');
            }

            Log::info('Handling file upload in AnswerService', [
                'file_type' => $fileType,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize()
            ]);

            // Kiểm tra MIME type hợp lệ
            $validMimeTypes = [];
            $maxSize = 5 * 1024 * 1024; // 5MB mặc định

            if ($fileType === 'images') {
                $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                $maxSize = 5 * 1024 * 1024; // 5MB
            } elseif ($fileType === 'videos') {
                $validMimeTypes = ['video/mp4', 'video/webm', 'video/quicktime', 'video/x-ms-wmv', 'video/x-msvideo'];
                $maxSize = 50 * 1024 * 1024; // 50MB
            } elseif ($fileType === 'sounds') {
                $validMimeTypes = ['audio/mpeg', 'audio/mp3', 'audio/wav', 'audio/ogg', 'audio/x-m4a', 'audio/m4a'];
                $maxSize = 10 * 1024 * 1024; // 10MB
            }

            // Kiểm tra kích thước
            if ($file->getSize() > $maxSize) {
                throw new \Exception('File size exceeds maximum allowed size');
            }

            // Kiểm tra mime type (trừ audio vì đôi khi MIME type không chuẩn)
            if ($fileType !== 'sounds' && !empty($validMimeTypes) && !in_array($file->getMimeType(), $validMimeTypes)) {
                $extension = strtolower($file->getClientOriginalExtension());

                // Kiểm tra thêm extension để linh hoạt hơn
                $validExtensions = [
                    'images' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                    'videos' => ['mp4', 'mov', 'avi', 'wmv', 'webm'],
                    'sounds' => ['mp3', 'wav', 'ogg', 'm4a']
                ];

                if (!isset($validExtensions[$fileType]) || !in_array($extension, $validExtensions[$fileType])) {
                    throw new \Exception('Invalid file type');
                }
            }

            // Gửi yêu cầu upload đến repository
            return $this->repository->handleFile($file, 'answers', $fileType);
        } catch (\Exception $e) {
            Log::error('File upload error in AnswerService: ' . $e->getMessage(), [
                'file' => $file ? $file->getClientOriginalName() : null,
                'file_type' => $fileType,
                'exception' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Xóa file từ hệ thống lưu trữ
     *
     * @param string $path Đường dẫn file cần xóa
     * @return bool Kết quả xóa file
     */
    public function deleteFile($path)
    {
        try {
            return $this->repository->deleteFile($path);
        } catch (\Exception $e) {
            Log::error('Delete file error in AnswerService: ' . $e->getMessage(), [
                'path' => $path
            ]);
            return false;
        }
    }

    /**
     * Lấy URL đầy đủ của file
     *
     * @param string $path Đường dẫn tương đối của file
     * @return string|null URL đầy đủ của file
     */
    public function getFullUrl($path)
    {
        try {
            return $this->repository->getFullUrl($path);
        } catch (\Exception $e) {
            Log::error('Get full URL error: ' . $e->getMessage(), [
                'path' => $path
            ]);
            return null;
        }
    }
}
