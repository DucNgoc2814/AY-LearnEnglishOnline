<?php

namespace App\Http\Controllers\Admin;
use App\Models\ClassSchedule;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý danh mục
 */
class ClassScheduleController extends BaseController
{
    protected $pageTitle = 'Danh sách lịch học';
    public function __construct()
    {
        $this->model = ClassSchedule::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.class-schedules';
        parent::__construct();
    }
}