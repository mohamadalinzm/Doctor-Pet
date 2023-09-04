<?php
namespace Auth\Service\Partition\admin\Event;

class AuthAdminLogoutEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}