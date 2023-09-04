<?php
namespace Auth\OTP\Provider;

use Auth\OTP\Contract\OTP;
use Twilio\Exceptions\TwilioException;

class OTPTwilioProvider extends OTP
{
    protected function sendOTP($mobile): int
    {
        try {
            app('twilioClient')->verifications->create($mobile, 'sms', ['locale' => 'en']);
            return self::OTP_SENT_SUCCESSFULLY;
        } catch (TwilioException $e) {
            return self::OTP_PROVIDER_THROWS_EXCEPTION;
        }
    }

    protected function verifyOTP($mobile, $otp): int
    {
        try {
            $verification = app('twilioClient')->verificationChecks->create(['code' => $otp, 'to' => $mobile]);
            return $verification->valid === true ? self::OTP_VERIFIED_SUCCESSFULLY : self::OTP_VERIFIED_FAILED;
        } catch (TwilioException $e) {
            return self::OTP_PROVIDER_THROWS_EXCEPTION;
        }
    }
}
