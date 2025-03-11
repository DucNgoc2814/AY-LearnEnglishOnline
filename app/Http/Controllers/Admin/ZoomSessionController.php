<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\ZoomSessionServiceInterface;
use App\Http\Requests\Admin\ZoomSession\StoreRequest;
use App\Http\Requests\Admin\ZoomSession\UpdateRequest;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý phiên học Zoom
 */
class ZoomSessionController extends BaseController
{
    protected $zoomSessionService;
    const VIEW_PATH = 'admin.components.zoom-sessions.';

    public function __construct(ZoomSessionServiceInterface $zoomSessionService)
    {
        $this->zoomSessionService = $zoomSessionService;
    }

    /**
     * Hiển thị danh sách phiên học Zoom
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->zoomSessionService->getList();
            $trashList = $this->zoomSessionService->getTrashList();
            return view(self::VIEW_PATH . 'index', [
                'zoomSessions' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu phiên học Zoom mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $result = $this->zoomSessionService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị form chỉnh sửa phiên học Zoom
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $result = $this->zoomSessionService->findById($id);
        return $this->viewResponse(self::VIEW_PATH . 'edit', $result);
    }

    /**
     * Cập nhật phiên học Zoom
     *
     * @param int $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->zoomSessionService->update($id, $request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Xóa phiên học Zoom
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->zoomSessionService->delete($id);
        return $this->redirectResponse($result);
    }

    /**
     * Khôi phục phiên học Zoom đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->zoomSessionService->restore($id);
        return $this->redirectResponse($result);
    }
}
