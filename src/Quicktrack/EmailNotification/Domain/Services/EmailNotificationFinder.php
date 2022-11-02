<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Domain\Services;

use Shared\Domain\Errors;
use Shared\Domain\Exceptions\DomainNotExistsException;
use Quicktrack\EmailNotification\Domain\Entity\EmailNotification;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationId;
use Quicktrack\EmailNotification\Domain\Contract\EmailNotificationRepository;

final class EmailNotificationFinder
{
    public function __construct(
        private EmailNotificationRepository $repository
    ) {
    }

    public function __invoke(
        EmailNotificationId $carId
    ): ?EmailNotification {
        $emailNotification = $this->repository->find($carId);

        if (null === $emailNotification) {
            Errors::getInstance()->addError(
                new DomainNotExistsException("There's not any email with ID {$carId->value()}", 400)
            );
        }

        return $emailNotification;
    }
}
