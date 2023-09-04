<?php

use Auth\Service\OTP\Contract\OTP;
use Auth\Support\AuthMessage;
use Tests\TestCaseAuth;

class UserLoginControllerTest extends TestCaseAuth
{
    // Test Login User Not Access To Login Operation When Authenticated
    public function testLoginUserNotAccessToLoginOperationWhenAuthenticated()
    {
        // Login User
        $this->userLogin();

        // Send Request
        $response = $this->post(route('login.mobile.post'));

        // Check Response
        $response->assertRedirect('/user/dashboard');
    }

    // Test Login Method With Invalid Data(country_code is empty)
    public function testLoginMethodWithInvalidDataCountryCodeIsEmpty()
    {
        // Send Request
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['country_code']);
    }

    // Test Login Method With Invalid Data(country_code is not in allow_country_codes)
    public function testLoginMethodWithInvalidDataCountryCodeIsNotInAllowCountryCodes()
    {
        // Send Request
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '123',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['country_code']);
    }

    // Test Login Method With Invalid Data(mobile is empty)
    public function testLoginMethodWithInvalidDataMobileIsEmpty()
    {
        // Send Request
        $response = $this->post(route('login.mobile.post'), [
            'mobile' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Login Method With Invalid Data Mobile Length(mobile length is 9 to 12 )
    public function testLoginMethodWithInvalidDataMobileLength()
    {
        // Send Request
        $response = $this->post(route('login.mobile.post'), [
            'mobile' => '1234567',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);

        // Send Request
           $response = $this->post(route('login.mobile.post'), [
            'mobile' => '1234567890123',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Login Method With Valid Data
    public function testLoginMethodWithValidData()
    {
        // Send Request
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response
        $response->assertSessionDoesntHaveErrors(['mobile', 'country_code']);
    }

    // Test Login Method With Valid Data But User Not Found
    public function testLoginMethodWithValidDataButUserNotFound()
    {
        // Send Request
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['message' => AuthMessage::$userNotFound]);
    }

    // Test Login Method With Valid Data And User Found But OTP Send Failed
    public function testLoginMethodWithValidDataAndUserFoundButOTPSendFailed()
    {
        // Create User
        $user = $this->createNewUser('123456789', '+971');

        // Mock OTP Send Failed
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startSendOTPProcess')->once()->with('+971123456789')->andReturnSelf();
        $mock->shouldReceive('sendIsSuccess')->once()->andReturn(false);
        $mock->shouldReceive('getMessage')->once()->andReturn('OTP Send Failed');
        $this->app->instance(OTP::class, $mock);

        // Send Request
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['message' => 'OTP Send Failed']);
    }

    // Test Login Method With Valid Data And User Found And OTP Send Success
    public function testLoginMethodWithValidDataAndUserFoundAndOTPSendSuccess()
    {
        // Create User
        $user = $this->createNewUser('123456789', '+971');

        // Mock OTP Send Success
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startSendOTPProcess')->once()->with('+971123456789')->andReturnSelf();
        $mock->shouldReceive('sendIsSuccess')->once()->andReturn(true);
        $mock->shouldReceive('getMessage')->never();
        $this->app->instance(OTP::class, $mock);

        // Send Request
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
        ]);

        // Check Response
        $response->assertSessionDoesntHaveErrors(['message']);
        $response->assertRedirect(route('login.get', ['otp' => 'success', 'mobile' => '123456789', 'country_code' => '+971']));
        $response->assertSessionHas('notification');
        $notification = $response->getSession()->get('notification');
        $this->assertEquals(AuthMessage::$sentOTPToYourMobileSuccessfully, $notification['message']);
        $this->assertEquals('success', $notification['alert-type']);
    }

    // Test Login Method With Valid Data And User Found And OTP Send Success And Request Has action
    public function testLoginMethodWithValidDataAndUserFoundAndOTPSendSuccessAndRequestHasAction()
    {
        // Create User
        $user = $this->createNewUser('123456789', '+971');

        // Mock OTP Send Success
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startSendOTPProcess')->once()->with('+971123456789')->andReturnSelf();
        $mock->shouldReceive('sendIsSuccess')->once()->andReturn(true);
        $mock->shouldReceive('getMessage')->never();
        $this->app->instance(OTP::class, $mock);

        // Send Request
        $response = $this->post(route('login.mobile.post'), [
            'country_code' => '+971',
            'mobile' => '123456789',
            'action' => 'checkout',
        ]);

        // Check Response
        $response->assertSessionDoesntHaveErrors(['message']);
        $response->assertRedirect(route('login.get', ['otp' => 'success', 'mobile' => '123456789', 'country_code' => '+971', 'action' => 'checkout']));
        $response->assertSessionHas('notification');
        $notification = $response->getSession()->get('notification');
        $this->assertEquals(AuthMessage::$sentOTPToYourMobileSuccessfully, $notification['message']);
        $this->assertEquals('success', $notification['alert-type']);
    }
    
}
