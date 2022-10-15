<?php

declare(strict_types=1);

namespace Shared\Domain;

use Exception;

final class Errors
{
    private static $instance;

    private array $errors;

    private function __construct()
    {
        $this->errors = [];
    }

    public static function getInstance(): self
    {
        if (! self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function addError(\Exception $error): void
    {
        $this->errors[] = $error;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function errorsMessage(): array
    {
        return array_map(
            fn(Exception $exception) => $exception->getMessage(),
            $this->errors
        );
    }
}