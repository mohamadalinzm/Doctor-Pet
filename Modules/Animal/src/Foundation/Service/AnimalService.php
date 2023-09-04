<?php

namespace Animal\Foundation\Service;

use Animal\Foundation\Abstraction\AnimalAbstract;
use Animal\Foundation\Driver\Admin;

class AnimalService extends AnimalAbstract
{
    public function admin()
    {
        return new Admin();
    }
}