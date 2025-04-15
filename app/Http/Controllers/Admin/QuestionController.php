<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\QuestionServiceInterface;
use App\Services\Interfaces\AnswerServiceInterface;
use App\Http\Requests\Admin\Question\StoreRequest;
use App\Http\Requests\Admin\Question\UpdateRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý câu hỏi
 */
class QuestionController extends BaseController
{
    protected $questionService;
    protected $answerService;
    protected const VIEW_PATH = 'admin.components.questions.';

    public function __construct(
        QuestionServiceInterface $questionService,
        AnswerServiceInterface $answerService
    ) {
        $this->questionService = $questionService;
        $this->answerService = $answerService;
    }

    /**
     * Hiển thị danh sách câu hỏi
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->questionService->getList();
            $trashList = $this->questionService->getTrashList();

            return view(self::VIEW_PATH . 'index', [
                'questions' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu câu hỏi mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();

            // Xử lý file media dựa vào loại câu hỏi
            if ($request->hasFile('media_file')) {
                $mediaFile = $request->file('media_file');
                $type = $request->input('type');

                Log::info('Processing media file upload', [
                    'type' => $type,
                    'file_name' => $mediaFile->getClientOriginalName(),
                    'file_size' => $mediaFile->getSize(),
                    'mime_type' => $mediaFile->getMimeType()
                ]);

                // Kiểm tra file có hợp lệ không
                if (!$mediaFile->isValid()) {
                    throw new \Exception('Invalid media file');
                }

                // Xử lý kiểm tra định dạng file
                $mediaType = '';
                switch ($type) {
                    case 'image':
                        $mediaType = 'images';
                        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                        $maxSize = 5 * 1024 * 1024; // 5MB
                        break;
                    case 'video':
                        $mediaType = 'videos';
                        $validExtensions = ['mp4', 'mov', 'avi', 'wmv', 'webm'];
                        $maxSize = 50 * 1024 * 1024; // 50MB
                        break;
                    case 'audio':
                        $mediaType = 'sounds';
                        $validExtensions = ['mp3', 'wav', 'ogg', 'm4a'];
                        $maxSize = 10 * 1024 * 1024; // 10MB
                        break;
                    default:
                        throw new \Exception('Unsupported media type');
                }

                // Kiểm tra kích thước file
                if ($mediaFile->getSize() > $maxSize) {
                    throw new \Exception('File size exceeds maximum allowed size');
                }

                // Kiểm tra phần mở rộng file
                $extension = strtolower($mediaFile->getClientOriginalExtension());
                if (!in_array($extension, $validExtensions)) {
                    throw new \Exception('File type not allowed. Allowed types: ' . implode(', ', $validExtensions));
                }

                // Upload file
                try {
                    $mediaUrl = $this->questionService->handleMediaUpload($mediaFile, $mediaType);
                    if ($mediaUrl) {
                        $data['media_url'] = $mediaUrl;
                    } else {
                        throw new \Exception('Failed to upload media file');
                    }
                } catch (\Exception $e) {
                    Log::error('Media upload error in controller', [
                        'error' => $e->getMessage(),
                        'type' => $type,
                        'file_name' => $mediaFile->getClientOriginalName()
                    ]);
                    throw new \Exception('Error uploading media: ' . $e->getMessage());
                }
            }

            // Tạo câu hỏi
            $question = $this->questionService->create($data);

            // Kiểm tra xem $question có phải là mảng không
            if (is_array($question) && isset($question['data'])) {
                $question = $question['data'];
            }

            // Xử lý câu trả lời
            if ($request->has('answers')) {
                $answers = $request->input('answers');
                $answerType = $request->input('answer_type', 'single');

                // Nếu là single choice, chỉ cho phép một đáp án đúng
                if ($answerType === 'single' && $request->has('correct_answer')) {
                    $correctAnswerIndex = $request->input('correct_answer');
                    foreach ($answers as $index => &$answer) {
                        $answer['is_correct'] = ($index == $correctAnswerIndex);
                    }
                }

                // Lưu các câu trả lời
                foreach ($answers as $answer) {
                    $answer['question_id'] = $question->id;
                    $answer['type'] = $answerType;
                    $this->answerService->create($answer);
                }
            }

            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tạo mới thành công',
                    'data' => $question
                ]);
            }

            return redirect()->route('admin.questions.index')->with('success', 'Tạo mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Question creation error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->back()->withErrors(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Hiển thị chi tiết câu hỏi
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->questionService->findById($id);
        return response()->json($result);
    }

    /**
     * Cập nhật câu hỏi
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

            // Lấy thông tin câu hỏi hiện tại
            $question = $this->questionService->findById($id);
            if (!$question) {
                throw new \Exception('Không tìm thấy câu hỏi');
            }

            // Log thông tin chi tiết về request
            Log::info('Question update request detail:', [
                'id' => $id,
                'all_files' => $request->allFiles(),
                'has_media_file' => $request->hasFile('media_file'),
                'remove_media' => $request->has('remove_media'),
                'question_type' => $data['type']
            ]);

            // Xử lý xóa media
            if ($request->has('remove_media') && $request->input('remove_media') == '1') {
                $data['media_url'] = null; // Đánh dấu xóa media
                Log::info('Marking media for removal');
            }
            // Xử lý upload media mới
            else if ($request->hasFile('media_file')) {
                $mediaFile = $request->file('media_file');
                $type = $data['type']; // Sử dụng loại câu hỏi từ dữ liệu đã validate

                // Xử lý file theo loại
                switch ($type) {
                    case 'image':
                        $mediaUrl = $this->questionService->handleMediaUpload($mediaFile, 'images');
                        break;
                    case 'video':
                        $mediaUrl = $this->questionService->handleMediaUpload($mediaFile, 'videos');
                        break;
                    case 'audio':
                        $mediaUrl = $this->questionService->handleMediaUpload($mediaFile, 'sounds');
                        break;
                    default:
                        $mediaUrl = null;
                }

                if ($mediaUrl) {
                    // Xóa file cũ nếu có
                    if (!empty($question->media_url)) {
                        $this->questionService->deleteMedia($question->media_url);
                    }
                    $data['media_url'] = $mediaUrl;
                }
            }

            // Gọi service để cập nhật
            $result = $this->questionService->update($data, $id);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật thành công',
                    'data' => $result
                ]);
            }

            return redirect()->route('admin.questions.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Question update error:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->back()->withErrors(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Xóa câu hỏi
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->questionService->delete($id);
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
        $result = $this->questionService->restore($id);
        return $this->redirectResponse($result);
    }

    /**
     * Lấy thông tin câu hỏi để chỉnh sửa
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        try {
            $question = $this->questionService->findWithFullUrls($id);

            Log::info('Question edit data:', [
                'question_id' => $id,
                'has_answers' => $question->answers->count(),
                'media_url' => $question->media_url,
                'full_media_url' => $question->full_media_url ?? null
            ]);

            return response()->json([
                'status' => true,
                'data' => $question
            ]);
        } catch (\Exception $e) {
            Log::error('Question edit error:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lấy danh sách câu trả lời của một câu hỏi
     *
     * @param int $questionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAnswersByQuestion($questionId)
    {
        try {
            $result = $this->questionService->getAnswersByQuestion($questionId);
            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('Error in QuestionController getAnswersByQuestion: ' . $e->getMessage(), [
                'question_id' => $questionId,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách câu trả lời'
            ], 500);
        }
    }
}
