<?php
namespace Auth\Support;

class MobileHelper
{
    // remove prefix from the beginning of the mobile number
    public static function getMobileWithoutPrefix($mobile, $prefix = '00')
    {
        if (substr($mobile, 0, strlen($prefix)) === $prefix) {
            $mobile = substr($mobile, strlen($prefix));
        }
        return $mobile;
    }

    public static function getMobileWithCountryCode($mobile)
    {
        return config('auth_config.default_mobile_country_code').$mobile;
    }
}
