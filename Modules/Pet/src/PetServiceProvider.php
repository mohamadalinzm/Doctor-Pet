<?php

namespace Pet;

use Pet\Database\Relations\PetReverseRelation;
use Pet\Foundation\Service\PetService;
use Pet\Service\PetRepositoryInterface;
use Pet\Service\Event\Resource\PetCreated;
use Pet\Service\Event\Resource\PetCreateListener;
use Pet\Service\Event\Resource\PetDeleted;
use Pet\Service\Event\Resource\PetDeleteListener;
use Pet\Service\Event\Resource\PetUpdated;
use Pet\Service\Event\Resource\PetUpdateListener;
use Pet\Service\Repository\Resource\PetRepositoryService;
use Illuminate\Support\ServiceProvider;

class PetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->defineConfig();
        $this->app->bind(PetInterface::class, PetService::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/Migration');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/View', 'Pet_view');
        $this->loadRelations();
        $this->loadObservations();
        $this->loadEvents();
    }

    private function loadEvents(): void
    {
        $this->app['events']->listen(PetCreated::class, PetCreateListener::class);

        $this->app['events']->listen(PetUpdated::class, PetUpdateListener::class);

        $this->app['events']->listen(PetDeleted::class, PetDeleteListener::class);

    }

    private function loadObservations(): void
    {

    }

    private function defineConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'Pet_config');
    }

    private function loadRelations(): void
    {
        PetReverseRelation::relations();
    }

}
