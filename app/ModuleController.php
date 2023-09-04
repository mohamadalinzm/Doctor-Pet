<?php

namespace App;

use App\Http\Controllers\Controller;
use General\Facade\GeneralFacade;
use General\Support\Enum\RouteType;

class ModuleController extends Controller
{

    protected function apiActions(): string
    {
        $this->api();
        return RouteType::Api;
    }

    protected function webActions(): string
    {
        $this->web();
        return RouteType::Web;
    }

    protected function getDriver($guard): string
    {
        return ucfirst(GeneralFacade::getRoleName(auth($guard)->user()));
    }

    protected function route(): string
    {
        if (GeneralFacade::checkApi()) {
            return $this->apiActions();
        }

        return $this->webActions();
    }


    private function api(): void
    {
        $this->middleware('api');
        $this->middleware('jwt');
        auth()->setDefaultDriver('api');
    }


    private function web(): void
    {
        $this->middleware('web');
        auth()->setDefaultDriver('admin');
    }
}