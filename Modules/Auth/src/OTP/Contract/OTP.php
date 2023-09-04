<?php

namespace Auth\OTP\Contract;

use Auth\Support\AuthMessage;
use Illuminate\Support\Facades\Cache;

abstract class OTP
{
    public $status;

    /**
     * otp result status
     */
    const OTP_SENT_SUCCESSFULLY = 1;
    const OTP_SENT_REQUEST_LIMIT_EXCEEDED = 2;
    const OTP_VERIFIED_SUCCESSFULLY = 3;
    const OTP_VERIFIED_FAILED = 4;
    const OTP_PROVIDER_THROWS_EXCEPTION = 5;
    const OTP_EXPIRED = 6;


    // All OTP Providers Must Implement This Method
    abstract protected function sendOTP($mobile);

    // All OTP Providers Must Implement This Method and return value is  OTP_SENT_SUCCESSFULLY , ...
    abstract protected function verifyOTP($mobile, $otp);


    // Runner For Verify OTP
    public function startVerifyOTPProcess($mobile, $otp)
    {
        if ($this->OTPIsExpired($mobile)) {
            $this->status = self::OTP_EXPIRED;
        } else {
            $this->status = $this->verifyOTP($mobile, $otp);
        }
        return $this;
    }

    // Runner For Send OTP
    public function startSendOTPProcess($mobile)
    {
        if ($this->executionLimitReached($mobile) == false) {
            $this->status = $this->sendOTP($mobile);
            $this->storeTimeSendOTP($mobile);
        } else {
            $this->status = self::OTP_SENT_REQUEST_LIMIT_EXCEEDED;
        }
        return $this;
    }

    // Save Time that OTP Sent - This Method Used For Check OTP Expired Or Not
    public function storeTimeSendOTP($mobile)
    {
        $key = config('app.name') . '_otp_sent_time_' . $mobile;
        $cacheExpireTime = config('auth_config.otp_expired_time') + 10;
        Cache::put($key, now()->timestamp, $cacheExpireTime);
    }

    public function OTPIsExpired($mobile)
    {
        $key = config('app.name') . '_otp_sent_time_' . $mobile;
        if (Cache::has($key)) {
            $time = Cache::get($key);
            if (now()->timestamp - $time > config('auth_config.otp_expired_time')) {
                return true;
            }else{
                return false;
            }
        }
        return true;
    }
    // Check OTP Send Successfully
    public function sendIsSuccess()
    {
        return $this->status == self::OTP_SENT_SUCCESSFULLY;
    }

    // Check OTP Verify Successfully
    public function verifyIsSuccess()
    {
        return $this->status == self::OTP_VERIFIED_SUCCESSFULLY;
    }



    // Get message for status
    public function getMessage()
    {
        switch ($this->status) {
            case self::OTP_SENT_SUCCESSFULLY:
                return AuthMessage::$sentOTPToYourMobileSuccessfully;
            case self::OTP_SENT_REQUEST_LIMIT_EXCEEDED:
                return AuthMessage::$OTPSendRequestLimitExceeded;
            case self::OTP_VERIFIED_SUCCESSFULLY:
                return AuthMessage::$OTPVerifiedSuccessfully;
            case self::OTP_VERIFIED_FAILED:
                return AuthMessage::$wrongOTP;
            case self::OTP_PROVIDER_THROWS_EXCEPTION:
                return AuthMessage::$OTPProviderThrowException;
            case self::OTP_EXPIRED:
                return AuthMessage::$OTPExpired;
            default:
                return AuthMessage::$loginFailed;
        }
    }

    // Check Execution Limit For Send OTP
    protected function executionLimitReached($mobile)
    {
        $minutes = config('auth_config.otp_send_request_limit_time');
        $limit = config('auth_config.otp_send_request_limit_count');
        $key = config('app.name') . '-otp_send_request_limit_' . $mobile;
        if (Cache::has($key)) {
            $count = Cache::get($key);
            if ($count >= $limit) {
                return true;
            } else {
                Cache::increment($key);
                return false;
            }
        } else {
            Cache::put($key, 1, now()->addMinutes($minutes));
            return false;
        }
    }
}
