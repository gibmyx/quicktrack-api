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
            //new CarYear($year),
            CarYear::createFromFormat('Y', $year),
            new CarStatus($status),
            new DateTimeValueObject($createdAt),
            new DateTimeValueObject($updatedAt)
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'code' => $this->code()->value(),
            'brand' => $this->brand()->value(),
            'model' => $this->model()->value(),
            'color' => $this->color()->value(),
            'fuel' => $this->fuel()->value(),
            'gearbox' => $this->gearbox()->value(),
            'kilometer' => $this->kilometer()->value(),
            'price' => $this->price()->value(),
            'type' => $this->type()->value(),
            'year' => $this->year()->value(),
            'status' => $this->status()->value(),
            'createdAt' => $this->createdAt()->value(),
            'updatedAt' => $this->updatedAt()->value(),
        ];
    }

    public function id(): CarId
    {
        return $this->id;
    }

    public function code(): CarCode
    {
        return $this->code;
    }

    public function brand(): CarBrand
    {
        return $this->brand;
    }

    public function model(): CarModel
    {
        return $this->model;
    }

    public function color(): CarColor
    {
        return $this->color;
    }

    public function fuel(): CarFuel
    {
        return $this->fuel;
    }

    public function gearbox(): CarGearbox
    {
        return $this->gearbox;
    }

    public function kilometer(): CarKilometer
    {
        return $this->kilometer;
    }

    public function price(): CarPrice
    {
        return $this->price;
    }

    public function type(): CarType
    {
        return $this->type;
    }

    public function year(): CarYear
    {
        return $this->year;
    }

    public function status(): CarStatus
    {
        return $this->status;
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeValueObject
    {
        return $this->updatedAt;
    }

    public function changeBrand(CarBrand $brand)
    {
        if (! $this->brand->equals($brand)) {
            $this->brand = $brand;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeModel(CarModel $model)
    {
        if (! $this->model->equals($model)) {
            $this->model = $model;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeColor(CarColor $color)
    {
        if (! $this->color->equals($color)) {
            $this->color = $color;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeFuel(CarFuel $fuel)
    {
        if (! $this->fuel->equals($fuel)) {
            $this->fuel = $fuel;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeGearbox(CarGearbox $gearbox)
    {
        if (! $this->gearbox->equals($gearbox)) {
            $this->brgearboxand = $gearbox;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeKilometer(CarKilometer $kilometer)
    {
        if (! $this->kilometer->equals($kilometer)) {
            $this->kilometer = $kilometer;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changePrice(CarPrice $price)
    {
        if (! $this->price->equals($price)) {
            $this->price = $price;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeType(CarType $type)
    {
        if (! $this->type->equals($type)) {
            $this->type = $type;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeYear(CarYear $year)
    {
        if (! $this->year->equals($year)) {
            $this->year = $year;
            $this->updatedAt = new DateTimeValueObject();
        }
    }

    public function changeStatus(CarStatus $status)
    {
        if (! $this->status->equals($status)) {
            $this->status = $status;
            $this->updatedAt = new DateTimeValueObject();
        }
    }
}