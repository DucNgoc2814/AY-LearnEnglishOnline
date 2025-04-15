<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // Mô phỏng dữ liệu tin tức (sau này sẽ lấy từ database)
        $news = [
            [
                'id' => 1,
                'title' => 'Thông báo lịch thi cuối kỳ Spring 2024',
                'category' => 'Thông báo',
                'summary' => 'Phòng Đào tạo thông báo lịch thi cuối kỳ Spring 2024 cho sinh viên...',
                'content' => 'Nội dung chi tiết về lịch thi...',
                'image' => 'news/exam-schedule.jpg',
                'created_at' => '2024-03-15',
                'is_important' => true
            ],
            [
                'id' => 2,
                'title' => 'Hướng dẫn đăng ký học phần Fall 2024',
                'category' => 'Hướng dẫn',
                'summary' => 'Hướng dẫn chi tiết quy trình đăng ký học phần trực tuyến...',
                'content' => 'Nội dung chi tiết về quy trình đăng ký...',
                'image' => 'news/registration-guide.jpg',
                'created_at' => '2024-03-14',
                'is_important' => true
            ],
            [
                'id' => 3,
                'title' => 'Thông báo nghỉ lễ 30/4 và 1/5',
                'category' => 'Thông báo',
                'summary' => 'Thông báo về lịch nghỉ lễ 30/4 và 1/5 năm 2024...',
                'content' => 'Nội dung chi tiết về lịch nghỉ lễ...',
                'image' => 'news/holiday-notice.jpg',
                'created_at' => '2024-03-13',
                'is_important' => false
            ],
            [
                'id' => 4,
                'title' => 'Cuộc thi Ý tưởng Sáng tạo 2024',
                'category' => 'Sự kiện',
                'summary' => 'Thông tin về cuộc thi Ý tưởng Sáng tạo dành cho sinh viên...',
                'content' => 'Nội dung chi tiết về cuộc thi...',
                'image' => 'news/innovation-contest.jpg',
                'created_at' => '2024-03-12',
                'is_important' => false
            ],
            [
                'id' => 5,
                'title' => 'Chương trình trao đổi sinh viên 2024',
                'category' => 'Học tập',
                'summary' => 'Thông tin về chương trình trao đổi sinh viên với các trường đối tác...',
                'content' => 'Nội dung chi tiết về chương trình trao đổi...',
                'image' => 'news/exchange-program.jpg',
                'created_at' => '2024-03-11',
                'is_important' => false
            ]
        ];

        return view('online.news.index', compact('news'));
    }

    public function show($id)
    {
        // Mô phỏng lấy tin tức theo ID (sau này sẽ lấy từ database)
        $news = [
            'id' => $id,
            'title' => 'Thông báo lịch thi cuối kỳ Spring 2024',
            'category' => 'Thông báo',
            'content' => '<p>Phòng Đào tạo thông báo lịch thi cuối kỳ Spring 2024 cho sinh viên. Chi tiết như sau:</p>
                         <h4>1. Thời gian thi</h4>
                         <p>- Thời gian: Từ ngày 15/05/2024 đến 30/05/2024</p>
                         <p>- Các môn thi được bố trí trong khung giờ:</p>
                         <ul>
                             <li>Ca 1: 7:30 - 9:30</li>
                             <li>Ca 2: 9:45 - 11:45</li>
                             <li>Ca 3: 13:30 - 15:30</li>
                             <li>Ca 4: 15:45 - 17:45</li>
                         </ul>
                         <h4>2. Quy định dự thi</h4>
                         <p>- Sinh viên phải có mặt tại phòng thi trước giờ thi 15 phút</p>
                         <p>- Mang theo thẻ sinh viên hoặc CMND/CCCD</p>
                         <p>- Tuân thủ nghiêm túc quy chế thi</p>',
            'image' => 'news/exam-schedule.jpg',
            'created_at' => '2024-03-15',
            'author' => 'Phòng Đào tạo',
            'is_important' => true
        ];

        return view('online.news.show', compact('news'));
    }
} 