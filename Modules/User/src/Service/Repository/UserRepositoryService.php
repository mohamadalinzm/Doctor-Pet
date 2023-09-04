<?php

namespace User\Service\Repository;


use User\Model\User;
use User\Service\UserRepositoryInterface;

class UserRepositoryService implements UserRepositoryInterface
{
    public function store($data)
    {
        return User::query()->create($data);
    }

    public function fetch($id, $append = [])
    {
        return User::query()->where('id', $id)->with($append)->first();
    }

    public function fetchUserByMobile($mobile)
    {
        return User::query()->where('mobile',$mobile)->first();
    }

    public function delete($user)
    {
        return $user->delete();
    }

    public function update($data, $user)
    {
        return $user->update($data);
    }

    public function list($limit = 10 , $appends = [])
    {
        return User::query()->select('*')
                            ->with($appends)
                            ->limit($limit)
                            ->orderBy('created_at', 'desc')->get();
    }

    public function create($data)
    {
        return User::query()->create($data);
    }

    public function information()
    {
        // TODO: Implement information() method.
    }
}
