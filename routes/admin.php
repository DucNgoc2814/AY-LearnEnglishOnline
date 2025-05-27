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
use App\Http\Controllers\Admin\ClassStudentController;
use App\Http\Controllers\Admin\CourseRegistrationController;
use App\Http\Controllers\Admin\DictationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ReflectionExerciseController;
use App\Http\Controllers\Admin\ReflectionExerciseQuestionController;
use App\Http\Controllers\Admin\ReflectionSentenceStructureController;
use App\Http\Controllers\Admin\ReflectionStudentAnswerController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\VideoExerciseLessonController;
use App\Http\Controllers\Admin\VideoHandoutFileController;
use App\Http\Controllers\Admin\VideoHandoutLessonController;
use App\Http\Controllers\Admin\VideoHandoutUnitController;
use App\Http\Controllers\Admin\VideoLessonController;
use App\Http\Controllers\Admin\VideoShadowingController;
use App\Http\Controllers\Admin\VideoShadowingSegmentController;
use App\Http\Controllers\Admin\VocabularyListeningDictationController;
use App\Http\Controllers\Admin\VocabularyListeningEndingSoundController;
use App\Http\Controllers\Admin\VocabularyListeningGrammarController;
use App\Http\Controllers\Admin\VocabularyListeningKeyPhraseController;
use App\Http\Controllers\Admin\VocabularyListeningQuizletController;
use App\Http\Controllers\Admin\VocabularyListeningSentenceBuildingController;
use App\Http\Controllers\Admin\VocabularyListeningTranscriptionController;
use App\Http\Controllers\Admin\VocabularyListeningVideoController;
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
    Route::prefix('vocabulary-listening-videos')->name('vocabulary-listening-videos.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VocabularyListeningVideoController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VocabularyListeningVideoController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VocabularyListeningVideoController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VocabularyListeningVideoController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VocabularyListeningVideoController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VocabularyListeningVideoController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VocabularyListeningVideoController::class, 'restore'])->name('restore');
    });
    Route::prefix('vocabulary-listening-quizlets')->name('vocabulary-listening-quizlets.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VocabularyListeningQuizletController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VocabularyListeningQuizletController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VocabularyListeningQuizletController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VocabularyListeningQuizletController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VocabularyListeningQuizletController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VocabularyListeningQuizletController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VocabularyListeningQuizletController::class, 'restore'])->name('restore');
    });
    Route::prefix('vocabulary-listening-dictations')->name('vocabulary-listening-dictations.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VocabularyListeningDictationController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VocabularyListeningDictationController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VocabularyListeningDictationController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VocabularyListeningDictationController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VocabularyListeningDictationController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VocabularyListeningDictationController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VocabularyListeningDictationController::class, 'restore'])->name('restore');
    });
    Route::prefix('vocabulary-listening-key-phrases')->name('vocabulary-listening-key-phrases.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VocabularyListeningKeyPhraseController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VocabularyListeningKeyPhraseController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VocabularyListeningKeyPhraseController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VocabularyListeningKeyPhraseController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VocabularyListeningKeyPhraseController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VocabularyListeningKeyPhraseController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VocabularyListeningKeyPhraseController::class, 'restore'])->name('restore');
    });
    Route::prefix('vocabulary-listening-sentence-buildings')->name('vocabulary-listening-sentence-buildings.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VocabularyListeningSentenceBuildingController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VocabularyListeningSentenceBuildingController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VocabularyListeningSentenceBuildingController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VocabularyListeningSentenceBuildingController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VocabularyListeningSentenceBuildingController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VocabularyListeningSentenceBuildingController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VocabularyListeningSentenceBuildingController::class, 'restore'])->name('restore');
    });
    Route::prefix('vocabulary-listening-grammars')->name('vocabulary-listening-grammars.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VocabularyListeningGrammarController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VocabularyListeningGrammarController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VocabularyListeningGrammarController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VocabularyListeningGrammarController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VocabularyListeningGrammarController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VocabularyListeningGrammarController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VocabularyListeningGrammarController::class, 'restore'])->name('restore');
    });
    Route::prefix('vocabulary-listening-transcriptions')->name('vocabulary-listening-transcriptions.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VocabularyListeningTranscriptionController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VocabularyListeningTranscriptionController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VocabularyListeningTranscriptionController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VocabularyListeningTranscriptionController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VocabularyListeningTranscriptionController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VocabularyListeningTranscriptionController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VocabularyListeningTranscriptionController::class, 'restore'])->name('restore');
    });
    Route::prefix('vocabulary-listening-ending-sounds')->name('vocabulary-listening-ending-sounds.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VocabularyListeningEndingSoundController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VocabularyListeningEndingSoundController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VocabularyListeningEndingSoundController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VocabularyListeningEndingSoundController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VocabularyListeningEndingSoundController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VocabularyListeningEndingSoundController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VocabularyListeningEndingSoundController::class, 'restore'])->name('restore');
    });
    Route::prefix('video-handout-units')->name('video-handout-units.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VideoHandoutUnitController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VideoHandoutUnitController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VideoHandoutUnitController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VideoHandoutUnitController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VideoHandoutUnitController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VideoHandoutUnitController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VideoHandoutUnitController::class, 'restore'])->name('restore');
    });
    Route::prefix('video-handout-lessons')->name('video-handout-lessons.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VideoHandoutLessonController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VideoHandoutLessonController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VideoHandoutLessonController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VideoHandoutLessonController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VideoHandoutLessonController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VideoHandoutLessonController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VideoHandoutLessonController::class, 'restore'])->name('restore');
    });
    Route::prefix('video-handout-files')->name('video-handout-files.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VideoHandoutFileController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VideoHandoutFileController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VideoHandoutFileController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VideoHandoutFileController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VideoHandoutFileController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VideoHandoutFileController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VideoHandoutFileController::class, 'restore'])->name('restore');
    });
    Route::prefix('video-shadowings')->name('video-shadowings.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VideoShadowingController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VideoShadowingController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VideoShadowingController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VideoShadowingController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VideoShadowingController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VideoShadowingController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VideoShadowingController::class, 'restore'])->name('restore');
    });
    Route::prefix('video-shadowing-segments')->name('video-shadowing-segments.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [VideoShadowingSegmentController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [VideoShadowingSegmentController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [VideoShadowingSegmentController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [VideoShadowingSegmentController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [VideoShadowingSegmentController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [VideoShadowingSegmentController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [VideoShadowingSegmentController::class, 'restore'])->name('restore');
    });
    Route::prefix('reflection-exercises')->name('reflection-exercises.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [ReflectionExerciseController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [ReflectionExerciseController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [ReflectionExerciseController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [ReflectionExerciseController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [ReflectionExerciseController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [ReflectionExerciseController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [ReflectionExerciseController::class, 'restore'])->name('restore');
    });
    Route::prefix('reflection-sentence-structures')->name('reflection-sentence-structures.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [ReflectionSentenceStructureController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [ReflectionSentenceStructureController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [ReflectionSentenceStructureController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [ReflectionSentenceStructureController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [ReflectionSentenceStructureController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [ReflectionSentenceStructureController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [ReflectionSentenceStructureController::class, 'restore'])->name('restore');
    });
    Route::prefix('reflection-exercise-questions')->name('reflection-exercise-questions.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [ReflectionExerciseQuestionController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [ReflectionExerciseQuestionController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [ReflectionExerciseQuestionController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [ReflectionExerciseQuestionController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [ReflectionExerciseQuestionController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [ReflectionExerciseQuestionController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [ReflectionExerciseQuestionController::class, 'restore'])->name('restore');
    });
    Route::prefix('class-students')->name('class-students.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [ClassStudentController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [ClassStudentController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [ClassStudentController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [ClassStudentController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [ClassStudentController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [ClassStudentController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [ClassStudentController::class, 'restore'])->name('restore');

        // API lấy danh sách học viên theo lớp
        Route::get('/get-students', [ClassStudentController::class, 'getStudents'])
            ->name('get-students');
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
    Route::prefix('course-registrations')->name('course-registrations.')->group(function () {
        // Hiển thị danh sách
        Route::get('/', [CourseRegistrationController::class, 'index'])->name('index');

        // Form tạo mới
        Route::get('/create', [CourseRegistrationController::class, 'create'])->name('create');

        // Lưu dữ liệu mới
        Route::post('/', [CourseRegistrationController::class, 'store'])->name('store');

        // Form chỉnh sửa
        Route::get('/{id}/edit', [CourseRegistrationController::class, 'edit'])->name('edit');

        // Cập nhật dữ liệu
        Route::put('/{id}', [CourseRegistrationController::class, 'update'])->name('update');

        // Xóa mềm
        Route::delete('/{id}', [CourseRegistrationController::class, 'destroy'])->name('destroy');

        // Khôi phục từ thùng rác
        Route::put('/{id}/restore', [CourseRegistrationController::class, 'restore'])->name('restore');
    });
});
