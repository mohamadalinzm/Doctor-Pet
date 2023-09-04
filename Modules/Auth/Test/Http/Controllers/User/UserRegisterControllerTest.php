<?php

use Auth\Service\OTP\Contract\OTP;
use Auth\Support\AuthMessage;
use Tests\TestCaseAuth;

class UserRegisterControllerTest extends TestCaseAuth
{
    // Test Auto Redirect To Dashboard If User Is Logged In
    public function testAutoRedirectToDashboardIfUserIsLoggedIn()
    {
        // Login User
        $this->userLogin();

        // Call Route
        $response = $this->post(route('register.mobile.post'));

        // Check Response
        $response->assertRedirect('/user/dashboard');
    }

    // Test Register With Invalid Data(Name Is Empty)
    public function testRegisterWithInvalidDataNameIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'name' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['name']);
    }

    // Test Register With Invalid Data(Name Is Not Alpha and Space)
    public function testRegisterWithInvalidDataNameIsNotAlphaAndSpace()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'name' => '123',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['name']);
    }

    // Test Register With Invalid Data(Name Max Length Is 50)
    public function testRegisterWithInvalidDataNameMaxLengthIs50()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'name' => str_repeat('a', 51),
        ]);

        // Check Response
        $response->assertSessionHasErrors(['name']);
    }

    // Test Register With Invalid Data(Mobile Is Empty)
    public function testRegisterWithInvalidDataMobileIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'mobile' => '',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Register With Invalid Data(Mobile Is Not Digits)
    public function testRegisterWithInvalidDataMobileIsNotDigits()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'mobile' => '123a',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Register With Invalid Data Mobile Length(Mobile Length Is 9 To 12 )
    public function testRegisterWithInvalidDataMobileLength()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'mobile' => '123456',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['mobile']);

        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'mobile' => '12345678901234',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Register With Invalid Data(Country Code Is Empty)
    public function testRegisterWithInvalidDataCountryCodeIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'country_code' => '',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['country_code']);
    }

    // Test Register With Invalid Data(Country Code Is Not In Allow Country Codes)
    public function testRegisterWithInvalidDataCountryCodeIsNotInAllowCountryCodes()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'country_code' => '123',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['country_code']);
    }

    // Test Register With Invalid Data(Role Is Empty)
    public function testRegisterWithInvalidDataRoleIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'role' => '',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['role']);
    }

    // Test Register With Invalid Data(Role Is Not In Seller And Buyer)
    public function testRegisterWithInvalidDataRoleIsNotInSellerAndBuyer()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'role' => '123',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['role']);
    }

    // Test Register With Invalid Data(Terms Is Empty)
    public function testRegisterWithInvalidDataTermsIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'terms' => '',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['terms']);
    }

    // Test Register With Invalid Data(Terms Is Not Accepted)
    public function testRegisterWithInvalidDataTermsIsNotAccepted()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'terms' => '0',
        ]);
        // Check Response
        $response->assertSessionHasErrors(['terms']);
    }

    // Test Register With Valid Data
    public function testRegisterWithValidData()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'name' => 'test',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
        ]);

        // Check Response
        $response->assertSessionDoesntHaveErrors(['name', 'mobile', 'country_code', 'role', 'terms']);
    }

    // Test Register With Valid Data But Mobile Is Already Exist
    public function testRegisterWithValidDataButMobileIsAlreadyExist()
    {
        // Create User
        $user = $this->createNewUser('123456789', '+971');

        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'name' => 'test',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['message' => AuthMessage::$userExist]);
    }
    // Test Register With Valid Data And Mobile Is Not Exist
    public function testRegisterWithValidDataAndMobileIsNotExist()
    {
        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'name' => 'test',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
        ]);

        // Check Response
        $response->assertSessionDoesntHaveErrors(['name', 'mobile', 'country_code', 'role', 'terms', 'message' => AuthMessage::$userExist]);
    }

    // Test Register With Valid Data And User Not Exists And Send OTP Failed
    public function testRegisterWithValidDataAndUserNotExistsAndSendOTPFailed()
    {
        // Mock Send OTP
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startSendOTPProcess')->once()->with('+971123456789')->andReturnSelf();
        $mock->shouldReceive('sendIsSuccess')->once()->andReturn(false);
        $mock->shouldReceive('getMessage')->once()->andReturn('error');
        $this->app->instance(OTP::class, $mock);

        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'name' => 'test',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['message' => 'error']);
    }

    // Test Register With Valid Data  And User Not Exists And Send OTP Success
    public function testRegisterWithValidDataAndUserNotExistsAndSendOTPSuccess()
    {
        // Mock Send OTP
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startSendOTPProcess')->once()->with('+971123456789')->andReturnSelf();
        $mock->shouldReceive('sendIsSuccess')->once()->andReturn(true);
        $mock->shouldReceive('getMessage')->never();
        $this->app->instance(OTP::class, $mock);

        // Call Route
        $response = $this->post(route('register.mobile.post'), [
            'name' => 'test',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
        ]);

        // Check Response
        $queryString = [
            'otp' => 'success',
            'mobile' => '123456789',
            'country_code' => '+971',
            'name' => 'test',
            'role' => 'seller',
            'terms' => '1',
        ];
        $response->assertRedirect(route('register.get', $queryString));
        $response->assertSessionHas('notification');
        $notification = $response->getSession()->get('notification');
        $this->assertEquals($notification['message'], AuthMessage::$sentOTPToYourMobileSuccessfully);
        $this->assertEquals($notification['alert-type'], 'success');
    }
}
