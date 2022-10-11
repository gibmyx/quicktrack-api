<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Infrastructure\Persistence\EloquentCarRepository;
use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Quicktrack\EmailHistory\Infrastructure\Persistence\EloquentEmailHistoryRepository;

class AppServiceProvider extends ServiceProvider
{

    private $wiringObjects = [
        CarRepository::class => EloquentCarRepository::class,
        EmailHistoryRepository::class => EloquentEmailHistoryRepository::class,
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
