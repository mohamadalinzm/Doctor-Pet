<?php

use Tests\TestCaseAuth;
use Auth\Support\AuthMessage;

class UserLogoutControllerTest extends TestCaseAuth
{
        // Test Guest Can not Logout
        public function testGuestCanNotLogout()
        {
            $response = $this->post(route('user.logout'));
            $response->assertStatus(302);
        }
    
        // Test User Can Logout
        public function testUserCanLogout()
        {
            $this->userLogin();
            $response = $this->post(route('user.logout'));
            $response->assertRedirect(route('user.login'));
    
            // Get Session Notification
            $notification = session('notification');
    
            // Assert Notification Type
            $this->assertEquals($notification['alert-type'], 'success');
    
            // Assert Notification Message
            $this->assertEquals($notification['message'], AuthMessage::$logoutSuccess);
    
            // Assert User Logged Out
            $this->assertGuest('user');
        }
}
