<?php

use Tests\TestCaseAuth;
use Auth\Support\AuthMessage;

class CheckOTPExpiredTest extends TestCaseAuth
{
    public function testSendOTPLimitation()
    {
        // Create User
        $user = $this->createNewUser('123456789', '+971');

        // Set Config
        config(['auth_config.otp_expired_time' => 120]); // 120 seconds

        // Send Request 1
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response 1
        $response->assertSessionHasNoErrors();

        // travel 121 seconds
        $this->travel(121)->seconds();

        // Send Request For Verify OTP
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'otp' => '123456',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['message' => AuthMessage::$OTPExpired]);
    }

}
