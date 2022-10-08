<?php

declare(strict_types=1);

namespace Quicktrack\Car\Domain\Entity;

use Quicktrack\Car\Domain\ValueObjects\CarBrand;
use Quicktrack\Car\Domain\ValueObjects\CarCode;
use Quicktrack\Car\Domain\ValueObjects\CarColor;
use Quicktrack\Car\Domain\ValueObjects\CarFuel;
use Quicktrack\Car\Domain\ValueObjects\CarGearbox;
use Quicktrack\Car\Domain\ValueObjects\CarId;
use Quicktrack\Car\Domain\ValueObjects\CarKilometer;
use Quicktrack\Car\Domain\ValueObjects\CarModel;
use Quicktrack\Car\Domain\ValueObjects\CarPrice;
use Quicktrack\Car\Domain\ValueObjects\CarStatus;
use Quicktrack\Car\Domain\ValueObjects\CarType;
use Quicktrack\Car\Domain\ValueObjects\CarYear;
use Shared\Domain\ValueObjects\DateTimeValueObject;

final class Car
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
    private $createdAt;
    private $updatedAt;

    public function __construct(
        CarId $id,
        CarCode $code,
        CarBrand $brand,
        CarModel $model,
        CarColor $color,
        CarFuel $fuel,
        CarGearbox $gearbox,
        CarKilometer $kilometer,
        CarPrice $price,
        CarType $type,
        CarYear $year,
        CarStatus $status,
        DateTimeValueObject $createdAt,
        DateTimeValueObject $updatedAt
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
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        CarId $id,
        CarCode $code,
        CarBrand $brand,
        CarModel $model,
        CarColor $color,
        CarFuel $fuel,
        CarGearbox $gearbox,
        CarKilometer $kilometer,
        CarPrice $price,
        CarType $type,
        CarYear $year,
        CarStatus $status
    ): self
    {
        return new self(
            $id,
            $code,
            $brand,
            $model,
            $color,
            $fuel,
            $gearbox,
            $kilometer,
            $price,
            $type,
            $year,
            $status,
            new DateTimeValueObject(),
            new DateTimeValueObject()
        );
    }

    public static function fromPrimitives(
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
        string $status,
        string $createdAt,
        string $updatedAt
    ): self
    {
        return new self(
            new CarId($id),
            new CarCode($code),
            new CarBrand($brand),
            new CarModel($model),
            new CarColor($color),
            new CarFuel($fuel),
            new CarGearbox($gearbox),
            new CarKilometer($kilometer),
            new CarPrice($price),
            new CarType($type),
            new CarYear($year),
            new CarStatus($status),
            new DateTimeValueObject($createdAt),
            new DateTimeValueObject($updatedAt)
        );
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'brand' => $this->brand,
            'model' => $this->model,
            'color' => $this->color,
            'fuel' => $this->fuel,
            'gearbox' => $this->gearbox,
            'kilometer' => $this->kilometer,
            'price' => $this->price,
            'type' => $this->type,
            'year' => $this->year,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
/*
    public function id(): OrderId
    {
        return $this->id;
    }

    public function code(): OrderCode
    {
        return $this->code;
    }

    public function total(): OrderTotal
    {
        return $this->total;
    }

    public function tableId(): TableId
    {
        return $this->tableId;
    }

    public function state(): OrderState
    {
        return $this->state;
    }

    public function items(): OrderItems
    {
        return $this->items;
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeValueObject
    {
        return $this->updatedAt;
    }

    public function changeCode(OrderCode $code): void
    {
        if (! $this->code->equals($code)) {
            $this->code = $code;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeTotal(OrderTotal $total): void
    {
        if (! $this->total->equals($total)) {
        $this->total = $total;
        $this->updatedAt = new DateTimeValueObject();
    }
    }

    public function changeTableId(TableId $tableId): void
    {
        if (! $this->tableId->equals($tableId)) {
            $this->tableId = $tableId;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeState(OrderState $state): void
    {
        if (! $this->state->equals($state)) {
            $this->state = $state;
            $this->updatedAt = new DateTimeValueObject();
        }
    }
*/
}