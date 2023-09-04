<?php

namespace Pet\Http\Controller\Costumer;

use Pet\Foundation\Service\PetService;

class PetCostumerController
{
    public $service;

    public function __construct()
    {
        $this->service = (new PetService);
    }

    public function store()
    {
        // Check Pet Validation
        $data = $this->service->validation()->store(request()->all());

        // Run Service
        $this->service->costumer()->store(auth()->user(), $data);

        // Throw Message
        $this->service->costumer()->response()->PetStored();
    }

    public function update($pet_id)
    {
        // Check Pet Validation
        $data = $this->service->validation()->update(request()->all(), $pet_id);

        // Run Service
        $this->service->costumer()->update($pet_id, $data, auth()->user());

        // Throw Message
        $this->service->costumer()->response()->PetUpdated();
    }

    public function delete($pet_id)
    {
        // Initializing
        $user = auth()->user();

        // Run Service
        $this->service->costumer()->delete($user, $pet_id);

        // Throw Message
        $this->service->costumer()->response()->PetDeleted();
    }

    public function show($pet_id)
    {
        // Run Service
        $Pet = $this->service->costumer()->show(auth()->user(), $pet_id);

        // Transformer
        return $this->service->costumer()->transformer()->show($Pet);
    }

    public function list()
    {
        // Initializing
        $user = auth()->user();

        // Prerequisite
        $limit = 10;
        $appends = ['animal', 'user'];

        // Throw Response
        return $this->service->costumer()->list($user, $limit, $appends);
    }

}
