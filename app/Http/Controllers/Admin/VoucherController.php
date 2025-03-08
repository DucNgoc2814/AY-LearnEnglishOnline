<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Voucher;
use App\Http\Requests\Admin\Voucher\StoreRequest;
use App\Http\Requests\Admin\Voucher\UpdateRequest;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý mã giảm giá
 */
class VoucherController extends Controller
{
    use CrudBasic;

    const PATH_VIEW = 'admin.components.vouchers.';
    protected $model = Voucher::class;

    /**
     * Hiển thị danh sách mã giảm giá
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $query = $this->model::query();
        
        if (request()->has('search')) {
            $search = request('search');
            $query->where('code', 'LIKE', "%{$search}%");
        }

        $items = $this->getList($query);
            
        $deletedVouchers = $this->getListWithTrashed($this->model::onlyTrashed());

        return view(self::PATH_VIEW . 'index', compact('items', 'deletedVouchers'));
    }

    /**
     * Lưu mã giảm giá mới
     * 
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $model = new $this->model();
            $data = $request->validated();

            $result = $this->storeItem($model, $data);
            
            $flashType = $result['status'] ? 'success' : 'error';
            $flashMessage = $result['message'];
            
            return redirect()->back()->with($flashType, $flashMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo mã giảm giá');
        }
    }

    /**
     * Hiển thị form chỉnh sửa mã giảm giá
     * 
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $result = $this->getDetail($this->model::query(), $id);
        if (!$result['status']) {
            return redirect()->back()->with('error', $result['message']);
        }
        
        return view(self::PATH_VIEW . 'edit', ['item' => $result['data']]);
    }

    /**
     * Cập nhật mã giảm giá
     * 
     * @param int $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateRequest $request)
    {
        try {
            $data = $request->validated();
            
            $result = $this->updateItem($this->model::query()->find($id), $data);
            
            if ($request->wantsJson()) {
                return response()->json($result);
            }
            
            $flashType = $result['status'] ? 'success' : 'error';
            $flashMessage = $result['message'];
            
            return redirect()->back()->with($flashType, $flashMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật mã giảm giá');
        }
    }

    /**
     * Xóa mã giảm giá
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $model = $this->model::query()->find($id);
        if (!$model) {
            return redirect()->back()->with('error', 'Không tìm thấy dữ liệu');
        }
        
        $result = $this->deleteItem($model, $id);
        
        if (request()->wantsJson()) {
            return response()->json($result);
        }
        
        $flashType = $result['status'] ? 'success' : 'error';
        $flashMessage = $result['message'];
        
        return redirect()->back()->with($flashType, $flashMessage);
    }

    /**
     * Khôi phục mã giảm giá đã xóa
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $result = $this->restoreItem($this->model::withTrashed()->find($id));
        
        if (request()->wantsJson()) {
            return response()->json($result);
        }
        
        $flashType = $result['status'] ? 'success' : 'error';
        $flashMessage = $result['message'];
        
        return redirect()->back()->with($flashType, $flashMessage);
    }

    /**
     * Hiển thị chi tiết mã giảm giá
     * 
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $result = $this->getDetail($this->model::query(), $id);
        if (!$result['status']) {
            return redirect()->back()->with('error', $result['message']);
        }
        
        return view(self::PATH_VIEW . 'show', ['item' => $result['data']]);
    }
} 