<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductSpecification;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->model = Product::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.products';

        // Cấu hình các model liên quan
        $this->relatedModels = [
            'detail' => ProductDetail::class,
            'specifications' => ProductSpecification::class
        ];

        parent::__construct();
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->model::rules());

        // Tạo instance mới
        $product = $this->model::create($validated);

        // Xử lý upload tất cả các trường media
        foreach ($product::mediaFields() as $field => $config) {
            if ($request->hasFile($field)) {
                $path = $product->handleMediaUpload($field, $request->file($field));
                $product->update([$field => $path]);
            }
        }

        // Xử lý các model liên quan
        $this->handleRelatedModels($request, $product);

        return redirect()->route($this->route . '.index')
            ->with('success', 'Sản phẩm đã được tạo thành công');
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::findOrFail($id);
        $validated = $request->validate($this->model::rules($id));

        // Cập nhật thông tin cơ bản
        $item->update($validated);

        // Xử lý upload tất cả các trường media
        foreach ($item::mediaFields() as $field => $config) {
            if ($request->hasFile($field)) {
                $path = $item->handleMediaUpload($field, $request->file($field));
                $item->update([$field => $path]);
            }
        }

        // Xử lý các model liên quan
        $this->handleRelatedModels($request, $item, true);

        return redirect()->route($this->route . '.index')
            ->with('success', 'Sản phẩm đã được cập nhật thành công');
    }

    public function destroy($id)
    {
        $item = $this->model::findOrFail($id);
        $item->delete();

        return redirect()->route($this->route . '.index')
            ->with('success', 'Sản phẩm đã được chuyển vào thùng rác');
    }
}
