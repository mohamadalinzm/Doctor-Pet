<?php
namespace Auth\OTP\Provider;

use Auth\OTP\Contract\OTP;
use Exception;

class OTPFakeProvider extends OTP
{
    protected function sendOTP($mobile): int
    {
        file_put_contents(storage_path('otp.json'), json_encode([$mobile => rand(100000, 999999)]));
        return self::OTP_SENT_SUCCESSFULLY;
    }

    protected function verifyOTP($mobile, $otp): int
    {
        try {
            $otpData  = file_get_contents(storage_path('otp.json'));
            $otpData = json_decode($otpData, true);
            if ($otpData[$mobile] == $otp) {
                return self::OTP_VERIFIED_SUCCESSFULLY;
            }
            return self::OTP_VERIFIED_FAILED;
        } catch (Exception $e) {
            return self::OTP_PROVIDER_THROWS_EXCEPTION;
        }
    }
}
