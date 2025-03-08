<?php

namespace App\Repositories;

use App\Models\Voucher;
use App\Repositories\Interfaces\VoucherRepositoryInterface;
use Illuminate\Support\Str;

class VoucherRepository extends BaseRepository implements VoucherRepositoryInterface
{
    protected $table = 'vouchers';
    protected $model;

    public function __construct()
    {
        $this->model = new Voucher();
        parent::__construct($this->model);
    }

    public function getQuery()
    {
        return $this->model
            ->whereNull('deleted_at')
            ->latest('id');
    }

    public function searchByCode($search)
    {
        return $this->getQuery()
            ->where('code', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }

    public function getAllWithTrashed()
    {
        return $this->model::onlyTrashed();
    }
} 