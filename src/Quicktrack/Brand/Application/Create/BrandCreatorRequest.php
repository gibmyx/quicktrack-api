<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Application\Create;

final class BrandCreatorRequest
{
    public function __construct(
        private string $id,
        private string $value,
        private string $name,
        private string $status
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function status(): string
    {
        return $this->status;
    }
}
