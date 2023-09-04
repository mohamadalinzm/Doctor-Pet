<?php

namespace Shift\Foundation\Decorator;

use Illuminate\Support\Facades\DB;
use Shift\Model\Shift;
use Shift\ShiftInterface;

class TransactionDecorator extends Management implements ShiftInterface
{
    protected $service;

    public function __construct($service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function store($data)
    {
        return $this->execute(function () use ($data) {
            return $this->service->store($data);
        });
    }

    public function update(array $data, $Shift)
    {
        return $this->execute(function () use ($data, $Shift) {
            return $this->service->update($data, $Shift);
        });
    }

    public function delete(Shift $Shift)
    {
        return $this->execute(function () use ($Shift) {
            return $this->service->delete($Shift);
        });
    }



    public function fetch(int $id , $appends = [] , $select = [] )
    {
        return $this->execute(function () use ($id,$appends,$select) {
            return $this->service->fetch($id,$appends,$select);
        });
    }


    public function ban(Shift $Shift)
    {
        return $this->execute(function () use ($Shift) {
            return $this->service->delete($Shift);
        });
    }

    public function information()
    {
        return $this->service->information();
    }


    public function listing(int $limit, array $appends, array $select)
    {
        return $this->execute(function () use ($limit,$appends,$select) {
            return $this->service->listing($limit,$appends,$select);
        });
    }

    public function isShiftHaveAnyStore(int $id)
    {
        return $this->execute(function () use ($id) {
            return $this->service->isShiftHaveAnyStore($id);
        });
    }

    public function isShiftExistInSellerStores(int $id, $stores)
    {
        return $this->execute(function () use ($id,$stores) {
            return $this->service->isShiftExistInSellerStores($id,$stores);
        });
    }

    public function activation(bool $activation, $Shift)
    {
        return $this->execute(function () use ($activation,$Shift) {
            return $this->service->activation($activation,$Shift);
        });
    }

    public function activities($select = [], $appends = [])
    {
        return $this->execute(function () use ($select,$appends) {
            return $this->service->activities($select,$appends);
        });
    }

    public function isBanned($Shift)
    {
        return $this->execute(function () use ($Shift) {
            return $this->service->isBanned($Shift);
        });
    }

    public function isAlreadyBanned(Shift $Shift)
    {
        return $this->execute(function () use ($Shift) {
            return $this->service->isAlreadyBanned($Shift);
        });
    }

    protected function execute(callable $callback)
    {
        return DB::transaction(function () use ($callback) {
            return $callback();
        });
    }
}
