<?php

namespace Animal\Http\Controller\Admin;

use Animal\Foundation\Service\AnimalService;

class AnimalAdminController
{
    public $service;

    public function __construct()
    {
        $this->service = (new AnimalService);
    }

    public function store()
    {
        // Check Animal Validation
        $data = $this->service->validation()->store(request()->all());

        // Run Service
        $this->service->admin()->store(auth()->user(), $data);

        // Throw Message
        $this->service->admin()->response()->AnimalStored();
    }

    public function update($Animal_id)
    {
        // Check Animal Validation
        $data = $this->service->validation()->update(request()->all(), $Animal_id);

        // Run Service
        $this->service->admin()->update($Animal_id, $data, auth()->user());

        // Throw Message
        $this->service->admin()->response()->AnimalUpdated();
    }

    public function delete($Animal_id)
    {
        // Initializing
        $user = auth()->user();

        // Run Service
        $this->service->admin()->delete($user, $Animal_id);

        // Throw Message
        $this->service->admin()->response()->AnimalDeleted();
    }

    public function show($Animal_id)
    {
        // Run Service
        $Animal = $this->service->admin()->show(auth()->user(), $Animal_id);

        // Transformer
        return $this->service->admin()->transformer()->show($Animal);
    }

    public function list()
    {
        // Initializing
        $user = auth()->user();

        // Prerequisite
        $limit = 10;
        $appends = ['creator'];

        // Throw Response
        return $this->service->admin()->list($user, $limit, $appends);
    }

}
