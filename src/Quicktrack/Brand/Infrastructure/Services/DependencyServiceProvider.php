<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Infrastructure\Services;

use Illuminate\Support\ServiceProvider as Service;
use Quicktrack\Brand\Domain\Contract\BrandRepository;
use Quicktrack\Brand\Infrastructure\Persistence\EloquentBrandRepository;


final class DependencyServiceProvider extends Service
{
    private $wiringObjects = [
        BrandRepository::class => EloquentBrandRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {
        foreach ($this->wiringObjects as $abstract => $implementation) {
            $this->app->bind($abstract, $implementation);
        }
    }
}
