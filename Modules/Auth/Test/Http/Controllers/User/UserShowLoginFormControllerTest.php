<?php

use Tests\TestCaseAuth;

class UserShowLoginFormControllerTest extends TestCaseAuth
{
    // Test  Guest User Can Access To Login Form
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testGuestUserCanAccessToLoginForm()
    {
        $response = $this->get(route('login.get'));
        $response->assertStatus(200);
        $response->assertViewIs('auth_view::user.login');
    }

    // Test  Authenticated User Can Not Access To Login Form
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testAuthenticatedUserCanNotAccessToLoginForm()
    {
        $this->userLogin();
        $response = $this->get(route('login.get'));
        $response->assertStatus(302);
        $response->assertRedirect(route('user.dashboard'));
    }

    // Test Fake Login with correct secret code and environment is testing(not production) and user login id exists
    public function testFakeLoginWithCorrectSecretCodeAndNotProductionsEnvironmentAndUserLoginIdExists()
    {
        $user = $this->createNewUser();
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => $user->id,
            'jb-auto-login-secret' => config('auth_config.fake_login_secret_code'),
        ]);
        $response = $this->get(route('login.get'));
        $this->assertNotNull(auth()->user());
        $this->assertEquals($user->id, auth()->user()->id);
    }

    // Test Fake Login with correct secret code and environment is testing(not production) and user login id not exists
    public function testFakeLoginWithCorrectSecretCodeAndNotProductionsEnvironmentAndUserLoginIdNotExists()
    {
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => 1000,
            'jb-auto-login-secret' => config('auth_config.fake_login_secret_code'),
        ]);
        $response = $this->get(route('login.get'));
        $this->assertNull(auth()->user());

    }

    // Test Fake Login with correct secret code and environment is production and user login id exists
    public function testFakeLoginWithCorrectSecretCodeAndProductionsEnvironmentAndUserLoginIdExists()
    {
        $user = $this->createNewUser();
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => $user->id,
            'jb-auto-login-secret' => config('auth_config.fake_login_secret_code'),
        ]);
        // set environment to production
        app()->detectEnvironment(function() { return 'production'; });

        $this->get(route('login.get'));
        
        $this->assertNull(auth()->user());
    }

    // Test Fake Login with correct secret code and environment is production and user login id not exists
    public function testFakeLoginWithCorrectSecretCodeAndProductionsEnvironmentAndUserLoginIdNotExists()
    {
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => 1000,
            'jb-auto-login-secret' => config('auth_config.fake_login_secret_code'),
        ]);
        // set environment to production
        app()->detectEnvironment(function() { return 'production'; });

        $this->get(route('login.get'));
        
        $this->assertNull(auth()->user());
    }

    // Test Fake Login with wrong secret code and environment is testing(not production) and user login id exists
    public function testFakeLoginWithWrongSecretCodeAndNotProductionsEnvironmentAndUserLoginIdExists()
    {
        $user = $this->createNewUser();
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => $user->id,
            'jb-auto-login-secret' => 'wrong secret code',
        ]);
        $this->get(route('login.get'));
        $this->assertNull(auth()->user());
    }

    
}
