<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NameController;
use App\Http\Controllers\Admin\ProductController;

// Nhóm tổng cho admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.layouts.app');
    })->name('dashboard');

    // Routes cho Category
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

    // Routes cho Product
    Route::prefix('products')->name('products.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [ProductController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [ProductController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [ProductController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [ProductController::class, 'restore'])->name('restore');
    });

    // Routes cho Name
    Route::prefix('names')->name('names.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [NameController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [NameController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [NameController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [NameController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [NameController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [NameController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [NameController::class, 'restore'])->name('restore');
    });
});
