<?php

namespace Wallet\Repository;

use Illuminate\Support\Str;
use Wallet\Models\Wallet;
use Wallet\Repository\Contracts\WalletRepository;
use Morilog\Jalali\Jalalian;

class EloquentWalletRepository implements WalletRepository
{


    public function show(Wallet $wallet)
    {
        return $wallet->select(['id','wallet_number','type','title','message','status'])
            ->with(['user','comments'])
            ->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function index($searchTerm = '', $active = null)
    {
        return Wallet::select(['id','wallet_number','type','title','status'])
            ->with(['user'])
            ->search($searchTerm)->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function delete(Wallet $wallet)
    {
        $wallet->delete();
    }

    public function store($data)
    {
        return Wallet::query()->create($data);
    }

    public function update(Wallet $wallet, $data)
    {

        $wallet->update($data);

        return $wallet;
    }

}
