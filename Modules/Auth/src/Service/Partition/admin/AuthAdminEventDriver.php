<?php

namespace Auth\Service\Partition\admin;

use Auth\Service\AuthEventInterface;
use Auth\Service\Partition\admin\Event\AuthAdminFailedOtpEvent;
use Auth\Service\Partition\admin\Event\AuthAdminLoginEvent;
use Auth\Service\Partition\admin\Event\AuthAdminLogoutEvent;
use Auth\Service\Partition\admin\Event\AuthAdminOtpRequestEvent;
use Auth\Service\Partition\admin\Event\AuthAdminVerifyOtpEvent;
use Auth\Service\Partition\user\Event\AuthUserRegisterEvent;
use User\Model\User;

class AuthAdminEventDriver implements AuthEventInterface
{

    public function login(User $user)
    {
        event(new AuthAdminLoginEvent($user));
    }

    public function logout(User $user)
    {
        event(new AuthAdminLogoutEvent($user));
    }

    public function otpRequest(User $user)
    {
        event(new AuthAdminOtpRequestEvent($user));
    }

    public function verifyOtp(User $user)
    {
        event(new AuthAdminVerifyOtpEvent($user));
    }

    public function verifyFailed(User $user)
    {
        event(new AuthAdminFailedOtpEvent($user));
    }

    public function register(User $user)
    {
        return false;
    }
}
