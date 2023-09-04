<?php

namespace Animal\Service;

interface AnimalResponseInterface
{
    public function AnimalAlreadyExisted();

    public function AnimalCantDeletedByYou();

    public function AnimalDeleted();

    public function AnimalValidationFailed($errors);

    public function AnimalStored();

    public function AnimalUpdated();

    public function AnimalSetDefault();

    public function AnimalNotFound();

    public function AnimalIsNotActive();

    public function AnimalOverLimitation();

    public function AnimalCantAlterByThisUser();

    public function AnimalDefaultIsAlreadyWasInThisStatus();

    public function AnimalCantSeeByYou();

}