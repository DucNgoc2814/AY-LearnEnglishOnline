<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\CourseServiceInterface;
use App\Http\Requests\Admin\Course\StoreRequest;
use App\Http\Requests\Admin\Course\UpdateRequest;

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
        // dd([
        //     'validated_data' => $request->validated(),
        //     'files' => $request->allFiles()
        // ]);

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
            \Log::info('Course update request:', [
                'id' => $id,
                'validated_data' => $request->validated(),
                'has_files' => [
                    'thumbnail' => $request->hasFile('thumbnail'),
                    'preview_video' => $request->hasFile('preview_video')
                ],
                'files' => [
                    'thumbnail' => $request->file('thumbnail'),
                    'preview_video' => $request->file('preview_video')
                ]
            ]);

            $result = $this->courseService->update($id, $request->validated());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật thành công',
                    'data' => $result
                ]);
            }

            return redirect()->route('admin.courses.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            \Log::error('Course update error:', [
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

    public function edit($id)
    {
        $course = $this->courseService->findWithFullUrls($id);
        return response()->json([
            'status' => true,
            'data' => $course
        ]);
    }
}
