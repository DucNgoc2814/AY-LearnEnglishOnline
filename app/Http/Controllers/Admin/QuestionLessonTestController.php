<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\QuestionLessonTest\StoreRequest;
use App\Http\Requests\Admin\QuestionLessonTest\UpdateRequest;
use App\Services\Interfaces\QuestionLessonTestServiceInterface;
use App\Services\Interfaces\AnswerLessonTestServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý câu hỏi bài kiểm tra
 */
class QuestionLessonTestController extends BaseController
{
    protected $questionLessonTestService;
    protected $answerLessonTestService;
    protected const VIEW_PATH = 'admin.components.question-lesson-tests.';

    public function __construct(QuestionLessonTestServiceInterface $questionLessonTestService, AnswerLessonTestServiceInterface $answerLessonTestService)
    {
        $this->questionLessonTestService = $questionLessonTestService;
        $this->answerLessonTestService = $answerLessonTestService;
    }

    /**
     * Hiển thị danh sách câu hỏi bài kiểm tra
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->questionLessonTestService->getList();
            $trashList = $this->questionLessonTestService->getTrashList();

            return view(self::VIEW_PATH . 'index', [
                'questionLessonTests' => $list['data'],
                'pagination' => $list['pagination'],
                'trashListQuestionLessonTest' => $trashList['data'],
                'trashPaginationQuestionLessonTest' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu câu hỏi bài kiểm tra mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            // Xử lý media file nếu có
            if ($request->hasFile('mediaUrl')) {
                $file = $request->file('mediaUrl');
                $fileExtension = strtolower($file->getClientOriginalExtension());

                // Xác định loại file và xử lý tương ứng
                if (in_array($fileExtension, ['mp4', 'mov', 'avi', 'wmv'])) {
                    $mediaPath = $this->handleVideo($file, 'question-tests/videos');
                    if (!$mediaPath) {
                        throw new \Exception('Failed to upload video file');
                    }
                } elseif (in_array($fileExtension, ['mp3', 'wav', 'ogg'])) {
                    $mediaPath = $this->handleAudio($file, 'question-tests/audios');
                    if (!$mediaPath) {
                        throw new \Exception('Failed to upload audio file');
                    }
                } else {
                    // Xử lý như file ảnh
                    $mediaPath = $this->handleImage($file, 'question-tests/images');
                    if (!$mediaPath) {
                        throw new \Exception('Failed to upload image file');
                    }
                }

                $data['mediaUrl'] = $mediaPath;
            }

            $result = $this->questionLessonTestService->create(data: $data);
            return $this->redirectResponse(result: $result);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Xử lý upload video
     */
    protected function handleVideo($file, $path)
    {
        if ($file && $file->isValid()) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/' . $path), $fileName);
            return $path . '/' . $fileName;
        }
        return false;
    }

    /**
     * Xử lý upload audio
     */
    protected function handleAudio($file, $path)
    {
        if ($file && $file->isValid()) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/' . $path), $fileName);
            return $path . '/' . $fileName;
        }
        return false;
    }

    /**
     * Xử lý upload ảnh
     */
    protected function handleImage($file, $path)
    {
        if ($file && $file->isValid()) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/' . $path), $fileName);
            return $path . '/' . $fileName;
        }
        return false;
    }

    /**
     * Hiển thị chi tiết câu hỏi bài kiểm tra
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->questionLessonTestService->findById($id);
        return response()->json($result);
    }

    /**
     * Cập nhật câu hỏi bài kiểm tra
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->questionLessonTestService->update($id, $request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Xóa câu hỏi bài kiểm tra
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->questionLessonTestService->delete($id);
        return $this->redirectResponse($result);
    }

    /**
     * Khôi phục câu hỏi bài kiểm tra đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->questionLessonTestService->restore($id);
        return $this->redirectResponse($result);
    }
}
