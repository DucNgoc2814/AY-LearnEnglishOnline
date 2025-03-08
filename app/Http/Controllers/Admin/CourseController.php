<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends BaseController
{
    protected const PATH_VIEW = 'admin.components.courses.';
    protected $model = Course::class;

    public function index()
    {
        $query = $this->model::query()->with('category');

        if (request()->has('search')) {
            $search = request('search');
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $items = $query->orderBy('id', 'DESC')->paginate(10);

        $deletedCourses = $this->model::onlyTrashed()
            ->with('category')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view(self::PATH_VIEW . 'index', compact('items', 'deletedCourses'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'categoryId' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'salePrice' => 'nullable|numeric|min:0',
                'description' => 'required|string',
                'sortDescription' => 'nullable|string',
                'thumbnail' => 'nullable|image|max:2048',
            ];

            $messages = [
                'name.required' => 'Tên khóa học không được để trống',
                'categoryId.required' => 'Danh mục không được để trống',
                'categoryId.exists' => 'Danh mục không tồn tại',
                'price.required' => 'Giá không được để trống',
                'price.numeric' => 'Giá phải là số',
                'price.min' => 'Giá phải lớn hơn 0',
                'salePrice.numeric' => 'Giá khuyến mãi phải là số',
                'salePrice.min' => 'Giá khuyến mãi phải lớn hơn 0',
                'description.required' => 'Mô tả không được để trống',
                'thumbnail.image' => 'File phải là ảnh',
                'thumbnail.max' => 'Kích thước ảnh tối đa là 2MB'
            ];

            $data = $request->validate($rules, $messages);

            // Khởi tạo các giá trị mặc định
            $data['releaseTime'] = now();
            $data['slug'] = Str::slug($data['name']);
            $data['totalStudent'] = 0;
            $data['rating'] = 0;
            $data['totalRating'] = 0;

            // Xử lý thumbnail nếu có
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/courses'), $filename);
                $data['thumbnail'] = 'uploads/courses/' . $filename;
            }

            // Tạo khóa học mới
            $course = Course::create($data);

            if (!$course) {
                throw new \Exception('Không thể tạo khóa học');
            }

            DB::commit();
            return redirect()->route('admin.courses.index')
                ->with('success', 'Thêm khóa học thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $course = $this->model::find($id);
            if (!$course) {
                return redirect()->back()->with('error', 'Không tìm thấy khóa học');
            }

            $rules = [
                'name' => 'required|string|max:255',
                'categoryId' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'salePrice' => 'nullable|numeric|min:0',
                'description' => 'required|string',
                'sortDescription' => 'nullable|string',
                'thumbnail' => 'nullable|image|max:2048',
            ];

            $messages = [
                'name.required' => 'Tên khóa học không được để trống',
                'categoryId.required' => 'Danh mục không được để trống',
                'categoryId.exists' => 'Danh mục không tồn tại',
                'price.required' => 'Giá không được để trống',
                'price.numeric' => 'Giá phải là số',
                'price.min' => 'Giá phải lớn hơn 0',
                'salePrice.numeric' => 'Giá khuyến mãi phải là số',
                'salePrice.min' => 'Giá khuyến mãi phải lớn hơn 0',
                'description.required' => 'Mô tả không được để trống',
                'thumbnail.image' => 'File phải là ảnh',
                'thumbnail.max' => 'Kích thước ảnh tối đa là 2MB'
            ];

            $data = $request->validate($rules, $messages);

            // Xử lý thumbnail nếu có file mới upload
            if ($request->hasFile('thumbnail')) {
                // Xóa ảnh cũ nếu có
                if ($course->thumbnail && file_exists(public_path($course->thumbnail))) {
                    unlink(public_path($course->thumbnail));
                }

                $file = $request->file('thumbnail');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/courses'), $filename);
                $data['thumbnail'] = 'uploads/courses/' . $filename;
            } else {
                // Nếu không có file mới, giữ lại thumbnail cũ
                unset($data['thumbnail']); // Loại bỏ thumbnail khỏi data nếu không có file mới
            }

            // Cập nhật dữ liệu
            $course->update([
                'name' => $data['name'],
                'categoryId' => $data['categoryId'],
                'price' => $data['price'],
                'salePrice' => $data['salePrice'],
                'sortDescription' => $data['sortDescription'],
                'description' => $data['description'],
                'slug' => Str::slug($data['name']),
                // Chỉ cập nhật thumbnail nếu có file mới
                'thumbnail' => isset($data['thumbnail']) ? $data['thumbnail'] : $course->thumbnail,
            ]);

            DB::commit();
            return redirect()->route('admin.courses.index')
                ->with('success', 'Cập nhật khóa học thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $model = $this->model::query()->find($id);
        if (!$model) {
            return redirect()->back()->with('error', 'Không tìm thấy dữ liệu');
        }

        $result = $this->deleteItem($model, $id);

        if (request()->wantsJson()) {
            return response()->json($result);
        }

        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }

    public function restore($id)
    {
        $result = $this->restoreItem($this->model::withTrashed()->find($id));

        if (request()->wantsJson()) {
            return response()->json($result);
        }

        return redirect()->back()->with($result['status'] ? 'success' : 'error', $result['message']);
    }

    public function show($id)
    {
        try {
            $course = Course::with(['category', 'ratings'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => [
                    'id' => $course->id,
                    'name' => $course->name,
                    'slug' => $course->slug,
                    'category' => $course->category,
                    'price' => $course->price,
                    'salePrice' => $course->salePrice,
                    'description' => $course->description,
                    'sortDescription' => $course->sortDescription,
                    'thumbnail' => $course->thumbnail,
                    'releaseTime' => $course->releaseTime,
                    'totalStudent' => $course->totalStudent,
                    'rating' => $course->ratings->avg('rating'),
                    'totalRating' => $course->ratings->count(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy khóa học'
            ], 404);
        }
    }
}
