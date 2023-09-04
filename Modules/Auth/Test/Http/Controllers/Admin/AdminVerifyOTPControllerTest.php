<?php

use Auth\Service\OTP\Contract\OTP;
use Auth\Support\AuthMessage;
use Tests\TestCaseAuth;

class AdminVerifyOTPControllerTest extends TestCaseAuth
{
    // Test Admin Can not Verify OTP When Admin Before Logged In
    public function testAdminVerifyOTPFormNotShowWhenAdminLoggedIn()
    {
        $this->adminLogin();
        $response = $this->post(route('admin.otp.verify.post'));
        $response->assertRedirect(route('admin.dashboard'));
    }

    // Test Verify OTP With Invalid Mobile (Required)
    public function testAdminLoginWithInvalidMobileRequired()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'mobile' => '',
        ]);
        $response->assertSessionHasErrors([
            'mobile' =>  'Mobile number is required',
        ]);
    }

    // Test Verify OTP With Invalid Mobile (Length)
    public function testAdminLoginWithInvalidMobileLength()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'mobile' => '0012345',
        ]);
        $response->assertSessionHasErrors([
            'mobile' =>  'Mobile number must be 11 characters',
        ]);
    }

    // Test Verify OTP With Invalid Mobile (Start With)
    public function testAdminLoginWithInvalidMobileStartWith()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'mobile' => '12345678901',
        ]);
        $response->assertSessionHasErrors([
            'mobile' =>  'Mobile number must begin with 00',
        ]);
    }


    // Test Verify OTP With Valid Mobile
    public function testAdminLoginWithValidMobile()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'mobile' => '00123456789',
        ]);
        $response->assertSessionDoesntHaveErrors(['mobile']);
    }


    // Test Verify OTP With Invalid OTP (Required)
    public function testAdminLoginWithInvalidOTPRequired()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'otp' => '',
            'mobile' => '00123456789',
        ]);
        $response->assertSessionHasErrors([
            'otp' =>  'OTP is required',
        ]);
    }

    // Test Verify OTP With Invalid OTP (Numeric)
    public function testAdminLoginWithInvalidOTPNumeric()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'otp' => '1234567890a',
            'mobile' => '00123456789',
        ]);
        $response->assertSessionHasErrors([
            'otp' =>  'OTP must be numeric',
        ]);
    }

    // Test Verify OTP With Invalid OTP (Min Length Is 6)
    public function testAdminLoginWithInvalidOTPMinLength()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'otp' => '123',
            'mobile' => '00123456789',
        ]);
        $response->assertSessionHasErrors([
            'otp' =>  'OTP must be between 6 to 10 digits',
        ]);
    }

    // Test Verify OTP With Invalid OTP (Max Length Is 10)
    public function testAdminLoginWithInvalidOTPMaxLength()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'otp' => '12345678901',
            'mobile' => '00123456789',
        ]);
        $response->assertSessionHasErrors([
            'otp' =>  'OTP must be between 6 to 10 digits',
        ]);
    }

    // Test Verify OTP With Valid OTP
    public function testAdminLoginWithValidOTP()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'otp' => '123456',
            'mobile' => '00123456789',
        ]);
        $response->assertSessionDoesntHaveErrors(['otp']);
    }


    // Test Verify OTP With Valid Mobile Number But Admin Not Found
    public function testAdminLoginWithValidMobileNumberButAdminNotFound()
    {
        $response = $this->post(route('admin.otp.verify.post'), [
            'mobile' => '00123456789',
            'otp' => '123456',
        ]);
        $response->assertSessionHasErrors([
            'message' => AuthMessage::$adminNotFound,
        ]);
    }

    // Test Verify OTP With Valid Mobile Number And Admin Found
    public function testAdminLoginWithValidMobileNumberAndAdminFound()
    {
        $this->createNewAdmin('00123456789');
        $response = $this->post(route('admin.otp.verify.post'), [
            'mobile' => '00123456789',
            'otp' => '123456',
        ]);
        $response->assertSessionDoesntHaveErrors(['message' => AuthMessage::$adminNotFound]);
    }

    // Test Verify OTP With Valid Mobile Number And Admin Found And OTP Verification Failed
    public function testAdminLoginWithValidMobileNumberAndAdminFoundAndOTPVerificationFailed()
    {
        $admin = $this->createNewAdmin('00123456789');

        // Mock OTP Verification
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startVerifyOTPProcess')->once()->with($admin->mobile, '1234567')->andReturnSelf();
        $mock->shouldReceive('verifyIsSuccess')->once()->andReturn(false);
        $mock->shouldReceive('getMessage')->once()->andReturn('OTP Verification Failed');
        $this->app->instance(OTP::class, $mock);

        $response = $this->post(route('admin.otp.verify.post'), [
            'mobile' => '00123456789',
            'otp' => '1234567',
        ]);
        $response->assertSessionHasErrors([
            'message' => 'OTP Verification Failed'
        ]);
    }


    // Test Verify OTP With Valid Mobile Number And Admin Found And OTP Verification Success
    public function testAdminLoginWithValidMobileNumberAndAdminFoundAndOTPVerificationSuccess()
    {
        $admin = $this->createNewAdmin('00123456789');

        // Mock OTP Verification
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startVerifyOTPProcess')->once()->with($admin->mobile, '123456')->andReturnSelf();
        $mock->shouldReceive('verifyIsSuccess')->once()->andReturn(true);
        $mock->shouldReceive('getMessage')->never();
        $this->app->instance(OTP::class, $mock);

        $response = $this->post(route('admin.otp.verify.post'), [
            'mobile' => '00123456789',
            'otp' => '123456',
        ]);
        $response->assertSessionDoesntHaveErrors(['message']);
    }

    // Test Verify OTP With Valid Mobile Number And Admin Found And OTP Verification Success And Admin Logged In
    public function testAdminLoginWithValidMobileNumberAndAdminFoundAndOTPVerificationSuccessAndAdminLoggedIn()
    {
        $admin = $this->createNewAdmin('00123456789');

        // Mock OTP Verification
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startVerifyOTPProcess')->once()->with($admin->mobile, '123456')->andReturnSelf();
        $mock->shouldReceive('verifyIsSuccess')->once()->andReturn(true);
        $mock->shouldReceive('getMessage')->never();
        $this->app->instance(OTP::class, $mock);

        $response = $this->post(route('admin.otp.verify.post'), [
            'mobile' => '00123456789',
            'otp' => '123456',
        ]);
        $response->assertSessionDoesntHaveErrors(['message']);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));

        $response->assertSessionHas('notification');
        $notification = session('notification');
        $this->assertEquals('success', $notification['alert-type']);
        $this->assertEquals(AuthMessage::$loginSuccess, $notification['message']);
    }
}
