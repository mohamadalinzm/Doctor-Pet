<?php

namespace Auth\Foundation\Factory;

use Auth\AuthInterface;
use Auth\Foundation\Driver\AuthAdminDriver;
use Auth\Foundation\Driver\AuthUserDriver;
use Auth\Service\AuthEventInterface;
use Auth\Service\AuthTransformerInterface;
use Auth\Service\Partition\Admin\AuthAdminEventDriver;
use Auth\Service\Partition\admin\Response\AuthAdminResponse;
use Auth\Service\Partition\user\Response\AuthUserResponse;
use Auth\Service\Partition\user\AuthUserTransformerDriver;
use Auth\Service\AuthValidationInterface;
use Auth\Service\Partition\user\AuthUserEventDriver;
use Auth\Service\Partition\Admin\AuthAdminValidationDriver;
use Auth\Service\Partition\user\AuthUserValidationDriver;
use Auth\Service\AuthResponseInterface;
use Auth\Service\Partition\admin\AuthAdminTransformerDriver;

class AuthFactory
{
    private static function getUserBinding()
    {
        return [
            AuthInterface::class => AuthUserDriver::class,
            AuthValidationInterface::class => AuthUserValidationDriver::class,
            AuthEventInterface::class => AuthUserEventDriver::class,
            AuthTransformerInterface::class => AuthUserTransformerDriver::class,
            AuthResponseInterface::class => AuthUserResponse::class,
        ];
    }

    private static function getAdminBinding()
    {
        return [
            AuthInterface::class => AuthAdminDriver::class,
            AuthValidationInterface::class => AuthAdminValidationDriver::class,
            AuthEventInterface::class => AuthAdminEventDriver::class,
            AuthTransformerInterface::class => AuthAdminTransformerDriver::class,
            AuthResponseInterface::class => AuthAdminResponse::class,
        ];
    }

    //----------------------------------------------//

    private static function bind($services)
    {
        foreach ($services as $key => $service) {
            app()->bind($key, $service);
        }
    }


    public static function factory(string $drive)
    {
        if (self::isUser($drive)) {
            return self::installUser();
        }elseif (self::isAdmin($drive)) {
            return self::installAdmin();
        }
        return false;
    }

    private static function installUser()
    {
        $services = self::getUserBinding();
        self::bind($services);
        return (new AuthUserDriver());
    }

    private static function installAdmin()
    {
        $services = self::getAdminBinding();
        self::bind($services);
        return (new AuthAdminDriver());
    }

    private static function isUser(string $drive): bool
    {
        return $drive == 'api/auth/user';
    }

    private static function isAdmin(string $drive): bool
    {
        return $drive == 'api/auth/admin';
    }
}