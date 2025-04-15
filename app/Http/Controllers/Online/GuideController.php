<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Display a listing of all student guides.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Logic to get all available guides
        // This is a placeholder - implement actual guides retrieval logic
        $guides = [
            [
                'id' => 1,
                'title' => 'Hướng dẫn sử dụng hệ thống học trực tuyến',
                'description' => 'Cách đăng nhập, truy cập lớp học, và sử dụng các tính năng cơ bản.'
            ],
            [
                'id' => 2,
                'title' => 'Hướng dẫn tham gia lớp trực tuyến',
                'description' => 'Chi tiết về cách tham gia, tương tác trong lớp học trực tuyến.'
            ],
        ];
        
        return view('online.guides.index', compact('guides'));
    }

    /**
     * Display the specified guide.
     *
     * @param  string  $topic
     * @return \Illuminate\View\View
     */
    public function show($topic)
    {
        // Logic to get specific guide by topic
        // This is a placeholder - implement actual guide retrieval logic
        $guide = null; // Replace with actual guide retrieval
        
        return view('online.guides.show', compact('guide'));
    }
} 