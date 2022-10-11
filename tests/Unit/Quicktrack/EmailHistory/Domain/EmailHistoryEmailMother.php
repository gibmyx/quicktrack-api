<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Domain;

use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryEmail;
use Tests\Unit\Shared\Domain\EmailMother;

final class EmailHistoryEmailMother
{
    public static function create(string $email): EmailHistoryEmail
    {
        return new EmailHistoryEmail($email);
    }

    public static function ramdon()
    {
        return self::create(
            EmailMother::random()
        );
    }
}
