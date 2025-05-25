<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassStudent;

class ClassStudentController extends BaseController
{
    protected $pageTitle = 'Danh sách học viên';
    public function __construct()
    {
        $this->model = ClassStudent::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.class-students';
        parent::__construct();
    }
}
