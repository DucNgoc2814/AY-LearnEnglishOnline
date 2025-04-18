<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\Interfaces\BannerServiceInterface;
use App\Http\Requests\Admin\Banner\StoreRequest;
use App\Http\Requests\Admin\Banner\UpdateRequest;
use Illuminate\Support\Facades\Log;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý banner
 */
class BannerController extends BaseController
{
    protected $bannerService;
    protected const VIEW_PATH = 'admin.components.banners.';

    public function __construct(BannerServiceInterface $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    /**
     * Hiển thị danh sách banner
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->bannerService->getList();
            $trashList = $this->bannerService->getTrashList();

            return view(self::VIEW_PATH . 'index', [
                'banners' => $list['data'],
                'pagination' => $list['pagination'],
                'trashList' => $trashList['data'],
                'trashPagination' => $trashList['pagination'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Lưu banner mới
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            Log::info('Banner store request:', [
                'data' => $request->validated(),
                'files' => $request->allFiles()
            ]);

            $result = $this->bannerService->create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Thêm banner thành công',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('Banner store error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra khi thêm banner: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hiển thị chi tiết banner
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->bannerService->findById($id);
        return response()->json($result);
    }

    /**
     * Cập nhật banner
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();

            Log::info('Banner update request detail:', [
                'id' => $id,
                'all_files' => $request->allFiles(),
                'has_image' => $request->hasFile('image'),
                'remove_image' => $request->has('remove_image')
            ]);

            if ($request->has('remove_image') && $request->input('remove_image') == '1') {
                $data['image_url'] = null;
                Log::info('Marking image for removal');
            }

            $result = $this->bannerService->update($data, $id);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật thành công',
                    'data' => $result
                ]);
            }

            return redirect()->route('admin.banners.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Log::error('Banner update error:', [
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
     * Xóa banner
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->bannerService->delete($id);
        return $this->redirectResponse($result);
    }

    /**
     * Khôi phục banner đã xóa
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = $this->bannerService->restore($id);
        return $this->redirectResponse($result);
    }

    /**
     * Lấy thông tin banner để chỉnh sửa
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $banner = $this->bannerService->findWithFullUrls($id);
        return response()->json([
            'status' => true,
            'data' => $banner
        ]);
    }
}
