<?php

namespace Animal\Service\Policy;

use Animal\Service\AnimalPolicyInterface;

class AnimalPolicyService implements AnimalPolicyInterface
{

    public function create($user)
    {
        return true;
    }


    public function delete($user, $Animal)
    {
        if ($user->id == $Animal->creator_id) {
            return true;
        }

        return false;
    }


    public function update($user, $Animal)
    {
        if ($user->id == $Animal->creator_id) {
            return true;
        }

        return false;
    }


    public function restore($user, $Animal)
    {
        if ($user->id == $Animal->creator_id) {
            return true;
        }

        return false;
    }


    public function forceDelete($user, $Animal)
    {
        if ($user->id == $Animal->creator_id) {
            return true;
        }

        return false;
    }


    public function show($user, $Animal)
    {
        //if ($user->id == $Animal->user_id) {
        //    return true;
        //}
        //
        //return false;
    }
}
