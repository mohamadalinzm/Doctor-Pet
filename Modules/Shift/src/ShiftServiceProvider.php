<?php

namespace Shift;

use Illuminate\Support\ServiceProvider;
use Shift\Database\Relations\ShiftReverseRelation;
use Shift\Service\Event\Resource\ShiftCreated;
use Shift\Service\Event\Resource\ShiftCreateListener;
use Shift\Service\Event\Resource\ShiftDeleted;
use Shift\Service\Event\Resource\ShiftDeleteListener;
use Shift\Service\Event\Resource\ShiftUpdated;
use Shift\Service\Event\Resource\ShiftUpdateListener;
use Shift\Service\Repository\ShiftRepositoryService;
use Shift\Service\ShiftRepositoryInterface;

class ShiftServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->defineConfig();
        $this->app->bind(ShiftRepositoryInterface::class, ShiftRepositoryService::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/Migration');
        $this->loadRoutesFrom(__DIR__.'/Route/routes.php');
        $this->loadViewsFrom(__DIR__.'/View', 'Shift_view');
        $this->loadRelations();
        $this->loadObservations();
        $this->loadEvents();
    }

    private function loadEvents(): void
    {
        $this->app['events']->listen(ShiftCreated::class, ShiftCreateListener::class);

        $this->app['events']->listen(ShiftUpdated::class, ShiftUpdateListener::class);

        $this->app['events']->listen(ShiftDeleted::class, ShiftDeleteListener::class);

    }

    private function loadObservations(): void
    {

    }

    private function defineConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'Shift_config');
    }

    private function loadRelations(): void
    {
        ShiftReverseRelation::relations();
    }

}
