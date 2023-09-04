<?php

use Tests\TestCaseAuth;
use Auth\Support\AuthMessage;

class SendOTPLimitationTest extends TestCaseAuth
{
    public function testSendOTPLimitation()
    {
        // Create User
        $user = $this->createNewUser('123456789', '+971');

        // Set Config
        config(['auth_config.otp_send_request_limit_time' => 1]); // 1 minutes
        config(['auth_config.otp_send_request_limit_count' => 2]); // 2 times

        // Send Request 1
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response 1
        $response->assertSessionHasNoErrors();

        // Send Request 2
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);
        // Check Response 2
        $response->assertSessionHasNoErrors();

        // Send Request 3
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response 3
        $response->assertSessionHasErrors(['message' => AuthMessage::$OTPSendRequestLimitExceeded]);
    }

    // Test Send OTP Limitation Reached Limitation And User Wait For 1 Minutes And Send Request Again
    public function testSendOTPLimitationAndAfterUserWaitCanTryAgain()
    {
        // Create User
        $user = $this->createNewUser('123456789', '+971');

        // Set Config
        config(['auth_config.otp_send_request_limit_time' => 1]); // 1 minutes
        config(['auth_config.otp_send_request_limit_count' => 2]); // 2 times

        // Send Request 1
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response 1
        $response->assertSessionHasNoErrors();

        // Send Request 2
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);
        // Check Response 2
        $response->assertSessionHasNoErrors();

        // Send Request 3
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response 3
        $response->assertSessionHasErrors(['message' => AuthMessage::$OTPSendRequestLimitExceeded]);

        // Set Now As 1 Minutes Later        
        $this->travel(1)->minutes();

        // Send Request 4
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response 4
        $response->assertSessionHasNoErrors();

    }

    
}
