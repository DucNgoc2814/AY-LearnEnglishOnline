<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\AnswerLessonTestServiceInterface;
use App\Http\Requests\Admin\AnswerLessonTest\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý danh mục
 */
class AnswerLessonTestController extends BaseController
{
    protected $answerLessonTestService;
    const VIEW_PATH = 'admin.components.answer-lesson-tests.';

    public function __construct(AnswerLessonTestServiceInterface $answerLessonTestService)
    {
        $this->answerLessonTestService = $answerLessonTestService;
    }

    /**
     * Hiển thị danh sách danh mục
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->answerLessonTestService->getList();
            $trashList = $this->answerLessonTestService->getTrashList();
            return view(self::VIEW_PATH . 'index', [
                'answerLessonTests' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu danh mục mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $result = $this->answerLessonTestService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị form chỉnh sửa danh mục
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $result = $this->answerLessonTestService->findById($id);
        return $this->viewResponse(self::VIEW_PATH . 'edit', $result);
    }

    /**
     * Cập nhật danh mục
     *
     * @param int $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->answerLessonTestService->update($request->validated(), $id);
        return $this->redirectResponse($result);
    }

    /**
     * Xóa danh mục
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($id)
    {
        $result = $this->answerLessonTestService->delete($id);
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
        $result = $this->answerLessonTestService->restore($id);
        return $this->redirectResponse($result);
    }
}
