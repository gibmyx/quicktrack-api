<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Domain\Entity;

use Quicktrack\Brand\Domain\ValueObjects\BrandId;
use Quicktrack\Brand\Domain\ValueObjects\BrandName;
use Quicktrack\Brand\Domain\ValueObjects\BrandStatus;
use Quicktrack\Brand\Domain\ValueObjects\BrandValue;

final class Brand
{
    const STATUS_ACTIVO = 'active';
    const STATUS_INACTIVO = 'inactive';

    private function __construct(
        private BrandId $id,
        private BrandValue $value,
        private BrandName $name,
        private BrandStatus $status
    ) {
    }

    public static function fromPrimitives(
        string $id,
        string $value,
        string $name,
        string $status
    ): self {
        return new self(
            new BrandId($id),
            new BrandValue($value),
            new BrandName($name),
            new BrandStatus($status),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'value' => $this->value->value(),
            'name' => $this->name->value(),
            'status' => $this->status->value(),
        ];
    }

    public function id(): BrandId
    {
        return $this->id;
    }

    public function value(): BrandValue
    {
        return $this->value;
    }

    public function name(): BrandName
    {
        return $this->name;
    }

    public function status(): BrandStatus
    {
        return $this->status;
    }
}
