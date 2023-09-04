<?php

use Tests\TestCaseAuth;

class AuthGuardTest extends TestCaseAuth
{

    public static function getCurrentUsedGuard()
    {
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
                return $guard;
            }
        }
        return null;
    }
    // when the user login without the guard name, web guard will use as the default guard
    public function test_default_guard_is_web()
    {
        $user = $this->createNewUser();

        // login without the guard name
        auth()->login($user);

        // the default guard is web
        $this->assertEquals('web', $this->getCurrentUsedGuard());
        $this->assertEquals('web', config('auth.defaults.guard'));
    }


    // when the user login with the admin guard name, web guard will use 
    public function test_guard_admin_is_alias_name_for_web()
    {
        $user = $this->createNewUser();

        // login with the admin guard name
        auth('admin')->login($user);

        // web guard will use
        $this->assertEquals('web', $this->getCurrentUsedGuard());
        // admin guard name is alias name for web guard name    
        $this->assertContains('admin', config('auth.guard_alias_names.web'));
    }


    // when the user login with the user guard name, web guard will use
    public function test_guard_user_is_alias_name_for_web()
    {
        $user = $this->createNewUser();

        // login with the user guard name 
        auth('user')->login($user);

        // web guard will use
        $this->assertEquals('web', $this->getCurrentUsedGuard());
        // user guard name is alias name for web guard name        
        $this->assertContains('user', config('auth.guard_alias_names.web'));
    }

    // login using api guard
    public function test_login_using_api_guard()
    {
        $user = $this->createNewUser();

        // login with the api guard name
        auth('api')->login($user);

        // the default guard is api
        $this->assertEquals('api', $this->getCurrentUsedGuard());
    }
}
