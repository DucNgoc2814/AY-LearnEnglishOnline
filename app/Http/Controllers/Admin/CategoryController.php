<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý danh mục
 */
class CategoryController extends BaseController
{
    protected $categoryService;
    const VIEW_PATH = 'admin.components.categories.';

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Hiển thị danh sách danh mục
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->categoryService->getList();
            $trashList = $this->categoryService->getTrashList();
            return view(self::VIEW_PATH . 'index', [
                'categories' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu danh mục mới
     * 
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $result = $this->categoryService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị form chỉnh sửa danh mục
     * 
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $result = $this->categoryService->findById($id);
        return $this->viewResponse(self::VIEW_PATH . 'edit', $result);
    }

    /**
     * Cập nhật danh mục
     * 
     * @param int $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->categoryService->update($id, $request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Xóa danh mục
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    
    public function destroy($id)
    {
        $result = $this->categoryService->delete($id);
        return $this->redirectResponse($result);
    }

    /**
     * Khôi phục danh mục đã xóa
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->categoryService->restore($id);
        return $this->redirectResponse($result);
    }
}
