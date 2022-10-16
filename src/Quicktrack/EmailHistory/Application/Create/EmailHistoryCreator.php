<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Application\Create;

use Quicktrack\EmailHistory\Domain\Entity\EmailHistory;
use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryCode;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryEmail;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryId;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryMessage;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryName;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryPhone;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryType;
use Shared\Domain\Errors;

final class EmailHistoryCreator
{
    public function __construct(
        private EmailHistoryRepository $repository
    ) {
    }

    public function __invoke(EmailHistoryCreatorRequest $request): void
    {
        $emailHistory = EmailHistory::create(
            new EmailHistoryId($request->id()),
            new EmailHistoryCode($request->code()),
            new EmailHistoryName($request->name()),
            new EmailHistoryEmail($request->email()),
            new EmailHistoryPhone($request->phone()),
            new EmailHistoryMessage($request->message()),
            new EmailHistoryType($request->type()),
        );

        if (!Errors::getInstance()->hasErrors()){
            $this->repository->create($emailHistory);
        }
    }
}
