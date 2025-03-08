<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    use CrudBasic;

    const MODEL = new Order();

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.orders.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'userId' => 'required|exists:users,id',
            'courseId' => 'required|exists:courses,id',
            'amount' => 'required|numeric|min:0',
            'paymentMethod' => 'required|string',
            'status' => 'required|string',
            'voucherId' => 'nullable|exists:vouchers,id',
            'discountAmount' => 'nullable|numeric|min:0'
        ];

        $messages = [
            'userId.required' => 'Người dùng không được để trống',
            'userId.exists' => 'Người dùng không tồn tại',
            'courseId.required' => 'Khóa học không được để trống',
            'courseId.exists' => 'Khóa học không tồn tại',
            'amount.required' => 'Số tiền không được để trống',
            'amount.numeric' => 'Số tiền phải là số',
            'amount.min' => 'Số tiền phải lớn hơn 0',
            'paymentMethod.required' => 'Phương thức thanh toán không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'voucherId.exists' => 'Mã giảm giá không tồn tại',
            'discountAmount.numeric' => 'Số tiền giảm giá phải là số',
            'discountAmount.min' => 'Số tiền giảm giá phải lớn hơn 0'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.orders.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = self::MODEL::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng');
        }

        $rules = [
            'status' => 'required|string'
        ];

        $messages = [
            'status.required' => 'Trạng thái không được để trống'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.orders.index')->with('success', $result['message']);
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
        return view('admin.orders.show', ['item' => $result['data']]);
    }
} 