<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\VideoLesson\StoreRequest;
use App\Http\Requests\Admin\VideoLesson\UpdateRequest;
use App\Services\Interfaces\VideoLessonServiceInterface;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý bài giảng video
 */
class VideoLessonController extends BaseController
{
    protected $videoLessonService;
    protected const VIEW_PATH = 'admin.components.video-lessons.';

    public function __construct(VideoLessonServiceInterface $videoLessonService)
    {
        $this->videoLessonService = $videoLessonService;
    }

    /**
     * Hiển thị danh sách bài giảng video
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->videoLessonService->getList();
            $trashList = $this->videoLessonService->getTrashList();

            return view(self::VIEW_PATH . 'index', [
                'videoLessons' => $list['data'],
                'pagination' => $list['pagination'],
                'trashListVideoLesson' => $trashList['data'],
                'trashPaginationVideoLesson' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu bài giảng video mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $result = $this->videoLessonService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị chi tiết bài giảng video
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->videoLessonService->findById($id);
        return response()->json($result);
    }

    /**
     * Cập nhật bài giảng video
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->videoLessonService->update($id, $request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Xóa bài giảng video
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->videoLessonService->delete($id);
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
        $result = $this->videoLessonService->restore($id);
        return $this->redirectResponse($result);
    }

    /**
     * Lấy danh sách video theo bài học
     *
     * @param int $lessonId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVideosByLesson($lessonId)
    {
        $result = $this->videoLessonService->getVideosByLesson($lessonId);
        return response()->json($result);
    }
}
