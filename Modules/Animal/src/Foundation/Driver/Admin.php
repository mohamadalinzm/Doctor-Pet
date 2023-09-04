<?php

namespace Animal\Foundation\Driver;

use Animal\AnimalInterface;
use Animal\Foundation\Abstraction\AnimalAbstract;
use Animal\Model\Animal;
use User\Model\User;

class Admin extends AnimalAbstract
{
    public function store($user, $data)
    {
        // Check Store Policy
        $this->policy()->create($user);

        // Attach Photo
        $image = $this->action()->upload($data['image']);
        $data = array_merge($data, ['image' => $image]);

        // Save And Retrieve Animal
        $data = array_merge($data, ['creator_id' => $user->id]);
        $Animal = $this->action()->store($data);

        // Run Event For Animal Generating
        $this->event()->create($user, $Animal);

        // Throw Response For Animal
        $this->response()->AnimalStored();
    }

    public function update($AnimalId, $data, $user)
    {
        // Check Is Animal Existed
        $Animal = $this->action()->fetch($AnimalId);

        // Check Animal Update Policy
        $this->policy()->update($user, $Animal);

        // Handle Image Updating
        $photo = $data['image'] ?? null;
        $image = $this->action()->handleImageUpdating($Animal, $photo);
        $data = $image ? array_merge($data, ['image' => $image]) : $data;

        // Update The Animal
        $this->action()->update($data, $AnimalId);

        // Run Animal Update Event
        $this->event()->update($user, $Animal);
    }

    public function delete($user, $AnimalId)
    {
        // Check Is Animal Existed
        $Animal = $this->action()->fetch($AnimalId);

        // Check Animal Delete Policy
        $this->policy()->delete($user, $Animal);

        // Delete The Animal
        $this->action()->delete($AnimalId);

        // Run Event Of Animal Deleted
        $this->event()->delete($user, $Animal);

        // Throw Animal Deleted Response
        $this->response()->AnimalDeleted();
    }

    public function show($user, $AnimalId)
    {
        // Check Is Animal Existed
        $Animal = $this->action()->fetch($AnimalId);

        // Check Animal Update Policy
        $this->policy()->show($user, $Animal);

        // Run Animal Update Event
        $this->event()->update($user, $Animal);

        // Throw Animal
        return $Animal;
    }

    public function list($user, $limit, $appends)
    {
        // List The Animals
        $Animals = $this->action()->list($appends, [], $limit);

        // Run Event That User Show Animal List
        $this->event()->list($user);

        // Throw Transformer For Animal
        return $this->transformer()->list($Animals);
    }
}