<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use CrudBasic;
    const MODEL = new Blog();

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.blogs.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'language' => 'required|string|in:vi,en'
        ];

        $messages = [
            'name.required' => 'Tên bài viết không được để trống',
            'description.required' => 'Nội dung không được để trống',
            'image.image' => 'File phải là ảnh',
            'image.max' => 'Kích thước ảnh tối đa là 2MB',
            'language.required' => 'Ngôn ngữ không được để trống',
            'language.in' => 'Ngôn ngữ không hợp lệ'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.blogs.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = self::MODEL::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy bài viết');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'language' => 'required|string|in:vi,en'
        ];

        $messages = [
            'name.required' => 'Tên bài viết không được để trống',
            'description.required' => 'Nội dung không được để trống',
            'image.image' => 'File phải là ảnh',
            'image.max' => 'Kích thước ảnh tối đa là 2MB',
            'language.required' => 'Ngôn ngữ không được để trống',
            'language.in' => 'Ngôn ngữ không hợp lệ'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.blogs.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function destroy($id)
    {
        $result = $this->deleteItem(self::MODEL, $id);
        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }

    public function show($id)
    {
        $result = $this->getDetail(self::MODEL::query(), $id);
        if (!$result['status']) {
            return redirect()->back()->with('error', $result['message']);
        }
        return view('admin.blogs.show', ['item' => $result['data']]);
    }
} 