<?php

namespace App\Http\Controllers\Admin;
use App\Models\CourseRegistration;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý danh mục
 */
class CourseRegistrationController extends BaseController
{
    protected $pageTitle = 'Danh sách đăng ký khóa học';
    public function __construct()
    {
        $this->model = CourseRegistration::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.course-registrations';
        parent::__construct();
    }
}