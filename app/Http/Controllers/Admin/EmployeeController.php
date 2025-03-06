<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use CrudBasic;

    const MODEL = new Employee();

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.employees.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'employeeCode' => 'required|string|unique:employees',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'note' => 'nullable|string'
        ];

        $messages = [
            'employeeCode.required' => 'Mã nhân viên không được để trống',
            'employeeCode.unique' => 'Mã nhân viên đã tồn tại',
            'name.required' => 'Tên không được để trống',
            'position.required' => 'Chức vụ không được để trống',
            'department.required' => 'Phòng ban không được để trống'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.employees.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = self::MODEL::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy nhân viên');
        }

        $rules = [
            'employeeCode' => 'required|string|unique:employees,employeeCode,'.$id,
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'note' => 'nullable|string'
        ];

        $messages = [
            'employeeCode.required' => 'Mã nhân viên không được để trống',
            'employeeCode.unique' => 'Mã nhân viên đã tồn tại',
            'name.required' => 'Tên không được để trống',
            'position.required' => 'Chức vụ không được để trống',
            'department.required' => 'Phòng ban không được để trống'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.employees.index')->with('success', $result['message']);
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
        return view('admin.employees.show', ['item' => $result['data']]);
    }
} 