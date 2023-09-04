<?php

namespace Pet\Service\Event\Resource;

use Pet\Model\Pet;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use User\Model\User;

class PetUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public Pet $Pet;

    public function __construct(User $user,Pet $Pet)
    {
        $this->user = $user;
        $this->Pet = $Pet;
    }
}
