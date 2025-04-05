<?php

namespace App\Services\Interfaces;

interface LessonServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);

    /**
     * Lấy danh sách bài học theo khóa học
     *
     * @param int $courseId
     * @return array
     */
    public function getLessonsByCourse($courseId);
}
