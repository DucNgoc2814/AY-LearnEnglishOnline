<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getQuery();
    public function getAllWithTrashed();
    public function findWithTrashed($id);
    public function restore($id);
    public function forceDelete($id);
} 