<?php

namespace Wallet\Database\Relations;

use Comment\Models\Comment;
use Wallet\Models\Wallet;
use User\Model\User;

class WalletRelations
{
    public static function relations()
    {

        // Each User Has Many Wallets
        User::resolveRelationUsing('wallet',function ($user){
            return $user->hasOne(Wallet::class);
        });

    }
}
