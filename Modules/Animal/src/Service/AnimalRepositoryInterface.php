<?php

namespace Animal\Service;

use Animal\Model\Animal;
use User\Model\User;

interface AnimalRepositoryInterface
{
    public function store(array $data);

    public function update(array $data, $AnimalId);

    public function delete($AnimalId);

    public function list(array $appends, array $filters, array $select, int $limit);

    public function fetch(int $id, array $appends, array $select);

    public function restore(int $id);

    public function forceDelete(int $id);

    public function exists(int $id);
}
