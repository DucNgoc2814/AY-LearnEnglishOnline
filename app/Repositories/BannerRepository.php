<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    protected $table = 'banners';
    protected $model;

    public function __construct()
    {
        $this->model = new Banner();
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

            // Handle image upload
            if (isset($data['image'])) {
                Log::info("Processing image upload", ['file' => $data['image']->getClientOriginalName()]);

                $cloudFrontUrl = $this->handleImage($data['image'], 'banners');
                if (!$cloudFrontUrl) {
                    throw new \Exception('Failed to upload image');
                }
                $data['image_url'] = $cloudFrontUrl;
                unset($data['image']); // Remove the image file from data array
                Log::info("Image uploaded successfully", ['url' => $cloudFrontUrl]);
            }

            // Create banner record
            $banner = $this->model->create($data);

            DB::commit();
            return $banner;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Banner creation error: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => array_merge($data, [
                    'image_info' => isset($data['image']) ? [
                        'name' => $data['image']->getClientOriginalName(),
                        'type' => $data['image']->getMimeType()
                    ] : null
                ])
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

    public function update($id, array $data)
    {
        try {
            DB::beginTransaction();

            $banner = $this->findById($id);
            if (!$banner) {
                throw new \Exception('Banner not found');
            }

            Log::info('Starting banner update:', [
                'id' => $id,
                'has_image' => isset($data['image'])
            ]);

            // Handle image
            if (isset($data['image'])) {
                if ($data['image'] instanceof \Illuminate\Http\UploadedFile) {
                    Log::info('Processing new image upload', [
                        'original_name' => $data['image']->getClientOriginalName()
                    ]);

                    // Delete old image if exists
                    if ($banner->image_url) {
                        Log::info('Deleting old image', ['path' => $banner->image_url]);
                        $this->deleteFile($banner->image_url);
                    }

                    // Upload new image
                    $imagePath = $this->handleImage($data['image'], 'banners');
                    if (!$imagePath) {
                        throw new \Exception('Failed to upload image');
                    }
                    $data['image_url'] = $imagePath;

                    Log::info('New image uploaded', ['path' => $imagePath]);
                }
            }

            // Update banner record
            $banner->update($data);

            DB::commit();

            Log::info('Banner updated successfully', [
                'id' => $id,
                'image_url' => $banner->image_url,
            ]);

            return $banner;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Banner update error:', [
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
            $banner = $this->findById($id);
            if (!$banner) {
                throw new \Exception('Banner not found');
            }

            // Delete associated image
            if ($banner->image_url) {
                $this->deleteFile($banner->image_url);
            }

            return parent::delete($id);
        } catch (\Exception $e) {
            Log::error('Banner deletion error: ' . $e->getMessage());
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
        $banner = $this->findOrFail($id);

        // Add full URLs for image
        $banner->image_url = $this->getFullUrl($banner->image_url);

        return $banner;
    }

    public function getFullUrl($path)
    {
        if (empty($path)) {
            return null;
        }

        // Nếu đã là URL đầy đủ, trả về nguyên vẹn
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Kiểm tra xem có sử dụng CloudFront không
        $cloudFrontDomain = config('filesystems.disks.s3.cloudfront_domain');
        if ($cloudFrontDomain) {
            return "https://{$cloudFrontDomain}/" . ltrim($path, '/');
        }

        // Nếu không có CloudFront, sử dụng URL S3 trực tiếp
        $s3Bucket = config('filesystems.disks.s3.bucket');
        $s3Region = config('filesystems.disks.s3.region');
        return "https://{$s3Bucket}.s3.{$s3Region}.amazonaws.com/" . ltrim($path, '/');
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
