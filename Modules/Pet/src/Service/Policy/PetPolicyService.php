<?php

namespace Pet\Service\Policy;

use Pet\Service\PetPolicyInterface;

class PetPolicyService implements PetPolicyInterface
{

    public function create($user)
    {
        return true;
    }

    public function delete($user, $Pet)
    {
        //if ($user->id == $Pet->user_id) {
        //    return true;
        //}
        //
        //return false;
        return true;
    }

    public function update($user, $Pet)
    {
        //if ($user->id == $Pet->user_id) {
        //    return true;
        //}
        //
        //return false;
        return true;
    }


    public function restore($user, $Pet)
    {
        // TODO: Implement restore() method.
    }

    public function forceDelete($user, $Pet)
    {
        // TODO: Implement forceDelete() method.
    }

    public function show($user, $Pet)
    {
        //if ($user->id == $Pet->user_id) {
        //    return true;
        //}
        //
        //return false;
        return true;
    }
}
