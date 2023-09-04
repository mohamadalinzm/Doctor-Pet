<?php

namespace Pet\Service\Validation;
use Pet\Foundation\Service\PetService;
use Pet\Service\PetResponseInterface;
use Pet\Service\PetValidationInterface;
use Pet\Service\Validation\Resource\PetListValidator;
use Pet\Service\Validation\Resource\PetStoreValidator;
use Pet\Service\Validation\Resource\PetUpdateValidator;

class PetValidationService implements PetValidationInterface
{

    public  $service;

    public function __construct()
    {
        $this->service = (new PetService);
    }

    public function store($data)
    {
        $validator = PetStoreValidator::check(request()->all());
        $errors = $validator->messages();
        if ($validator->fails()) {
             $this->service->response()->PetValidationFailed($errors);
        }

        return $validator->getData();
    }

    public function update($data,$PetId)
    {
        $validator = PetUpdateValidator::check($data);
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            $this->service->response()->PetValidationFailed($errors);
        }

        return $validator->getData();
    }

    public function list($data)
    {
        $validator = PetListValidator::check($data);
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            $this->service->response()->PetValidationFailed($errors);
        }

        return $validator->getData();
    }
}
