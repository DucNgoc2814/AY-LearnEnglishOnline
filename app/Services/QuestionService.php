<?php

namespace App\Services;

use App\Models\Question;
use App\Services\Interfaces\QuestionServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use Illuminate\Support\Facades\Log;

class QuestionService extends BaseService implements QuestionServiceInterface
{
    protected $repository;

    public function __construct(QuestionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $questions = $this->repository->searchByName($keyword);
            return $this->successResponse($questions, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }

    /**
     * Tìm câu hỏi với URLs đầy đủ
     *
     * @param int $id
     * @return array
     */
    public function findWithFullUrls($id)
    {
        try {
            $question = $this->repository->findWithFullUrls($id);
            if (!$question) {
                throw new \Exception('Không tìm thấy câu hỏi');
            }

            // Thêm thông tin URL đầy đủ nếu có
            if ($question->media_url) {
                $question->full_media_url = $this->getFullUrl($question->media_url);
            }

            // Xác định loại câu trả lời (single/multiple)
            if ($question->answers && $question->answers->count() > 0) {
                $correctAnswers = $question->answers->where('is_correct', true)->count();
                $question->answer_type = $correctAnswers > 1 ? 'multiple' : 'single';
            }

            return $question;
        } catch (\Exception $e) {
            Log::error('Error in QuestionService findWithFullUrls:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Lấy URL đầy đủ cho file
     *
     * @param string|null $path
     * @return string|null
     */
    protected function getFullUrl($path = null)
    {
        if (empty($path)) {
            return null;
        }

        // Nếu đã là URL đầy đủ, trả về luôn
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Xây dựng URL đầy đủ từ cấu hình
        $diskConfig = config('filesystems.disks.s3');
        $cloudFrontDomain = config('filesystems.disks.cloudfront.domain', null);

        if ($cloudFrontDomain) {
            return "https://{$cloudFrontDomain}/{$path}";
        }

        return "{$diskConfig['url']}/{$path}";
    }

    /**
     * Xử lý việc upload file media và chuyển đến thư mục tương ứng
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $mediaType (images, videos, sounds)
     * @return string|null Path của file đã upload
     */
    public function handleMediaUpload($file, $mediaType)
    {
        try {
            if (!$file || !$file->isValid()) {
                throw new \Exception('Invalid media file');
            }

            $folder = 'questions';
            $mimeType = $file->getMimeType();
            $extension = strtolower($file->getClientOriginalExtension());

            Log::info('Handling media upload', [
                'media_type' => $mediaType,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $mimeType,
                'extension' => $extension,
                'size' => $file->getSize()
            ]);

            // Kiểm tra MIME type hợp lệ
            $validMimeTypes = [];
            if ($mediaType === 'images') {
                $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            } elseif ($mediaType === 'videos') {
                $validMimeTypes = ['video/mp4', 'video/webm', 'video/quicktime', 'video/x-ms-wmv', 'video/x-msvideo'];
            } elseif ($mediaType === 'sounds') {
                $validMimeTypes = [
                    'audio/mpeg', 'audio/mp3', 'audio/wav', 'audio/wave', 'audio/x-wav',
                    'audio/x-pn-wav', 'audio/ogg', 'audio/mp4', 'audio/x-m4a'
                ];

                // Nếu là file audio mà MIME không đúng, thử xác định lại theo extension
                if (!in_array($mimeType, $validMimeTypes)) {
                    if ($extension === 'mp3') {
                        $mimeType = 'audio/mpeg';
                    } elseif ($extension === 'wav') {
                        $mimeType = 'audio/wav';
                    } elseif ($extension === 'ogg') {
                        $mimeType = 'audio/ogg';
                    } elseif ($extension === 'm4a') {
                        $mimeType = 'audio/mp4';
                    }

                    Log::info('Updated MIME type based on extension', [
                        'original_mime' => $file->getMimeType(),
                        'updated_mime' => $mimeType,
                        'extension' => $extension
                    ]);
                }
            }

            // Xử lý file theo loại media
            switch ($mediaType) {
                case 'images':
                    return $this->repository->handleImage($file, $folder);
                case 'videos':
                    return $this->repository->handleVideo($file, $folder);
                case 'sounds':
                    // Ghi đè MIME type cho file audio nếu cần
                    if ($mediaType === 'sounds' && !in_array($file->getMimeType(), $validMimeTypes)) {
                        Log::info('Audio file with non-standard mime type', [
                            'original_mime' => $file->getMimeType(),
                            'extension' => $extension
                        ]);

                        // Cách xử lý mới: Sử dụng file gốc với MIME type phù hợp
                        // Việc ghi đè MIME type sẽ được thực hiện trong BaseRepository->handleFileUpload
                        return $this->repository->handleAudio($file, $folder);
                    }

                    return $this->repository->handleAudio($file, $folder);
                default:
                    throw new \Exception('Unsupported media type: ' . $mediaType);
            }
        } catch (\Exception $e) {
            Log::error('Media upload error: ' . $e->getMessage(), [
                'file' => $file ? $file->getClientOriginalName() : null,
                'media_type' => $mediaType,
                'exception' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Xóa file media từ hệ thống lưu trữ
     *
     * @param string $path Đường dẫn file cần xóa
     * @return bool Kết quả xóa file
     */
    public function deleteMedia($path)
    {
        try {
            if (empty($path)) {
                return true;
            }

            Log::info('Attempting to delete media file', ['path' => $path]);
            return $this->repository->deleteFile($path);
        } catch (\Exception $e) {
            Log::error('Error deleting media file: ' . $e->getMessage(), [
                'path' => $path
            ]);
            return false;
        }
    }

    /**
     * Lấy danh sách câu trả lời của một câu hỏi
     *
     * @param int $questionId
     * @return array
     */
    public function getAnswersByQuestion($questionId)
    {
        try {
            $question = $this->repository->findWithFullUrls($questionId);
            if (!$question) {
                throw new \Exception('Không tìm thấy câu hỏi');
            }

            $answers = $this->repository->getAnswersByQuestionId($questionId);

            return [
                'success' => true,
                'question' => $question,
                'answers' => $answers,
                'explanation' => $question->correct_answer_explanation
            ];
        } catch (\Exception $e) {
            Log::error('Error in QuestionService getAnswersByQuestion: ' . $e->getMessage(), [
                'question_id' => $questionId,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách câu trả lời: ' . $e->getMessage()
            ];
        }
    }
}
