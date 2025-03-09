<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\VoucherServiceInterface;
use App\Http\Requests\Admin\Voucher\StoreRequest;
use App\Http\Requests\Admin\Voucher\UpdateRequest;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý mã giảm giá
 */
class VoucherController extends BaseController
{
    protected $voucherService;
    const VIEW_PATH = 'admin.components.vouchers.';

    public function __construct(VoucherServiceInterface $voucherService)
    {
        $this->voucherService = $voucherService;
    }

    /**
     * Hiển thị danh sách voucher
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->voucherService->getList();
            $trashList = $this->voucherService->getTrashList();
            return view(self::VIEW_PATH . 'index', [
                'vouchers' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu voucher mới
     * 
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $result = $this->voucherService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị form chỉnh sửa voucher
     * 
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $result = $this->voucherService->findById($id);
        return $this->viewResponse(self::VIEW_PATH . 'edit', $result);
    }

    /**
     * Cập nhật voucher
     * 
     * @param int $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->voucherService->update($id, $request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Xóa voucher
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->voucherService->delete($id);
        return $this->redirectResponse($result);
    }

    /**
     * Khôi phục voucher đã xóa
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->voucherService->restore($id);
        return $this->redirectResponse($result);
    }
} 