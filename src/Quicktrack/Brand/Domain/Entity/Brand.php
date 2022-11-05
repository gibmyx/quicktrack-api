<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Domain\Entity;

use Quicktrack\Brand\Domain\ValueObjects\BrandId;
use Quicktrack\Brand\Domain\ValueObjects\BrandName;
use Quicktrack\Brand\Domain\ValueObjects\BrandValue;

final class Brand
{
    private function __construct(
        private BrandId $id,
        private BrandValue $value,
        private BrandName $name
    ) {
    }

    public static function fromPrimitives(
        string $id,
        string $value,
        string $name
    ): self {
        return new self(
            new BrandId($id),
            new BrandValue($value),
            new BrandName($name)
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'value' => $this->value->value(),
            'name' => $this->name->value(),
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
}
