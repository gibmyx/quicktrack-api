<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use DateTimeImmutable;
use Shared\Domain\Exceptions\InvalidDateException;

class DateTimeValueObject
{
    private $date;

    public function __construct(string $date = 'now', ?string $format = null)
    {
        $this->date = $this->setDate($date, $format);
    }

    public static function createFromFormat(string $format, string $dateTime): self
    {
        $dateTimeImmutable = \DateTimeImmutable::createFromFormat($format, $dateTime);

        if (false == $dateTimeImmutable)
            throw new InvalidDateException("The given date time is invalid", 400);

        return new static(
            $dateTimeImmutable->format($format),
            $format
        );
    }

    private function setDate(string $date, ?string $format): string
    {
        try {
            $date = $date != 'now'
                ? (new DateTimeImmutable($date))->format('Y-m-d H:s:i')
                : date('Y-m-d H:s:i');

            $explodedDate = explode('-', $date);

            if (! checkdate(
                (int)$explodedDate[1],
                (int)$explodedDate[2],
                (int)$explodedDate[0]
            ))
                throw new InvalidDateException("The given date time {$date} is invalid", 400);


            if ($format)
                return (new DateTimeImmutable($date))->format($format);
            
            return $date; 
        } catch (\Exception $e) {
            throw new InvalidDateException("The given date time {$date} is invalid", 400);
        }
    }

    public static function now(): self
    {
        $dateTimeImmutable = new \DateTimeImmutable;

        return new static(
            $dateTimeImmutable->format('Y-m-d H:s:i')
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
