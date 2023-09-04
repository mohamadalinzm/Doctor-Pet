<?php

namespace User\Traits;

use User\Service\Response\Resource\AdminUserResponse;

trait ServiceFunctionality
{

    public function store($data)
    {
        return $this->UserRepository->save($data);
    }


    public function update($data, $user)
    {
        return $this->UserRepository->update($data, $user);
    }


    public function delete($user)
    {
        $this->UserRepository->delete($user);
    }


    public function fetch($id, $appends = [], $select = [])
    {
        $user = $this->UserRepository->fetch($id, $appends , $select);
        if (! $user) {
            return AdminUserResponse::UserNotFound();
        }

        return $user;
    }


    public function unban($user)
    {
        return $this->UserRepository->unBan($user);
    }


    public function list($limit = 5, $appends = [], $select = [], $storeIds = [])
    {
        return $this->UserRepository->list($limit, $appends, $select, $storeIds);
    }
}