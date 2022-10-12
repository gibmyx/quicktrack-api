<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Create;

final class CarCreatorRequest
{
    public function __construct(
        private string $id,
        private string $code,
        private string $brand,
        private string $model,
        private string $color,
        private string $fuel,
        private string $gearbox,
        private float $kilometer,
        private float $price,
        private string $type,
        private string $year,
        private string $status
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function brand(): string
    {
        return $this->brand;
    }

    public function model(): string
    {
        return $this->model;
    }

    public function color(): string
    {
        return $this->color;
    }

    public function fuel(): string
    {
        return $this->fuel;
    }

    public function gearbox(): string
    {
        return $this->gearbox;
    }

    public function kilometer(): float
    {
        return $this->kilometer;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function year(): string
    {
        return $this->year;
    }

    public function status(): string
    {
        return $this->status;
    }
}