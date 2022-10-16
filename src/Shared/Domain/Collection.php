<?php

declare(strict_types=1);

namespace Shared\Domain;

use ArrayIterator;
use function Lambdish\Phunctional\each;

abstract class Collection implements \Countable, \IteratorAggregate
{
    public function __construct(
        private array $items
    )
    {
        $this->ensureInstanceOf($this->type(), $items);
    }

    abstract protected function type(): string;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return count($this->items());
    }

    public function each(callable $fn): void
    {
        foreach ($this->items() as $item) {
            $fn($item);
        }
        //each($fn, $this->items());
    }

    protected function items(): array
    {
        return $this->items;
    }

    public function toArray(): array
    {
        return array_map(
            fn($item) => $item->toArray(),
            $this->items
        );
    }

    private function ensureInstanceOf(string $type, array $items)
    {
        foreach ($items as $item) {
            if (! $item instanceof  $type)
                throw new \InvalidArgumentException(
                    sprintf('The object <%s> is not an instance of <%s>', $type, get_class($item))
                );
        }
    }
}
