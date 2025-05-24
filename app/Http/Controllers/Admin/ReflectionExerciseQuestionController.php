<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReflectionExerciseQuestion;

class ReflectionExerciseQuestionController extends BaseController
{
    protected $pageTitle = 'Quản lý câu hỏi Reflection';

    public function __construct()
    {
        $this->model = ReflectionExerciseQuestion::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.reflection-exercise-questions';

        parent::__construct();
    }
}
