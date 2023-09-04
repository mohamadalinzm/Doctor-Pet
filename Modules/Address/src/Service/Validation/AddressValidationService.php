<?php

namespace Address\Service\Validation;
use Address\Foundation\Service\AddressService;
use Address\Service\AddressResponseInterface;
use Address\Service\AddressValidationInterface;
use Address\Service\Validation\Resource\AddressListValidator;
use Address\Service\Validation\Resource\AddressStoreValidator;
use Address\Service\Validation\Resource\AddressUpdateValidator;

class AddressValidationService implements AddressValidationInterface
{

    public  $service;

    public function __construct()
    {
        $this->service = (new AddressService);
    }

    public function store($data)
    {
        $validator = AddressStoreValidator::check(request()->all());
        $errors = $validator->messages();
        if ($validator->fails()) {
             $this->service->response()->AddressValidationFailed($errors);
        }

        return $validator->getData();
    }

    public function update($data,$addressId)
    {
        $validator = AddressUpdateValidator::check($data);
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            $this->service->response()->AddressValidationFailed($errors);
        }

        return $validator->getData();
    }

    public function setAsDefault($data)
    {

        $validator = AddressUpdateValidator::check($data);
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            $this->service->response()->AddressValidationFailed($errors);
        }

        return $validator->getData();
    }

    public function list($data)
    {
        $validator = AddressListValidator::check($data);
        $errors = $validator->messages()->toArray();
        if ($validator->fails()) {
            $this->service->response()->AddressValidationFailed($errors);
        }

        return $validator->getData();
    }
}
