<?php

namespace App\Http\Controllers\Admin;

use App\Models\VocabularyListeningSentenceBuilding;

class VocabularyListeningSentenceBuildingController extends BaseController
{
    protected $pageTitle = 'Quản lý bài tập xây dựng câu';

    public function __construct()
    {
        $this->model = VocabularyListeningSentenceBuilding::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.vocabulary-listening-sentence-buildings';

        parent::__construct();
    }
}
