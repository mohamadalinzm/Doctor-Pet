<?php

use App\Models\User;
use Auth\Service\Event\UserRegisterEvent;
use Auth\Service\OTP\Contract\OTP;
use Auth\Support\AuthMessage;
use Illuminate\Support\Facades\Event;
use Tests\TestCaseAuth;

class UserRegisterVerifyOTPControllerTest extends TestCaseAuth
{
    // Test Auto Redirect To Dashboard If User Is Logged In
    public function testAutoRedirectToDashboardIfUserIsLoggedIn()
    {
        // Login User
        $this->userLogin();

        // Call Route
        $response = $this->post(route('register.verify-otp.post'));

        // Check Response
        $response->assertRedirect('/user/dashboard');
    }

    // Test Verify OTP With Invalid Data(Name Is Empty)
    public function testVerifyOTPWithInvalidDataNameIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'name' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['name']);
    }

    // Test Verify OTP With Invalid Data(Name Is Not Alpha and Space)
    public function testVerifyOTPWithInvalidDataNameIsNotAlphaAndSpace()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'name' => '123',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['name']);
    }

    // Test Verify OTP With Invalid Data(Name Max Length Is 50)
    public function testVerifyOTPWithInvalidDataNameMaxLengthIs50()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'name' => '123456789012345678901234567890123456789012345678901',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['name']);
    }


    // Test Verify OTP With Invalid Data(Mobile Is Empty)
    public function testVerifyOTPWithInvalidDataMobileIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'mobile' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Verify OTP With Invalid Data(Mobile Is Not Numeric)
    public function testVerifyOTPWithInvalidDataMobileIsNotNumeric()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'mobile' => 'abc',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Verify OTP With Invalid Data(Mobile Length Is Invalid - mobile length must be 9 to 12 digits)
    public function testVerifyOTPWithInvalidDataMobileLengthIsInvalid()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'mobile' => '123456',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);

        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'mobile' => '12345678901234',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['mobile']);
    }

    // Test Verify OTP With Invalid Data(Country Code Is Empty)
    public function testVerifyOTPWithInvalidDataCountryCodeIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'country_code' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['country_code']);
    }

    // Test Verify OTP With Invalid Data(Country Code Is Not In Allow Country Codes)
    public function testVerifyOTPWithInvalidDataCountryCodeIsNotInAllowCountryCodes()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'country_code' => '123',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['country_code']);
    }

    // Test Verify OTP With Invalid Data(Role Is Empty)
    public function testVerifyOTPWithInvalidDataRoleIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'role' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['role']);
    }

    // Test Verify OTP With Invalid Data(Role Is Not In Seller And Buyer)
    public function testVerifyOTPWithInvalidDataRoleIsNotInSellerAndBuyer()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'role' => '123',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['role']);
    }

    // Test Verify OTP With Invalid Data(Terms Is Empty)
    public function testVerifyOTPWithInvalidDataTermsIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'terms' => '',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['terms']);
    }

    // Test Verify OTP With Invalid Data(Terms Is Not Accepted)
    public function testVerifyOTPWithInvalidDataTermsIsNotAccepted()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'terms' => '123',
        ]);

        // Check Response
        $response->assertSessionHasErrors(['terms']);
    }

    // Test Verify OTP With Invalid Data(OTP Is Empty)
    public function testVerifyOTPWithInvalidDataOTPIsEmpty()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'otp' => '',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
            'name' => 'test'
        ]);

        // Check Response
        $response->assertSessionHasErrors(['otp']);
    }

    // Test Verify OTP With Invalid Data(OTP Is Not Numeric)
    public function testVerifyOTPWithInvalidDataOTPIsNotNumeric()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'otp' => 'abc',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
            'name' => 'test'
        ]);

        // Check Response
        $response->assertSessionHasErrors(['otp']);
    }

    // Test Verify OTP With Invalid Data(OTP Min Length Is 6)
    public function testVerifyOTPWithInvalidDataOTPLengthIs6()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'otp' => '12345',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
            'name' => 'test'
        ]);

        // Check Response
        $response->assertSessionHasErrors(['otp']);
    }

    // Test Verify OTP With Invalid Data(OTP Max Length Is 10)
    public function testVerifyOTPWithInvalidDataOTPLengthIs10()
    {
        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'otp' => '12345678901',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
            'name' => 'test'
        ]);

        // Check Response
        $response->assertSessionHasErrors(['otp']);
    }

    // Test Verify OTP With Valid Data But User Mobile Duplicate
    public function testVerifyOTPWithValidDataButUserMobileDuplicate()
    {
        // Create User
        $user = $this->createNewUser('123456789', '+971');

        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'otp' => '123456',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
            'name' => 'test'
        ]);

        // Check Response
        $response->assertSessionHasErrors(['message' => AuthMessage::$userExist]);
    }

    // Test Verify OTP With Valid Data But Verify OTP Failed
    public function testVerifyOTPWithValidDataButVerifyOTPFailed()
    {
        // Mock Verify OTP
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startVerifyOTPProcess')->once()->with('+971123456789', '123456')->andReturnSelf();
        $mock->shouldReceive('verifyIsSuccess')->once()->andReturn(false);
        $mock->shouldReceive('getMessage')->once()->andReturn('Error');
        $this->app->instance(OTP::class, $mock);

        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'otp' => '123456',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
            'name' => 'test'
        ]);

        // Check Response
        $response->assertSessionHasErrors(['message' => 'Error']);
        // Assert User Not Created
        $this->assertEquals(0, User::count());
    }

    // Test Verify OTP With Valid Data But And Verify OTP Success
    public function testVerifyOTPWithValidDataButAndVerifyOTPSuccess()
    {
        // Fake Event
        Event::fake();

        // Mock Verify OTP
        $mock = Mockery::mock(OTP::class);
        $mock->shouldReceive('startVerifyOTPProcess')->once()->with('+971123456789', '123456')->andReturnSelf();
        $mock->shouldReceive('verifyIsSuccess')->once()->andReturn(true);
        $mock->shouldReceive('getMessage')->never();
        $this->app->instance(OTP::class, $mock);

        // Call Route
        $response = $this->post(route('register.verify-otp.post'), [
            'otp' => '123456',
            'mobile' => '123456789',
            'country_code' => '+971',
            'role' => 'seller',
            'terms' => '1',
            'name' => 'test'
        ]);

        // Check Response
        $response->assertSessionHasNoErrors();
        // Assert User Created
        $this->assertEquals(1, User::count());
        // Assert User Created With Correct Data
        $this->assertEquals('test', User::first()->name);
        $this->assertEquals('123456789', User::first()->mobile);
        $this->assertEquals('+971', User::first()->country_code);
        $this->assertEquals('seller', User::first()->role->name);

        // Assert Redirect To user.dashboard
        $response->assertRedirect(route('user.dashboard'));

        // Check Event
        Event::assertDispatched(UserRegisterEvent::class, function ($e) {
            return $e->user->mobile === '123456789';
        });
    }
}
