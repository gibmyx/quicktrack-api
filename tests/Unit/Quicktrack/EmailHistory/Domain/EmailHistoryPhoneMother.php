<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Domain;

use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryPhone;
use Tests\Unit\Shared\Domain\NameMother;

final class EmailHistoryPhoneMother
{
    public static function create(string $phone): EmailHistoryPhone
    {
        return new EmailHistoryPhone($phone);
    }

    public static function random()
    {
        return self::create(
            NameMother::random()
        );
    }
}
