<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Application\Update;

use Quicktrack\EmailNotification\Domain\Contract\EmailNotificationRepository;
use Quicktrack\EmailNotification\Domain\Services\EmailNotificationFinder;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationEmail;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationId;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationName;
use Shared\Domain\Errors;

final class EmailNotificationUpdater
{
    private EmailNotificationFinder $finder;

    public function __construct(
        private EmailNotificationRepository $repository
    ) {
        $this->finder = new EmailNotificationFinder($repository);
    }

    public function __invoke(EmailNotificationUpdaterRequest $request): void
    {
        $emailNotification = ($this->finder)(new EmailNotificationId($request->id()));

        if (!Errors::getInstance()->hasErrors()) {
            $emailNotification->changeName(new EmailNotificationName($request->name()));
            $emailNotification->changeEmail(new EmailNotificationEmail($request->email()));

            $this->repository->update($emailNotification);
        }
    }
}
