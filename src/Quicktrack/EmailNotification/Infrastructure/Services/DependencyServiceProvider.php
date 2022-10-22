<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Infrastructure\Services;

use Illuminate\Support\ServiceProvider as Service;

use Quicktrack\EmailNotification\Domain\Contract\EmailNotificationRepository;
use Quicktrack\EmailNotification\Infrastructure\Persistence\EloquentEmailNotificationRepository;

final class DependencyServiceProvider extends Service
{
    private $wiringObjects = [
        EmailNotificationRepository::class => EloquentEmailNotificationRepository::class
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
