<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\LessonServiceInterface;
use App\Http\Requests\Admin\Lesson\StoreRequest;
use App\Http\Requests\Admin\Lesson\UpdateRequest;
use App\Services\Interfaces\CourseServiceInterface;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý bài học
 */
class LessonController extends BaseController
{
    protected $lessonService;
    protected const VIEW_PATH = 'admin.components.lessons.';

    public function __construct(LessonServiceInterface $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Hiển thị danh sách bài học
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $params = [];
            $courseId = $request->route('courseId') ?? $request->query('courseId');

            if ($courseId) {
                $params['courseId'] = $courseId;
            }

            $list = $this->lessonService->getList($params);
            $trashList = $this->lessonService->getTrashList();

            // Lấy thông tin khóa học nếu có courseId
            $course = null;
            if ($courseId) {
                $courseService = app(CourseServiceInterface::class);
                $courseResult = $courseService->findById($courseId);
                $course = $courseResult['status'] ? $courseResult['data'] : null;
            }

            return view(self::VIEW_PATH . 'index', [
                'lessons' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
                'course' => $course
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu bài học mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $result = $this->lessonService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị chi tiết bài học
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->lessonService->findById($id);
        return response()->json($result);
    }

    /**
     * Cập nhật bài học
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->lessonService->update($id, $request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Xóa bài học
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->lessonService->delete($id);

        if ($result['status']) {
            return redirect()->route('admin.lessons.index')
                           ->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Khôi phục bài học đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->lessonService->restore($id);

        if ($result['status']) {
            return redirect()->route('admin.lessons.index')
                           ->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }
}
