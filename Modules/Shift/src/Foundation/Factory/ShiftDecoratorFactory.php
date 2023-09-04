<?php

namespace Shift\Foundation\Factory;

use Shift\Foundation\Decorator\CacheDecorator;
use Shift\Foundation\Decorator\TransactionDecorator;
use Shift\Foundation\Decorator\TryCatchDecorator;

class ShiftDecoratorFactory
{
    public static function create(array $config)
    {

        $management = (new ShiftManagement());

        if ($config['tryCatch']) {
            $management = new TryCatchDecorator($management);
        }

        if ($config['dbTransaction']) {
            $management = new TransactionDecorator($management);
        }

        if ($config['cache']) {
            $management = new CacheDecorator($management);
        }

        if ($config['tryCatch'] && $config['dbTransaction'] && !$config['cache']) {
            $management = new TryCatchDecorator(new TransactionDecorator($management));
        }

        if ($config['tryCatch'] && $config['cache'] && !$config['dbTransaction']) {
            $management = new TryCatchDecorator(new CacheDecorator($management));
        }

        if ($config['dbTransaction'] && $config['cache'] && !$config['tryCatch']){
            $management = new TransactionDecorator(new CacheDecorator($management));
        }

        if ($config['tryCatch'] && $config['dbTransaction'] && $config['cache']) {
            $management = new TryCatchDecorator(new TransactionDecorator(new CacheDecorator($management)));
        }

        return $management;
    }

}