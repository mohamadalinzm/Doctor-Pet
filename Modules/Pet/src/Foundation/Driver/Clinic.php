<?php

namespace Pet\Foundation\Driver;

use Pet\PetInterface;
use Pet\Foundation\Abstraction\PetAbstract;
use Pet\Model\Pet;
use User\Model\User;

class Clinic extends PetAbstract
{
    public function store($user)
    {
        // Check Pet Validation
        $data = $this->validation()->store(request()->all());

        // Check Store Policy
        $this->policy()->create($user);

        // Save And Retrieve Pet
        $Pet = $this->action()->store($data, $user);

        // Run Event For Pet Generating
        $this->event()->create($user, $Pet);
    }

    public function update($user, $PetId)
    {
        // Check Pet Validation For Update
        $data = $this->validation()->update(request()->all(), $PetId);

        // Check Is Pet Existed
        $Pet = $this->action()->fetch($PetId);

        // Check Pet Update Policy
        $this->policy()->update($user, $Pet);

        // Update The Pet
        $this->action()->update($data, $PetId);

        // Run Pet Update Event
        $this->event()->update($user, $Pet);
    }

    public function delete($user, $PetId)
    {
        // Check Is Pet Existed
        $Pet = $this->action()->fetch($PetId);

        // Check Pet Delete Policy
        $this->policy()->delete($user, $Pet);

        // Delete The Pet
        $this->action()->delete($PetId);

        // Run Event Of Pet Deleted
        $this->event()->delete($user, $Pet);
    }

    public function show($user, $PetId)
    {
        // Check Is Pet Existed
        $Pet = $this->action()->fetch($PetId);

        // Check Pet Update Policy
        $this->policy()->show($user, $Pet);

        // Run Pet Update Event
        $this->event()->update($user, $Pet);
    }

    public function list($user, $limit, $appends)
    {
        // List The Petes
        $Petes = $this->action()->list($user, $appends, [], $limit);

        // Run Event That User Show Pet List
        $this->event()->list($user);
    }
}