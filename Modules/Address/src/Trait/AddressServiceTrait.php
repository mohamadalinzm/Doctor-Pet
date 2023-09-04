<?php

namespace Address\Trait;

use Address\Model\Address;

class AddressServiceTrait
{
    public function store(array $data)
    {
        return $this->repository->store($data);
    }


    public function update(array $data, Address $address)
    {
        return $this->repository->update($data,$address);
    }


    public function delete(Address $address)
    {
        return $this->repository->delete($address);
    }


    public function list(array $appends, array $filters, int $limit)
    {
        $addresses = $this->repository->list($this->listLimitation,$appends,$select);
        if (!$address){
            $this->response->AddressNotFound();
        }
        return $addresses;
    }


    public function fetch(int $id, array $appends = null, array $select = null)
    {
        $address = $this->repository->fetch($id,$appends,$select);
        if (!$address){
            $this->response->AddressNotFound();
        }

        return $address;
    }


    public function isAddressLimited($user)
    {
        $count = $this->repository->getUserAddressCount();
        if ($count > $this->limitation){
            $this->response->AddressOverLimitation();
        }
    }


    public function isAddressActive(Address $address)
    {
        if (!$address->is_active){
            $this->response->AddressIsNotActive();
        }
    }

    public function isUserCanAlterTheAddress(int $creatorId, int $userId)
    {
        if ($creatorId !== $userId){
            $this->response->AddressCantAlterByThisUser();
        }
    }

    public function isUserCanDeleteTheAddress(int $creatorId, int $userId)
    {
        if ($creatorId !== $userId){
            $this->response->AddressCantDeletedByYou();
        }
    }

    public function isUserCanSeeTheAddress(int $creatorId, int $userId)
    {
        if ($creatorId !== $userId){
            $this->response->AddressCantSeeByYou();
        }
    }

    public function isAddressDefaultIsAlreadyInSameStatus(bool $addressDefault, bool $requestDefault)
    {
        if ($addressDefault !== $requestDefault){
            $this->response->AddressDefaultIsAlreadyWasInThisStatus();
        }
    }
}
