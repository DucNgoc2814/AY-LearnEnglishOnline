<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Employee;

class DashboardController extends BaseController
{
    public function index()
    {
        $totalUsers = User::count();
        $totalEmployees = Employee::count();
        $totalCourses = Course::count();
        $totalLessons = Lesson::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('amount');
        
        $recentOrders = Order::with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $topCourses = Course::withCount(['enrollments', 'ratings'])
            ->orderBy('enrollments_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalEmployees',
            'totalCourses',
            'totalLessons',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'topCourses'
        ));
    }
} 