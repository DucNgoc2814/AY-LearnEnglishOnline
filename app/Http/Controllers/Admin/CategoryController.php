<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use CrudBasic;

    const PATH_VIEW = 'admin.components.categories.';
    protected $model = Category::class;

    public function index()
    {
        $items = $this->getList($this->model::query()->withCount('courses'));
        return view(self::PATH_VIEW . 'index', compact('items'));
    }

    public function create()
    {
        return view(self::PATH_VIEW . 'create');
    }

    public function store(Request $request)
    {
        $result = $this->createItem($this->model::query(), $request->all());
        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->getDetail($this->model::query(), $id);
        if (!$result['status']) {
            return redirect()->back()->with('error', $result['message']);
        }
        return view(self::PATH_VIEW . 'edit', ['item' => $result['data']]);
    }

    public function update(Request $request, $id)
    {
        $result = $this->updateItem($this->model::query()->find($id), $request->all());
        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }

    public function destroy($id)
    {
        $result = $this->deleteItem($this->model::query()->find($id), $id);
        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }

    public function show($id)
    {
        $result = $this->getDetail($this->model::query(), $id);
        if (!$result['status']) {
            return redirect()->back()->with('error', $result['message']);
        }
        return view(self::PATH_VIEW . 'show', ['item' => $result['data']]);
    }
}
