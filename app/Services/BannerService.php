<?php

namespace App\Services;

use App\Models\Banner;
use App\Services\Interfaces\BannerServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use Illuminate\Support\Facades\Log;

class BannerService extends BaseService implements BannerServiceInterface
{
    protected $repository;

    public function __construct(BannerRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $banners = $this->repository->searchByName($keyword);
            return $this->successResponse($banners, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }

    /**
     * Tìm banner với URLs đầy đủ
     *
     * @param int $id
     * @return array
     */
    public function findWithFullUrls($id)
    {
        try {
            $banner = $this->repository->findWithFullUrls($id);
            if (!$banner) {
                throw new \Exception('Không tìm thấy banner');
            }

            return $banner;
        } catch (\Exception $e) {
            Log::error('Error in BannerService findWithFullUrls:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
