<?php
namespace Auth\Service\Partition\admin\Event;

class AuthAdminOtpRequestEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}