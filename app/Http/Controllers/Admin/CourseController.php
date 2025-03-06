<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use CrudBasic;

    const PATH_VIEW = 'admin.components.courses.';
    protected $model = Course::class;

    public function index()
    {
        $items = $this->getList($this->model::query());
        return view(self::PATH_VIEW . 'index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:courses,slug',
            'description' => 'required|string',
            'categoryId' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|max:2048'
        ];

        $messages = [
            'name.required' => 'Tên khóa học không được để trống',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'description.required' => 'Mô tả không được để trống',
            'categoryId.required' => 'Danh mục không được để trống',
            'categoryId.exists' => 'Danh mục không tồn tại',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là số',
            'price.min' => 'Giá phải lớn hơn 0',
            'thumbnail.image' => 'File phải là ảnh',
            'thumbnail.max' => 'Kích thước ảnh tối đa là 2MB'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem($this->model(), $data);

        if ($result['status']) {
            return redirect()->route('admin.components.courses.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy khóa học');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:courses,slug,'.$id,
            'description' => 'required|string',
            'categoryId' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|max:2048'
        ];

        $messages = [
            'name.required' => 'Tên khóa học không được để trống',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'description.required' => 'Mô tả không được để trống',
            'categoryId.required' => 'Danh mục không được để trống',
            'categoryId.exists' => 'Danh mục không tồn tại',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là số',
            'price.min' => 'Giá phải lớn hơn 0',
            'thumbnail.image' => 'File phải là ảnh',
            'thumbnail.max' => 'Kích thước ảnh tối đa là 2MB'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.components.courses.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function destroy($id)
    {
        $result = $this->deleteItem($this->model::find($id), $id);
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
