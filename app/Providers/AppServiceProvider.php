<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Infrastructure\Persistence\EloquentCarRepository;

class AppServiceProvider extends ServiceProvider
{

    private $wiringObjects = [
        CarRepository::class => EloquentCarRepository::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->wiringObjects as $abstract => $implementation) {
            $this->app->bind($abstract, $implementation);
        }
    }
}
