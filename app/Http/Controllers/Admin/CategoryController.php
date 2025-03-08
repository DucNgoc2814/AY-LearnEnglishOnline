<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý danh mục
 */
class CategoryController extends Controller
{
    use CrudBasic;

    const PATH_VIEW = 'admin.components.categories.';
    protected $model = Category::class;

    /**
     * Hiển thị danh sách danh mục
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $query = $this->model::query();
        
        if (request()->has('search')) {
            $search = request('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $items = $this->getList($this->model::query());
        $deletedCategories = $this->getListWithTrashed($this->model::onlyTrashed()->withCount('courses'));

        return view(self::PATH_VIEW . 'index', compact('items', 'deletedCategories'));
    }

    /**
     * Lưu danh mục mới
     * 
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $model = new $this->model();
            $data = $request->validated();
            $data['slug'] = Str::slug($data['name']);
            $result = $this->storeItem($model, $data);
            $flashType = $result['status'] ? 'success' : 'error';
            $flashMessage = $result['message'];
         
            return redirect()->back()->with($flashType, $flashMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Hiển thị form chỉnh sửa danh mục
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
     * Cập nhật danh mục
     * 
     * @param int $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['name']);
            $result = $this->updateItem($this->model::query()->find($id), $data);
            $flashType = $result['status'] ? 'success' : 'error';
            $flashMessage = $result['message'];
            
            return redirect()->back()->with($flashType, $flashMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật danh mục');
        }
    }

    /**
     * Xóa danh mục
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
        $flashType = $result['status'] ? 'success' : 'error';
        $flashMessage = $result['message'];
        
        return redirect()->back()->with($flashType, $flashMessage);
    }

    /**
     * Khôi phục danh mục đã xóa
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $result = $this->restoreItem($this->model::withTrashed()->find($id));
        $flashType = $result['status'] ? 'success' : 'error';
        $flashMessage = $result['message'];
        
        return redirect()->back()->with($flashType, $flashMessage);
    }
}
