<?php

use App\Models\Wallet;
use Tests\TestCaseAuth;

class CreateUserWalletTest extends TestCaseAuth
{
    public function testCreateUserWallet()
    {
        $user = $this->createNewUser();
        $event = new \Auth\Service\Event\UserRegisterEvent($user);
        $listener = new \Auth\Service\Listeners\CreateUserWallet();
        $listener->handle($event);
        $this->assertEquals(1, Wallet::count());
        $this->assertEquals($user->id, Wallet::first()->user_id);
        $this->assertEquals($user->id, $user->wallet->user_id);
    }


}
