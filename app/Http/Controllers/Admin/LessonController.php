<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    use CrudBasic;

    const MODEL = new Lesson();

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.lessons.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'courseId' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:lessons',
            'videoUrl' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|integer|min:0',
            'orderNumber' => 'required|integer|min:0',
            'isPreview' => 'required|boolean',
            'totalView' => 'required|integer|min:0',
            'totalComment' => 'required|integer|min:0'
        ];

        $messages = [
            'courseId.required' => 'Khóa học không được để trống',
            'courseId.exists' => 'Khóa học không tồn tại',
            'name.required' => 'Tên bài học không được để trống',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'videoUrl.required' => 'URL video không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'duration.required' => 'Thời lượng không được để trống',
            'duration.min' => 'Thời lượng phải lớn hơn 0',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.min' => 'Thứ tự phải lớn hơn 0',
            'isPreview.required' => 'Trạng thái xem trước không được để trống'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.lessons.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = self::MODEL::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy bài học');
        }

        $rules = [
            'courseId' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:lessons,slug,'.$id,
            'videoUrl' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|integer|min:0',
            'orderNumber' => 'required|integer|min:0',
            'isPreview' => 'required|boolean',
            'totalView' => 'required|integer|min:0',
            'totalComment' => 'required|integer|min:0'
        ];

        $messages = [
            'courseId.required' => 'Khóa học không được để trống',
            'courseId.exists' => 'Khóa học không tồn tại',
            'name.required' => 'Tên bài học không được để trống',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'videoUrl.required' => 'URL video không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'duration.required' => 'Thời lượng không được để trống',
            'duration.min' => 'Thời lượng phải lớn hơn 0',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.min' => 'Thứ tự phải lớn hơn 0',
            'isPreview.required' => 'Trạng thái xem trước không được để trống'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.lessons.index')->with('success', $result['message']);
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
        return view('admin.lessons.show', ['item' => $result['data']]);
    }
} 