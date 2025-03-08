<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\QuestionLessonTest;
use Illuminate\Http\Request;

class QuestionLessonTestController extends BaseController
{
    use CrudBasic;

    const MODEL = new QuestionLessonTest();

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.question-lesson-tests.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'lessonTestId' => 'required|exists:lesson_tests,id',
            'question' => 'required|string',
            'orderNumber' => 'required|integer|min:0'
        ];

        $messages = [
            'lessonTestId.required' => 'Bài kiểm tra không được để trống',
            'lessonTestId.exists' => 'Bài kiểm tra không tồn tại',
            'question.required' => 'Câu hỏi không được để trống',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.min' => 'Thứ tự phải lớn hơn 0'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.question-lesson-tests.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = self::MODEL::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy câu hỏi');
        }

        $rules = [
            'lessonTestId' => 'required|exists:lesson_tests,id',
            'question' => 'required|string',
            'orderNumber' => 'required|integer|min:0'
        ];

        $messages = [
            'lessonTestId.required' => 'Bài kiểm tra không được để trống',
            'lessonTestId.exists' => 'Bài kiểm tra không tồn tại',
            'question.required' => 'Câu hỏi không được để trống',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.min' => 'Thứ tự phải lớn hơn 0'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.question-lesson-tests.index')->with('success', $result['message']);
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
        return view('admin.question-lesson-tests.show', ['item' => $result['data']]);
    }
} 