<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\LessonTestServiceInterface;
use App\Http\Requests\Admin\LessonTest\StoreRequest;
use App\Http\Requests\Admin\LessonTest\UpdateRequest;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý bài kiểm tra
 */
class LessonTestController extends BaseController
{
    protected $lessonTestService;
    protected const VIEW_PATH = 'admin.components.lesson-tests.';

    public function __construct(LessonTestServiceInterface $lessonTestService)
    {
        $this->lessonTestService = $lessonTestService;
    }

    /**
     * Hiển thị danh sách bài kiểm tra
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->lessonTestService->getList();
            $trashList = $this->lessonTestService->getTrashList();

            return view(self::VIEW_PATH . 'index', [
                'lessonTests' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu bài kiểm tra mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $result = $this->lessonTestService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị chi tiết bài kiểm tra
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $result = $this->lessonTestService->findById($id);
        return response()->json($result);
    }

    /**
     * Cập nhật bài kiểm tra
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->lessonTestService->update($request->validated(), $id);
        return $this->redirectResponse($result);
    }

    /**
     * Xóa bài kiểm tra
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->lessonTestService->delete($id);
        return $this->redirectResponse($result);
    }

    /**
     * Khôi phục bài kiểm tra đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->lessonTestService->restore($id);
        return $this->redirectResponse($result);
    }
}
