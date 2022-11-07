<?php

declare(strict_types=1);


namespace Quicktrack\EmailNotification\Infrastructure\Persistence;


use Illuminate\Database\Eloquent\Builder;
use Shared\Infrastructure\Persistence\EloquentQueryFilters;

class EloquentQueryEmailNotificationFilters extends EloquentQueryFilters
{
    public function name(string $name): Builder
    {
        return $this->builder->where('emails_notifications.name', 'like', "%{$name}%");
    }
}
