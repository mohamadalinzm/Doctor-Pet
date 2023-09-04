<?php

use Auth\Service\OTP\Contract\OTP;
use Auth\Support\AuthMessage;
use Tests\TestCaseAuth;

class AdminLoginControllerTest extends TestCaseAuth
{

    // Test Admin Can not Login Again When Admin Before Logged In
    public function testAdminLoginFormNotShowWhenAdminLoggedIn()
    {
        $this->adminLogin();
        $response = $this->post(route('admin.login.post'));
        $response->assertRedirect(route('admin.dashboard'));
    }

    // Test Login With Invalid Mobile Number (Length)
    public function testLoginWithInvalidMobileNumberLength()
    {
        $response = $this->post(route('admin.login.post'), [
            'mobile' => '00123456',
        ]);
        $response->assertSessionHasErrors([
            'mobile' =>  'Mobile number must be 11 characters',
        ]);
    }

    // Test Login With Invalid Mobile Number (Start With)
    public function testAdminLoginWithInvalidMobileStartWith()
    {
        $response = $this->post(route('admin.login.post'), [
            'mobile' => '12345678901',
        ]);
        $response->assertSessionHasErrors([
            'mobile' =>  'Mobile number must begin with 00',
        ]);
    }

    // Test Login With Invalid Mobile Number (Required)
    public function testAdminLoginWithInvalidMobileRequired()
    {
        $response = $this->post(route('admin.login.post'), [
            'mobile' => '',
        ]);
        $response->assertSessionHasErrors([
            'mobile' =>  'Mobile number is required',
        ]);
    }

    // Test Login With Valid Mobile Number
    public function testAdminLoginWithValidMobile()
    {
        $response = $this->post(route('admin.login.post'), [
            'mobile' => '00123456789',
        ]);
        $response->assertSessionDoesntHaveErrors(['mobile']);
    }

    // Test Login With Valid Mobile Number And Admin Not Found
    public function testAdminLoginWithValidMobileAndAdminNotFound()
    {
        $response = $this->post(route('admin.login.post'), [
            'mobile' => '00123456789',
        ]);
        $response->assertSessionDoesntHaveErrors('mobile');
        $response->assertSessionHasErrors(['message' => AuthMessage::$adminNotFound]);
    }


    // Test Login With Valid Mobile Number And Send OTP Success
    public function testAdminLoginWithValidMobileAndSendOTPSuccess()
    {
        $admin = $this->createNewAdmin('00123456789');

        // Mock OTP Abstract Class
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startSendOTPProcess')->once()->with($admin->mobile)->andReturnSelf();
        $mock->shouldReceive('sendIsSuccess')->once()->andReturn(true);
        $this->app->instance(OTP::class, $mock);

        $response = $this->post(route('admin.login.post'), [
            'mobile' => '00123456789',
        ]);

        $response->assertSessionDoesntHaveErrors('mobile');
        $response->assertSessionDoesntHaveErrors(['message' => AuthMessage::$adminNotFound]);

        // assert Redirect To OTP Page
        $response->assertRedirect(route('admin.login', ['otp' => 'success', 'mobile' => '00123456789']));

        // assert Session Has OTP Success Message 
        $response->assertSessionHas('notification');

        // Get Session Notification
        $notification = session('notification');


        // Assert Notification Type
        $this->assertEquals($notification['alert-type'], 'success');

        // Assert Notification Message
        $this->assertEquals($notification['message'], AuthMessage::$sentOTPToYourMobileSuccessfully);
    }

    // Test Login With Valid Mobile Number And Send OTP Failed
    public function testAdminLoginWithValidMobileAndSendOTPFailed()
    {
        $admin = $this->createNewAdmin('00123456789');

        // Mock OTP Abstract Class
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startSendOTPProcess')->once()->with($admin->mobile)->andReturnSelf();
        $mock->shouldReceive('sendIsSuccess')->once()->andReturn(false);
        $mock->shouldReceive('getMessage')->once()->andReturn('Error Message');
        $this->app->instance(OTP::class, $mock);

        $response = $this->post(route('admin.login.post'), [
            'mobile' => '00123456789',
        ], ['HTTP_REFERER' => route('admin.login')]);

        $response->assertSessionDoesntHaveErrors('mobile');
        $response->assertSessionDoesntHaveErrors(['message' => AuthMessage::$adminNotFound]);
        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHasErrors(['message' => 'Error Message']);
    }
}
