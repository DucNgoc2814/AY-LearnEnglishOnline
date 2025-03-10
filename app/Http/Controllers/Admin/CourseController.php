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
        $result = $this->courseService->update($id, $request->validated());
        return $this->redirectResponse($result);
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

        if ($result['status']) {
            return redirect()->route('admin.courses.index')
                           ->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Khôi phục khóa học đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->courseService->restore($id);

        if ($result['status']) {
            return redirect()->route('admin.courses.index')
                           ->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }
}
