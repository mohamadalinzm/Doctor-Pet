<?php

namespace MedicalCenter;

use Illuminate\Support\ServiceProvider;
use MedicalCenter\Repository\Contracts\MedicalCenterRepository;
use MedicalCenter\Repository\Contracts\MedicalCenterTypeRepository;
use MedicalCenter\Repository\Contracts\ServiceRepository;
use MedicalCenter\Repository\EloquentMedicalCenterRepository;
use MedicalCenter\Repository\EloquentMedicalCenterTypeRepository;
use MedicalCenter\Repository\EloquentServiceRepository;
use MedicalCenter\Database\Relations\MedicalCenterRelation;

class MedicalCenterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->defineConfig();
        $this->bingRepository();
    }

    public function boot()
    {
        $this->loadRoutes();
        $this->loadViews();
        $this->loadRelations();
        $this->loadMigrations();
    }

    public function loadViews()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'medical_center_view');
    }

    public function loadRoutes()
    {
//        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
    }

    public function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    private function loadRelations(): void
    {
        MedicalCenterRelation::relations();
    }

    private function defineConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'medical_center_config');
    }

    public function bingRepository()
    {
        // If you want to use cache, you can use this
        // $this->app->singleton(ProductRepository::class, function ($app) {
        // return new CacheProductRepository(
        //         new EloquentProductRepository()
        //     );
        // });

        // If you don't want to use cache, you can use this
        $this->app->singleton(MedicalCenterRepository::class, function ($app) {
            return new EloquentMedicalCenterRepository();
        });

        $this->app->singleton(MedicalCenterTypeRepository::class, function ($app) {
            return new EloquentMedicalCenterTypeRepository();
        });

        $this->app->singleton(ServiceRepository::class, function ($app) {
            return new EloquentServiceRepository();
        });
    }

}
