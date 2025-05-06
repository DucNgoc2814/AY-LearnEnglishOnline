<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Repositories\Interfaces\AnswerRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AnswerRepository extends BaseRepository implements AnswerRepositoryInterface
{
    protected $table = 'answers';
    protected $model;

    public function __construct()
    {
        $this->model = new Answer();
        parent::__construct($this->model);
    }

    public function getQuery()
    {
        return $this->model
            ->whereNull('deleted_at')
            ->latest('id');
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            // Tạo bản ghi câu trả lời
            $answer = parent::create($data);

            DB::commit();
            return $answer;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Answer creation error: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $data
            ]);
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        try {
            DB::beginTransaction();

            $answer = $this->findById($id);
            if (!$answer) {
                throw new \Exception('Answer not found');
            }

            Log::info('Starting answer update:', [
                'id' => $id,
                'has_url' => isset($data['url'])
            ]);

            // Xử lý url nếu có
            if (isset($data['url']) && $data['url'] instanceof \Illuminate\Http\UploadedFile) {
                $file = $data['url'];
                Log::info('Processing new file upload for answer', [
                    'original_name' => $file->getClientOriginalName(),
                    'type' => $data['type'] ?? 'unknown'
                ]);

                // Xóa file cũ nếu có
                if ($answer->url) {
                    Log::info('Deleting old file', ['path' => $answer->url]);
                    $this->deleteFile($answer->url);
                }

                // Upload file mới dựa vào type
                $type = $data['type'] ?? 'single';
                $filePath = $this->handleFile($file, 'answers', $type);

                if (!$filePath) {
                    throw new \Exception('Failed to upload file');
                }

                $data['url'] = $filePath;
                Log::info('New file uploaded', ['path' => $filePath]);
            }

            // Cập nhật câu trả lời
            $answer->update($data);

            DB::commit();

            Log::info('Answer updated successfully', [
                'id' => $id,
                'url' => $answer->url
            ]);

            return $answer;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Answer update error:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function handleFile($file, string $folder, string $type = 'single')
    {
        try {
            if (!$file) {
                return null;
            }

            $filename = uniqid() . '_' . time();
            $extension = $file->getClientOriginalExtension();

            // Xác định loại file và thư mục lưu trữ
            $subfolder = 'files'; // Mặc định

            // Kiểm tra loại file để đặt đúng thư mục
            $mimeType = $file->getMimeType();
            if (strpos($mimeType, 'image/') === 0) {
                $subfolder = 'images';
            } elseif (strpos($mimeType, 'video/') === 0) {
                $subfolder = 'videos';
            } elseif (strpos($mimeType, 'audio/') === 0) {
                $subfolder = 'sounds';
            }

            $path = $folder . '/' . $subfolder . '/' . $filename . '.' . $extension;

            // Upload to S3
            $result = Storage::disk('s3')->put($path, file_get_contents($file));

            if (!$result) {
                throw new \Exception('Failed to upload file to S3');
            }

            return $path;
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage(), [
                'file' => $file->getClientOriginalName()
            ]);
            throw $e;
        }
    }

    public function deleteFile($path)
    {
        try {
            if (empty($path)) {
                return true;
            }

            // If path is a full URL, extract just the path portion
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                $cloudFrontDomain = config('filesystems.disks.cloudfront.domain');
                $path = str_replace("https://{$cloudFrontDomain}/", '', $path);
            }

            // Ensure the path doesn't start with a slash
            $path = ltrim($path, '/');

            Log::info('Attempting to delete file from S3', ['path' => $path]);

            if (Storage::disk('s3')->exists($path)) {
                $result = Storage::disk('s3')->delete($path);
                Log::info('File deletion result', ['result' => $result]);
                return $result;
            }

            Log::warning('File not found for deletion', ['path' => $path]);
            return true;
        } catch (\Exception $e) {
            Log::error('File deletion error: ' . $e->getMessage(), [
                'path' => $path
            ]);
            return false;
        }
    }

    public function getFullUrl($path = null)
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

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('answer', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }

    public function getAllWithTrashed()
    {
        return $this->model::onlyTrashed();
    }
}
