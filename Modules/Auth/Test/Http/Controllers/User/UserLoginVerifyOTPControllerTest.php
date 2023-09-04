<?php

use Auth\Service\OTP\Contract\OTP;
use Auth\Support\AuthMessage;
use Tests\TestCaseAuth;

class UserLoginVerifyOTPControllerTest extends TestCaseAuth
{
    // Test Authorize User Not Allowed To Access This Route
    public function testAuthorizeUserNotAllowedToAccessThisRoute()
    {
        // Login User
        $this->userLogin();

        // Call Route
        $response = $this->post(route('login.verify-otp.post'));

        // Check Response
        $response->assertRedirect('/user/dashboard');
    }

    // Test Verify OTP With Invalid Data(Mobile Is Empty)
    public function testVerifyOTPWithInvalidDataMobileIsEmpty()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'mobile' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Verify OTP With Invalid Data(Mobile Is Not Digits)
    public function testVerifyOTPWithInvalidDataMobileIsNotDigits()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'mobile' => 'abc',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Verify OTP With Invalid Data Mobile Length(Mobile Length Is 9 To 12 )
    public function testVerifyOTPWithInvalidDataMobileLength()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'mobile' => '123456',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);

        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'mobile' => '12345678912345',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Verify OTP With Invalid Data(Country Code Is Empty)
    public function testVerifyOTPWithInvalidDataCountryCodeIsEmpty()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['country_code']);
    }

    // Test Verify OTP With Invalid Data(Country Code Is Not In Allow Country Codes)
    public function testVerifyOTPWithInvalidDataCountryCodeIsNotInAllowCountryCodes()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '123',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['country_code']);
    }

    // Test Verify OTP With Invalid Data(OTP Is Empty)
    public function testVerifyOTPWithInvalidDataOTPIsEmpty()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'otp' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['otp']);
    }

    // Test Verify OTP With Invalid Data(OTP Is Not Digits)
    public function testVerifyOTPWithInvalidDataOTPIsNotDigits()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'otp' => 'abc',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['otp']);
    }

    // Test Verify OTP With Invalid Data(OTP Min 6 Digits)
    public function testVerifyOTPWithInvalidDataOTPMin6Digits()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'otp' => '12345',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['otp']);
    }

    // Test Verify OTP With Invalid Data(OTP Max 10 Digits)
    public function testVerifyOTPWithInvalidDataOTPMax10Digits()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'otp' => '12345678901',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['otp']);
    }

    // Test Verify OTP With Valid Data
    public function testVerifyOTPWithValidData()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'otp' => '123456',
        ]);

        // Check Response
        $response->assertSessionDoesntHaveErrors(['country_code', 'mobile', 'otp']);
    }


    // Test Verify OTP With Valid Data But User Not Found
    public function testVerifyOTPWithValidDataButUserNotFound()
    {
        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'otp' => '123456',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['message' => AuthMessage::$userNotFound]);
    }

    // Test Verify OTP With Valid Data And User Found But OTP Verification Failed
    public function testVerifyOTPWithValidDataAndUserFoundButOTPVerificationFailed()
    {
        $this->createNewUser('123456789', '+971');

        // Mock OTP Verification Failed
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startVerifyOTPProcess')->once()->with('+971123456789', '123456')->andReturnSelf();
        $mock->shouldReceive('verifyIsSuccess')->once()->andReturn(false);
        $mock->shouldReceive('getMessage')->once()->andReturn('OTP Verification Failed');
        $this->app->instance(OTP::class, $mock);


        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'otp' => '123456',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['message' => 'OTP Verification Failed']);
    }

    // Test Verify OTP With Valid Data And User Found And OTP Verification Success And Login User And Redirect To Dashboard
    public function testVerifyOTPWithValidDataAndUserFoundAndOTPVerificationSuccess()
    {
        $this->createNewUser('123456789', '+971');

        // Mock OTP Verification Success
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startVerifyOTPProcess')->once()->with('+971123456789', '123456')->andReturnSelf();
        $mock->shouldReceive('verifyIsSuccess')->once()->andReturn(true);
        $mock->shouldReceive('getMessage')->never();
        $this->app->instance(OTP::class, $mock);

        // Call Route
        $response = $this->post(route('login.verify-otp.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'otp' => '123456',
        ]);

        // Check Response
        $response->assertSessionDoesntHaveErrors(['message']);
        $response->assertRedirect(route('user.dashboard'));
        $response->assertSessionHas('notification');
        $notification = $response->getSession()->get('notification');
        $this->assertEquals($notification['alert-type'], 'success');
        $this->assertEquals($notification['message'], AuthMessage::$loginSuccess);

        // Check User Logged In
        $this->assertAuthenticated();
    }
}
