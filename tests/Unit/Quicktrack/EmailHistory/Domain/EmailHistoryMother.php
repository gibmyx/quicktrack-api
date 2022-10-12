<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Domain;

use Quicktrack\EmailHistory\Application\Create\EmailHistoryCreatorRequest;
use Quicktrack\EmailHistory\Domain\Entity\EmailHistory;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryCode;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryEmail;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryId;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryMessage;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryName;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryPhone;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryType;

final class EmailHistoryMother
{

    public static function create(
        EmailHistoryId $id,
        EmailHistoryCode $code,
        EmailHistoryName $name,
        EmailHistoryEmail $email,
        EmailHistoryPhone $phone,
        EmailHistoryMessage $message,
        EmailHistoryType $type
    ): EmailHistory
    {
        return EmailHistory::create(
            $id,
            $code,
            $name,
            $email,
            $phone,
            $message,
            $type
        );
    }

    public static function random(): EmailHistory
    {
        return self::create(
            EmailHistoryIdMother::random(),
            EmailHistoryCodeMother::random(),
            EmailHistoryNameMother::random(),
            EmailHistoryEmailMother::random(),
            EmailHistoryPhoneMother::random(),
            EmailHistoryMessageMother::random(),
            EmailHistoryTypeMother::random()
        );
    }

    public static function fromRequest(EmailHistoryCreatorRequest $request): EmailHistory
    {
        return self::create(
            EmailHistoryIdMother::create($request->id()),
            EmailHistoryCodeMother::create($request->code()),
            EmailHistoryNameMother::create($request->name()),
            EmailHistoryEmailMother::create($request->email()),
            EmailHistoryPhoneMother::create($request->phone()),
            EmailHistoryMessageMother::create($request->message()),
            EmailHistoryTypeMother::create($request->type())
        );
    }
}
