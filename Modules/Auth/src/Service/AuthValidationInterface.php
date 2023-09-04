<?php

namespace Auth\Service;

interface AuthValidationInterface
{

    public function mobile(array $data);

    public function otp(array $data);

    public function login(array $data , $recaptcha);

    public function register(array $data);

    public function token(array $data);
}
