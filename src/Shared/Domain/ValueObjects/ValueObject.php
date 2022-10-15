<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use Exception;
use Shared\Domain\Errors;

abstract class ValueObject
{
    public function addError(Exception $error): void
    {
        Errors::getInstance()->addError($error);
    }
}
