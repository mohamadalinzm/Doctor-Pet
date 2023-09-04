<?php

namespace Animal;

use Animal\Database\Relation\AnimalReverseRelation;
use Animal\Foundation\Service\AnimalService;
use Animal\Service\Event\Resource\AnimalCreated;
use Animal\Service\Event\Resource\AnimalCreateListener;
use Animal\Service\Event\Resource\AnimalDeleted;
use Animal\Service\Event\Resource\AnimalDeleteListener;
use Animal\Service\Event\Resource\AnimalUpdated;
use Animal\Service\Event\Resource\AnimalUpdateListener;
use Illuminate\Support\ServiceProvider;

class AnimalServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->defineConfig();
        $this->app->bind(AnimalInterface::class, AnimalService::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/Migration');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/View', 'Animal_view');
        $this->loadRelations();
        $this->loadObservations();
        $this->loadEvents();
    }

    private function loadEvents(): void
    {
        $this->app['events']->listen(AnimalCreated::class, AnimalCreateListener::class);

        $this->app['events']->listen(AnimalUpdated::class, AnimalUpdateListener::class);

        $this->app['events']->listen(AnimalDeleted::class, AnimalDeleteListener::class);

    }

    private function loadObservations(): void
    {

    }

    private function defineConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'Animal_config');
    }

    private function loadRelations(): void
    {
        AnimalReverseRelation::relations();
    }

}
