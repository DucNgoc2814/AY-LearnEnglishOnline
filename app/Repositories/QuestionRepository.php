<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    protected $table = 'questions';
    protected $model;

    public function __construct()
    {
        $this->model = new Question();
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

            // Các trường dữ liệu cơ bản của câu hỏi
            $questionData = [
                'test_id' => $data['test_id'],
                'type' => $data['type'],
                'question' => $data['question'],
                'order_number' => $data['order_number'],
                'media_url' => $data['media_url'] ?? null
            ];

            Log::info('Creating question with data', [
                'type' => $questionData['type'],
                'has_media' => isset($questionData['media_url'])
            ]);

            // Tạo bản ghi câu hỏi
            $question = $this->model->create($questionData);

            DB::commit();
            return $question;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Question creation error: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $data
            ]);
            throw $e;
        }
    }

    public function handleImage($image, string $folder)
    {
        try {
            if (!$image) {
                return null;
            }

            $filename = uniqid() . '_' . time();
            $extension = $image->getClientOriginalExtension();
            $path = $folder . '/images/' . $filename . '.' . $extension;

            // Upload to S3
            $result = Storage::disk('s3')->put($path, file_get_contents($image));

            if (!$result) {
                throw new \Exception('Failed to upload image to S3');
            }

            return $path;
        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage(), [
                'file' => $image->getClientOriginalName()
            ]);
            throw $e;
        }
    }

    public function handleVideo($video, string $folder)
    {
        try {
            if (!$video) {
                return null;
            }

            $filename = uniqid() . '_' . time();
            $extension = $video->getClientOriginalExtension();
            $path = $folder . '/videos/' . $filename . '.' . $extension;

            // Upload to S3
            $result = Storage::disk('s3')->put($path, file_get_contents($video));

            if (!$result) {
                throw new \Exception('Failed to upload video to S3');
            }

            return $path;
        } catch (\Exception $e) {
            Log::error('Video upload error: ' . $e->getMessage(), [
                'file' => $video->getClientOriginalName()
            ]);
            throw $e;
        }
    }

    public function handleAudio($audio, string $folder)
    {
        try {
            if (!$audio) {
                return null;
            }

            $filename = uniqid() . '_' . time();
            $extension = strtolower($audio->getClientOriginalExtension());
            $path = $folder . '/sounds/' . $filename . '.' . $extension;

            // Upload to S3 giống như cách xử lý ảnh và video
            $result = Storage::disk('s3')->put($path, file_get_contents($audio));

            if (!$result) {
                throw new \Exception('Failed to upload audio to S3');
            }

            Log::info('Audio file uploaded successfully', [
                'path' => $path,
                'file_name' => $audio->getClientOriginalName()
            ]);

            return $path;
        } catch (\Exception $e) {
            Log::error('Audio upload error: ' . $e->getMessage(), [
                'file' => $audio->getClientOriginalName()
            ]);
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        try {
            DB::beginTransaction();

            $question = $this->findById($id);
            if (!$question) {
                throw new \Exception('Question not found');
            }

            Log::info('Starting question update:', [
                'id' => $id,
                'has_thumbnail' => isset($data['thumbnail']),
                'has_video' => isset($data['preview_video'])
            ]);

            // Handle thumbnail
            if (isset($data['thumbnail'])) {
                if ($data['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
                    Log::info('Processing new thumbnail upload', [
                        'original_name' => $data['thumbnail']->getClientOriginalName()
                    ]);

                    // Delete old thumbnail if exists
                    if ($question->thumbnail) {
                        Log::info('Deleting old thumbnail', ['path' => $question->thumbnail]);
                        $this->deleteFile($question->thumbnail);
                    }

                    // Upload new thumbnail
                    $thumbnailPath = $this->handleImage($data['thumbnail'], 'questions');
                    if (!$thumbnailPath) {
                        throw new \Exception('Failed to upload thumbnail');
                    }
                    $data['thumbnail'] = $thumbnailPath;

                    Log::info('New thumbnail uploaded', ['path' => $thumbnailPath]);
                }
            }

            // Handle preview video
            if (isset($data['preview_video'])) {
                if ($data['preview_video'] instanceof \Illuminate\Http\UploadedFile) {
                    Log::info('Processing new video upload', [
                        'original_name' => $data['preview_video']->getClientOriginalName()
                    ]);

                    // Delete old video if exists
                    if ($question->preview_video) {
                        Log::info('Deleting old video', ['path' => $question->preview_video]);
                        $this->deleteFile($question->preview_video);
                    }

                    // Upload new video
                    $videoPath = $this->handleVideo($data['preview_video'], 'questions');
                    if (!$videoPath) {
                        throw new \Exception('Failed to upload video');
                    }
                    $data['preview_video'] = $videoPath;

                    Log::info('New video uploaded', ['path' => $videoPath]);
                }
            }

            // Update question record
            $question->update($data);

            DB::commit();

            Log::info('Question updated successfully', [
                'id' => $id,
                'thumbnail' => $question->thumbnail,
                'preview_video' => $question->preview_video
            ]);

            return $question;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Question update error:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function delete($id)
    {
        try {
            $question = $this->findById($id);
            if (!$question) {
                throw new \Exception('Question not found');
            }

            // Delete associated files
            if ($question->thumbnail) {
                $this->deleteFile($question->thumbnail);
            }
            if ($question->preview_video) {
                $this->deleteFile($question->preview_video);
            }

            return parent::delete($id);
        } catch (\Exception $e) {
            Log::error('Question deletion error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('title', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }

    public function getAllWithTrashed()
    {
        return $this->model::onlyTrashed();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findWithFullUrls($id)
    {
        $question = $this->findOrFail($id);

        // Add full URLs for image and video
        $question->thumbnail = $this->getFullUrl($question->thumbnail);
        $question->preview_video = $this->getFullUrl($question->preview_video);

        return $question;
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
}
