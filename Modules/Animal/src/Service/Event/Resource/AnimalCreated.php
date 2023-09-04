<?php

namespace Animal\Service\Event\Resource;

use Animal\Model\Animal;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use User\Model\User;

class AnimalCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public Animal $Animal;

    public function __construct(User $user,Animal $Animal)
    {
        $this->user = $user;
        $this->Animal = $Animal;
    }
}
