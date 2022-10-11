<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Domain;

use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryId;
use Tests\Unit\Shared\Domain\UuidMother;

final class EmailHistoryIdMother
{
    public static function create(string $id): EmailHistoryId
    {
        return new EmailHistoryId($id);
    }

    public static function ramdon()
    {
        return self::create(
            UuidMother::random()
        );
    }
}
