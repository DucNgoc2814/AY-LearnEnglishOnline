<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait CrudBasic
{

    /**
     * Lấy danh sách có phân trang
     */
    protected function getList($query)
    {
        try {
            $items = $query->orderBy('id', 'DESC')
                ->paginate(CrudConfig::PAGINATION['per_page']);
            return $items;
        } catch (\Exception $e) {
            return $this->errorResponse();
        }
    }

    /**
     * Thêm mới bản ghi
     */
    protected function storeItem(Model $model, array $data)
    {
        try {
            $item = $model->create($data);
            if ($item) {
                return [
                    'status' => true,
                    'message' => 'Thêm mới dữ liệu thành công',
                    'data' => $item
                ];
            }
            return [
                'status' => false,
                'message' => 'Không thể tạo dữ liệu mới'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi tạo dữ liệu mới'
            ];
        }
    }

    /**
     * Cập nhật bản ghi
     */
    protected function updateItem(Model $model, array $data)
    {
        try {
            $updated = $model->update($data);
            if ($updated) {
                return [
                    'status' => true,
                    'message' => 'Cập nhật dữ liệu thành công',
                    'data' => $model->fresh()
                ];
            }
            return [
                'status' => false,
                'message' => 'Không thể cập nhật dữ liệu'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật dữ liệu'
            ];
        }
    }

    /**
     * Xóa mềm bản ghi
     */
    protected function deleteItem(Model $model, $id)
    {
        try {
            $deleted = $model->delete();
            if ($deleted) {
                return [
                    'status' => true,
                    'message' => 'Xóa dữ liệu thành công'
                ];
            }
            return [
                'status' => false,
                'message' => 'Không thể xóa dữ liệu'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi xóa dữ liệu'
            ];
        }
    }

    /**
     * Lấy thông tin chi tiết một bản ghi
     */
    protected function getDetail($query, $id)
    {
        try {
            $item = $query->find($id);
            if (!$item) {
                return [
                    'status' => false,
                    'message' => 'Không tìm thấy dữ liệu'
                ];
            }
            return [
                'status' => true,
                'message' => 'Lấy thông tin chi tiết thành công',
                'data' => $item
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy thông tin chi tiết'
            ];
        }
    }

    /**
     * Lấy tất cả bản ghi kể cả đã xóa mềm
     */
    protected function getListWithTrashed($query)
    {
        try {
            $items = $query->withTrashed()
                ->orderBy('id', 'DESC')
                ->paginate(CrudConfig::PAGINATION['per_page']);
                return $items;
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách'
            ];
        }
    }

    /**
     * Lấy chi tiết bản ghi kể cả đã xóa mềm
     */
    protected function getDetailWithTrashed($query, $id)
    {
        try {
            $item = $query->withTrashed()->find($id);
            if (!$item) {
                return [
                    'status' => false,
                    'message' => 'Không tìm thấy dữ liệu'
                ];
            }
            return [
                'status' => true,
                'message' => 'Lấy thông tin chi tiết thành công',
                'data' => $item
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy thông tin chi tiết'
            ];
        }
    }

    /**
     * Khôi phục bản ghi đã xóa mềm
     */
    protected function restoreItem(Model $model)
    {
        try {
            $restored = $model->restore();
            if ($restored) {
                return [
                    'status' => true,
                    'message' => 'Khôi phục dữ liệu thành công',
                    'data' => $model
                ];
            }
            return [
                'status' => false,
                'message' => 'Không thể khôi phục dữ liệu'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi khôi phục dữ liệu'
            ];
        }
    }
}
