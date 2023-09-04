<?php

namespace Address\Http\Controller;

use Address\Foundation\Service\AddressService;

class AddressController
{
    public $service;

    public function __construct()
    {
        $this->service = (new AddressService);
    }

    public function store()
    {
        $this->service->costumer()->store(auth()->user());
    }

    public function update($addressId)
    {
        $this->service->costumer()->update(auth()->user(),$addressId);
    }

    public function delete($addressId)
    {
        $this->service->costumer()->delete(auth()->user(),$addressId);
    }

    public function show($addressId)
    {
        return $this->service->costumer()->show(auth()->user(),$addressId);
    }

    public function list()
    {
        $limit = 5;
        $appends = ['user','city','province'];
        return $this->service->costumer()->list(auth()->user(),$limit,$appends);
    }

}
