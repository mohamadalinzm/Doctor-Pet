<?php

namespace Auth\Service;

use Illuminate\Support\Collection;
use User\Model\User;

interface AuthViewInterface
{
    public function login(Collection $data);

    public function register(array $data);

    public function otp(User $user);
}
