<?php

use Tests\TestCaseAuth;

class AdminShowLoginFormControllerTest extends TestCaseAuth
{
    // Test the showLoginForm() method
    public function testShowLoginForm()
    {
        $response = $this->get(route('admin.login'));
        $response->assertStatus(200);
        $response->assertViewIs('auth_view::admin.login');
    }

    // Test Admin Login Form Not Show When Admin Logged In
    public function testAdminLoginFormNotShowWhenAdminLoggedIn()
    {
        $this->adminLogin();
        $response = $this->get(route('admin.login'));
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.dashboard'));
    }

    // Test Fake Login with correct secret code and environment is testing(not production) and admin login id exists
    public function testFakeLoginWithCorrectSecretCodeAndEnvironmentIsTestingAndAdminLoginIdExists()
    {
        $admin = $this->createNewAdmin();
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => $admin->id,
            'jb-auto-login-secret' => config('auth_config.fake_login_secret_code'),
        ]);
        $this->get(route('admin.login'));
        $this->assertNotNull(auth('admin')->user());
        $this->assertEquals($admin->id, auth('admin')->user()->id);
    }

    // Test Fake Login with correct secret code and environment is testing(not production) and admin login id not exists
    public function testFakeLoginWithCorrectSecretCodeAndEnvironmentIsTestingAndAdminLoginIdNotExists()
    {
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => 999999999,
            'jb-auto-login-secret' => config('auth_config.fake_login_secret_code'),
        ]);
        $this->get(route('admin.login'));
        $this->assertNull(auth('admin')->user());
    }

    // Test Fake Login with correct secret code and environment is production and admin login id exists
    public function testFakeLoginWithCorrectSecretCodeAndEnvironmentIsProductionAndAdminLoginIdExists()
    {
        $admin = $this->createNewAdmin();
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => $admin->id,
            'jb-auto-login-secret' => config('auth_config.fake_login_secret_code'),
        ]);

        // set environment to production
        app()->detectEnvironment(function() { return 'production'; });

        $this->get(route('admin.login'));
        $this->assertNull(auth('admin')->user());
    }

    // Test Fake Login with correct secret code and environment is production and admin login id not exists
    public function testFakeLoginWithCorrectSecretCodeAndEnvironmentIsProductionAndAdminLoginIdNotExists()
    {
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => 999999999,
            'jb-auto-login-secret' => config('auth_config.fake_login_secret_code'),
        ]);

        // set environment to production
        app()->detectEnvironment(function() { return 'production'; });

        $this->get(route('admin.login'));
        $this->assertNull(auth('admin')->user());
    }

    // Test Fake Login with wrong secret code and environment is testing(not production) and admin login id exists
    public function testFakeLoginWithWrongSecretCodeAndEnvironmentIsTestingAndAdminLoginIdExists()
    {
        $admin = $this->createNewAdmin();
        // set request headers jb-auto-login-id and jb-auto-login-secret
        $this->withHeaders([
            'jb-auto-login-id' => $admin->id,
            'jb-auto-login-secret' => 'wrong secret code',
        ]);
        $this->get(route('admin.login'));
        $this->assertNull(auth('admin')->user());
    }
}