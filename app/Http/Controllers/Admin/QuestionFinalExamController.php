<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\QuestionFinalExam;
use Illuminate\Http\Request;

class QuestionFinalExamController extends BaseController
{

    const MODEL = new QuestionFinalExam();

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.question-final-exams.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'finalExamId' => 'required|exists:final_exams,id',
            'question' => 'required|string',
            'orderNumber' => 'required|integer|min:0'
        ];

        $messages = [
            'finalExamId.required' => 'Bài thi cuối khóa không được để trống',
            'finalExamId.exists' => 'Bài thi cuối khóa không tồn tại',
            'question.required' => 'Câu hỏi không được để trống',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.min' => 'Thứ tự phải lớn hơn 0'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.question-final-exams.index')->with('success', $result['message']);
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
            'finalExamId' => 'required|exists:final_exams,id',
            'question' => 'required|string',
            'orderNumber' => 'required|integer|min:0'
        ];

        $messages = [
            'finalExamId.required' => 'Bài thi cuối khóa không được để trống',
            'finalExamId.exists' => 'Bài thi cuối khóa không tồn tại',
            'question.required' => 'Câu hỏi không được để trống',
            'orderNumber.required' => 'Thứ tự không được để trống',
            'orderNumber.min' => 'Thứ tự phải lớn hơn 0'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.question-final-exams.index')->with('success', $result['message']);
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
        return view('admin.question-final-exams.show', ['item' => $result['data']]);
    }
} 