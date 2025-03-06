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
            return null;
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
                    'message' => CrudConfig::MESSAGES['create']['success'],
                    'data' => $item
                ];
            }
            return [
                'status' => false,
                'message' => CrudConfig::MESSAGES['create']['error']
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => CrudConfig::MESSAGES['create']['error']
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
                    'message' => CrudConfig::MESSAGES['update']['success'],
                    'data' => $model->fresh()
                ];
            }
            return [
                'status' => false,
                'message' => CrudConfig::MESSAGES['update']['error']
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => CrudConfig::MESSAGES['update']['error']
            ];
        }
    }

    /**
     * Xóa mềm bản ghi
     */
    protected function deleteItem(Model $model, $id)
    {
        try {
            $deleted = $model->find($id)->delete();
            if ($deleted) {
                return [
                    'status' => true,
                    'message' => CrudConfig::MESSAGES['delete']['success']
                ];
            }
            return [
                'status' => false,
                'message' => CrudConfig::MESSAGES['delete']['error']
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => CrudConfig::MESSAGES['delete']['error']
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
                    'message' => CrudConfig::MESSAGES['not_found']
                ];
            }
            return [
                'status' => true,
                'data' => $item
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => CrudConfig::MESSAGES['not_found']
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
            return null;
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
                    'message' => CrudConfig::MESSAGES['not_found']
                ];
            }
            return [
                'status' => true,
                'data' => $item
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => CrudConfig::MESSAGES['not_found']
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
                    'message' => 'Khôi phục dữ liệu thành công!',
                    'data' => $model
                ];
            }
            return [
                'status' => false,
                'message' => 'Không thể khôi phục dữ liệu!'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi khôi phục dữ liệu!'
            ];
        }
    }
}
