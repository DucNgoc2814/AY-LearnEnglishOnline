<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\CategoryService;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\VoucherRepositoryInterface;
use App\Repositories\VoucherRepository;
use App\Services\Interfaces\VoucherServiceInterface;
use App\Services\VoucherService;
use App\Services\Interfaces\CourseServiceInterface;
use App\Services\CourseService;
use App\Services\Interfaces\LessonServiceInterface;
use App\Services\LessonService;
use App\Services\Interfaces\VideoLessonServiceInterface;
use App\Services\VideoLessonService;
use App\Services\Interfaces\TestServiceInterface;
use App\Services\TestService;
use App\Services\Interfaces\QuestionServiceInterface;
use App\Services\QuestionService;
use App\Services\Interfaces\AnswerServiceInterface;
use App\Services\AnswerService;
use App\Services\Interfaces\StudentServiceInterface;
use App\Services\StudentService;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(VoucherRepositoryInterface::class, VoucherRepository::class);
        $this->app->bind(VoucherServiceInterface::class, VoucherService::class);
        $this->app->bind(CourseServiceInterface::class,CourseService::class);
        $this->app->bind(LessonServiceInterface::class, LessonService::class);
        $this->app->bind(VideoLessonServiceInterface::class, VideoLessonService::class);
        $this->app->bind(TestServiceInterface::class, TestService::class);
        $this->app->bind(QuestionServiceInterface::class, QuestionService::class);
        $this->app->bind(AnswerServiceInterface::class, AnswerService::class);
        $this->app->bind(StudentServiceInterface::class, StudentService::class);
    }
}
