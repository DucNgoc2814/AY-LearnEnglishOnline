<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;

/**
 * @package App\Http\Controllers\Admin
 * @author Your Name
 * @description Controller quản lý danh mục
 */
class CategoryController extends BaseController
{
    protected $pageTitle = 'Danh sách danh mục';
    public function __construct()
    {
        $this->model = Category::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.categories';
        parent::__construct();
    }
}
