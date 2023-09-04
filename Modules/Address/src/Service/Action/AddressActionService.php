<?php

namespace Address\Service\Action;

use Address\AddressInterface;
use Address\Foundation\Abstraction\AddressAbstract;
use Address\Model\Address;

class AddressActionService extends AddressAbstract
{

    // Save An Address
    public function store(array $data, $entity)
    {
        return $this->repository()->store($data, $entity);
    }

    // Update And Address
    public function update(array $data, int $addressId)
    {
        return $this->repository()->update($data, $addressId);
    }

    // Delete And Address
    public function delete(int $addressId)
    {
        return $this->repository()->delete($addressId);
    }

    // List Addresses
    public function list($entity, array $appends, array $filters, int $limit, array $select = null)
    {
        return $this->repository()->list($entity, $appends, $filters, $select, $limit);
    }

    // Fetch Address
    public function fetch(int $id, array $appends = [], array $select = [])
    {
        $result = $this->repository()->fetch($id, $appends, $select);
        if (! $result) {
            $this->response()->AddressNotFound();
        }

        return $result;
    }

    // Set Address
    public function set(int $id)
    {
        return $this->repository()->set($id);
    }

    // Restore Address
    public function restore(int $id)
    {
        return $this->repository()->restore($id);
    }

    // Force Delete An Address
    public function forceDelete(int $id)
    {
        return $this->repository()->forceDelete($id);
    }

    // Check Is Address Existed Or Not
    public function exist($id)
    {
        $result = $this->repository()->exists($id);
        if (! $result) {
            $this->response()->AddressNotFound();
        }

        return $result;
    }

}
