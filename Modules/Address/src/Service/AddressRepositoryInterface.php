<?php

namespace Address\Service;

use Address\Model\Address;
use User\Model\User;

interface AddressRepositoryInterface
{
    public function store(array $data , $entity);

    public function update(array $data, $addressId);

    public function delete($addressId);

    public function list(int $userId, array $appends, array $filters, array $select, int $limit);

    public function fetch(int $id, array $appends, array $select);

    public function set(int $id);

    public function restore(int $id);

    public function forceDelete(int $id);

    public function exists(int $id);
}
