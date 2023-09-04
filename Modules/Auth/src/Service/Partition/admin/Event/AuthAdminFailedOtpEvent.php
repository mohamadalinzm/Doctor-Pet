<?php
namespace Auth\Service\Partition\admin\Event;

class AuthAdminFailedOtpEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}