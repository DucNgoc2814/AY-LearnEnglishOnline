<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PracticeTestController extends Controller
{
    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            // Lưu URL hiện tại vào session để sau khi đăng nhập sẽ redirect lại
            session()->put('url.intended', route('practice-tests.index'));
            return redirect()->route('login')->with('message', 'Vui lòng đăng nhập để truy cập các bài thi thử.');
        }

        // Logic để lấy danh sách các bài thi thử
        $practiceTests = []; // TODO: Thêm logic lấy bài thi thử từ database
        
        return view('client.practice-tests.index', compact('practiceTests'));
    }
} 