<?php

declare(strict_types=1);


namespace Quicktrack\EmailNotification\Application\Update;


final class EmailNotificationUpdaterRequest
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }
}
