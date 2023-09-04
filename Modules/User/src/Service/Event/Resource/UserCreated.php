<?php

namespace User\Service\Event\Resource;

use Address\Model\Address;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct($user,Address $address)
    {
        $this->user = $user;
        $this->address = $address;
    }
}
