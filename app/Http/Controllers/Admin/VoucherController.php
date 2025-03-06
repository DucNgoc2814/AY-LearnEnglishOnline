<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    use CrudBasic;

    const MODEL = new Voucher();

    public function index()
    {
        $items = $this->getList(self::MODEL::query());
        return view('admin.vouchers.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'code' => 'required|string|unique:vouchers',
            'sale' => 'required|numeric|min:0',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
            'usageCount' => 'required|integer|min:0',
            'maxUsage' => 'required|integer|min:1',
            'minOrderValue' => 'required|numeric|min:0',
            'maxDiscount' => 'required|numeric|min:0'
        ];

        $messages = [
            'code.required' => 'Mã giảm giá không được để trống',
            'code.unique' => 'Mã giảm giá đã tồn tại',
            'sale.required' => 'Giá trị giảm không được để trống',
            'sale.min' => 'Giá trị giảm phải lớn hơn 0',
            'startDate.required' => 'Ngày bắt đầu không được để trống',
            'endDate.required' => 'Ngày kết thúc không được để trống',
            'endDate.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
            'usageCount.required' => 'Số lần sử dụng không được để trống',
            'maxUsage.required' => 'Số lần sử dụng tối đa không được để trống',
            'maxUsage.min' => 'Số lần sử dụng tối đa phải lớn hơn 0',
            'minOrderValue.required' => 'Giá trị đơn hàng tối thiểu không được để trống',
            'maxDiscount.required' => 'Giá trị giảm tối đa không được để trống'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->storeItem(self::MODEL, $data);

        if ($result['status']) {
            return redirect()->route('admin.vouchers.index')->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message'])->withInput();
    }

    public function update(Request $request, $id)
    {
        $item = self::MODEL::find($id);
        if (!$item) {
            return redirect()->back()->with('error', 'Không tìm thấy mã giảm giá');
        }

        $rules = [
            'code' => 'required|string|unique:vouchers,code,'.$id,
            'sale' => 'required|numeric|min:0',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
            'usageCount' => 'required|integer|min:0',
            'maxUsage' => 'required|integer|min:1',
            'minOrderValue' => 'required|numeric|min:0',
            'maxDiscount' => 'required|numeric|min:0'
        ];

        $messages = [
            'code.required' => 'Mã giảm giá không được để trống',
            'code.unique' => 'Mã giảm giá đã tồn tại',
            'sale.required' => 'Giá trị giảm không được để trống',
            'sale.min' => 'Giá trị giảm phải lớn hơn 0',
            'startDate.required' => 'Ngày bắt đầu không được để trống',
            'endDate.required' => 'Ngày kết thúc không được để trống',
            'endDate.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
            'usageCount.required' => 'Số lần sử dụng không được để trống',
            'maxUsage.required' => 'Số lần sử dụng tối đa không được để trống',
            'maxUsage.min' => 'Số lần sử dụng tối đa phải lớn hơn 0',
            'minOrderValue.required' => 'Giá trị đơn hàng tối thiểu không được để trống',
            'maxDiscount.required' => 'Giá trị giảm tối đa không được để trống'
        ];

        $data = $request->validate($rules, $messages);
        $result = $this->updateItem($item, $data);

        if ($result['status']) {
            return redirect()->route('admin.vouchers.index')->with('success', $result['message']);
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
        return view('admin.vouchers.show', ['item' => $result['data']]);
    }
} 