<?php

namespace Auth\Service;

use User\Model\User;

interface AuthEventInterface
{
    public function login(User $user);

    public function logout(User $user);

    public function register(User $user);

    public function otpRequest(User $user);

    public function verifyOtp(User $user);

    public function verifyFailed(User $user);

}
