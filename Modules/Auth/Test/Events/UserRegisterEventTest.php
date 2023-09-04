<?php

use Auth\Service\Event\UserRegisterEvent;
use Auth\Service\Listeners\CreateUserWallet;
use Illuminate\Support\Facades\Event;
use Tests\TestCaseAuth;

class UserRegisterEventTest extends TestCaseAuth
{
    public function testUserRegisterEvent()
    {
        $user = $this->createNewUser();
        $event = new \Auth\Service\Event\UserRegisterEvent($user);
        $this->assertEquals($user, $event->user);
    }

    // Test UserCreateWallet Listener Attached To UserRegisterEvent 
    public function testUserCreateWalletListenerAttachedToUserRegisterEvent()
    {
        Event::fake();
        Event::assertListening(
            UserRegisterEvent::class,
            CreateUserWallet::class
        );
    }
}
