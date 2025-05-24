<?php

namespace App\Http\Controllers\Admin;

use App\Models\VocabularyListeningKeyPhrase;

class VocabularyListeningKeyPhraseController extends BaseController
{
    protected $pageTitle = 'Quản lý cụm từ quan trọng';

    public function __construct()
    {
        $this->model = VocabularyListeningKeyPhrase::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.vocabulary-listening-key-phrases';

        parent::__construct();
    }
}
