<?php

namespace App\Providers;

use Components\CarSegment\Adapters\Infrastructure\Database\EloquentCarOwners;
use Components\CarSegment\Adapters\Infrastructure\Database\EloquentCars;
use Components\CarSegment\Adapters\Infrastructure\Database\EloquentCarTrips;
use Components\CarSegment\Application\Commands\CreateCarTrip\CreateCarTrip;
use Components\CarSegment\Application\Commands\CreateCarTrip\CreateCarTripHandler;
use Components\CarSegment\Application\Commands\CreateCarWithOwner\CreateCarWithOwner;
use Components\CarSegment\Application\Commands\CreateCarWithOwner\CreateCarWithOwnerHandler;
use Components\CarSegment\Application\Commands\RemoveCarOwner\RemoveCarOwner;
use Components\CarSegment\Application\Commands\RemoveCarOwner\RemoveCarOwnerHandler;
use Components\CarSegment\Application\Ports\CarOwnerAssigner;
use Components\CarSegment\Application\Ports\Cars;
use Components\CarSegment\Application\Ports\CarTrips;
use Components\CarSegment\ReadModel\Ports\GetCars;
use Components\CarSegment\ReadModel\Ports\GetCarStatistic;
use Components\CarSegment\ReadModel\Ports\GetCarTrips;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use System\Dispatchers\IlluminateCommandBus;
use System\Messaging\CommandBus;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        Cars::class             => EloquentCars::class,
        GetCars::class          => EloquentCars::class,
        GetCarTrips::class      => EloquentCarTrips::class,
        GetCarStatistic::class  => EloquentCarTrips::class,
        CarOwnerAssigner::class => EloquentCarOwners::class,
        CarTrips::class         => EloquentCarTrips::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->app->singleton(CommandBus::class, IlluminateCommandBus::class);

        $commandBus = resolve(IlluminateCommandBus::class);

        $commandBus->map([
            CreateCarWithOwner::class => CreateCarWithOwnerHandler::class,
            CreateCarTrip::class      => CreateCarTripHandler::class,
            RemoveCarOwner::class     => RemoveCarOwnerHandler::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
