<?php
namespace Auth\Service\Partition\admin\Event;

class AuthAdminLoginEvent
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}