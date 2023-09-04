<?php

namespace Wallet;

use Illuminate\Support\ServiceProvider;


class WalletServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__.'/Views', 'wallet_view');
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
//        AppointmentRelation::relations();
    }

    private function defineConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'wallet_config');
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
//        $this->app->singleton(AppointmentRepository::class, function ($app) {
//            return new EloquentAppointmentRepository();
//        });

    }

}
