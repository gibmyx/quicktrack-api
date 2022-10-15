<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use DateTimeImmutable;
use Error;
use Shared\Domain\Errors;
use Shared\Domain\Exceptions\InvalidDateException;

class DateTimeValueObject extends ValueObject
{
    public function __construct(
        private string $date = 'now', 
        ?string $format = null
    )
    {
        $this->date = $this->setDate($date, $format);
    }

    public static function createFromFormat(string $format, string $dateTime): self
    {
        $dateTimeImmutable = \DateTimeImmutable::createFromFormat($format, $dateTime);

        if (false == $dateTimeImmutable)
            Errors::getInstance()->addError(
                new InvalidDateException("The given date time is invalid", 400)
            );

        return new static(
            $dateTimeImmutable->format($format),
            $format
        );
    }

    private function setDate(string $date, ?string $format): string
    {
        $date = $date != 'now'
            ? (new DateTimeImmutable($date))->format('Y-m-d H:i:s')
            : date('Y-m-d H:i:s');

        $explodedDate = explode('-', $date);

        if (! checkdate(
            (int)$explodedDate[1],
            (int)$explodedDate[2],
            (int)$explodedDate[0]
        ))
            $this->addError(
                new InvalidDateException("The given date time {$date} is invalid", 400)
            );


        if ($format)
            return (new DateTimeImmutable($date))->format($format);
        
        return $date; 
    }

    public static function now(): self
    {
        $dateTimeImmutable = new \DateTimeImmutable;

        return new static(
            $dateTimeImmutable->format('Y-m-d H:i:s')
        );
    }

    public function value(): string
    {
        return $this->date;
    }

    public function equals(self $newValue): bool
    {
        return $this->date === $newValue->value();
    }

    public function format(string $format): string
    {
        $dateTimeImmutable = new \DateTimeImmutable($this->date);

        return $dateTimeImmutable->format($format);
    }

    public function __toString(): string
    {
        return (string)$this->value();
    }
}
