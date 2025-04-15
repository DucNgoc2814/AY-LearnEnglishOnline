<?php

namespace App\Services\Interfaces;

interface AnswerServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
}
