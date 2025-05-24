<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReflectionExercise;

class ReflectionExerciseController extends BaseController
{
    protected $pageTitle = 'Quản lý bài tập Reflection';

    public function __construct()
    {
        $this->model = ReflectionExercise::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.reflection-exercises';

        parent::__construct();
    }
}
