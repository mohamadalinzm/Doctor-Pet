<?php

use Tests\TestCaseAuth;

class UserShowRegisterFormControllerTest extends TestCaseAuth
{
    // Test Authorize User Not Allowed To Access This Route
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testAuthorizeUserNotAllowedToAccessThisRoute()
    {
        // Login User
        $this->userLogin();

        // Call Route
        $response = $this->get(route('register.get'));

        // Check Response
        $response->assertRedirect('/user/dashboard');
    }

    // Test Show Register Form
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testShowRegisterForm()
    {
        // Call Route
        $response = $this->get(route('register.get'));

        // Check Response
        $response->assertStatus(200);
        $response->assertViewIs('auth_view::user.register');
    }
}
