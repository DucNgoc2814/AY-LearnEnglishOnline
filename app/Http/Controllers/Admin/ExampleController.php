<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Config\CrudBasic;
use App\Http\Controllers\Config\CrudConfig;
use App\Http\Controllers\Config\CrudRules;
use App\Models\YourModel;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    use CrudBasic;

    public function index()
    {
        $items = $this->getList(YourModel::query());
        return view('admin.your-view.index', compact('items'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => CrudRules::TEXT_RULES['name'],
            'description' => CrudRules::TEXT_RULES['description'],
            'category_id' => CrudRules::RELATION_RULES['category_id'],
            'image' => CrudRules::FILE_RULES['image'],
            'price' => CrudRules::NUMBER_RULES['price'],
            'published_at' => CrudRules::DATE_RULES['published_at'],
        ];

        $messages = CrudRules::MESSAGES;
        $attributes = CrudRules::ATTRIBUTES;

        $data = $request->validate($rules, $messages, $attributes);
        $result = $this->storeItem(new YourModel(), $data);
        
        if ($result['status']) {
            return redirect()->back()->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message']);
    }

    public function update(Request $request, $id)
    {
        $item = YourModel::find($id);
        if (!$item) {
            return redirect()->back()->with('error', CrudConfig::MESSAGES['not_found']);
        }

        $rules = [
            'name' => CrudRules::TEXT_RULES['name'],
            'description' => CrudRules::TEXT_RULES['description'],
            'category_id' => CrudRules::RELATION_RULES['category_id'],
            'image' => CrudRules::FILE_RULES['image'],
            'price' => CrudRules::NUMBER_RULES['price'],
            'published_at' => CrudRules::DATE_RULES['published_at'],
        ];

        $messages = CrudRules::MESSAGES;
        $attributes = CrudRules::ATTRIBUTES;

        $data = $request->validate($rules, $messages, $attributes);
        $result = $this->updateItem($item, $data);
        
        if ($result['status']) {
            return redirect()->back()->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message']);
    }

    public function destroy($id)
    {
        $item = YourModel::find($id);
        if (!$item) {
            return redirect()->back()->with('error', CrudConfig::MESSAGES['not_found']);
        }

        $result = $this->deleteItem($item);
        
        if ($result['status']) {
            return redirect()->back()->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message']);
    }

    public function show($id)
    {
        $result = $this->getDetail(YourModel::query(), $id);
        
        if (!$result['status']) {
            return redirect()->back()->with('error', $result['message']);
        }
        
        return view('admin.your-view.show', ['item' => $result['data']]);
    }

    // Lấy tất cả bản ghi kể cả đã xóa mềm
    public function indexWithTrashed()
    {
        $items = $this->getListWithTrashed(YourModel::query());
        return view('admin.your-view.index', compact('items'));
    }

    // Xem chi tiết bản ghi đã xóa mềm
    public function showTrashed($id)
    {
        $result = $this->getDetailWithTrashed(YourModel::query(), $id);
        
        if (!$result['status']) {
            return redirect()->back()->with('error', $result['message']);
        }
        
        return view('admin.your-view.show', ['item' => $result['data']]);
    }

    // Khôi phục bản ghi đã xóa mềm
    public function restore($id)
    {
        $item = YourModel::withTrashed()->find($id);
        if (!$item) {
            return redirect()->back()->with('error', CrudConfig::MESSAGES['not_found']);
        }

        $result = $this->restoreItem($item);
        
        if ($result['status']) {
            return redirect()->back()->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message']);
    }
} 