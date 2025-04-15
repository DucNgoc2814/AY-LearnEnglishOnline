<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\AnswerServiceInterface;
use App\Http\Requests\Admin\Answer\StoreRequest;
use App\Http\Requests\Admin\Answer\UpdateRequest;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý câu trả lời
 */
class AnswerController extends BaseController
{
    protected $answerService;
    const VIEW_PATH = 'admin.components.answers.';

    public function __construct(AnswerServiceInterface $answerService)
    {
        $this->answerService = $answerService;
    }

    /**
     * Hiển thị danh sách danh mục
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->answerService->getList();
            $trashList = $this->answerService->getTrashList();
            return view(self::VIEW_PATH . 'index', [
                'answers' => $list['data'],
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
        $result = $this->answerService->create($request->validated());
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
        $result = $this->answerService->findById($id);
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
        $result = $this->answerService->update($request->validated(), $id);
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
        $result = $this->answerService->delete($id);
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
        $result = $this->answerService->restore($id);
        return $this->redirectResponse($result);
    }
}
