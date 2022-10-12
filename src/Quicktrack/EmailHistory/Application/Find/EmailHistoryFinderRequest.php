<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Application\Find;

final class EmailHistoryFinderRequest
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
