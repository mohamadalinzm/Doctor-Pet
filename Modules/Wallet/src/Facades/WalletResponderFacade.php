<?php

namespace Wallet\Facades;

use Illuminate\Support\Facades\Facade;
use Wallet\Responder\WalletApiResponder;
use Wallet\Responder\WalletWebResponder;

class WalletResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $response = 'Web';

        if (request()->wantsJson()) {
            $response = 'Json';
        }

        return [
                'Json' => WalletApiResponder::class,
                'Web' => WalletWebResponder::class,
            ][$response] ?? WalletApiResponder::class;
    }
}
