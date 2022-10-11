<?php

declare(strict_types=1);


namespace Tests\Unit\Quicktrack\EmailHistory\Application\Create;


use Quicktrack\EmailHistory\Application\Create\EmailHistoryCreatorRequest;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryCodeMother;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryEmailMother;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryIdMother;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryMessageMother;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryNameMother;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryPhoneMother;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryTypeMother;

final class EmailHistoryRequestMother
{
    public static function random(): EmailHistoryCreatorRequest
    {
        return new EmailHistoryCreatorRequest(
            EmailHistoryIdMother::ramdon()->value(),
            EmailHistoryCodeMother::ramdon()->value(),
            EmailHistoryNameMother::ramdon()->value(),
            EmailHistoryEmailMother::ramdon()->value(),
            EmailHistoryPhoneMother::ramdon()->value(),
            EmailHistoryMessageMother::ramdon()->value(),
            EmailHistoryTypeMother::ramdon()->value(),
        );
    }
}
