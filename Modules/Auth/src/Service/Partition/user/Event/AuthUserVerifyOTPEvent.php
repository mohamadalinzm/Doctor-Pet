<?php
namespace Auth\Service\Partition\user\Event;

class AuthUserVerifyOTPEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}