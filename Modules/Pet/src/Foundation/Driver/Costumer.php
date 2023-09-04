<?php

namespace Pet\Foundation\Driver;

use Pet\PetInterface;
use Pet\Foundation\Abstraction\PetAbstract;
use Pet\Model\Pet;
use User\Model\User;

class Costumer extends PetAbstract
{
    public function store($user, $data)
    {
        // Check Store Policy
        $this->policy()->create($user);

        // Attach Photo
        $image = $this->action()->upload($data['avatar']);
        $data = array_merge($data, ['avatar' => $image]);

        // Save And Retrieve Pet
        $data = array_merge($data, ['user_id' => $user->id]);
        $Pet = $this->action()->store($data);

        // Run Event For Pet Generating
        $this->event()->create($user, $Pet);

        // Throw Response For Pet
        $this->response()->PetStored();
    }

    public function update($PetId, $data, $user)
    {
        // Check Is Pet Existed
        $Pet = $this->action()->fetch($PetId);

        // Check Pet Update Policy
        $this->policy()->update($user, $Pet);

        // Handle Image Updating
        $photo = $data['avatar'] ?? null;
        $image = $this->action()->handleImageUpdating($Pet, $photo);
        $data = $image ? array_merge($data, ['avatar' => $image]) : $data;

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

        // Throw Pet Deleted Response
        $this->response()->PetDeleted();
    }

    public function show($user, $PetId)
    {
        // Check Is Pet Existed
        $Pet = $this->action()->fetch($PetId);

        // Check Pet Update Policy
        $this->policy()->show($user, $Pet);

        // Run Pet Update Event
        $this->event()->update($user, $Pet);

        // Throw Pet
        return $Pet;
    }

    public function list($user, $limit, $appends)
    {
        // List The Pets
        $Pets = $this->action()->list($appends, [],$limit,[],$user->id);

        // Run Event That User Show Pet List
        $this->event()->list($user);

        // Throw Transformer For Pet
        return $this->transformer()->list($Pets);
    }
}