<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseServiceInterface;

interface QuestionServiceInterface extends BaseServiceInterface
{
    /**
     * Tìm kiếm câu hỏi theo tên
     *
     * @param string $keyword Từ khóa tìm kiếm
     * @return array
     */
    public function searchByName($keyword);

    /**
     * Tìm câu hỏi với URLs đầy đủ
     *
     * @param int $id ID của câu hỏi
     * @return array|object
     */
    public function findWithFullUrls($id);
}
