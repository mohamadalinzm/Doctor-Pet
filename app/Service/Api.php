<?php

namespace App\Service;

use App\Http\Controllers\Controller;


abstract class Api extends Controller
{

    protected function api()
    {
        auth()->setDefaultDriver('api');
    }

    protected function getPrefix($section = null): ?string
    {
        $prefix = request()->route()->getPrefix();
        if (filled($section)) {
            $sections = explode('/', $prefix);
            $prefix = implode('/', array_slice($sections, 0, $section));
        }

        return $prefix;
    }

    protected function getDriver($user): string
    {
        return ucfirst($this->getRoleName($user));
    }

    protected function setup()
    {
    }

    public function getRoleName($user): string
    {
        if (is_null($user)) {
            return 'guest';
        }
        $role = $user->role;
        if (! $role) {
            return 'guest';
        }

        return $role->name;
    }

}