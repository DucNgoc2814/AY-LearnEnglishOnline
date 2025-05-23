<?php

namespace App\Http\Controllers\Admin;

use App\Models\VocabularyListeningTranscription;

class VocabularyListeningTranscriptionController extends BaseController
{
    protected $pageTitle = 'Quản lý bài tập phiên âm';

    public function __construct()
    {
        $this->model = VocabularyListeningTranscription::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.vocabulary-listening-transcriptions';

        parent::__construct();
    }
}
