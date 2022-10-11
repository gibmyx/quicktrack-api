<?php

declare(strict_types=1);


namespace Tests\Unit\Quicktrack\EmailHistory\Domain;


use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryCode;
use Tests\Unit\Shared\Domain\CodeMother;

final class EmailHistoryCodeMother
{
    public static function create(string $code): EmailHistoryCode
    {
        return new EmailHistoryCode($code);
    }

    public static function ramdon()
    {
        return self::create(
            CodeMother::random()
        );
    }
}
