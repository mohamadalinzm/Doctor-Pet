<?php

namespace Animal\Service\Validation;
use Animal\Foundation\Service\AnimalService;
use Animal\Service\AnimalResponseInterface;
use Animal\Service\AnimalValidationInterface;
use Animal\Service\Validation\Resource\AnimalListValidator;
use Animal\Service\Validation\Resource\AnimalStoreValidator;
use Animal\Service\Validation\Resource\AnimalUpdateValidator;

class AnimalValidationService implements AnimalValidationInterface
{

    public  $service;

    public function __construct()
    {
        $this->service = (new AnimalService);
    }

    public function store($data)
    {
        $validator = AnimalStoreValidator::check(request()->all());
        $errors = $validator->messages();
        if ($validator->fails()) {
             $this->service->response()->AnimalValidationFailed($errors);
        }

        return $validator->getData();
    }

    public function update($data,$AnimalId)
    {
        $validator = AnimalUpdateValidator::check($data,$AnimalId);
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            $this->service->response()->AnimalValidationFailed($errors);
        }

        return $validator->getData();
    }

    public function list($data)
    {
        $validator = AnimalListValidator::check($data);
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            $this->service->response()->AnimalValidationFailed($errors);
        }

        return $validator->getData();
    }
}
