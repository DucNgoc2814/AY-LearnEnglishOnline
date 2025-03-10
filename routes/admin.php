<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LessonTestController;
use App\Http\Controllers\Admin\FinalExamController;
use App\Http\Controllers\Admin\QuestionLessonTestController;
use App\Http\Controllers\Admin\QuestionFinalExamController;

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

    // Courses Management
    Route::controller(CourseController::class)
        ->prefix('courses')
        ->name('courses.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::get('/{courseId}', [LessonController::class, 'index'])->name('by.course');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });

    // Categories Management
    Route::controller(CategoryController::class)
        ->prefix('categories')
        ->name('categories.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });

    // Lessons Management
    Route::controller(LessonController::class)
        ->prefix('lessons')
        ->name('lessons.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('/{id}/restore', 'restore')->name('restore');
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

    // Employees Management
    Route::resource('employees', EmployeeController::class);

    // Tests & Exams Management
    Route::resource('lesson-tests', LessonTestController::class);
    Route::resource('final-exams', FinalExamController::class);
    Route::resource('question-lesson-tests', QuestionLessonTestController::class);
    Route::resource('question-final-exams', QuestionFinalExamController::class);
});
