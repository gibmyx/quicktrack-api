<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Services;

use Illuminate\Support\ServiceProvider as Service;

use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Infrastructure\Repository\JWTAuthRepository;

use Quicktrack\User\Domain\Contract\UserRepository;
use Quicktrack\User\Infrastructure\Persistence\EloquentUserRepository;

final class DependencyServiceProvider extends Service
{
    private $wiringObjects = [
        AuthRepository::class => JWTAuthRepository::class,
        UserRepository::class => EloquentUserRepository::class,
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
