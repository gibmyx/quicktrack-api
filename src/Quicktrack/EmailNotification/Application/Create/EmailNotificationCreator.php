<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Application\Create;

use Quicktrack\EmailNotification\Domain\Contract\EmailNotificationRepository;
use Quicktrack\EmailNotification\Domain\Entity\EmailNotification;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationEmail;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationId;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationName;
use Shared\Domain\Errors;

final class EmailNotificationCreator
{
    public function __construct(
        private EmailNotificationRepository $repository
    ) {
    }

    public function __invoke(EmailNotificationCreatorRequest $request): void
    {
        $emalNotification = EmailNotification::create(
            new EmailNotificationId($request->id()),
            new EmailNotificationName($request->name()),
            new EmailNotificationEmail($request->email())
        );

        if (!Errors::getInstance()->hasErrors()) {
            $this->repository->save($emalNotification);
        }
    }
}
