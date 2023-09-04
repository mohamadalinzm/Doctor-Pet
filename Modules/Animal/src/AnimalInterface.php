<?php

namespace Animal;

use Animal\Model\Animal;
use User\Model\User;

interface AnimalInterface
{
    //--------------RepositoriesActions-----------------//

    public function store(array $data);

    public function update(array $data , Animal $Animal);

    public function delete(Animal $Animal);

    public function list(array $appends , array $filters , int $limit);

    public function fetch(int $id , array $appends , array $select);

    public function restore(int $id);

    public function forceDelete(int $id);
}
