<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Name;

class NameController extends BaseController
{
    public function __construct()
    {
        $this->model = Name::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.names';
        parent::__construct();
    }
}
