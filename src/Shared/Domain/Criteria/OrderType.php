<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria;

use Shared\Domain\ValueObjects\StringValueObject;

final class OrderType extends StringValueObject
{
    public const ASC  = 'asc';
    public const DESC = 'desc';
    public const NONE = 'none';

    public function isNone(): bool
    {
        return $this->equals(new OrderType(OrderType::NONE));
    }

    public static function none(): OrderType
    {
        return new OrderType(OrderType::NONE);
    }

    public static function desc(): OrderType
    {
        return new OrderType(OrderType::DESC);
    }

    public static function asc(): OrderType
    {
        return new OrderType(OrderType::ASC);
    }
}
