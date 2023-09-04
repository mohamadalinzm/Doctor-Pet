<?php
namespace Auth\Service\Partition\user\Event;

class AuthUserLogoutEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}