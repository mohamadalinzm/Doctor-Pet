<?php

namespace Address;

use Address\Model\Address;
use User\Model\User;

interface AddressInterface
{
    //-----------------ControllerActions-----------------//

    //public function ListAddresses(int $limit , array $appends , array $filters);
    //
    //public function SaveAddress(array $data);
    //
    //public function UpdateAddress(array $data , int $addressId);
    //
    //public function DeleteAddress(int $addressId);
    //
    //public function ShowAddress(int $addressId);
    //
    //public function SetDefaultAddress(int $addressId);

    //--------------RepositoriesActions-----------------//

    public function store(array $data);

    public function update(array $data , Address $address);

    public function delete(Address $address);

    public function list(array $appends , array $filters , int $limit);

    public function fetch(int $id , array $appends , array $select);

    public function set(int $id);

    public function restore(int $id);

    public function forceDelete(int $id);

    public function isAddressLimited($user);

    public function isAddressActive(Address $address);

    public function isUserCanAlterTheAddress(int $creatorId , int $userId);

    public function isUserCanDeleteTheAddress(int $creatorId , int $userId);

    public function isUserCanSeeTheAddress(int $creatorId , int $userId);

    public function isAddressDefaultIsAlreadyInSameStatus(bool $addressDefault , bool $requestDefault);
}
