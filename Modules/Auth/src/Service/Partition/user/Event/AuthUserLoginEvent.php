<?php
namespace Auth\Service\Partition\user\Event;

class AuthUserLoginEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}