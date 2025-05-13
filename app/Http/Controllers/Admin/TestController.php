<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;
/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý bài test
 */
class TestController extends BaseController
{
    protected $pageTitle = 'Danh sách bài test';
    public function __construct()
    {
        $this->model = Test::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.tests';
        parent::__construct();
    }
}
