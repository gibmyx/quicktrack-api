<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Domain\Services;

use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryId;
use Shared\Domain\Exceptions\DomainNotExistsException;

final class EmailHistoryFinder
{
    public function __construct(
        private EmailHistoryRepository $repository
    ) {
    }

    public function __invoke(
        EmailHistoryId $emailHistoryId
    ) {
        $car = $this->repository->find($emailHistoryId);

        if (null === $car) {
            throw new DomainNotExistsException("There's not any car with ID {$emailHistoryId->value()}");
        }

        return $car;
    }
}
