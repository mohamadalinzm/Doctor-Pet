<?php

namespace Auth\Service\Repository;

use App\Models\User;
use Ramsey\Uuid\Uuid;

class AuthRepository
{
    public function findByMobile($mobile, $countryCode = null)
    {
        return User::where('mobile', $mobile)->when($countryCode, function ($query) use ($countryCode) {
            $query->where('country_code', $countryCode);
        })->first();
    }

    public function createUser($mobile,$countryCode,$name,$roleId)
    {
        $user = new User;
        $user->name = $name;
        $user->slug = Uuid::uuid4()->getHex();
        $user->mobile = $mobile;
        $user->country_code = $countryCode;
        $user->hash = Uuid::uuid4()->getHex();
        $user->last_logged_in_as = $roleId;
        $user->role_id = $roleId;
        $user->save();
        return $user;
    }

    public function getAdminByMobile($mobile, $countryCode = "+971")
    {
        return User::where('mobile', $mobile)->where('country_code',$countryCode)->notUser()->first();
    }

    public function getUserRole($user)
    {
        return $user->role->name;
    }
}
