<?php

namespace User;

use Illuminate\Support\ServiceProvider;
use User\Database\Relations\UserReverseRelation;
use User\Service\Event\Resource\UserCreated;
use User\Service\Event\Resource\UserDeleted;
use User\Service\Event\Resource\UserUpdated;
use User\Service\Repository\UserRepositoryService;
use User\Service\UserRepositoryInterface;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->defineConfig();
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryService::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/Migration');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/View', 'user_view');
        $this->loadRelations();
        $this->loadObservations();
        $this->loadEvents();
    }

    private function loadEvents(): void
    {
        // Order Submitted By User
        $this->app['events']->listen(UserCreated::class, Create::class);

        // OrderAddExtraTime event
        $this->app['events']->listen(UserUpdated::class, Update::class);

        // OrderApprovedEvent event
        $this->app['events']->listen(UserDeleted::class, Delete::class);

    }

    private function loadObservations(): void
    {
        //OrderItem::observe(OrderItemObserver::class);
        //Order::observe(OrderObserver::class);
    }

    private function defineConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'user_config');
    }

    private function loadRelations(): void
    {
        UserReverseRelation::relations();
    }

    ///**
    // * @return mixed
    // */
    //function getUser()
    //{
    //    return auth()->user()->role->name;
    //}

}
