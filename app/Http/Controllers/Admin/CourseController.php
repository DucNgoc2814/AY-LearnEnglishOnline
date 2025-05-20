<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    protected $pageTitle = 'Danh sách khóa học';
    public function __construct()
    {
        $this->model = Course::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.courses';

        // Cấu hình các model liên quan
        $this->relatedModels = [
            // 'detail' => Lesson::class,
            // 'specifications' => ProductSpecification::class
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
        $item = $this->model::withTrashed()->findOrFail($id);
        $validated = $request->validate($this->model::rules($item->id));

        // Cập nhật thông tin cơ bản
        $item->update($validated);

        // Xử lý upload tất cả các trường media
        foreach ($item::mediaFields() as $field => $config) {
            if ($request->hasFile($field)) {
                $path = $item->handleMediaUpload($field, $request->file($field));
                $item->update([$field => $path]);
            }
            // Nếu không có file mới và có request xóa file cũ
            elseif ($request->has("remove_{$field}")) {
                $item->deleteMedia($item->$field);
                $item->update([$field => null]);
            }
            // Nếu không có file mới nhưng có file cũ và đang edit
            elseif ($request->has("{$field}_current")) {
                $item->update([$field => $request->input("{$field}_current")]);
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
