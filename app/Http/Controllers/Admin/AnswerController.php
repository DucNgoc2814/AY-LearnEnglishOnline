<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\AnswerServiceInterface;
use App\Http\Requests\Admin\Answer\StoreRequest;
use App\Http\Requests\Admin\Answer\UpdateRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
     * Lưu câu trả lời mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();

            // Xử lý upload file nếu có
            if ($request->hasFile('url')) {
                $file = $request->file('url');

                Log::info('Processing file upload for answer', [
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]);

                if (!$file->isValid()) {
                    throw new \Exception('Invalid file');
                }

                // Xác định loại file dựa vào MIME type
                $fileType = 'files'; // Mặc định
                $mimeType = $file->getMimeType();

                if (strpos($mimeType, 'image/') === 0) {
                    $fileType = 'images';
                    $maxSize = 5 * 1024 * 1024; // 5MB
                    $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                } elseif (strpos($mimeType, 'video/') === 0) {
                    $fileType = 'videos';
                    $maxSize = 50 * 1024 * 1024; // 50MB
                    $validExtensions = ['mp4', 'mov', 'avi', 'wmv', 'webm'];
                } elseif (strpos($mimeType, 'audio/') === 0) {
                    $fileType = 'sounds';
                    $maxSize = 10 * 1024 * 1024; // 10MB
                    $validExtensions = ['mp3', 'wav', 'ogg', 'm4a'];
                } else {
                    throw new \Exception('Unsupported file type');
                }

                // Kiểm tra kích thước file
                if ($file->getSize() > $maxSize) {
                    throw new \Exception('File size exceeds maximum allowed size');
                }

                // Kiểm tra phần mở rộng file
                $extension = strtolower($file->getClientOriginalExtension());
                if (!in_array($extension, $validExtensions)) {
                    throw new \Exception('File type not allowed. Allowed types: ' . implode(', ', $validExtensions));
                }

                // Upload file
                try {
                    $filePath = $this->answerService->handleFileUpload($file, $fileType);
                    if ($filePath) {
                        $data['url'] = $filePath;
                    } else {
                        throw new \Exception('Failed to upload file');
                    }
                } catch (\Exception $e) {
                    Log::error('File upload error in controller', [
                        'error' => $e->getMessage(),
                        'file_name' => $file->getClientOriginalName()
                    ]);
                    throw new \Exception('Error uploading file: ' . $e->getMessage());
                }
            }

            // Tạo câu trả lời
            $result = $this->answerService->create($data);

            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tạo mới thành công',
                    'data' => $result
                ]);
            }

            return redirect()->route('admin.answers.index')->with('success', 'Tạo mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Answer creation error:', [
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
     * Hiển thị form chỉnh sửa câu trả lời
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try {
            $result = $this->answerService->findById($id);

            // Nếu có URL, thêm URL đầy đủ
            if (isset($result['data']) && isset($result['data']->url)) {
                $result['data']->full_url = $this->answerService->getFullUrl($result['data']->url);
            }

            if ($this->isAjaxRequest()) {
                return response()->json($result);
            }

            return $this->viewResponse(self::VIEW_PATH . 'edit', $result);
        } catch (\Exception $e) {
            Log::error('Answer edit error:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            if ($this->isAjaxRequest()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật câu trả lời
     *
     * @param int $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();

            // Lấy thông tin câu trả lời hiện tại
            $answer = $this->answerService->findById($id);
            if (!$answer) {
                throw new \Exception('Không tìm thấy câu trả lời');
            }

            Log::info('Answer update request detail:', [
                'id' => $id,
                'all_files' => $request->allFiles(),
                'has_url' => $request->hasFile('url'),
                'remove_url' => $request->has('remove_url'),
            ]);

            // Xử lý xóa file
            if ($request->has('remove_url') && $request->input('remove_url') == '1') {
                // Xóa file hiện tại nếu có
                if (!empty($answer['data']->url)) {
                    $this->answerService->deleteFile($answer['data']->url);
                }
                $data['url'] = null; // Đánh dấu xóa url
                Log::info('Removing url file');
            }
            // Xử lý upload file mới
            else if ($request->hasFile('url')) {
                $file = $request->file('url');

                // Xác định loại file dựa vào MIME type
                $fileType = 'files'; // Mặc định
                $mimeType = $file->getMimeType();

                if (strpos($mimeType, 'image/') === 0) {
                    $fileType = 'images';
                } elseif (strpos($mimeType, 'video/') === 0) {
                    $fileType = 'videos';
                } elseif (strpos($mimeType, 'audio/') === 0) {
                    $fileType = 'sounds';
                }

                // Upload file
                $filePath = $this->answerService->handleFileUpload($file, $fileType);

                if ($filePath) {
                    // Xóa file cũ nếu có
                    if (!empty($answer['data']->url)) {
                        $this->answerService->deleteFile($answer['data']->url);
                    }
                    $data['url'] = $filePath;
                }
            }

            // Gọi service để cập nhật
            $result = $this->answerService->update($data, $id);

            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật thành công',
                    'data' => $result
                ]);
            }

            return redirect()->route('admin.answers.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Answer update error:', [
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
     * Xóa câu trả lời
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
     * Khôi phục câu trả lời đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->answerService->restore($id);
        return $this->redirectResponse($result);
    }

    /**
     * Kiểm tra xem request có phải là Ajax hay không
     *
     * @return bool
     */
    protected function isAjaxRequest()
    {
        return request()->ajax() || request()->wantsJson();
    }
}
