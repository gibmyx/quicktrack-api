<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Infrastructure\Persistence;

use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Quicktrack\EmailHistory\Domain\Entity\EmailHistory;
use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryId;
use Quicktrack\EmailHistory\Infrastructure\Eloquent\Models\EmailHistory as ModelsEmailHistory;

final class EloquentEmailHistoryRepository implements EmailHistoryRepository
{
    public function create(EmailHistory $EmailHistory): void
    {
        ModelsEmailHistory::create($EmailHistory->toArray());
    }

    public function update(EmailHistory $EmailHistory): void
    {
        ModelsEmailHistory::update($EmailHistory->toArray());
    }

    public function find(EmailHistoryId $carId): ?EmailHistory
    {
        $modelsEmailHistory = ModelsEmailHistory::find($carId->value());

        if (! $modelsEmailHistory) {
            return null;
        }

        return EmailHistory::fromPrimitives(
            $modelsEmailHistory->id,
            $modelsEmailHistory->code,
            $modelsEmailHistory->name,
            $modelsEmailHistory->email,
            $modelsEmailHistory->phone,
            $modelsEmailHistory->messege,
            $modelsEmailHistory->type,
            $modelsEmailHistory->status,
            $modelsEmailHistory->created_at->format('Y-m-d H:i:s'),
            $modelsEmailHistory->updated_at->format('Y-m-d H:i:s'),
        );
    }

    public function matching(array $filters): array
    {
        return [];
    }
}
