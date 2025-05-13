<?php

namespace App\Http\Controllers\Admin;
use App\Models\Classes;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý danh mục
 */
class ClassController extends BaseController
{
    protected $pageTitle = 'Danh sách lớp học';
    public function __construct()
    {
        $this->model = Classes::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.classes';
        parent::__construct();
    }
}