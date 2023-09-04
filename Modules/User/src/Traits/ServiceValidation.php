<?php

namespace User\Traits;

trait ServiceValidation
{

    public function store($data)
    {
        return $this->UserRepository->save($data);
    }


    public function update($data, $user)
    {
        return $this->UserRepository->update($data, $user);
    }


    public function filter($data, $user)
    {
        return $this->UserRepository->update($data, $user);
    }


}