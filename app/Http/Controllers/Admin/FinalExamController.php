<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\FinalExam;
use Illuminate\Http\Request;

class FinalExamController extends BaseController
{
    use CrudBasic;

    const MODEL = new FinalExam();

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.final-exams.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'courseId' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:final_exams,slug',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'minScore' => 'required|integer|min:0',
            'maxScore' => 'required|integer|gt:minScore',
            'isRequired' => 'required|boolean',
            'maxAttempt' => 'nullable|integer|min:1'
        ];

        $messages = [
            'courseId.required' => 'Khóa học không được để trống',
            'courseId.exists' => 'Khóa học không tồn tại',
            'name.required' => 'Tên bài thi không được để trống',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'description.required' => 'Mô tả không được để trống',
            'duration.required' => 'Thời gian làm bài không được để trống',
            'duration.integer' => 'Thời gian làm bài phải là số nguyên',
            'duration.min' => 'Thời gian làm bài phải lớn hơn 0',
            'minScore.required' => 'Điểm tối thiểu không được để trống',
            'minScore.integer' => 'Điểm tối thiểu phải là số nguyên',
            'minScore.min' => 'Điểm tối thiểu phải lớn hơn hoặc bằng 0',
            'maxScore.required' => 'Điểm tối đa không được để trống',
            'maxScore.integer' => 'Điểm tối đa phải là số nguyên',
            'maxScore.gt' => 'Điểm tối đa phải lớn hơn điểm tối thiểu',
            'isRequired.required' => 'Trạng thái bắt buộc không được để trống',
            'isRequired.boolean' => 'Trạng thái bắt buộc không hợp lệ',
            'maxAttempt.integer' => 'Số lần làm tối đa phải là số nguyên',
            'maxAttempt.min' => 'Số lần làm tối đa phải lớn hơn 0'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.final-exams.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = self::MODEL::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy bài thi');
        }

        $rules = [
            'courseId' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:final_exams,slug,'.$id,
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'minScore' => 'required|integer|min:0',
            'maxScore' => 'required|integer|gt:minScore',
            'isRequired' => 'required|boolean',
            'maxAttempt' => 'nullable|integer|min:1'
        ];

        $messages = [
            'courseId.required' => 'Khóa học không được để trống',
            'courseId.exists' => 'Khóa học không tồn tại',
            'name.required' => 'Tên bài thi không được để trống',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'description.required' => 'Mô tả không được để trống',
            'duration.required' => 'Thời gian làm bài không được để trống',
            'duration.integer' => 'Thời gian làm bài phải là số nguyên',
            'duration.min' => 'Thời gian làm bài phải lớn hơn 0',
            'minScore.required' => 'Điểm tối thiểu không được để trống',
            'minScore.integer' => 'Điểm tối thiểu phải là số nguyên',
            'minScore.min' => 'Điểm tối thiểu phải lớn hơn hoặc bằng 0',
            'maxScore.required' => 'Điểm tối đa không được để trống',
            'maxScore.integer' => 'Điểm tối đa phải là số nguyên',
            'maxScore.gt' => 'Điểm tối đa phải lớn hơn điểm tối thiểu',
            'isRequired.required' => 'Trạng thái bắt buộc không được để trống',
            'isRequired.boolean' => 'Trạng thái bắt buộc không hợp lệ',
            'maxAttempt.integer' => 'Số lần làm tối đa phải là số nguyên',
            'maxAttempt.min' => 'Số lần làm tối đa phải lớn hơn 0'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.final-exams.index')->with('success', $result['message']);
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
        return view('admin.final-exams.show', ['item' => $result['data']]);
    }
} 