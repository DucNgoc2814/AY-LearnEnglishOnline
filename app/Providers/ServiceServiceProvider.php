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
    }
}
