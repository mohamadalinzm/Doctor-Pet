<?php

namespace Specialty;

use Illuminate\Support\ServiceProvider;
use Specialty\Database\Relations\SpecialtyRelation;
use Specialty\Repository\Contracts\SpecialtyRepository;
use Specialty\Repository\EloquentSpecialtyRepository;

class SpecialtyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->defineConfig();
        $this->bingRepository();
    }

    public function boot()
    {
        $this->loadRoutes();
//        $this->loadViews();
        $this->loadRelations();
        $this->loadMigrations();
    }

    public function loadViews()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'specialty_view');
    }

    public function loadRoutes()
    {
//        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
    }

    public function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
    }

    private function loadRelations(): void
    {
        SpecialtyRelation::relations();
    }

    private function defineConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'specialty_config');
    }

    public function bingRepository()
    {

        // If you don't want to use cache, you can use this
        $this->app->singleton(SpecialtyRepository::class, function ($app) {
            return new EloquentSpecialtyRepository();
        });

    }

}
