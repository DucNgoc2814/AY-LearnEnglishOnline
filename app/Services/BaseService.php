<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use App\Repositories\BaseRepository;

abstract class BaseService implements BaseServiceInterface
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getList()
    {
        try {
            $items = $this->repository->getQuery()->paginate(10);
            return [
                'status' => true,
                'message' => 'Lấy danh sách thành công',
                'data' => $items->items(),
                'pagination' => [
                    'total' => $items->total(),
                    'per_page' => $items->perPage(),
                    'current_page' => $items->currentPage(),
                    'last_page' => $items->lastPage(),
                    'links' => $items->links()
                ]
            ];
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi lấy danh sách');
        }
    }

    public function getTrashList()
    {
        try {
            $items = $this->repository->getAllWithTrashed()->paginate(
                10,
                ['*'],
                'trash_page'
            );
            return [
                'status' => true,
                'message' => 'Lấy danh sách đã xóa thành công',
                'data' => $items->items(),
                'pagination' => [
                    'total' => $items->total(),
                    'per_page' => $items->perPage(),
                    'current_page' => $items->currentPage(),
                    'last_page' => $items->lastPage(),
                    'links' => $items->appends(request()->except('trash_page'))->links()
                ]
            ];
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi lấy danh sách đã xóa');
        }
    }

    public function findById($id)
    {
        try {
            $result = $this->repository->findOrFail($id);
            return [
                'status' => true,
                'message' => 'Lấy thông tin thành công',
                'data' => $result
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra'
            ];
        }
    }

    public function create(array $data)
    {
        try {
            $item = $this->repository->create($data);
            return [
                'status' => true,
                'message' => 'Thêm mới thành công',
                'data' => $item
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi thêm mới'
            ];
        }
    }

    public function update($id, $data)
    {
        try {

            $item = $this->repository->findById($id);
            if (!$item) {
                return [
                    'status' => false,
                    'message' => 'Không tìm thấy dữ liệu'
                ];
            }

            $this->repository->update($id, $data);
            return [
                'status' => true,
                'message' => 'Cập nhật thành công',
                'data' => $this->repository->findById($id)
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật'
            ];
        }
    }

    public function delete($id)
    {
        try {
            $item = $this->repository->findById($id);
            if (!$item) {
                return [
                    'status' => false,
                    'message' => 'Không tìm thấy dữ liệu'
                ];
            }

            $this->repository->delete($id);
            return [
                'status' => true,
                'message' => 'Xóa thành công'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi xóa'
            ];
        }
    }

    public function restore($id)
    {
        try {
            $result = $this->repository->restore($id);
            if (!$result) {
                return [
                    'status' => false,
                    'message' => 'Không tìm thấy dữ liệu hoặc khôi phục thất bại'
                ];
            }

            return [
                'status' => true,
                'message' => 'Khôi phục thành công',
                'data' => $result
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi khôi phục'
            ];
        }
    }

    public function forceDelete($id)
    {
        try {
            $item = $this->repository->findWithTrashed($id);
            if (!$item) {
                return [
                    'status' => false,
                    'message' => 'Không tìm thấy dữ liệu'
                ];
            }

            $this->repository->forceDelete($id);
            return [
                'status' => true,
                'message' => 'Xóa vĩnh viễn thành công'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi xóa vĩnh viễn'
            ];
        }
    }

    protected function successResponse($data = null, $message = '')
    {
        return [
            'status' => true,
            'message' => $message,
            'data' => $data
        ];
    }

    protected function errorResponse($message = '')
    {
        return [
            'status' => false,
            'message' => $message
        ];
    }
}
