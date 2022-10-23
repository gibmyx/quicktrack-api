<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Application\Delete;

final class EmailNotificationDeleterRequest
{
    public function __construct(
        private string $id
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }
}
