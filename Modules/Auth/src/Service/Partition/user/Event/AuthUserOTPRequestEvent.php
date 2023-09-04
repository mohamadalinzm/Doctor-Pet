<?php
namespace Auth\Service\Partition\user\Event;

class AuthUserOTPRequestEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}