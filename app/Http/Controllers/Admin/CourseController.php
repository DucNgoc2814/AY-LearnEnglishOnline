<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\CourseServiceInterface;
use App\Http\Requests\Admin\Course\StoreRequest;
use App\Http\Requests\Admin\Course\UpdateRequest;
use Illuminate\Support\Facades\Log;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý khóa học
 */
class CourseController extends BaseController
{
    protected $courseService;
    protected const VIEW_PATH = 'admin.components.courses.';

    public function __construct(CourseServiceInterface $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Hiển thị danh sách khóa học
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->courseService->getList();
            $trashList = $this->courseService->getTrashList();

            return view(self::VIEW_PATH . 'index', [
                'courses' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu khóa học mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {

        $result = $this->courseService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị chi tiết khóa học
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->courseService->findById($id);
        return response()->json($result);
    }

    /**
     * Cập nhật khóa học
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            // Lấy tất cả dữ liệu đã validate
            $data = $request->validated();

            // Log thông tin chi tiết về request
            Log::info('Course update request detail:', [
                'id' => $id,
                'all_files' => $request->allFiles(),
                'has_thumbnail' => $request->hasFile('thumbnail'),
                'has_preview_video' => $request->hasFile('preview_video'),
                'remove_thumbnail' => $request->has('remove_thumbnail'),
                'remove_preview_video' => $request->has('remove_preview_video')
            ]);

            // Xử lý flag xóa ảnh
            if ($request->has('remove_thumbnail') && $request->input('remove_thumbnail') == '1') {
                $data['thumbnail'] = null; // Đánh dấu xóa ảnh
                Log::info('Marking thumbnail for removal');
            }

            // Xử lý flag xóa video
            if ($request->has('remove_preview_video') && $request->input('remove_preview_video') == '1') {
                $data['preview_video'] = null; // Đánh dấu xóa video
                Log::info('Marking video for removal');
            }

            // Gọi service để cập nhật
            $result = $this->courseService->update($data, $id);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật thành công',
                    'data' => $result
                ]);
            }

            return redirect()->route('admin.courses.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Course update error:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->back()->withErrors(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Xóa khóa học
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->courseService->delete($id);
        return $this->redirectResponse($result);
    }

    /**
     * Khôi phục danh mục đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->courseService->restore($id);
        return $this->redirectResponse($result);
    }

    /**
     * Lấy thông tin khóa học để chỉnh sửa
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $course = $this->courseService->findWithFullUrls($id);
        return response()->json([
            'status' => true,
            'data' => $course
        ]);
    }
}
