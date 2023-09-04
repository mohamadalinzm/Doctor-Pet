<?php

namespace Pet;

use Pet\Model\Pet;
use User\Model\User;

interface PetInterface
{
    //-----------------ControllerActions-----------------//

    //public function ListPetes(int $limit , array $appends , array $filters);
    //
    //public function SavePet(array $data);
    //
    //public function UpdatePet(array $data , int $PetId);
    //
    //public function DeletePet(int $PetId);
    //
    //public function ShowPet(int $PetId);
    //
    //public function SetDefaultPet(int $PetId);

    //--------------RepositoriesActions-----------------//

    public function store(array $data);

    public function update(array $data , Pet $Pet);

    public function delete(Pet $Pet);

    public function list(array $appends , array $filters , int $limit);

    public function fetch(int $id , array $appends , array $select);

    public function set(int $id);

    public function restore(int $id);

    public function forceDelete(int $id);

    public function isPetLimited($user);

    public function isPetActive(Pet $Pet);

    public function isUserCanAlterThePet(int $creatorId , int $userId);

    public function isUserCanDeleteThePet(int $creatorId , int $userId);

    public function isUserCanSeeThePet(int $creatorId , int $userId);

    public function isPetDefaultIsAlreadyInSameStatus(bool $PetDefault , bool $requestDefault);
}
