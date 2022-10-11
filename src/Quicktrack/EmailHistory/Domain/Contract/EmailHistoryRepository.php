<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Domain\Contract;

use Quicktrack\EmailHistory\Domain\Entity\EmailHistory;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryId;

interface EmailHistoryRepository
{
    public function create(EmailHistory $car): void;
    public function update(EmailHistory $car): void;
    public function find(EmailHistoryId $carId): ?EmailHistory;
    public function matching(array $filters): array;
}
