<?php

namespace App\Services\Interfaces;

interface BaseServiceInterface
{
    public function getList();
    public function findById($id);
    public function create(array $data);
    public function update($data, $id);
    public function delete($id);
    public function getTrashList();
    public function restore($id);
    public function forceDelete($id);
} 