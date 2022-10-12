<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Domain;

use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryMessage;
use Tests\Unit\Shared\Domain\LongTextMother;

final class EmailHistoryMessageMother
{
    public static function create(string $phone): EmailHistoryMessage
    {
        return new EmailHistoryMessage($phone);
    }

    public static function random()
    {
        return self::create(
            LongTextMother::random()
        );
    }
}
