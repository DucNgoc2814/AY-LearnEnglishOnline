<?php

use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\DictationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\VideoExerciseLessonController;
use App\Http\Controllers\Admin\VideoLessonController;
use App\Http\Controllers\Admin\ZoomSessionController;

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
// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Users Management
    Route::controller(UserController::class)
        ->prefix('users')
        ->name('users.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{user}', 'show')->name('show');
            Route::get('/{user}/edit', 'edit')->name('edit');
            Route::put('/{user}', 'update')->name('update');
            Route::delete('/{user}', 'destroy')->name('destroy');
        });
        Route::prefix('classes')->name('classes.')->group(function () {
            // Hiển thị danh sách
            Route::get('/', [ClassController::class, 'index'])->name('index');

            // Form tạo mới
            Route::get('/create', [ClassController::class, 'create'])->name('create');

            // Lưu dữ liệu mới
            Route::post('/', [ClassController::class, 'store'])->name('store');

            // Form chỉnh sửa
            Route::get('/{id}/edit', [ClassController::class, 'edit'])->name('edit');

            // Cập nhật dữ liệu
            Route::put('/{id}', [ClassController::class, 'update'])->name('update');

            // Xóa mềm
            Route::delete('/{id}', [ClassController::class, 'destroy'])->name('destroy');

            // Khôi phục từ thùng rác
            Route::put('/{id}/restore', [ClassController::class, 'restore'])->name('restore');
        });
    Route::controller(UserController::class)
        ->prefix('users')
        ->name('users.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{user}', 'show')->name('show');
            Route::get('/{user}/edit', 'edit')->name('edit');
            Route::put('/{user}', 'update')->name('update');
            Route::delete('/{user}', 'destroy')->name('destroy');
        });

    // Courses Management
    Route::prefix('courses')->name('courses.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [CourseController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [CourseController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [CourseController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [CourseController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [CourseController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [CourseController::class, 'restore'])->name('restore');
    });

    // Video Lessons Management
    Route::controller(VideoLessonController::class)
        ->prefix('video-lessons')
        ->name('video-lessons.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            // Route::get('/{courseId}', [LessonController::class, 'index'])->name('by.course');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });

    // Zoom Sessions Management
    Route::controller(ZoomSessionController::class)
        ->prefix('zoom-sessions')
        ->name('zoom-sessions.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            // Route::get('/{courseId}', [LessonController::class, 'index'])->name('by.course');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });
    // Categories Management
        Route::prefix('categories')->name('categories.')->group(function () {
            // Hiển thị danh sách
            Route::get('/', [CategoryController::class, 'index'])->name('index');

            // Form tạo mới
            Route::get('/create', [CategoryController::class, 'create'])->name('create');

            // Lưu dữ liệu mới
            Route::post('/', [CategoryController::class, 'store'])->name('store');

            // Form chỉnh sửa
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');

            // Cập nhật dữ liệu
            Route::put('/{id}', [CategoryController::class, 'update'])->name('update');

            // Xóa mềm
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');

            // Khôi phục từ thùng rác
            Route::put('/{id}/restore', [CategoryController::class, 'restore'])->name('restore');
        });
        Route::prefix('tests')->name('tests.')->group(function () {
            // Hiển thị danh sách
            Route::get('/', [TestController::class, 'index'])->name('index');

            // Form tạo mới
            Route::get('/create', [TestController::class, 'create'])->name('create');

            // Lưu dữ liệu mới
            Route::post('/', [TestController::class, 'store'])->name('store');

            // Form chỉnh sửa
            Route::get('/{id}/edit', [TestController::class, 'edit'])->name('edit');

            // Cập nhật dữ liệu
            Route::put('/{id}', [TestController::class, 'update'])->name('update');

            // Xóa mềm
            Route::delete('/{id}', [TestController::class, 'destroy'])->name('destroy');

            // Khôi phục từ thùng rác
            Route::put('/{id}/restore', [TestController::class, 'restore'])->name('restore');
        });
    // Questions Management
    Route::prefix('questions')->name('questions.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [QuestionController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [QuestionController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [QuestionController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [QuestionController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [QuestionController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [QuestionController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [QuestionController::class, 'restore'])->name('restore');
    });
    Route::prefix('dictations')->name('dictations.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [DictationController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [DictationController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [DictationController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [DictationController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [DictationController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [DictationController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [DictationController::class, 'restore'])->name('restore');
    });

    // Lessons Management
    Route::prefix('lessons')->name('lessons.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [LessonController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [LessonController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [LessonController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [LessonController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [LessonController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [LessonController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [LessonController::class, 'restore'])->name('restore');
    });

    // Blogs Management
    Route::controller(BlogController::class)
        ->prefix('blogs')
        ->name('blogs.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{blog}', 'show')->name('show');
            Route::get('/{blog}/edit', 'edit')->name('edit');
            Route::put('/{blog}', 'update')->name('update');
            Route::delete('/{blog}', 'destroy')->name('destroy');
        });

    // Orders Management
    Route::controller(OrderController::class)
        ->prefix('orders')
        ->name('orders.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{order}', 'show')->name('show');
            Route::get('/{order}/edit', 'edit')->name('edit');
            Route::put('/{order}', 'update')->name('update');
            Route::delete('/{order}', 'destroy')->name('destroy');

            // Additional order routes
            Route::post('{order}/approve', 'approve')->name('approve');
            Route::post('{order}/reject', 'reject')->name('reject');
            Route::get('export', 'export')->name('export');
        });

    // Vouchers Management
    Route::controller(VoucherController::class)
        ->prefix('vouchers')
        ->name('vouchers.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });
    // Students Management
    Route::controller(StudentController::class)
        ->prefix('students')
        ->name('students.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });
    // Banners Management

        Route::controller(BannerController::class)
        ->prefix('banners')
        ->name('banners.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });

    // Classes Management
    Route::controller(ClassController::class)
        ->prefix('classes')
        ->name('classes.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });

    // Employees Management
    Route::resource('employees', EmployeeController::class);

        // Video Exercise Lessons Management
        Route::prefix('video-exercise-lessons')->name('video-exercise-lessons.')->group(function () {
            // Hiển thị danh sách
            Route::get('/', [VideoExerciseLessonController::class, 'index'])->name('index');

            // Form tạo mới
            Route::get('/create', [VideoExerciseLessonController::class, 'create'])->name('create');

            // Lưu dữ liệu mới
            Route::post('/', [VideoExerciseLessonController::class, 'store'])->name('store');

            // Form chỉnh sửa
            Route::get('/{id}/edit', [VideoExerciseLessonController::class, 'edit'])->name('edit');

            // Cập nhật dữ liệu
            Route::put('/{id}', [VideoExerciseLessonController::class, 'update'])->name('update');

            // Xóa mềm
            Route::delete('/{id}', [VideoExerciseLessonController::class, 'destroy'])->name('destroy');

            // Khôi phục từ thùng rác
            Route::put('/{id}/restore', [VideoExerciseLessonController::class, 'restore'])->name('restore');
        });
});
