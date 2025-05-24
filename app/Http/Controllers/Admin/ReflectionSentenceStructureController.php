<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReflectionSentenceStructure;

class ReflectionSentenceStructureController extends BaseController
{
    protected $pageTitle = 'Quản lý mẫu câu Reflection';

    public function __construct()
    {
        $this->model = ReflectionSentenceStructure::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.reflection-sentence-structures';

        parent::__construct();
    }
}
