<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Domain\Contract;

use Quicktrack\EmailNotification\Domain\Entity\EmailNotification;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationId;

interface EmailNotificationRepository
{
    public function create(EmailNotification $emailNotification): void;
    public function update(EmailNotification $emailNotification): void;
    public function delete(EmailNotificationId $id): void;
    public function find(EmailNotificationId $id): ?EmailNotification;
    public function matching(array $filters): array;
}
