<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Application\Delete;

use Quicktrack\EmailNotification\Domain\Contract\EmailNotificationRepository;
use Quicktrack\EmailNotification\Domain\Services\EmailNotificationFinder;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationId;
use Shared\Domain\Errors;

final class EmailNotificationDeleter
{
    private EmailNotificationFinder $finder;

    public function __construct(
        private EmailNotificationRepository $repository,
    ) {
        $this->finder = new EmailNotificationFinder($repository);
    }

    public function __invoke(EmailNotificationDeleterRequest $request)
    {
        $emailNotification = ($this->finder)(new EmailNotificationId($request->id()));

        if (!Errors::getInstance()->hasErrors()) {
            $this->repository->delete($emailNotification->id());
        }
    }
}
