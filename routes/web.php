<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\auth\AuthController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\CourseController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Admin\VideoLessonController;
use App\Http\Controllers\Client\PracticeTestController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\TestResultController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('client.index');
});

Route::get('/trang-chu', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route cho trang thi thử
Route::get('/thi-thu-toeic', [PracticeTestController::class, 'index'])->name('practice-tests.index');

// Đặt tất cả routes auth trong middleware web
Route::middleware('web')->group(function () {
    // Routes cho khách
    Route::middleware(['guest', 'prevent-back-history'])->group(function () {
        Route::get('/dang-ky', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/dang-ky', [AuthController::class, 'register'])->name('register.submit');

        Route::get('/dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login.submit');
    });

    // Route để kiểm tra trạng thái đăng nhập
    Route::get('/check-auth', [AuthController::class, 'checkAuth'])->name('check.auth');
    Route::get('/session-status', [AuthController::class, 'sessionStatus'])->name('session.status');
    Route::get('/schedule-logout', [AuthController::class, 'scheduleLogout'])->name('schedule.logout');
    Route::match(['get', 'post'], '/cancel-logout', [AuthController::class, 'cancelLogout'])->name('cancel.logout');
    Route::get('/debug-schedule', [AuthController::class, 'checkScheduledLogout'])->name('debug.schedule');

    Route::get('/khoa-hoc/{slug}', [CourseController::class, 'detailCourse'])->name('detailCourse');
    Route::get('/danh-muc/{slug?}', [CategoryController::class, 'index'])->name('category.index');

    // Routes cho user đã đăng nhập
    Route::middleware(['jwt', 'prevent-back-history'])->group(function () {
        Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
        Route::get('/thanh-toan', [PaymentController::class, 'showQrPayment'])->name('checkout');
        Route::get('/thanh-toan/{slug}', [PaymentController::class, 'showQrPayment'])->name('payment.qr');
        Route::get('/thanh-toan/expired', [PaymentController::class, 'expired'])->name('payment.expired');

        // Tạo route riêng cho API kiểm tra thanh toán
        Route::post('/thanh-toan/check-expiry', [PaymentController::class, 'checkPaymentExpiry'])
            ->withoutMiddleware(['csrf'])
            ->name('payment.check-expiry');

        Route::group(['prefix' => 'tai-khoan', 'as' => 'profile.'], function () {
            Route::get('/', [AuthController::class, 'profile'])->name('index');
            Route::post('/update', [AuthController::class, 'updateProfile'])->name('update');
        });

        Route::prefix('hoc-khoa-hoc')->group(function () {

            // Route mặc định
            Route::get('/{courseSlug}', [CourseController::class, 'learning'])
                ->name('course.learning');

            // Route cho video
            Route::get('/{courseSlug}/bai-hoc/{lessonSlug}/video/{videoSlug}', [CourseController::class, 'learning'])
                ->name('course.learning.video');

            // Route cho test
            Route::get('/{courseSlug}/bai-hoc/{lessonSlug}/bai-kiem-tra/{testSlug}', [CourseController::class, 'learning'])
                ->name('course.learning.test');
        });

        // Comment routes
        Route::middleware(['auth'])->group(function () {
            Route::post('/comments', [App\Http\Controllers\Client\CommentController::class, 'store'])->name('client.comments.store');
            Route::post('/comments/{comment}/reply', [App\Http\Controllers\Client\CommentController::class, 'reply'])->name('client.comments.reply');
            
            // Rating routes
            Route::post('/ratings', [App\Http\Controllers\Client\CommentController::class, 'storeRating'])->name('client.ratings.store');
        });

        Route::post('/test/{test}/submit', [TestResultController::class, 'submit'])->name('test.submit');
        Route::get('/test/{test}/retry', [TestResultController::class, 'retry'])->name('test.retry');
    });

    // Lesson routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/lessons/{lessonId}/{enrollmentId}', function ($lessonId, $enrollmentId) {
            return view('lessons.view', compact('lessonId', 'enrollmentId'));
        })->name('lessons.view');
    });
});

/*
|--------------------------------------------------------------------------
| Maintenance/Cache Routes
|--------------------------------------------------------------------------
|
| Routes for clearing application cache, view cache, and other maintenance tasks
|
*/
Route::middleware(['auth'])->group(function () {
    // Chỉ admin mới có thể xóa cache
    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        return redirect()->back()->with('success', 'Cache đã được xóa thành công!');
    })->name('clear.cache');

    Route::get('/clear-view', function () {
        Artisan::call('view:clear');
        return redirect()->back()->with('success', 'View cache đã được xóa thành công!');
    })->name('clear.view');

    Route::get('/clear-config', function () {
        Artisan::call('config:clear');
        return redirect()->back()->with('success', 'Config cache đã được xóa thành công!');
    })->name('clear.config');

    Route::get('/clear-all', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        return redirect()->back()->with('success', 'Tất cả cache đã được xóa thành công!');
    })->name('clear.all');
});
