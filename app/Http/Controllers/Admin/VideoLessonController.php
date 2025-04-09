<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\VideoLessonServiceInterface;
use App\Http\Requests\Admin\VideoLesson\StoreRequest;
use App\Http\Requests\Admin\VideoLesson\UpdateRequest;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý bài học video
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
     * Hiển thị danh sách bài học video
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
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu bài học video mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            \Illuminate\Support\Facades\Log::info('VideoLesson store request:', [
                'validated_data' => $request->validated(),
                'files' => [
                    'has_thumbnail' => $request->hasFile('thumbnail_url'),
                    'has_video' => $request->hasFile('video_url'),
                    'thumbnail' => $request->file('thumbnail_url'),
                    'video' => $request->file('video_url'),
                    'all_files' => $request->allFiles()
                ]
            ]);

            $result = $this->videoLessonService->create($request->validated());
            return $this->redirectResponse($result);
        } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error('VideoLesson store error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Hiển thị chi tiết bài học video
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
     * Cập nhật bài học video
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
            \Illuminate\Support\Facades\Log::info('VideoLesson update request detail:', [
                'id' => $id,
                'all_files' => $request->allFiles(),
                'has_thumbnail' => $request->hasFile('thumbnail_url'),
                'has_video' => $request->hasFile('video_url'),
                'remove_thumbnail' => $request->has('remove_thumbnail_url'),
                'remove_video' => $request->has('remove_video_url')
            ]);

            // Xử lý flag xóa ảnh
            if ($request->has('remove_thumbnail_url') && $request->input('remove_thumbnail_url') == '1') {
                $data['thumbnail_url'] = null; // Đánh dấu xóa ảnh
                \Illuminate\Support\Facades\Log::info('Marking thumbnail for removal');
            }

            // Xử lý flag xóa video
            if ($request->has('remove_video_url') && $request->input('remove_video_url') == '1') {
                $data['video_url'] = null; // Đánh dấu xóa video
                \Illuminate\Support\Facades\Log::info('Marking video for removal');
            }

            // Gọi service để cập nhật
            $result = $this->videoLessonService->update($data, $id);

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('VideoLesson update error:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Xóa bài học video
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
                 * Khôi phục bài học video đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
                public function restore($id)
    {
        $result = $this->videoLessonService->restore($id);
        return $this->redirectResponse($result);
    }

    public function edit($id)
    {
        $videoLesson = $this->videoLessonService->findWithFullUrls($id);
        return response()->json([
            'status' => true,
            'data' => $videoLesson
        ]);
    }

}
