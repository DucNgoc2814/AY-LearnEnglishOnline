<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    protected const MODEL = User::class;

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.users.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phoneNumber' => 'nullable|string|max:20',
            'birthDate' => 'nullable|date',
            'role' => 'required|string|in:admin,user'
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'phoneNumber.max' => 'Số điện thoại không được quá 20 ký tự',
            'birthDate.date' => 'Ngày sinh không hợp lệ',
            'role.required' => 'Vai trò không được để trống',
            'role.in' => 'Vai trò không hợp lệ'
        ];

        $data = $request->validate($rules, $messages);
        $data['password'] = Hash::make($data['password']);
        
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.users.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = self::MODEL::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy người dùng');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
            'phoneNumber' => 'nullable|string|max:20',
            'birthDate' => 'nullable|date',
            'role' => 'required|string|in:admin,user'
        ];

        $messages = [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'phoneNumber.max' => 'Số điện thoại không được quá 20 ký tự',
            'birthDate.date' => 'Ngày sinh không hợp lệ',
            'role.required' => 'Vai trò không được để trống',
            'role.in' => 'Vai trò không hợp lệ'
        ];

        $data = $request->validate($rules, $messages);
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.users.index')->with('success', $result['message']);
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
        return view('admin.users.show', ['item' => $result['data']]);
    }
} 