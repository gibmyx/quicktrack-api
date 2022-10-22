<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Infrastructure\Persistence;

use Quicktrack\EmailNotification\Domain\Entity\EmailNotification;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationId;
use Quicktrack\EmailNotification\Domain\Contract\EmailNotificationRepository;
use Quicktrack\EmailNotification\Infrastructure\Eloquent\Models\EmailNotification as ModelsEmailNotification;

final class EloquentEmailNotificationRepository implements EmailNotificationRepository
{
    public function save(EmailNotification $emailNotification): void
    {
        ModelsEmailNotification::updateOrCreate(
            ['id' => $emailNotification->id()->value()],
            $emailNotification->toArray()
        );
    }

    public function delete(EmailNotificationId $id): void
    {
        ModelsEmailNotification::where('id', $id->value())->delete();
    }

    public function find(EmailNotificationId $id): ?EmailNotification
    {
        $modelsEmailNotification = ModelsEmailNotification::find($id->value());

        if (!$modelsEmailNotification) {
            return null;
        }

        return EmailNotification::fromPrimitives(
            $modelsEmailNotification->id,
            $modelsEmailNotification->name,
            $modelsEmailNotification->email,
            $modelsEmailNotification->created_at->format('Y-m-d H:i:s'),
            $modelsEmailNotification->updated_at->format('Y-m-d H:i:s')
        );
    }

    public function matching(array $filters): array
    {
        return [];
    }
}
