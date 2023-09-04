<?php

namespace Shift\Foundation\Factory;

use Shift\Service\ProfileResponseInterface;
use Shift\Service\Response\Resources\AdminJsonResponse;
use Shift\Service\Response\Resources\AdminWebResponse;
use Shift\Service\Response\Resources\ProfileJsonResponse;
use Shift\Service\Response\Resources\ProfileWebResponse;
use Shift\Service\Response\Resources\ShiftJsonResponse;
use Shift\Service\Response\Resources\ShiftWebResponse;
use Shift\Service\ShiftResponseInterface;
use Shift\Support\Enum\Scope;

class ResponseFactory
{
    public static function factory($scope)
    {
        if (request()->wantsJson() || request()->ajax()) {
            if ($scope == Scope::ADMIN) {
                app()->bind(ShiftResponseInterface::class, AdminJsonResponse::class);
            } elseif ($scope == Scope::SELLER) {
                app()->bind(ShiftResponseInterface::class, ShiftJsonResponse::class);
            }elseif($scope == Scope::CUSTOMER){
                app()->bind(ProfileResponseInterface::class, ProfileJsonResponse::class);
            }
        } else {
            if ($scope == Scope::ADMIN) {
                app()->bind(ShiftResponseInterface::class, AdminWebResponse::class);
            } elseif ($scope == Scope::SELLER) {
                app()->bind(ShiftResponseInterface::class, ShiftWebResponse::class);
            }elseif($scope == Scope::CUSTOMER){
                app()->bind(ProfileResponseInterface::class, ProfileWebResponse::class);
            }
        }

        if ($scope == Scope::CUSTOMER){
            return app(ProfileResponseInterface::class);
        }

        return app(ShiftResponseInterface::class);
    }

}