<?php

namespace Auth\Support;

use User\Model\User;

class AuthHelper
{

    public static function noPrefix(string $mobile, string $prefix = '00'): string
    {
        $prefixLength = strlen($prefix);

        if (substr($mobile, 0, $prefixLength) === $prefix) {
            $mobile = substr($mobile, $prefixLength);
        }

        return $mobile;
    }


    public static function fakeLogin()
    {
        $secret = config('auth_config.fake_login_secret_code');
        $header = request()->header('auto-login-secret');

        if (app()->environment(['local', 'testing']) && $header === $secret) {
            $loginAdminId = request()->header('auto-login-id');

            if ($loginAdminId) {
                $user = User::find($loginAdminId);
                if ($user) {
                    auth()->login($user);
                    return redirect('/admin/dashboard')->throwResponse();
                }
            }
        }

        return false;
    }

    public static function withCountryCode($mobile)
    {
        return config('auth_config.default_mobile_country_code').$mobile;
    }
}
