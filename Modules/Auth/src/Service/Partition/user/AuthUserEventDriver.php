<?php

namespace Auth\Service\Partition\user;

use Auth\Service\AuthEventInterface;
use Auth\Service\Partition\user\Event\AuthUserLoginEvent;
use Auth\Service\Partition\user\Event\AuthUserLogoutEvent;
use Auth\Service\Partition\user\Event\AuthUserRegisterEvent;
use User\Model\User;

class AuthUserEventDriver implements AuthEventInterface
{

    public function login(User $user)
    {
        event(new AuthUserLoginEvent($user));
    }

    public function logout(User $user)
    {
        event(new AuthUserLogoutEvent($user));
    }

    public function register(User $user)
    {
        event(new AuthUserRegisterEvent($user));
    }

    public function otpRequest(User $user)
    {
        return false;
    }

    public function verifyOtp(User $user)
    {
        return false;
    }

    public function verifyFailed(User $user)
    {
        return false;
    }
}
