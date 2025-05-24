<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReflectionStudentAnswer;

class ReflectionStudentAnswerController extends BaseController
{
    protected $pageTitle = 'Quản lý câu trả lời Reflection';

    public function __construct()
    {
        $this->model = ReflectionStudentAnswer::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.reflection-student-answers';

        parent::__construct();
    }
}
