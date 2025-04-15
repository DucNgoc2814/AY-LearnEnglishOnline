<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PracticeTestController extends Controller
{
    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập bằng JWT chưa
        try {
            if (!session('jwt_token') || !JWTAuth::setToken(session('jwt_token'))->authenticate()) {
                // Lưu URL hiện tại vào session để sau khi đăng nhập sẽ redirect lại
                session()->put('url.intended', route('practice-tests.index'));
                return redirect()->route('login')->with('message', 'Vui lòng đăng nhập để truy cập các bài thi thử.');
            }
        } catch (\Exception $e) {
            session()->put('url.intended', route('practice-tests.index'));
            return redirect()->route('login')->with('message', 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
        }

        // Logic để lấy danh sách các bài thi thử
        $practiceTests = []; // TODO: Thêm logic lấy bài thi thử từ database
        return view('client.practice-tests.index', compact('practiceTests'));
    }
} 