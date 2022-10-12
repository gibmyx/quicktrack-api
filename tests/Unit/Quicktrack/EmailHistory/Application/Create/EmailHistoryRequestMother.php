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
            EmailHistoryIdMother::random()->value(),
            EmailHistoryCodeMother::random()->value(),
            EmailHistoryNameMother::random()->value(),
            EmailHistoryEmailMother::random()->value(),
            EmailHistoryPhoneMother::random()->value(),
            EmailHistoryMessageMother::random()->value(),
            EmailHistoryTypeMother::random()->value(),
        );
    }

    public static function withEmailInvalid(): EmailHistoryCreatorRequest
    {
        return new EmailHistoryCreatorRequest(
            EmailHistoryIdMother::random()->value(),
            EmailHistoryCodeMother::random()->value(),
            EmailHistoryNameMother::random()->value(),
            EmailHistoryEmailMother::create("text")->value(),
            EmailHistoryPhoneMother::random()->value(),
            EmailHistoryMessageMother::random()->value(),
            EmailHistoryTypeMother::random()->value(),
        );
    }

    public static function withEmptyEmail(): EmailHistoryCreatorRequest
    {
        return new EmailHistoryCreatorRequest(
            EmailHistoryIdMother::random()->value(),
            EmailHistoryCodeMother::random()->value(),
            EmailHistoryNameMother::random()->value(),
            EmailHistoryEmailMother::create('')->value(),
            EmailHistoryPhoneMother::random()->value(),
            EmailHistoryMessageMother::random()->value(),
            EmailHistoryTypeMother::random()->value(),
        );
    }

    public static function withEmptyMessage(): EmailHistoryCreatorRequest
    {
        return new EmailHistoryCreatorRequest(
            EmailHistoryIdMother::random()->value(),
            EmailHistoryCodeMother::random()->value(),
            EmailHistoryNameMother::random()->value(),
            EmailHistoryEmailMother::random()->value(),
            EmailHistoryPhoneMother::random()->value(),
            EmailHistoryMessageMother::create('')->value(),
            EmailHistoryTypeMother::random()->value(),
        );
    }

    public static function withEmptyName(): EmailHistoryCreatorRequest
    {
        return new EmailHistoryCreatorRequest(
            EmailHistoryIdMother::random()->value(),
            EmailHistoryCodeMother::random()->value(),
            EmailHistoryNameMother::create('')->value(),
            EmailHistoryEmailMother::random()->value(),
            EmailHistoryPhoneMother::random()->value(),
            EmailHistoryMessageMother::random()->value(),
            EmailHistoryTypeMother::random()->value(),
        );
    }

    public static function withEmptyPhone(): EmailHistoryCreatorRequest
    {
        return new EmailHistoryCreatorRequest(
            EmailHistoryIdMother::random()->value(),
            EmailHistoryCodeMother::random()->value(),
            EmailHistoryNameMother::random()->value(),
            EmailHistoryEmailMother::random()->value(),
            EmailHistoryPhoneMother::create('')->value(),
            EmailHistoryMessageMother::random()->value(),
            EmailHistoryTypeMother::random()->value(),
        );
    }
}
