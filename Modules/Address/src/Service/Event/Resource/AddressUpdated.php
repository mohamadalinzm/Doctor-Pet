<?php

namespace Address\Service\Event\Resource;

use Address\Model\Address;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use User\Model\User;

class AddressUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public Address $address;

    public function __construct(User $user,Address $address)
    {
        $this->user = $user;
        $this->address = $address;
    }
}
