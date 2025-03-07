<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;

class CategoryController extends Controller
{
    use CrudBasic;

    const PATH_VIEW = 'admin.components.categories.';
    protected $model = Category::class;

    public function index()
    {
        $query = $this->model::query()->withCount('courses');
        
        if (request()->has('search')) {
            $search = request('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $items = $query->orderBy('id', 'DESC')->paginate(10);
            
        $deletedCategories = $this->model::onlyTrashed()
            ->withCount('courses')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view(self::PATH_VIEW . 'index', compact('items', 'deletedCategories'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $model = new $this->model;
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

    public function edit($id)
    {
        $result = $this->getDetail($this->model::query(), $id);
        if (!$result['status']) {
            return redirect()->back()->with('error', $result['message']);
        }
        return view(self::PATH_VIEW . 'edit', ['item' => $result['data']]);
    }

    public function update($id, UpdateRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $result = $this->updateItem($this->model::query()->find($id), $data);

        if ($request->wantsJson()) {
            return response()->json($result);
        }

        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }

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

        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }

    public function restore($id)
    {
        $result = $this->restoreItem($this->model::withTrashed()->find($id));

        if (request()->wantsJson()) {
            return response()->json($result);
        }

        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }
}
