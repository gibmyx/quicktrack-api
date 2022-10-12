<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Application\Find;

use Quicktrack\EmailHistory\Application\Find\EmailHistoryFinderRequest;

final class EmailHistoryFinderRequestMother
{
    public static function withId(string $id): EmailHistoryFinderRequest
    {
        return new EmailHistoryFinderRequest($id);
    }
}
