<?php

namespace Pet\Service;

interface PetResponseInterface
{
    public function PetAlreadyExisted();

    public function PetCantDeletedByYou();

    public function PetDeleted();

    public function PetValidationFailed($errors);

    public function PetStored();

    public function PetUpdated();

    public function PetSetDefault();

    public function PetNotFound();

    public function PetIsNotActive();

    public function PetOverLimitation();

    public function PetCantAlterByThisUser();

    public function PetDefaultIsAlreadyWasInThisStatus();

    public function PetCantSeeByYou();

}