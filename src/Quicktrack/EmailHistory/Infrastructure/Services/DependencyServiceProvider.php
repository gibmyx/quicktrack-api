<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Infrastructure\Services;

use Illuminate\Support\ServiceProvider as Service;

use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Quicktrack\EmailHistory\Infrastructure\Persistence\EloquentEmailHistoryRepository;

final class DependencyServiceProvider extends Service
{
    private $wiringObjects = [
        EmailHistoryRepository::class => EloquentEmailHistoryRepository::class
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
