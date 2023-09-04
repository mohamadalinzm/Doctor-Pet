<?php

use Tests\TestCaseAuth;
use Auth\Support\AuthMessage;

class AdminLogoutControllerTest extends TestCaseAuth
{
    // Test Guest Can not Logout
    public function testGuestCanNotLogout()
    {
        $response = $this->post(route('admin.logout'));
        $response->assertStatus(302);
    }

    // Test Admin Can Logout
    public function testAdminCanLogout()
    {
        $this->adminLogin();
        $response = $this->post(route('admin.logout'));
        $response->assertRedirect(route('admin.login'));

        // Get Session Notification
        $notification = session('notification');

        // Assert Notification Type
        $this->assertEquals($notification['alert-type'], 'success');

        // Assert Notification Message
        $this->assertEquals($notification['message'], AuthMessage::$logoutSuccess);

        // Assert Admin Logged Out
        $this->assertGuest('admin');
    }
}
