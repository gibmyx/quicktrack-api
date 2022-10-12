<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Domain;

use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryName;
use Tests\Unit\Shared\Domain\NameMother;

final class EmailHistoryNameMother
{
    public static function create(string $name): EmailHistoryName
    {
        return new EmailHistoryName($name);
    }

    public static function random()
    {
        return self::create(
            NameMother::random()
        );
    }
}
