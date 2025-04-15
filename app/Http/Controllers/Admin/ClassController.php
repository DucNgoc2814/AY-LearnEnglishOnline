<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\ClassServiceInterface;
use App\Http\Requests\Admin\Class\StoreRequest;
use App\Http\Requests\Admin\Class\UpdateRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý lớp học
 */
class ClassController extends BaseController
{
    protected $classService;
    const VIEW_PATH = 'admin.components.classes.';

    public function __construct(ClassServiceInterface $classService)
    {
        $this->classService = $classService;
    }

    /**
     * Hiển thị danh sách lớp học
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->classService->getList();
            $trashList = $this->classService->getTrashList();

            // Lấy danh sách giáo viên đang hoạt động
            $teachers = Employee::query()
                ->select('id', 'employee_code', 'name', 'position', 'department')
                ->activeTeachers()
                ->orderBy('name')
                ->get();

            // Log để debug
            Log::info('Số lượng giáo viên: ' . $teachers->count());

            return view(self::VIEW_PATH . 'index', [
                'classes' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
                'teachers' => $teachers,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in ClassController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải dữ liệu');
        }
    }

    /**
     * Lưu lớp học mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $result = $this->classService->create($request->validated());
        return $this->redirectResponse($result);
    }

    /**
     * Hiển thị form chỉnh sửa lớp học
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try {
            $result = $this->classService->findById($id);

            // Lấy danh sách giáo viên đang hoạt động
            $teachers = Employee::query()
                ->select('id', 'employee_code', 'name', 'position', 'department')
                ->activeTeachers()
                ->orderBy('name')
                ->get();

            return view(self::VIEW_PATH . 'edit', array_merge($result, ['teachers' => $teachers]));
        } catch (\Exception $e) {
            Log::error('Error in ClassController@edit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải dữ liệu');
        }
    }

    /**
     * Cập nhật lớp học
     *
     * @param int $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $result = $this->classService->update($request->validated(), $id);
        return $this->redirectResponse($result);
    }

    /**
     * Xóa lớp học
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->classService->delete($id);
        return $this->redirectResponse($result);
    }

    /**
     * Khôi phục lớp học đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->classService->restore($id);
        return $this->redirectResponse($result);
    }
}
