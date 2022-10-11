<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Domain\ValueObjects;

use Shared\Domain\ValueObjects\StringValueObject;

final class EmailHistoryStatus extends StringValueObject
{
    const STATUS_PENDING = 'pending';
    const STATUS_VIEWED = 'viewed';
    const STATUS_CONTACTED = 'contacted';

    public function __construct(string $value = self::STATUS_PENDING)
    {
        parent::__construct($value);
    }
}
