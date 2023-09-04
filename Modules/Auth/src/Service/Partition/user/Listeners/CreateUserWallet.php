<?php
namespace Auth\Service\Partition\user\Listeners;

use App\Repo\WalletRepository;

class CreateUserWallet
{
    public function handle($event)
    {
        WalletRepository::createWallet($event->user->id);
    }
}