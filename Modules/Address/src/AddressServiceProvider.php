<?php

namespace Address;

use Address\Database\Relations\AddressReverseRelation;
use Address\Foundation\Service\AddressService;
use Address\Service\AddressRepositoryInterface;
use Address\Service\Event\Resource\AddressCreated;
use Address\Service\Event\Resource\AddressCreateListener;
use Address\Service\Event\Resource\AddressDeleted;
use Address\Service\Event\Resource\AddressDeleteListener;
use Address\Service\Event\Resource\AddressUpdated;
use Address\Service\Event\Resource\AddressUpdateListener;
use Address\Service\Repository\Resource\AddressRepositoryService;
use Illuminate\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->defineConfig();
        $this->app->bind(AddressInterface::class, AddressService::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/Migration');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/View', 'address_view');
        $this->loadRelations();
        $this->loadObservations();
        $this->loadEvents();
    }

    private function loadEvents(): void
    {
        $this->app['events']->listen(AddressCreated::class, AddressCreateListener::class);

        $this->app['events']->listen(AddressUpdated::class, AddressUpdateListener::class);

        $this->app['events']->listen(AddressDeleted::class, AddressDeleteListener::class);

    }

    private function loadObservations(): void
    {

    }

    private function defineConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'address_config');
    }

    private function loadRelations(): void
    {
        AddressReverseRelation::relations();
    }

}
