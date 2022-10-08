<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Create;

final class CarCreatorRequest
{
    private $id;
    private $code;
    private $brand;
    private $model;
    private $color;
    private $fuel;
    private $gearbox;
    private $kilometer;
    private $price;
    private $type;
    private $year;
    private $status;

    public function __construct(
        string $id,
        string $code,
        string $brand,
        string $model,
        string $color,
        string $fuel,
        string $gearbox,
        float $kilometer,
        float $price,
        string $type,
        string $year,
        string $status
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
        $this->fuel = $fuel;
        $this->gearbox = $gearbox;
        $this->kilometer = $kilometer;
        $this->price = $price;
        $this->type = $type;
        $this->year = $year;
        $this->status = $status;
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