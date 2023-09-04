<?php

namespace Address\Service;

interface AddressResponseInterface
{
    public function AddressAlreadyExisted();

    public function AddressCantDeletedByYou();

    public function AddressDeleted();

    public function AddressValidationFailed($errors);

    public function AddressStored();

    public function AddressUpdated();

    public function AddressSetDefault();

    public function AddressNotFound();

    public function AddressIsNotActive();

    public function AddressOverLimitation();

    public function AddressCantAlterByThisUser();

    public function AddressDefaultIsAlreadyWasInThisStatus();

    public function AddressCantSeeByYou();

}