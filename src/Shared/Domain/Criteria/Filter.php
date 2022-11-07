<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria;

final class Filter
{
    public function __construct(
        private FilterField $field,
        private FilterValue $value
    ) {
    }

    public static function fromValues(array $values): self
    {
        return new self(
            new FilterField($values['field']),
            new FilterValue($values['value'])
        );
    }

    public function field(): FilterField
    {
        return $this->field;
    }

    public function value(): FilterValue
    {
        return $this->value;
    }
}
