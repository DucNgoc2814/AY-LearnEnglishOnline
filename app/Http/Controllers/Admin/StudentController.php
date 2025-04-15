<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\StudentServiceInterface;
use App\Http\Requests\Admin\Student\StoreRequest;
use App\Http\Requests\Admin\Student\UpdateRequest;
use Illuminate\Support\Facades\Log;
use App\Models\User;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý khóa học
 */
class StudentController extends BaseController
{
    protected $studentService;
    protected const VIEW_PATH = 'admin.components.students.';

    public function __construct(StudentServiceInterface $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Hiển thị danh sách khóa học
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->studentService->getList();
            $trashList = $this->studentService->getTrashList();
            $users = User::whereDoesntHave('student')->get(); // Lấy danh sách user chưa là học viên

            return view(self::VIEW_PATH . 'index', [
                'students' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
                'users' => $users,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu khóa học mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {

        $result = $this->studentService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị chi tiết khóa học
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->studentService->findById($id);
        return response()->json($result);
    }

    /**
     * Cập nhật khóa học
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

            // Xử lý flag xóa ảnh
            if ($request->has('remove_thumbnail') && $request->input('remove_thumbnail') == '1') {
                $data['thumbnail'] = null; // Đánh dấu xóa ảnh
                Log::info('Marking thumbnail for removal');
            }

            // Gọi service để cập nhật
            $result = $this->studentService->update($data, $id);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật thành công',
                    'data' => $result
                ]);
            }

            return redirect()->route('admin.courses.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Course update error:', [
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
     * Xóa khóa học
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->studentService->delete($id);
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
        $result = $this->studentService->restore($id);
        return $this->redirectResponse($result);
    }

    /**
     * Lấy thông tin khóa học để chỉnh sửa
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $student = $this->studentService->findWithFullUrls($id);
        return response()->json([
            'status' => true,
            'data' => $student
        ]);
    }
}
