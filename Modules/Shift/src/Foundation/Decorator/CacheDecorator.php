<?php

namespace Shift\Foundation\Decorator;

use Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\Cache;
use Shift\Model\Shift;
use Shift\ShiftInterface;

class CacheDecorator extends Management implements ShiftInterface
{
    protected $service;

    protected CacheManager $cache;

    public function __construct(ShiftInterface $service)
    {
        parent::__construct();
        $cache = resolve(CacheManager::class);
        $this->cache = $cache;
        $this->service = $service;
    }

    public function store($data)
    {
        $Shift = $this->service->store($data);

        $this->cache->forget('Shift.'.$Shift->id);
        $this->cache->forget('Shift.list');
    }


    public function update(array $data, $Shift)
    {
        $this->service->update($data, $Shift);

        $this->cache->forget('Shift.'.$Shift->id);
        $this->cache->forget('Shift.list');
    }


    public function delete(Shift $Shift)
    {
        $this->service->delete($Shift);

        $this->cache->forget('Shift.'.$Shift->id);
        $this->cache->forget('Shift.list');
    }


    public function listing($limit,$appends = [],$select = [])
    {
        return $this->cache(function () {
            return $this->service->listing();
        }, 'Shifts.list');
    }


    public function show(Shift $Shift)
    {
        return $this->cache(function () use ($Shift) {
            return $this->service->show($Shift);
        }, 'Shift.'.$Shift->id);
    }

    protected function cache(callable $callback, $key)
    {
        return Cache::remember($key, 3600, function () use ($callback) {
            return $callback();
        });
    }

    public function fetch(int $id, array $appends = [], array $select = [])
    {
        // TODO: Implement fetch() method.
    }

    public function isShiftHaveAnyStore(int $id)
    {
        // TODO: Implement isShiftHaveAnyStore() method.
    }

    public function isShiftExistInSellerStores(int $id, $stores)
    {
        // TODO: Implement isShiftExistInSellerStores() method.
    }

    public function activation(bool $activation, $Shift)
    {
        // TODO: Implement activation() method.
    }

    public function ban(Shift $Shift)
    {
        // TODO: Implement ban() method.
    }

    public function information()
    {
        // TODO: Implement information() method.
    }

    public function activities($select = [], $appends = [])
    {
        // TODO: Implement activities() method.
    }

    public function isBanned(Shift $Shift)
    {
        // TODO: Implement isBanned() method.
    }

    public function isAlreadyBanned(Shift $Shift)
    {
        // TODO: Implement isAlreadyBanned() method.
    }
}
