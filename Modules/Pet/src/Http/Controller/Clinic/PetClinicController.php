<?php

namespace Pet\Http\Controller\Clinic;

use Pet\Foundation\Service\PetService;

class PetClinicController
{
    public $service;

    public function __construct()
    {
        $this->service = (new PetService);
    }

    public function store()
    {
        $this->service->costumer()->store(auth()->user());
    }

    public function update($PetId)
    {
        $this->service->costumer()->update(auth()->user(),$PetId);
    }

    public function delete($PetId)
    {
        $this->service->costumer()->delete(auth()->user(),$PetId);
    }

    public function show($PetId)
    {
        return $this->service->costumer()->show(auth()->user(),$PetId);
    }

    public function list()
    {
        $limit = 5;
        $appends = ['user','city','province'];
        return $this->service->costumer()->list(auth()->user(),$limit,$appends);
    }

}
