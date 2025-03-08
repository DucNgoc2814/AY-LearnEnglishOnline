<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\LessonTest;
use Illuminate\Http\Request;

class LessonTestController extends BaseController
{
    use CrudBasic;

    const MODEL = new LessonTest();

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.lesson-tests.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'lessonId' => 'required|exists:lessons,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:lesson_tests',
            'description' => 'required|string',
            'duration' => 'required|integer|min:0',
            'minScore' => 'required|integer|min:0',
            'maxScore' => 'required|integer|min:0',
            'orderNumber' => 'required|integer|min:0',
            'isRequired' => 'required|boolean',
            'totalAttempt' => 'required|integer|min:0',
            'maxAttempt' => 'required|integer|min:1'
        ];

        $messages = [
            'lessonId.required' => 'Bài học không được để trống',
            'lessonId.exists' => 'Bài học không tồn tại',
            'name.required' => 'Tên bài kiểm tra không được để trống',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'description.required' => 'Mô tả không được để trống',
            'duration.required' => 'Thời gian làm bài không được để trống',
            'duration.min' => 'Thời gian làm bài phải lớn hơn 0',
            'minScore.required' => 'Điểm tối thiểu không được để trống',
            'minScore.min' => 'Điểm tối thiểu phải lớn hơn 0',
            'maxScore.required' => 'Điểm tối đa không được để trống',
            'maxScore.min' => 'Điểm tối đa phải lớn hơn 0',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.min' => 'Thứ tự phải lớn hơn 0',
            'isRequired.required' => 'Trạng thái bắt buộc không được để trống',
            'totalAttempt.required' => 'Số lần làm bài không được để trống',
            'maxAttempt.required' => 'Số lần làm bài tối đa không được để trống',
            'maxAttempt.min' => 'Số lần làm bài tối đa phải lớn hơn 0'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.lesson-tests.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = self::MODEL::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy bài kiểm tra');
        }

        $rules = [
            'lessonId' => 'required|exists:lessons,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:lesson_tests,slug,'.$id,
            'description' => 'required|string',
            'duration' => 'required|integer|min:0',
            'minScore' => 'required|integer|min:0',
            'maxScore' => 'required|integer|min:0',
            'orderNumber' => 'required|integer|min:0',
            'isRequired' => 'required|boolean',
            'totalAttempt' => 'required|integer|min:0',
            'maxAttempt' => 'required|integer|min:1'
        ];

        $messages = [
            'lessonId.required' => 'Bài học không được để trống',
            'lessonId.exists' => 'Bài học không tồn tại',
            'name.required' => 'Tên bài kiểm tra không được để trống',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'description.required' => 'Mô tả không được để trống',
            'duration.required' => 'Thời gian làm bài không được để trống',
            'duration.min' => 'Thời gian làm bài phải lớn hơn 0',
            'minScore.required' => 'Điểm tối thiểu không được để trống',
            'minScore.min' => 'Điểm tối thiểu phải lớn hơn 0',
            'maxScore.required' => 'Điểm tối đa không được để trống',
            'maxScore.min' => 'Điểm tối đa phải lớn hơn 0',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.min' => 'Thứ tự phải lớn hơn 0',
            'isRequired.required' => 'Trạng thái bắt buộc không được để trống',
            'totalAttempt.required' => 'Số lần làm bài không được để trống',
            'maxAttempt.required' => 'Số lần làm bài tối đa không được để trống',
            'maxAttempt.min' => 'Số lần làm bài tối đa phải lớn hơn 0'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.lesson-tests.index')->with('success', $result['message']);
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
        return view('admin.lesson-tests.show', ['item' => $result['data']]);
    }
} 