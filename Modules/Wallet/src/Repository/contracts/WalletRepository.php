<?php

namespace Wallet\Repository\Contracts;

use Wallet\Models\Wallet;

interface WalletRepository
{
    public function show(Wallet $wallet);

    public function index();

    public function delete(Wallet $wallet);

    public function store($data);

    public function update(Wallet $wallet, $data);

}
