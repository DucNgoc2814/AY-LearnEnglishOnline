<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\TestServiceInterface;
use App\Http\Requests\Admin\Test\StoreRequest;
use App\Http\Requests\Admin\Test\UpdateRequest;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý bài test
 */
class TestController extends BaseController
{
    protected $testService;
    const VIEW_PATH = 'admin.components.tests.';

    public function __construct(TestServiceInterface $testService)
    {
        $this->testService = $testService;
    }

    /**
     * Hiển thị danh sách bài test
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->testService->getList();
            $trashList = $this->testService->getTrashList();
            return view(self::VIEW_PATH . 'index', [
                'tests' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu bài test mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $result = $this->testService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị form chỉnh sửa bài test
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $result = $this->testService->findById($id);
        return $this->viewResponse(self::VIEW_PATH . 'edit', $result);
    }

    /**
     * Cập nhật bài test
     *
     * @param int $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->testService->update($request->validated(), $id);
        return $this->redirectResponse($result);
    }

    /**
     * Xóa bài test
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($id)
    {
        $result = $this->testService->delete($id);
        return $this->redirectResponse($result);
    }

    /**
     * Khôi phục bài test đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->testService->restore($id);
        return $this->redirectResponse($result);
    }

    /**
     * Lấy danh sách câu hỏi của bài test
     *
     * @param int $testId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuestionsByTest($testId)
    {
        $result = $this->testService->getQuestionsByTest($testId);
        return response()->json($result);
    }
}
