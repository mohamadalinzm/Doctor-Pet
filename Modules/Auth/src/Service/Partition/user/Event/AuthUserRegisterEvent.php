<?php
namespace Auth\Service\Partition\user\Event;

class AuthUserRegisterEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}