<?php

namespace Pet\Service;

use Pet\Model\Pet;
use User\Model\User;

interface PetRepositoryInterface
{
    public function store(array $data);

    public function update(array $data, $PetId);

    public function delete($PetId);

    public function list(array $appends, array $filters, array $select, int $limit , int $userId);

    public function fetch(int $id, array $appends, array $select);

    public function restore(int $id);

    public function forceDelete(int $id);

    public function exists(int $id);
}
