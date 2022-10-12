<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Domain;

use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryType;
use Tests\Unit\Shared\Domain\NameMother;

final class EmailHistoryTypeMother
{
    public static function create(string $phone): EmailHistoryType
    {
        return new EmailHistoryType($phone);
    }

    public static function random()
    {
        return self::create(
            NameMother::random()
        );
    }
}
