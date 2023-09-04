<?php

namespace User\Service\Event\Resource;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use User\Model\User;

class UserUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
