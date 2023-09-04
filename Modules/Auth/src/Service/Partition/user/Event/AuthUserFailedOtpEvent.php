<?php
namespace Auth\Service\Partition\user\Event;

class AuthUserFailedOtpEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}