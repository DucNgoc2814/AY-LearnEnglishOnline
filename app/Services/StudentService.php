<?php

namespace App\Services;

use App\Models\Student;
use App\Services\Interfaces\StudentServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StudentService extends BaseService implements StudentServiceInterface
{
    protected $repository;

    public function __construct(StudentRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function searchByName($name)
    {
        try {
            return $this->repository->searchByName($name);
        } catch (\Exception $e) {
            Log::error('Error searching students by name: ' . $e->getMessage(), [
                'name' => $name,
                'exception' => $e
            ]);
            throw $e;
        }
    }

    /**
     * Tìm khóa học với URLs đầy đủ
     *
     * @param int $id
     * @return array
     */
    public function findWithFullUrls($id)
    {
        try {
            $student = $this->repository->findWithFullUrls($id);
            if (!$student) {
                throw new \Exception('Không tìm thấy học sinh');
            }

            return $student;
        } catch (\Exception $e) {
            Log::error('Error in StudentService findWithFullUrls:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function getStudentsWithFullUrls()
    {
        try {
            $students = $this->repository->getQuery()->get();
            return $students->map(function ($student) {
                if ($student->avatar) {
                    $student->avatar = $student->getAvatarUrl();
                }
                return $student;
            });
        } catch (\Exception $e) {
            Log::error('Error getting students with full URLs: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            throw $e;
        }
    }

    public function createStudent(array $data)
    {
        try {
            return $this->repository->create($data);
        } catch (\Exception $e) {
            Log::error('Error creating student: ' . $e->getMessage(), [
                'data' => $data,
                'exception' => $e
            ]);
            throw $e;
        }
    }

    public function updateStudent($id, array $data)
    {
        try {
            return $this->repository->update($id, $data);
        } catch (\Exception $e) {
            Log::error('Error updating student: ' . $e->getMessage(), [
                'id' => $id,
                'data' => $data,
                'exception' => $e
            ]);
            throw $e;
        }
    }

    public function deleteStudent($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (\Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage(), [
                'id' => $id,
                'exception' => $e
            ]);
            throw $e;
        }
    }
}
