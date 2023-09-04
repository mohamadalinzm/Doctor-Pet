<?php
namespace Auth\Service\Partition\admin\Event;

class AuthAdminVerifyOtpEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}