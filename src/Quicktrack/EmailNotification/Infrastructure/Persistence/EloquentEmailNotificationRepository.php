<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Infrastructure\Persistence;

use Quicktrack\Car\Infrastructure\Persistence\EloquentQueryCarFilters;
use Quicktrack\EmailNotification\Domain\Collection\EmailsNotification;
use Quicktrack\EmailNotification\Domain\Entity\EmailNotification;
use Quicktrack\EmailNotification\Domain\ValueObjects\EmailNotificationId;
use Quicktrack\EmailNotification\Domain\Contract\EmailNotificationRepository;
use Quicktrack\EmailNotification\Infrastructure\Eloquent\Models\EmailNotification as ModelsEmailNotification;
use Shared\Domain\Criteria\Criteria;
use function Lambdish\Phunctional\map;

final class EloquentEmailNotificationRepository extends EloquentQueryEmailNotificationFilters implements EmailNotificationRepository
{
    public function create(EmailNotification $emailNotification): void
    {
        ModelsEmailNotification::create($emailNotification->toArray());
    }

    public function update(EmailNotification $emailNotification): void
    {
        $emailNotificationModel = ModelsEmailNotification::find($emailNotification->id()->value());

        if ($emailNotificationModel) {
            $emailNotificationModel->update($emailNotification->toArray());
        }
    }

    public function delete(EmailNotificationId $id): void
    {
        $emailNotificationModel = ModelsEmailNotification::find($id->value());

        if ($emailNotificationModel) {
            $emailNotificationModel->delete();
        }
    }

    public function find(EmailNotificationId $id): ?EmailNotification
    {
        $modelsEmailNotification = ModelsEmailNotification::find($id->value());

        if (!$modelsEmailNotification) {
            return null;
        }

        return $this->toEntity($modelsEmailNotification);
    }

    public function matching(Criteria $criteria): EmailsNotification
    {
        $query = $this->apply(ModelsEmailNotification::query(), $criteria);

        if ($criteria->hasOrder()) {
            $query->orderBy(
                $criteria->order()->orderBy()->value(),
                $criteria->order()->orderType()->value()
            );
        }

        $emails = $criteria->limit()
            ? $query->paginate($criteria->limit())
            : $query->get();

        return new EmailsNotification(
            map($this->toEachEntity(), $criteria->limit() ? $emails->items() : $query->get()),
            $criteria->limit() ? $emails->currentPage() : null,
            $criteria->limit() ? $emails->lastPage() : null,
            $criteria->limit() ? $emails->total() : null
        );
    }

    private function toEntity(ModelsEmailNotification $modelsEmailNotification): EmailNotification
    {
        return EmailNotification::fromPrimitives(
            $modelsEmailNotification->id,
            $modelsEmailNotification->name,
            $modelsEmailNotification->email,
            $modelsEmailNotification->created_at->format('Y-m-d H:i:s'),
            $modelsEmailNotification->updated_at->format('Y-m-d H:i:s')
        );
    }

    private function toEachEntity(): callable
    {
        return function (ModelsEmailNotification $modelsEmailNotification) {
            return $this->toEntity($modelsEmailNotification);
        };
    }
}
