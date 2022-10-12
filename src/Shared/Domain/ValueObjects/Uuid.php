<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use Sys\Shared\Domain\Exceptions\InvalidUuidException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function __construct(private string $uuid)
    {
        $this->ensureIsValidUuid($uuid);
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->uuid;
    }

    public function equals(self $newValue): bool
    {
        return $this->uuid === $newValue->value();
    }

    private function ensureIsValidUuid(string $uuid): void
    {
        if(! RamseyUuid::isValid($uuid)){
            throw new InvalidUuidException(sprintf("<%s> does not allow the value <%s>", static::class, $uuid));
        }
    }
}
